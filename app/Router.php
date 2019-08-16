<?php

namespace app;

use app\controllers\Controller;
use app\controllers\FactoryControllers;


class Router
{
    private static $current_main_controller = null;
    private static $current_main_view = null;
    private static $data_for_view = [];

    public static function get($get)
    {
        if (!$get)
        {
            self::$current_main_controller
                = FactoryControllers::getController("Pages");

            self::$current_main_view = "content";

            self::$data_for_view = self::getCurrentController()->getData(1, "content");
        }
        else
        {
            foreach ($get as $key => $value)
            {
                if ($key == 'page')
                {
                    self::$current_main_controller
                        = FactoryControllers::getController("Pages");

                    self::$current_main_view = "content";

                    self::$data_for_view = self::getCurrentController()->getData($value, "content");
                }
            }
        }
    }

    /**
     * @return Controller|null
     */
    public static function getCurrentController()
    {
        return self::$current_main_controller;
    }

    /**
     * @return void
     */
    public static function showMainView()
    {
        \loading\showview(self::$current_main_view);
    }

    /**
     * @return array|mixed
     */
    public static function getDataForView()
    {
        return self::$data_for_view;
    }
}