<?php

namespace app;


class Factory
{
    protected static $objects = [];
    protected static $namespace = "\\app\\";

    public static function getObjects()
    {
        return self::$objects;
    }

    /**
     * @param string[] $objects
     */
    public static function setUnserialized(array $objects)
    {
        if ($objects)
        {
            self::$objects = $objects;
        }
    }

    public static function createInstance(string $classname, array $params=[])
    {
        if (class_exists($class_full_name = self::$namespace . $classname))
            return new $class_full_name(...$params);
        else
            return null;
    }
}