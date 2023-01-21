<?php

namespace TheBachtiarz\AccountResource\Services;

use TheBachtiarz\AccountResource\Helpers\ResourceHelper;
use TheBachtiarz\AccountResource\Interfaces\Model\AccountResourceInterface;
use TheBachtiarz\AccountResource\Interfaces\Model\Data\AccountResourceDataInterface;
use TheBachtiarz\AccountResource\Libraries\AccountCreateService;
use TheBachtiarz\AccountResource\Libraries\AccountDetailService;
use TheBachtiarz\AccountResource\Libraries\BiodataCreateService;
use TheBachtiarz\AccountResource\Libraries\BiodataCurrentService;
use TheBachtiarz\AccountResource\Libraries\BiodataUpdateService;
use TheBachtiarz\AccountResource\Models\Data\AccountResourceData;
use TheBachtiarz\AccountResource\Repositories\AccountResourceRepository;
use TheBachtiarz\Toolkit\Helper\Curl\Data\CurlResolverData;

abstract class AbstractService
{
    //

    /**
     * Account Resource Data Interface
     *
     * @var AccountResourceDataInterface
     */
    protected AccountResourceDataInterface $accountResourceDataInterface;

    /**
     * Curl Resolver Data
     *
     * @var CurlResolverData|null
     */
    protected ?CurlResolverData $curlResolverData = null;

    /**
     * Account Resource Interface
     *
     * @var AccountResourceInterface|null
     */
    protected ?AccountResourceInterface $accountResourceInterface = null;

    /**
     * Constructor
     *
     * @param AccountResourceRepository $accountResourceRepository
     * @param AccountCreateService $accountCreateService
     * @param AccountDetailService $accountDetailService
     * @param BiodataCreateService $biodataCreateService
     * @param BiodataCurrentService $biodataCurrentService
     * @param BiodataUpdateService $biodataUpdateService
     * @param ResourceHelper $resourceHelper
     */
    public function __construct(
        protected AccountResourceRepository $accountResourceRepository,
        protected AccountCreateService $accountCreateService,
        protected AccountDetailService $accountDetailService,
        protected BiodataCreateService $biodataCreateService,
        protected BiodataCurrentService $biodataCurrentService,
        protected BiodataUpdateService $biodataUpdateService,
        protected ResourceHelper $resourceHelper
    ) {
        $this->accountResourceRepository = $accountResourceRepository;
        $this->accountCreateService = $accountCreateService;
        $this->accountDetailService = $accountDetailService;
        $this->biodataCreateService = $biodataCreateService;
        $this->biodataCurrentService = $biodataCurrentService;
        $this->biodataUpdateService = $biodataUpdateService;
        $this->resourceHelper = $resourceHelper;
        $this->accountResourceDataInterface = new AccountResourceData;
    }
}
