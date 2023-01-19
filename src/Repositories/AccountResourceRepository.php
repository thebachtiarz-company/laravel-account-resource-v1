<?php

namespace TheBachtiarz\AccountResource\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use TheBachtiarz\AccountResource\Interfaces\Model\AccountResourceInterface;
use TheBachtiarz\AccountResource\Models\AccountResource;

class AccountResourceRepository extends AbstractRepositories
{
    //

    // ? Public Methods
    /**
     * Get resource by id
     *
     * @param integer $id
     * @return AccountResourceInterface
     */
    public function getById(int $id): AccountResourceInterface
    {
        $_accountResource = AccountResource::find($id);

        if (!$_accountResource) throw new ModelNotFoundException("Resource with id '$id' not found");

        return $_accountResource;
    }

    /**
     * Get resource by code
     *
     * @param string $code
     * @return AccountResourceInterface
     */
    public function getByCode(string $code): AccountResourceInterface
    {
        $_accountResource = AccountResource::getByCode($code)->first();

        if (!$_accountResource) throw new ModelNotFoundException("Resource with code '$code' not found");

        return $_accountResource;
    }

    /**
     * Create new resource
     *
     * @param AccountResourceInterface $accountResourceInterface
     * @return AccountResource
     */
    public function create(AccountResourceInterface $accountResourceInterface): AccountResourceInterface
    {
        /** @var AccountResource $accountResourceInterface */

        /** @var AccountResource $_create */
        $_create = $this->createFromModel($accountResourceInterface);

        if (!$_create) throw new ModelNotFoundException("Failed to create new resource");

        return $_create;
    }

    /**
     * Update current resource
     *
     * @param AccountResourceInterface $accountResourceInterface
     * @return AccountResourceInterface
     */
    public function save(AccountResourceInterface $accountResourceInterface): AccountResourceInterface
    {
        /** @var AccountResource $accountResourceInterface */
        $_accountResource = $accountResourceInterface->save();

        if (!$_accountResource) throw new ModelNotFoundException("Failed to save current resource");

        return $accountResourceInterface;
    }

    /**
     * Delete resource by id
     *
     * @param integer $id
     * @return boolean
     */
    public function deleteById(int $id): bool
    {
        /** @var AccountResource $_accountResource */
        $_accountResource = $this->getById($id);

        return $_accountResource->delete();
    }

    /**
     * Delete resource by code
     *
     * @param string $code
     * @return boolean
     */
    public function deleteByCode(string $code): bool
    {
        /** @var AccountResource $_accountResource */
        $_accountResource = $this->getByCode($code);

        return $_accountResource->delete();
    }

    // ? Private Methods

    // ? Setter Modules
}
