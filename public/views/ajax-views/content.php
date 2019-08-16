<?php

require_once "head.php";

print(\app\controllers\FactoryControllers
    ::getController("Pages")
    ->getDataForView("content", ["id" => $_GET['page']]));