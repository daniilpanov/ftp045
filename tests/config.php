<pre>
    <?php
    require_once "../app/Config.php";
    echo "\n";
    \app\Config::set(["test", "ok"], "Good Test!");
    echo "\n\n";
    var_dump(\app\Config::get());
    echo "\n\n\n\n\n\n\n\n";
    \app\Config::set("test", "value1");
    var_dump(\app\Config::get("test"));
    \app\Config::set(["test", "test2"], "value2");
    var_dump(\app\Config::get(["test", "test2"]));
    \app\Config::set(["test", "test2"], null);
    var_dump(\app\Config::get(["test", "test2"]));
    echo "\n\n";
    var_dump(\app\Config::get());
    ?>
</pre>