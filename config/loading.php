<?php

namespace loading;

require_once HOMEDIR . "app/Loading.php";

use app\Loading as L;

function checkdirend(string &$dirname, string $end="/")
{
    $len = strlen($dirname);

    $dirend = substr($dirname, $len - 1, 1);

    if ($dirend != $end)
    {
        $dirname .= $end;
    }
}

function load
(
    string $filename,
    string $type="php",
    bool $once=true,
    bool $fail_on_errors=true
)
{
    return (new L(HOMEDIR . $filename . "." . $type))
        ->once($once)
        ->failOnErrors($fail_on_errors)
        ->load();
}

function loadphp
(
    string $filename,
    bool $once=true,
    bool $fail_on_errors=true
)
{
    return load($filename, "php", $once, $fail_on_errors);
}

function loadconfig(string $filename)
{
    return loadphp("config/" . $filename);
}

function loadclass(string $classnamespace)
{
    $classpath = str_replace("\\", "/", $classnamespace);

    loadphp($classpath);
}

function showview(string $viewname)
{
    loadphp("public/views/" . $viewname, false, false);
}


function link(string $path, string $rel="stylesheet", $type="text/css")
{
    echo "<link href='$path' rel='$rel'";
    if ($type !== null)
    {
        echo " type='$type'";
    }
    echo ">\n\t";
}

function linkcss(string $cssname, string $path="public/css/", string $type="css")
{
    checkdirend($path);
    link($path . $cssname . "." . $type);
}

function includescript(string $src, string $path="public/js/", string $type="js")
{
    checkdirend($path);
    $src = $path . $src;
    echo "<script src='$src.$type' rel='script' type='text/javascript'></script>\n";
}

function linkframework(string $dir, string $filetype)
{
    checkdirend($dir);
    $framework = opendir($dir);

    while ($framework_item = readdir($framework))
    {
        $filename_seq = explode(".", $framework_item);
        $type = end($filename_seq);
        $min = ($filename_seq[count($filename_seq)-2] == "min");

        if ($type == $filetype && $min)
        {
            if (
                $filetype == "js"
                || $filetype == "coffee"
                || $filetype == "ts"
            )
            {
                echo "<script rel='script' type='text/javascript' src='$dir$framework_item'></script>\n\t";
            }
            elseif ($filetype == "css" || $filetype == "scss")
            {
                echo "<link rel='stylesheet' type='text/css' href='$dir$framework_item'>\n\t";
            }
        }
    }
    echo "\n\t";
    closedir($framework);
}