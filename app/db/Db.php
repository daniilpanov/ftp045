<?php

namespace dbtools;


class Db
{
    private static $current_instance = null;
    private static $instances = [];

    private $pdo = null;
    private $params = [];
    private $options = [];

    private function __construct(string $host, string $dbname, string $user, string $password=null)
    {

    }

    public function connect(): bool
    {

    }

    public function query(string $sql): \PDOStatement
    {

    }

    public static function initNewQuery(string $host, string $dbname, string $user, string $password=null): self
    {

    }

    public static function setCurrentInstance(self $instance): bool
    {

    }

    public static function seekInstance(string $params): self
    {

    }
}