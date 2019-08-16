<?php

namespace dbtools;


class Db
{
    /** @var self $current_instance */
    private static $current_instance = null;
    private static $instances = [];
    private static $settings = [];
    // Опции для инициализации подключения к БД
    private static $options = [
        \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
    ];

    private $pdo = null;
    private $params = [];

    private function __construct(string $host, string $dbname, string $user, string $password, $charset)
    {
        $this->pdo = new \PDO(
            ("mysql:host={$host};dbname={$dbname};charset="
                . (
                    isset(self::$settings['charset'])
                        ? self::$settings['charset']
                        : ($charset !== null)
                            ? $charset
                            : "utf8"
                )
            ),
            $user, $password, self::$options
        );

        if ($charset !== null)
        {
            $this->pdo->query("SET NAMES utf8");
        }
    }

    public function query(string $sql, array $params)
    {
        $sth = null;

        if ($params)
        {
            $sth = $this->pdo->prepare($sql);

            $sth->execute($params);
        }
        else
        {
            $sth = $this->pdo->query($sql);
        }

        return $sth;
    }

    public static function initNewConnection(string $host, string $dbname, string $user, string $password=null, $charset=null): self
    {
        return self::$instances["$user@$host%$dbname"] = new self($host, $dbname, $user, $password, $charset);
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

    public static function getInstance(): self
    {
        return self::$current_instance;
    }

    public static function sql(string $sql, array $params=[])
    {
        return self::getInstance()->query($sql, $params);
    }
}