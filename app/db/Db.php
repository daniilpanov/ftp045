<?php

namespace dbtools;


class Db
{
    /** @var self $current_instance */
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

    public function query(string $sql, array $params): \PDOStatement
    {
        if ($params)
        {
            $sth = $this->pdo->prepare($sql);
            $sth->execute($params);
            return $sth;
        }
        else
        {
            return $this->pdo->query($sql);
        }
    }

    public static function initNewConnection(string $host, string $dbname, string $user, string $password=null): self
    {
        return self::$instances["$user@$host%$dbname"] = new self($host, $dbname, $user, $password);
    }

    public static function setCurrentInstance(self $instance)
    {
        self::$current_instance = $instance;
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

    public static function sql(string $query, array $params=[]): \PDOStatement
    {
        return self::$current_instance->query($query, $params);
    }
}