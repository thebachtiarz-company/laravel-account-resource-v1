<?php

namespace TheBachtiarz\AccountResource\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use TheBachtiarz\AccountResource\Models\AccountResource;

class AccountResourceRepository extends AbstractRepositories
{
    //

    // ? Public Methods
    /**
     * Get resource by id
     *
     * @param integer $id
     * @return AccountResource
     */
    public function getById(int $id): AccountResource
    {
        $_accountResource = AccountResource::find($id);

        if (!$_accountResource) throw new ModelNotFoundException("Resource with id '$id' not found");

        return $_accountResource;
    }

    /**
     * Get resource by code
     *
     * @param string $code
     * @return AccountResource
     */
    public function getByCode(string $code): AccountResource
    {
        $_accountResource = AccountResource::getByCode($code)->first();

        if (!$_accountResource) throw new ModelNotFoundException("Resource with code '$code' not found");

        return $_accountResource;
    }

    /**
     * Create new resource
     *
     * @param AccountResource $accountResource
     * @return AccountResource
     */
    public function create(AccountResource $accountResource): AccountResource
    {
        $_create = $this->createFromModel($accountResource);

        if (!$_create) throw new ModelNotFoundException("Failed to create new resource");

        return $_create;
    }

    /**
     * Update current resource
     *
     * @param AccountResource $accountResource
     * @return AccountResource
     */
    public function save(AccountResource $accountResource): AccountResource
    {
        $_accountResource = $accountResource->save();

        if (!$_accountResource) throw new ModelNotFoundException("Failed to save current resource");

        return $accountResource;
    }

    /**
     * Delete resource by id
     *
     * @param integer $id
     * @return boolean
     */
    public function deleteById(int $id): bool
    {
        return $this->getById($id)->delete();
    }

    /**
     * Delete resource by code
     *
     * @param string $code
     * @return boolean
     */
    public function deleteByCode(string $code): bool
    {
        return $this->getByCode($code)->delete();
    }

    // ? Private Methods

    // ? Setter Modules
}
