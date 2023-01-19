<?php

namespace TheBachtiarz\AccountResource\Services;

use TheBachtiarz\AccountResource\Helpers\ResourceHelper;
use TheBachtiarz\AccountResource\Interfaces\Model\AccountResourceInterface;
use TheBachtiarz\AccountResource\Interfaces\Model\Data\AccountResourceDataInterface;
use TheBachtiarz\AccountResource\Libraries\AccountCreateService;
use TheBachtiarz\AccountResource\Libraries\AccountDetailService;
use TheBachtiarz\AccountResource\Models\AccountResource;
use TheBachtiarz\AccountResource\Repositories\AccountResourceRepository;
use TheBachtiarz\Toolkit\Helper\Curl\Data\CurlResolverData;

class AccountResourceService
{
    //

    /**
     * Account Resource Data Interface
     *
     * @var AccountResourceDataInterface|null
     */
    private ?AccountResourceDataInterface $accountResourceDataInterface = null;

    /**
     * Curl Resolver Data
     *
     * @var CurlResolverData|null
     */
    private ?CurlResolverData $curlResolverData = null;

    /**
     * Account Resource Interface
     *
     * @var AccountResourceInterface|null
     */
    private ?AccountResourceInterface $accountResourceInterface = null;

    /**
     * Constructor
     *
     * @param AccountResourceRepository $accountResourceRepository
     * @param AccountCreateService $accountCreateService
     * @param AccountDetailService $accountDetailService
     * @param ResourceHelper $resourceHelper
     */
    public function __construct(
        protected AccountResourceRepository $accountResourceRepository,
        protected AccountCreateService $accountCreateService,
        protected AccountDetailService $accountDetailService,
        protected ResourceHelper $resourceHelper
    ) {
        $this->accountResourceRepository = $accountResourceRepository;
        $this->accountCreateService = $accountCreateService;
        $this->accountDetailService = $accountDetailService;
        $this->resourceHelper = $resourceHelper;
    }

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

        return $this->createResourceByCode($this->curlResolverData->getData('code'));
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
     * Create resource by existing code
     *
     * @param string $resourceCode
     * @return array
     */
    public function createResourceByCode(string $resourceCode): array
    {
        if (!$this->curlResolverData) {
            $this->curlResolverData = $this->accountDetailService->execute(['code' => $resourceCode]);
        }

        $_accountResourcePrepare = (new AccountResource)
            ->setCode($this->curlResolverData->getData('code'))
            ->setIdentifier($this->accountResourceDataInterface->getName())
            ->setValue($this->resourceHelper->encryptBiodata($this->curlResolverData->getData('biodatas')));

        $this->accountResourceInterface = $this->accountResourceRepository->create($_accountResourcePrepare);

        return $this->getResourceDetail($this->accountResourceInterface->getCode(), true);
    }

    /**
     * Get resource detail
     *
     * @param string $resourceCode
     * @param boolean $onlyLatest
     * @return array
     */
    public function getResourceDetail(string $resourceCode, bool $onlyLatest = false): array
    {
        if (!$this->accountResourceInterface) {
            $this->accountResourceInterface = $this->accountResourceRepository->getByCode($resourceCode);
        }

        return $this->resourceHelper->biodataResolver($this->accountResourceInterface->getValue(), $onlyLatest);
    }

    // ? Private Methods

    // ? Setter Modules
}
