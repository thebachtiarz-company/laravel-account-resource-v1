<?php

namespace TheBachtiarz\AccountResource\Libraries;

use TheBachtiarz\Toolkit\Helper\Curl\Data\CurlResolverData;

class AccountDetailService extends CurlService
{
    //

    /**
     * {@inheritDoc}
     */
    public function execute(array $data): CurlResolverData
    {
        return $this->setUrl(self::URL_DOMAIN_GETACCOUNTDETAIL_NAME)->setBody($data)->get();
    }
}
