<?php
declare(strict_types=1);

namespace knotphp\module\zendhttp;

use Throwable;

use Zend\Diactoros\Response;

use knotlib\kernel\exception\ModuleInstallationException;
use knotlib\kernel\kernel\ApplicationInterface;
use knotlib\kernel\eventstream\Channels;
use knotlib\kernel\eventstream\Events;
use knotlib\kernel\module\ModuleInterface;
use knotlib\kernel\module\ComponentTypes;

class ZendResponseModule implements ModuleInterface
{
    /**
     * Declare dependency on another modules
     *
     * @return array
     */
    public static function requiredModules() : array
    {
        return [];
    }

    /**
     * Declare dependent on components
     *
     * @return array
     */
    public static function requiredComponentTypes() : array
    {
        return [
            ComponentTypes::EVENTSTREAM,
        ];
    }

    /**
     * Declare component type of this module
     *
     * @return string
     */
    public static function declareComponentType() : string
    {
        return ComponentTypes::RESPONSE;
    }

    /**
     * Install module
     *
     * @param ApplicationInterface $app
     *
     * @throws ModuleInstallationException
     */
    public function install(ApplicationInterface $app)
    {
        try{
            $app->response(new Response);

            // fire event
            $app->eventstream()->channel(Channels::SYSTEM)->push(Events::RESPONSE_ATTACHED, $app->response());
        }
        catch(Throwable $e)
        {
            throw new ModuleInstallationException(self::class, $e->getMessage(), 0, $e);
        }
    }
}