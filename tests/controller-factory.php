<pre>
    <?php
    use app\Config as C;
    use dbtools\Db;

    spl_autoload_register(function ($namespace)
    {
        $path = str_replace("\\", "/", $namespace);
        $path = str_replace("dbtools", "app/db", $path);

        require_once "../" . $path . ".php";
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
                "../config/config.json"
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

    \app\controllers\FactoryControllers::getController("Pages");

    var_dump(\app\controllers\FactoryControllers::getController("Pages")->getData());
    ?>
</pre>