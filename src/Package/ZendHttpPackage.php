<?php
declare(strict_types=1);

namespace KnotPhp\Module\ZendHttp\Package;

use KnotLib\Kernel\Module\PackageInterface;
use KnotPhp\Module\KnotPipeline\KnotPipelineModule;
use KnotPhp\Module\Stk2kEventStream\Stk2kEventStreamModule;
use KnotPhp\Module\ZendHttp\ZendRequestModule;
use KnotPhp\Module\ZendHttp\ZendResponseModule;

class ZendHttpPackage implements PackageInterface
{
    /**
     * Get package module list
     *
     * @return string[]
     */
    public static function getModuleList() : array
    {
        return [
            KnotPipelineModule::class,
            Stk2kEventStreamModule::class,
            ZendRequestModule::class,
            ZendResponseModule::class,
        ];
    }
}