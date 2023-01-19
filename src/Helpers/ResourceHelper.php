<?php

namespace TheBachtiarz\AccountResource\Helpers;

use TheBachtiarz\Toolkit\Helper\App\Encryptor\EncryptorHelper;

class ResourceHelper
{
    use EncryptorHelper;

    /**
     * Encrypt resource biodata(s)
     *
     * @param array $biodatas
     * @return string
     */
    public function encryptBiodata(array $biodatas = []): string
    {
        $_result = '';

        try {
            $_result = self::simpleEncrypt($biodatas);
        } catch (\Throwable $th) {
        } finally {
            return $_result;
        }
    }

    /**
     * Decrypt resource biodata(s)
     *
     * @param string $encryptedBiodatas
     * @return array
     */
    public function decryptBiodata(string $encryptedBiodatas): array
    {
        $_result = [];

        try {
            $_result = self::decrypt($encryptedBiodatas);
        } catch (\Throwable $th) {
        } finally {
            return $_result;
        }
    }

    /**
     * Resolve encrypted biodata
     *
     * @param string $encryptedBiodata
     * @param boolean $onlyLatest
     * @return array
     */
    public function biodataResolver(string $encryptedBiodata, bool $onlyLatest = false): array
    {
        $_biodatas = $this->decryptBiodata($encryptedBiodata);

        return $onlyLatest ? end($_biodatas) : $_biodatas;
    }
}
