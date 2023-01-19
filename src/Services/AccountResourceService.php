<?php

namespace TheBachtiarz\AccountResource\Services;

use TheBachtiarz\AccountResource\Interfaces\Model\Data\AccountResourceDataInterface;
use TheBachtiarz\AccountResource\Models\AccountResource;
use TheBachtiarz\AccountResource\Repositories\AccountResourceRepository;

class AccountResourceService
{
    //

    /**
     * Account Resource Repository
     *
     * @var AccountResourceRepository
     */
    protected AccountResourceRepository $accountResourceRepository;

    public function __construct(
        AccountResourceRepository $accountResourceRepository
    ) {
        $this->accountResourceRepository = $accountResourceRepository;
    }

    // ? Public Methods
    public function createNewResource(AccountResourceDataInterface $accountResourceDataInterface): AccountResource
    {
        // process to send new account resource into account service

        $_accountResourcePrepare = (new AccountResource)
            ->setCode('')
            ->setIdentifier($accountResourceDataInterface->getName())
            ->setValue('');

        return $this->accountResourceRepository->create($_accountResourcePrepare);
    }

    // ? Private Methods

    // ? Setter Modules
}
