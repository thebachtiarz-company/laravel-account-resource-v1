<?php

namespace TheBachtiarz\AccountResource\Services;

use TheBachtiarz\AccountResource\Interfaces\Model\Data\AccountResourceDataInterface;
use TheBachtiarz\AccountResource\Models\AccountResource;

class AccountResourceService extends AbstractService
{
    //

    // ? Public Methods
    /**
     * Create new resource
     *
     * @param AccountResourceDataInterface $accountResourceDataInterface
     * @return array
     */
    public function createNewResource(AccountResourceDataInterface $accountResourceDataInterface): array
    {
        $this->accountResourceDataInterface = $accountResourceDataInterface;

        if (!$this->curlResolverData) {
            $this->createResourceOrigin($accountResourceDataInterface);
        }

        return $this->createOrUpdateResourceByCode($this->curlResolverData->getData('code'));
    }

    /**
     * Create new resource.
     *
     * Without save into database.
     *
     * @param AccountResourceDataInterface $accountResourceDataInterface
     * @return array
     */
    public function createResourceOrigin(AccountResourceDataInterface $accountResourceDataInterface): array
    {
        $this->accountResourceDataInterface = $accountResourceDataInterface;

        $this->curlResolverData = $this->accountCreateService->execute($accountResourceDataInterface->getData());

        throw_if(!$this->curlResolverData->getStatus(), 'Exception', $this->curlResolverData->getMessage());

        return $this->curlResolverData->getData();
    }

    /**
     * Create or update resource by existing code
     *
     * @param string $resourceCode
     * @return array
     */
    public function createOrUpdateResourceByCode(string $resourceCode): array
    {
        if (!$this->curlResolverData) {
            $this->curlResolverData = $this->accountDetailService->execute(['code' => $resourceCode]);
        }

        throw_if(!$this->curlResolverData->getStatus(), 'Exception', $this->curlResolverData->getMessage());

        /**
         * Get name from current biodata, and set into identifier
         */
        $_currentBiodata = array_filter($this->curlResolverData->getData('biodatas'), fn ($biodata): bool => $biodata['type'] === '1');
        $this->accountResourceDataInterface->setName(end($_currentBiodata)['attributes']['name'] ?? '');

        try {
            /**
             * Update if exist
             */
            $_accountResource = $this->accountResourceRepository->getByCode($resourceCode);

            $_accountResource->setIdentifier($this->accountResourceDataInterface->getName());
            $_accountResource->setValue($this->resourceHelper->encryptBiodata($this->curlResolverData->getData('biodatas')));

            $this->accountResourceInterface = $this->accountResourceRepository->save($_accountResource);
        } catch (\Throwable $th) {
            /**
             * Create new record
             */
            $_accountResourcePrepare = (new AccountResource)
                ->setCode($this->curlResolverData->getData('code'))
                ->setIdentifier($this->accountResourceDataInterface->getName())
                ->setValue($this->resourceHelper->encryptBiodata($this->curlResolverData->getData('biodatas')));

            $this->accountResourceInterface = $this->accountResourceRepository->create($_accountResourcePrepare);
        }

        return $this->getResourceDetail($this->accountResourceInterface->getCode(), true);
    }

    /**
     * Get resource detail
     *
     * @param string $resourceCode
     * @param boolean $onlyLatest default: false
     * @param boolean $withSync default: false
     * @return array
     */
    public function getResourceDetail(string $resourceCode, bool $onlyLatest = false, bool $withSync = false): array
    {
        try {
            if ($withSync) throw new \Exception("Apply syncronize");

            if (!$this->accountResourceInterface) {
                $this->accountResourceInterface = $this->accountResourceRepository->getByCode($resourceCode);
            }
        } catch (\Throwable $th) {
            $this->createOrUpdateResourceByCode($resourceCode);
        }

        return $this->resourceHelper->biodataResolver($this->accountResourceInterface->getValue(), $onlyLatest);
    }

    /**
     * Get current biodata from repository.
     *
     * Get from service if not exist.
     *
     * @param string $resourceCode
     * @param boolean $withSync default: false
     * @return array
     */
    public function getCurrentBiodata(string $resourceCode, bool $withSync = false): array
    {
        try {
            if ($withSync) throw new \Exception("Apply syncronize");

            $this->accountResourceInterface = $this->accountResourceRepository->getByCode($resourceCode);

            return $this->getResourceDetail($resourceCode, true);
        } catch (\Throwable $th) {
            return $this->createOrUpdateResourceByCode($resourceCode);
        }
    }

    /**
     * Create a new or update current biodata in current account resource
     *
     * @param AccountResourceDataInterface $accountResourceDataInterface
     * @param boolean $isNewBiodata default: false
     * @return array
     */
    public function createOrUpdateCurrentBiodata(
        AccountResourceDataInterface $accountResourceDataInterface,
        bool $isNewBiodata = false
    ): array {
        $this->getResourceDetail($accountResourceDataInterface->getData('code'));

        $this->accountResourceDataInterface = $accountResourceDataInterface;

        /** @var \TheBachtiarz\AccountResource\Interfaces\Library\LibraryServiceInterface $_biodataService */
        $_biodataService = $isNewBiodata ? $this->biodataCreateService : $this->biodataUpdateService;

        $this->curlResolverData = $_biodataService->execute($accountResourceDataInterface->getData());

        throw_if(!$this->curlResolverData->getStatus(), 'Exception', $this->curlResolverData->getMessage());

        $this->curlResolverData = null;

        $this->createOrUpdateResourceByCode($accountResourceDataInterface->getData('code'));

        return $this->getResourceDetail($accountResourceDataInterface->getData('code'), true);
    }

    // ? Private Methods

    // ? Setter Modules
}
