<?php

namespace dbtools;


abstract class Query
{
    protected $sql = "";
    protected $params = [];

    public function getSQL(): string
    {
        return $this->sql;
    }

    public function params(array $params)
    {
        $this->params = $params;
    }

    public function param($name, $value)
    {
        $this->params[$name] = $value;
    }

    public function getResult($fetch=true)
    {
        $res = Db::sql($this->getSQL(), $this->params);

        if ($fetch)
        {
            $res = $res->fetchAll();
        }

        return $res;
    }

    public static function select($select, string $table): SelectQ
    {
        return new SelectQ($select, $table);
    }
}