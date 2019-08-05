<?php
/** @noinspection PhpUndefinedMethodInspection */

use app\Config as C;
use loading as l;
use dbtools\Db;

spl_autoload_register(function ($namespace)
{
    $nsc_segments = explode("\\", $namespace);
    $classname = end($nsc_segments);
    $parent_namespace = str_replace($classname, "", $namespace);

    foreach (\PATHS as $nsc => $path)
    {
        if ("\\" . $parent_namespace == $nsc)
        {
            l\loadclass($path . $classname);
            return;
        }
    }

    $path = str_replace("\\", "/", $namespace);

    l\loadclass($path);
});

function object_to_array(stdClass $obj): array
{
    $arr = get_object_vars($obj);

    foreach ($arr as $key => $value)
    {
        if (is_object($value))
        {
            $arr[$key] = object_to_array($value);
        }
    }

    return $arr;
}

$config = object_to_array(
    json_decode(
        file_get_contents(
            HOMEDIR . "config/config.json"
        )
    )
);
/*
foreach ($config as $name => $value)
{
    new C($name, $value);
}

$host = C::getHost();
$dbname = C::getDb();
$username = C::getUser();
$pass = C::getPassword();
$charset = C::getCharset();

$params = [
    'host' => $host,
    'dbname' => $dbname,
    'username' => $username
];

if ($pass !== null)
{
    $params['password'] = $pass;
}

if (($instance = Db::seekInstance($params)) === null)
{
    $instance = Db::initNewQuery(
        C::getHost(), C::getDb(),
        C::getUser(), C::getPassword()
    );
}

Db::setCurrentInstance($instance);*/