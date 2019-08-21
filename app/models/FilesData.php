<?php

namespace app\models;


class FilesData extends Model
{
    private $handle;

    public function __construct(string $path)
    {
        \loading\checkdirend($path);

        $this->handle = opendir($path);
        while ($child = readdir($this->handle))
        {
            if ($child != "." && $child != "..")
            {
                echo "<br>$child";
                $this->data[$child] = (is_dir(($child_path = $path . $child)))
                    ? new self($child_path)
                    : file_get_contents($child_path);
            }
        }

        closedir($this->handle);
    }

    public static function initSome($from, $to, $args = [])
    {
        // TODO: Implement initSome() method.
    }
}