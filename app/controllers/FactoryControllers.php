<?php

namespace app\controllers;


class FactoryControllers
{
    private static $controllers = [];

    /**
     * @return array
     */
    public static function getControllers(): array
    {
        return self::$controllers;
    }

    /**
     * @param array $controllers
     */
    public static function setUnserializedControllers(array $controllers)
    {
        if ($controllers)
        {
            self::$controllers = $controllers;
        }
    }

    private final function __construct()
    {
    }

    /**
     * @param $controller
     * @param array $args
     * @return Controller|null
     */
    public static function getController($controller, $args=[])
    {
        /** @var Controller|string $controller_full_name */
        $controller_full_name = "\\app\\controllers\\" . $controller;
        $type = $controller_full_name::getType();
        $controllers = &self::$controllers[$type];

        if (isset($controllers[$controller]))
        {
            if ($type == Controller::UPDATING)
            {
                if ((
                    $created_controller
                        = self::createController(
                            $controller_full_name, $args
                    )) !== null
                )
                {
                    $controllers[$controller] = $created_controller;
                }
            }
        }
        else
        {
            if ((
                    $created_controller
                        = self::createController(
                            $controller_full_name, $args
                )) !== null
            )
            {
                $controllers[$controller] = $created_controller;
            }
        }

        return $controllers[$controller];
    }

    private static function createController($namespace, $args)
    {
        try
        {
            $ref = new \ReflectionClass($namespace);
            $instance = $ref->newInstanceArgs($args);

            return $instance;
        }
        catch (\ReflectionException $e)
        {
            return null;
        }
    }

    /*public static function printSerializeControllers()
    {
        echo "\n<div id='controllers'>\n";

        echo "\t<div id='" . Controller::SINGLE . "'>\n";

        if (isset(self::$controllers[Controller::SINGLE]))
        {
            foreach (self::$controllers[Controller::SINGLE] as $name => $controller)
            {
                $serialized_controller = serialize($controller);
                echo "\t\t<input type='hidden' name='$name' value='$serialized_controller'>\n";
            }
        }

        echo "\t</div>\n\n";

        echo "\t<div id='" . Controller::UPDATING . "'>";

        if (isset(self::$controllers[Controller::UPDATING]))
        {
            foreach (self::$controllers[Controller::UPDATING] as $name => $controller)
            {
                $serialized_controller = serialize($controller);
                echo "\t\t<input type='hidden' name='$name' value='$serialized_controller'>\n";
            }
        }

        echo "\t</div>\n";

        echo "</div>\n";
    }*/
}