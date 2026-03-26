<?php

namespace App\Modules\Newsletter\Config;

use App\Modules\Newsletter\Libraries\NewsletterService;
use CodeIgniter\Config\BaseService;

class Services extends BaseService
{
    public static function newsletterService(bool $getShared = true): NewsletterService
    {
        if ($getShared) {
            return static::getSharedInstance('newsletterService');
        }

        return new NewsletterService();
    }
}
