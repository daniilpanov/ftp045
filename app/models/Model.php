<?php

namespace app\models;


abstract class Model
{
    protected $data = [];
    protected $id = null;

    public function getData()
    {
        return $this->data;
    }

    public function get($key)
    {
        return (isset($this->data[$key]) ? $this->data[$key] : null);
    }

    public function getID()
    {
        return $this->id;
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

    public function check(array $params): bool
    {
        $params_diff = count($this->data) - count($params);

        $diff = array_diff_assoc($this->data, $params);

        if (count($diff) === $params_diff)
        {
            return true;
        }

        return false;
    }
}