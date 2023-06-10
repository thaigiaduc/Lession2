<?php

class Connection
{
    private static $instance = null, $conn = null;
    public function __construct($config)
    {
        try {
            $dsn = 'mysql:dbname=' . $config['db'] . ';host'. $config['host'];
            $options = [
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ];
            $con = new PDO($dsn, $config['username'], $config['password'], $options);
            self::$conn = $con;
        } catch (Exception $exception) {
            $message = $exception->getMessage();
            $data['message'] = $message; 
            App::$app->loadErrors(500, $data);
            die();
        }
    }

    public static function getInstance($config)
    {
        if (self::$instance == null) {
            $connection = new Connection($config);
            self::$instance = self::$conn;
        }

        return self::$instance;
    }
}
