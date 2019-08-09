<?php

namespace app;

// TODO: Create an objects data (add vars $key and $value to class Config (not static!) and insert to array data an object of this class)
class Config
{
    public function __construct($key, $value)
    {
        self::$data[$key] = $value;
    }

    private static $data = [];

    private static function get($key)
    {
        return (isset(self::$data[$key]) ? self::$data[$key] : null);
    }

    private static function set($key, $value)
    {
        self::$data[$key] = $value;
    }

    public static function __callStatic($name, $args)
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
    }
}