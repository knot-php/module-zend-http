<?php
declare(strict_types=1);

namespace knotphp\module\zendhttp;

use Throwable;

use Zend\Diactoros\ServerRequestFactory;

use knotlib\kernel\exception\ModuleInstallationException;
use knotlib\kernel\kernel\ApplicationInterface;
use knotlib\kernel\module\ModuleInterface;
use knotlib\kernel\module\ComponentTypes;
use knotlib\kernel\eventstream\Channels;
use knotlib\kernel\eventstream\Events;

class ZendRequestModule implements ModuleInterface
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
        return ComponentTypes::REQUEST;
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
            $request = ServerRequestFactory::fromGlobals();
            $app->request($request);

            // fire event
            $app->eventstream()->channel(Channels::SYSTEM)->push(Events::REQUEST_ATTACHED, $app->request());
        }
        catch(Throwable $e)
        {
            throw new ModuleInstallationException(self::class, $e->getMessage(), 0, $e);
        }
    }
}