<?php

namespace Models\Core;


/**
 * Class Database
 * @package Models\Core
 */
class Database
{
    /**
     * @var \PDO|null
     */
    private static $instance = null;

    /**
     * @param $config
     * @return \PDO|null
     * @throws \Exception
     */

    public static function getInstance($config = null)
    {
        if (!self::$instance) {
            try {
                self::$instance = self::$instance = new \PDO("mysql:host=" .
                    $config['host'] .
                    ";dbname=" . $config['database'],
                    $config['username'], $config['password']
                );
                self::$instance->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                self::$instance->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
            } catch (\Exception $e) {
                throw new \Exception('An error ocurred during application start: ' . $e->getMessage());
            }
        }
        return self::$instance;
    }
}
