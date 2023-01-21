<?php

namespace TheBachtiarz\AccountResource\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use TheBachtiarz\AccountResource\Interfaces\Model\AccountResourceInterface;
use TheBachtiarz\AccountResource\Traits\Model\AccountResourceScopeTrait;

class AccountResource extends Model implements AccountResourceInterface
{
    use SoftDeletes, AccountResourceScopeTrait;

    /**
     * {@inheritDoc}
     */
    protected $fillable = self::ATTRIBUTE_FILLABLE;

    // ? Getter Modules
    /**
     * {@inheritDoc}
     */
    public function getId(): ?int
    {
        return $this->__get(self::ATTRIBUTE_ID);
    }

    /**
     * {@inheritDoc}
     */
    public function getCode(): ?string
    {
        return $this->__get(self::ATTRIBUTE_CODE);
    }

    /**
     * {@inheritDoc}
     */
    public function getIdentifier(): ?string
    {
        return $this->__get(self::ATTRIBUTE_IDENTIFIER);
    }

    /**
     * {@inheritDoc}
     */
    public function getValue(): ?string
    {
        return $this->__get(self::ATTRIBUTE_VALUE);
    }

    // ? Setter Modules
    /**
     * {@inheritDoc}
     */
    public function setCode(string $code): self
    {
        $this->__set(self::ATTRIBUTE_CODE, $code);

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setIdentifier(string $identifier): self
    {
        $this->__set(self::ATTRIBUTE_IDENTIFIER, $identifier);

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setValue(string $value): self
    {
        $this->__set(self::ATTRIBUTE_VALUE, $value);

        return $this;
    }
}
