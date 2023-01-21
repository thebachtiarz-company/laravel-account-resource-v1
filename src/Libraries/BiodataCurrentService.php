<?php

namespace TheBachtiarz\AccountResource\Libraries;

use TheBachtiarz\Toolkit\Helper\Curl\Data\CurlResolverData;

class BiodataCurrentService extends CurlService
{
    //

    /**
     * {@inheritDoc}
     */
    public function execute(array $data): CurlResolverData
    {
        return $this->setUrl(self::URL_DOMAIN_GETCURRENTBIODATA_NAME)->setBody($data)->get();
    }
}
