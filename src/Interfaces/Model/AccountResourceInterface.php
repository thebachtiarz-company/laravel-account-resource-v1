<?php

namespace TheBachtiarz\AccountResource\Interfaces\Model;

interface AccountResourceInterface
{
    /**
     * Model attributes fillable
     *
     * @var array
     */

    public const ATTRIBUTE_FILLABLE = [
        self::ATTRIBUTE_CODE,
        self::ATTRIBUTE_IDENTIFIER,
        self::ATTRIBUTE_VALUE
    ];

    public const ATTRIBUTE_ID = 'id';
    public const ATTRIBUTE_CODE = 'code';
    public const ATTRIBUTE_IDENTIFIER = 'identifier';
    public const ATTRIBUTE_VALUE = 'value';

    // ? Getter Modules
    /**
     * Get code
     *
     * @return string|null
     */
    public function getCode(): ?string;

    /**
     * Get identifier
     *
     * @return string|null
     */
    public function getIdentifier(): ?string;

    /**
     * Get value
     *
     * @return string|null
     */
    public function getValue(): ?string;

    // ? Setter Modules
    /**
     * Set code
     *
     * @param string $code
     * @return self
     */
    public function setCode(string $code): self;

    /**
     * Set identifier
     *
     * @param string $identifier
     * @return self
     */
    public function setIdentifier(string $identifier): self;

    /**
     * Set value
     *
     * @param string $value
     * @return self
     */
    public function setValue(string $value): self;
}
