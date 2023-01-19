<?php

namespace TheBachtiarz\AccountResource\Libraries;

use TheBachtiarz\AccountResource\Interfaces\Library\LibraryServiceInterface;
use TheBachtiarz\Toolkit\Helper\Curl\Data\CurlResolverData;

class AccountDetailService extends CurlService implements LibraryServiceInterface
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
