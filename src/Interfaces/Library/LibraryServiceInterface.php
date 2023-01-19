<?php

namespace TheBachtiarz\AccountResource\Interfaces\Library;

use TheBachtiarz\Toolkit\Helper\Curl\Data\CurlResolverData;

interface LibraryServiceInterface extends UrlDomainInterface
{
    /**
     * Execute service process
     *
     * @param array $data
     * @return CurlResolverData
     */
    public function execute(array $data): CurlResolverData;
}
