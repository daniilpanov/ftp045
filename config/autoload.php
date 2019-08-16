<?php
use app\Config as C;
use loading as l;
use dbtools\Db;

spl_autoload_register(function ($namespace)
{
    $nsc_segments = explode("\\", $namespace);
    $classname = end($nsc_segments);
    $nsc = str_replace($classname, "", $namespace);

    if (key_exists(($nsc = "\\" . $nsc), \PATHS))
    {
        l\loadclass(\PATHS[$nsc] . $classname);
        return;
    }

    l\loadclass($namespace);
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

/*echo "<pre>";
var_dump(\app\controllers\FactoryControllers::getControllers());
echo "<br><br>";
var_dump(\app\models\FactoryModels::getModels());
echo "</pre>";*/

$config = object_to_array(
    json_decode(
        file_get_contents(
            HOMEDIR . "config/config.json"
        )
    )
);

C::set($config);

$db = C::get('database');

$host = $db['host'];
$dbname = $db['db'];
$username = $db['user'];
$pass = $db['password'];
$charset = $db['charset'];

$params = [
    'host' => $host,
    'dbname' => $dbname,
    'username' => $username
];

if (($instance = Db::seekInstance($params)) === null)
{
    $instance = Db::initNewConnection(
        $host, $dbname,
        $username, $pass
    );
}

Db::setCurrentInstance($instance);

\app\Router::get($_GET);