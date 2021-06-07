<?php
declare(strict_types=1);

namespace knotphp\module\zendhttp\package;

use knotlib\kernel\module\PackageInterface;
use knotphp\module\knotpipeline\KnotPipelineModule;
use knotphp\module\stk2keventstream\Stk2kEventStreamModule;
use knotphp\module\zendhttp\ZendRequestModule;
use knotphp\module\zendhttp\ZendResponseModule;

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