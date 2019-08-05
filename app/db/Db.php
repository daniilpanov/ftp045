<?php

namespace dbtools;


class Db
{
    private static $current_instance = null;
    private static $instances = [];
    private static $settings = [];
    private static $options = [];

    private $pdo = null;
    private $params = [];

    private function __construct(string $host, string $dbname, string $user, string $password)
    {
        $this->pdo = new \PDO(
            "mysql:host={$host};dbname={$dbname};charset="
                . self::$settings['charset'],
            $user, $password, self::$options
        );
    }

    public function connect(): bool
    {

    }

    public function query(string $sql): \PDOStatement
    {

    }

    public static function initNewQuery(string $host, string $dbname, string $user, string $password=null): self
    {
        return self::$instances["$user@$host%$dbname"] = new self($host, $dbname, $user, $password);
    }

    public static function setCurrentInstance(self $instance): bool
    {

    }

    public static function seekInstance(array $params)
    {
        foreach (self::$instances as $some_params => $instance)
        {
            if ($some_params == "{$params['user']}@{$params['host']}%{$params['db']}")
            {
                if ($instance->params == $params)
                {
                    return $instance;
                }
            }
        }

        return null;
    }
}