<?php

namespace dbtools;


class SelectQ extends Query
{
    private $isset_where = false;

    public function __construct($select, string $table)
    {
        $this->sql = "select ";
        $this->sql .= (is_array($select))
            ? implode(", ", $select)
            : $select;
        $this->sql .= " from $table";
    }

    private function whereInit()
    {
        $this->sql .= " where ";
    }

    public function where(string $col, string $value, string $op="="): self
    {
        if (!$this->isset_where)
        {
            $this->whereInit();
        }

        $this->sql .= "`$col` $op '$value'";

        return $this;
    }

    public function and(string $col, string $value, string $op="="): self
    {
        $this->sql .= " and `$col` $op '$value'";

        return $this;
    }

    public function or(string $col, string $value, string $op="="): self
    {
        $this->sql .= " or `$col` $op '$value'";

        return $this;
    }

    private function beginGroup($op)
    {
        $this->sql .= " $op (";
    }

    private function endGroup()
    {
        $this->sql .= ")";
    }

    public function group($op, callable $func): self
    {
        $this->beginGroup($op);

        $func();

        $this->endGroup();

        return $this;
    }

    public function orderBy($colname, string $how="asc"): self
    {
        $this->sql .= " order by ";
        $this->sql .= (is_array($colname))
            ? implode(", ", $colname)
            : $colname;
        $this->sql .= " " . $how;

        return $this;
    }

    public function limit(int $limit, int $begin=0): self
    {
        $this->sql .= " limit ";
        $this->sql .= ($begin > 0) ? "$begin, $limit" : $limit;

        return $this;
    }
}