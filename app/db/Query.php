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

    public function getResult($fetch=false)
    {
        $res = Db::sql($this->getSQL(), $this->params);

        if ($fetch)
        {
            $res = $res->fetchAll();
        }

        return $res;
    }
}