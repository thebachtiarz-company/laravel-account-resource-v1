<?php

namespace TheBachtiarz\AccountResource\Services;

use TheBachtiarz\AccountResource\Interfaces\Model\AccountResourceInterface;
use TheBachtiarz\AccountResource\Models\AccountResource;

class ResourceSyncronizeService extends AccountResourceService
{
    //

    private const RESOURCE_SYNC_FAILED_COUNT = 3;

    /**
     * Account Resource Interface
     *
     * @var array<AccountResourceInterface>|null
     */
    private ?array $accountResourceInterfaces = null;

    /**
     * Failed count from resource sync
     *
     * @var array
     */
    private array $failedResourceSyncCount = [];

    // ? Public Methods
    /**
     * Do account resource syncronize process
     *
     * @return boolean
     */
    public function execute(): bool
    {
        do {
            /** @var AccountResourceInterface $resource */
            foreach ($this->accountResourceInterfaces ?? AccountResource::all() ?? [] as $key => $resource) {
                $this->curlResolverData = $this->accountDetailService->execute(['code' => $resource->getCode()]);

                if ($this->curlResolverData->getStatus()) {
                    $this->createOrUpdateResourceByCode($resource->getCode());

                    $this->deleteAccountResourceCache($resource);
                } else {
                    if (@$this->accountResourceInterfaces[$resource->getId()]) {
                        $this->failedResourceSyncCount[$resource->getId()]++;
                    } else {
                        $this->failedResourceSyncCount[$resource->getId()] = 1;
                    }

                    $this->accountResourceInterfaces[$resource->getId()] = $resource;

                    if ($this->failedResourceSyncCount[$resource->getId()] >= self::RESOURCE_SYNC_FAILED_COUNT) {
                        $this->deleteAccountResourceCache($resource);
                    }
                }
            }
        } while (count($this->accountResourceInterfaces));

        return true;
    }

    // ? Private Methods
    /**
     * Delete cache account resoource
     *
     * @param AccountResourceInterface $accountResourceInterface
     * @return void
     */
    private function deleteAccountResourceCache(AccountResourceInterface $accountResourceInterface): void
    {
        $this->accountResourceInterfaces = array_filter(
            $this->accountResourceInterfaces ?? [],
            fn ($resource): bool => $resource->getId() !== $accountResourceInterface->getId()
        );
    }

    // ? Setter Modules
}
