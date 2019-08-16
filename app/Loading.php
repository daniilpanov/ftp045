<?php

namespace app;


class Loading
{
    private static $home_dir = "";

    /**
     * @param string $home_dir
     */
    public static function setHomeDir(string $home_dir)
    {
        self::$home_dir = $home_dir;
    }

    private $path;
    private $once = true, $fail_on_errors = true;

    public function __construct(string $path)
    {
        $this->path = self::$home_dir . $path;
    }

    public function once(bool $once): self
    {
        $this->once = $once;

        return $this;
    }

    public function failOnErrors(bool $fail): self
    {
        $this->fail_on_errors = $fail;

        return $this;
    }

    public function load()
    {
        $res = null;

        if ($this->fail_on_errors)
        {
            if ($this->once)
            {
                $res = require_once $this->path;
            }
            else
            {
                $res = require $this->path;
            }
        }
        else
        {
            if ($this->once)
            {
                $res = include_once $this->path;
            }
            else
            {
                $res = include $this->path;
            }
        }

        return $res;
    }
}