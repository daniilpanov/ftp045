<?php

namespace app\models;


abstract class Model
{
    protected $data = [];
    protected $id = null;

    public abstract function __construct();

    public function get($key)
    {
        return (isset($this->data[$key]) ? $this->data[$key] : null);
    }

    public function set($key, $value)
    {
        $this->data[$key] = $value;
    }

    public function __call($name, $args)
    {
        if (!method_exists($this, $name))
        {
            $f_argc = count($args);
            $seq = [];

            if (
                preg_match("/get(.*)/", $name, $seq)
                && $f_argc == 0
            )
            {
                return $this->get(mb_strtolower($seq[1]));
            }
            elseif (
                preg_match("/set(.*)/", $name, $seq)
                && $f_argc == 1
            )
            {
                $this->set(mb_strtolower($seq[1]), $args[0]);
            }
        }
    }
}