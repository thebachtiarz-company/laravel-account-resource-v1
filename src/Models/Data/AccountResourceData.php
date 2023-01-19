<?php

namespace TheBachtiarz\AccountResource\Models\Data;

use TheBachtiarz\AccountResource\Interfaces\Model\Data\AccountResourceDataInterface;

class AccountResourceData implements AccountResourceDataInterface
{
    //

    private array $data = [];

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setName('');
    }

    // ? Public Methods
    /**
     * {@inheritDoc}
     */
    public function getData(?string $attribute = null): mixed
    {
        try {
            return $this->data[$attribute];
        } catch (\Throwable $th) {
            return $this->data;
        }
    }

    /**
     * {@inheritDoc}
     */
    public function setData(string $attribute, mixed $value): self
    {
        $this->data[$attribute] = $value;

        return $this;
    }

    // ? Getter Modules
    /**
     * {@inheritDoc}
     */
    public function getName(): ?string
    {
        return $this->getData(self::ATTRIBUTE_NAME_CODE);
    }

    // ? Setter Modules
    /**
     * {@inheritDoc}
     */
    public function setName(string $name): self
    {
        $this->setData(self::ATTRIBUTE_NAME_CODE, $name);

        return $this;
    }
}
