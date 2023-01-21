<?php

namespace TheBachtiarz\AccountResource\Libraries;

use TheBachtiarz\Toolkit\Helper\Curl\Data\CurlResolverData;

class AccountCreateService extends CurlService
{
    //

    /**
     * {@inheritDoc}
     */
    public function execute(array $data): CurlResolverData
    {
        return $this->setUrl(self::URL_DOMAIN_CREATENEWACCOUNT_NAME)->setBody($data)->post();
    }
}
