<?php

namespace TheBachtiarz\AccountResource\Traits\Model;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use TheBachtiarz\AccountResource\Interfaces\Model\AccountResourceInterface;

/**
 * Account Resource Scope Trait
 */
trait AccountResourceScopeTrait
{
    //

    /**
     * Get resource by code
     *
     * @param Builder $builder
     * @param string $code
     * @return Builder
     */
    public function scopeGetByCode(Builder $builder, string $code): Builder
    {
        $_codeAttribute = AccountResourceInterface::ATTRIBUTE_CODE;

        return $builder->where(DB::raw("BINARY `$_codeAttribute`"), $code);
    }
}
