<?php

class Database {
    public $__conn;
    public function __construct()
    {
        global $db_config;
        $this->__conn = Connection::getInstance($db_config);
    }

    function insert($table, $data) {
        if (!empty($data)) {
            $fieldStr = '';
            $valueStr = '';
            foreach ($data as $key => $value) {
                $fieldStr .= $key . ', ';
                $valueStr .= "'" . $value . "', ";
            }
            $fieldStr = rtrim($fieldStr, ', ');
            $valueStr = rtrim($valueStr, ', ');
            $sql = "INSERT INTO $table ($fieldStr) VALUES ($valueStr)";
            $status = $this->query($sql);
            if ($status) {
                return true;
            } 
        }
        return false;
    }

    function update($table, $data, $condition='') {
        if (!empty($data)) {
            $updateStr = '';
            foreach ($data as $key => $value) {
                $updateStr .= $key . "='" . $value . "', ";
            }
            $updateStr = rtrim($updateStr, ', ');
            if ($condition) {
                $sql = "UPDATE $table SET $updateStr WHERE $condition";
            } else {
                $sql = "UPDATE $table SET $updateStr";
            }

            $status = $this->query($sql);

            if ($status) {
                return true;
            }
        }

        return false;
    }

    function query($sql) {
        try {
            $statement = $this->__conn->prepare($sql);
            $statement->execute();
            return $statement;
        } catch (Exception $exception) {
            $message = $exception->getMessage();
            $data['message'] = $message; 
            App::$app->loadErrors(500, $data);
            die();
        }
    }
    
    // function lastInsertId() {
    //     return $this->__conn->lastInsertId();
    // }
}