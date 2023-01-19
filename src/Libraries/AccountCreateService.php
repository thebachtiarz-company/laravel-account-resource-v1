<?php

namespace TheBachtiarz\AccountResource\Libraries;

use TheBachtiarz\AccountResource\Interfaces\Library\LibraryServiceInterface;
use TheBachtiarz\Toolkit\Helper\Curl\Data\CurlResolverData;

class AccountCreateService extends CurlService implements LibraryServiceInterface
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
