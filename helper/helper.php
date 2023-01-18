<?php

use TheBachtiarz\AccountResource\Interfaces\Config\ConfigInterface;

/**
 * TheBachtiarz account resource config
 *
 * @param string|null $keyName config key name | null will return all
 * @return mixed
 */
function tbaccountresourceconfig(?string $keyName = null): mixed
{
    $configName = ConfigInterface::CONFIG_NAME;

    return iconv_strlen($keyName)
        ? config("{$configName}.{$keyName}")
        : config("{$configName}");
}
