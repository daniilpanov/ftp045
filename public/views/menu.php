<?php

$data = \app\controllers\FactoryControllers
    ::getController("Pages")
    ->getDataForView("menu");

foreach ($data as $datum)
{
    $datum['name'] = mb_strtoupper($datum['name']);
    echo "<a aria-roledescription='{$datum['type']}' href='?page={$datum['id']}'>{$datum['name']}</a>";
}
?>