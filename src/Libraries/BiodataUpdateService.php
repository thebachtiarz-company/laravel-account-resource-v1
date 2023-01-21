<?php

namespace TheBachtiarz\AccountResource\Libraries;

use TheBachtiarz\Toolkit\Helper\Curl\Data\CurlResolverData;

class BiodataUpdateService extends CurlService
{
    //

    /**
     * {@inheritDoc}
     */
    public function execute(array $data): CurlResolverData
    {
        return $this->setUrl(self::URL_DOMAIN_UPDATECURRENTBIODATA_NAME)->setBody($data)->post();
    }
}
