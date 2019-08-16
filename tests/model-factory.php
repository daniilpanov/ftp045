<?php

spl_autoload_register(function ($namespace)
{
    $path = str_replace("\\", "/", $namespace);

    require_once "../" . $path . ".php";
});

\app\models\FactoryModels::createModel("TestModel", [["Hey", "h" => "d"]]);

\app\models\FactoryModels
    ::search("TestModel")
    ->set(0, "Hey")
    ->h("d")
    ->getModel();
