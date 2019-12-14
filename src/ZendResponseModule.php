<?php
declare(strict_types=1);

namespace KnotPhp\Module\ZendHttp;

use Throwable;

use Zend\Diactoros\Response;

use KnotLib\Kernel\Exception\ModuleInstallationException;
use KnotLib\Kernel\Kernel\ApplicationInterface;
use KnotLib\Kernel\EventStream\Channels;
use KnotLib\Kernel\EventStream\Events;
use KnotLib\Kernel\Module\ComponentModule;
use KnotLib\Kernel\Module\Components;

class ZendResponseModule extends ComponentModule
{
    /**
     * Declare dependent on components
     *
     * @return array
     */
    public static function requiredComponents() : array
    {
        return [
            Components::EVENTSTREAM,
        ];
    }

    /**
     * Declare component type of this module
     *
     * @return string
     */
    public static function declareComponentType() : string
    {
        return Components::RESPONSE;
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