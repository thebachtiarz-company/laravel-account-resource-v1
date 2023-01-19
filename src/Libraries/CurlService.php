<?php

namespace TheBachtiarz\AccountResource\Libraries;

use TheBachtiarz\AccountResource\Interfaces\Library\UrlDomainInterface;
use TheBachtiarz\Toolkit\Helper\Curl\AbstractCurl;

class CurlService extends AbstractCurl
{
    //

    /**
     * {@inheritDoc}
     */
    protected function urlDomainResolver(): string
    {
        $_baseDomain = tbaccountresourceconfig('is_production_mode') ? tbaccountresourceconfig('api_url_production') : tbaccountresourceconfig('api_url_sandbox');
        $_prefix = tbaccountresourceconfig('api_url_prefix');
        $_endPoint = UrlDomainInterface::URL_DOMAIN_AVAILABLE[$this->getUrl()];

        return "{$_baseDomain}/{$_prefix}/{$_endPoint}";
    }

    /**
     * {@inheritDoc}
     */
    protected function bodyDataResolver(): array
    {
        return $this->body;
    }
}
