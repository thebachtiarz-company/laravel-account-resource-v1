<?php

namespace TheBachtiarz\AccountResource\Interfaces\Model\Data;

interface AccountResourceDataInterface
{
    public const ATTRIBUTE_NAME_CODE = 'code';

    // ? Public Methods
    /**
     * Get data
     *
     * @param string|null $attribute
     * @return mixed
     */
    public function getData(?string $attribute = null): mixed;

    /**
     * Set data
     *
     * @param string $attribute
     * @param mixed $value
     * @return self
     */
    public function setData(string $attribute, mixed $value): self;

    // ? Getter Modules
    /**
     * Get name
     *
     * @return string|null
     */
    public function getName(): ?string;

    // ? Setter Modules
    /**
     * Set name
     *
     * @param string $name
     * @return self
     */
    public function setName(string $name): self;
}
