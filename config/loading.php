<?php

namespace loading;

require_once ((defined("HOMEDIR")) ? HOMEDIR : "") . "app/Loading.php";

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

function configurepaths($home=HOMEDIR)
{
    L::setHomeDir($home);
}

function load
(
    string $filename,
    string $type="php",
    bool $once=true,
    bool $fail_on_errors=true
)
{
    return (new L($filename . "." . $type))
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

function linkframework(string $dir, array $filetypes=[], bool $min=true)
{
    checkdirend($dir);
    $framework = opendir($dir);

    while ($framework_item = readdir($framework))
    {
        if (is_dir($dir . $framework_item) && $framework_item != "." && $framework_item != "..")
        {
            linkframework($dir . $framework_item, $filetypes, $min);
        }

        $filename_seq = explode(".", $framework_item);
        $type = end($filename_seq);
        if ($min)
        {
            $key_with_min = count($filename_seq) - 2;
            $is_min = ($key_with_min > -1)
                ? $filename_seq[$key_with_min] == "min"
                : false;
        }

        if (in_array($type, $filetypes) && (!$min || $is_min))
        {
            if (
                in_array("js", $filetypes)
                || in_array("coffee", $filetypes)
                || in_array("ts", $filetypes)
            )
            {
                echo "<script rel='script' type='text/javascript' src='$dir$framework_item'></script>\n\t";
            }
            elseif (in_array("css", $filetypes) || in_array("scss", $filetypes))
            {
                echo "<link rel='stylesheet' type='text/css' href='$dir$framework_item'>\n\t";
            }
        }
    }
    echo "\n\t";
    closedir($framework);
}