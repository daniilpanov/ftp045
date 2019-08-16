<?php

namespace app;


class Config
{
    private function __construct()
    {
    }

    private static $settings = [];

    public static function get($keys=null)
    {
        if ($keys === null)
        {
            return self::$settings;
        }
        elseif(!is_array($keys))
        {
            return (isset(self::$settings[$keys]))
                ? self::$settings[$keys]
                : null;
        }
        else
        {
            $value = self::$settings;

            foreach ($keys as $key)
            {
                if (isset($value[$key]))
                {
                    $value = $value[$key];
                }
            }

            return $value;
        }
    }

    public static function set($settings)
    {
        self::$settings = $settings;
    }

    /*public static function __callStatic($name, $args)
    {
        if (!method_exists(self::class, $name))
        {
            $f_argc = count($args);
            $seq = [];

            if (
                preg_match("/get(.*)/", $name, $seq)
                && $f_argc == 0
            )
            {
                return self::get(mb_strtolower($seq[1]));
            }
            elseif (
                preg_match("/set(.*)/", $name, $seq)
                && $f_argc == 1
            )
            {
                self::set(mb_strtolower($seq[1]), $args[0]);
            }
        }
    }*/
}