<?php

namespace TheBachtiarz\AccountResource\Interfaces\Library;

interface UrlDomainInterface
{
    public const URL_DOMAIN_AVAILABLE = [
        self::URL_DOMAIN_CREATENEWACCOUNT_NAME => self::URL_DOMAIN_CREATENEWACCOUNT_PATH,
        self::URL_DOMAIN_CREATENEWBIODATA_NAME => self::URL_DOMAIN_CREATENEWBIODATA_PATH,
        self::URL_DOMAIN_GETACCOUNTDETAIL_NAME => self::URL_DOMAIN_GETACCOUNTDETAIL_PATH,
        self::URL_DOMAIN_GETCURRENTBIODATA_NAME => self::URL_DOMAIN_GETCURRENTBIODATA_PATH,
        self::URL_DOMAIN_UPDATECURRENTBIODATA_NAME => self::URL_DOMAIN_UPDATECURRENTBIODATA_PATH
    ];

    public const URL_DOMAIN_CREATENEWACCOUNT_NAME = 'account_create';
    public const URL_DOMAIN_CREATENEWBIODATA_NAME = 'biodata_create';
    public const URL_DOMAIN_GETACCOUNTDETAIL_NAME = 'account_detail';
    public const URL_DOMAIN_GETCURRENTBIODATA_NAME = 'biodata_current';
    public const URL_DOMAIN_UPDATECURRENTBIODATA_NAME = 'biodata_update';

    public const URL_DOMAIN_CREATENEWACCOUNT_PATH = 'account-create';
    public const URL_DOMAIN_CREATENEWBIODATA_PATH = 'biodata-create';
    public const URL_DOMAIN_GETACCOUNTDETAIL_PATH = 'account-detail';
    public const URL_DOMAIN_GETCURRENTBIODATA_PATH = 'biodata-detail';
    public const URL_DOMAIN_UPDATECURRENTBIODATA_PATH = 'biodata-update';
}
