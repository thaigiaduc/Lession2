<?php 

abstract class Model extends Database {
    protected $db, $tableName;
    function __construct()
    {
        $this->db = new Database();
    }

    abstract function tableFill();
    abstract function fieldFill();

    public function get()
    {
        $tableName = $this->tableFill();
        $fieldSelect = $this->fieldFill();
        if (empty($fieldSelect)) {
            $fieldSelect = '*';
        }
        $sql = "SELECT $fieldSelect FROM $tableName";
        $query = $this->db->query($sql);
        if (!empty($query)) {
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        return false;
    }

    public function first()
    {
        $tableName = $this->tableFill();
        $fieldSelect = $this->fieldFill();
        if (empty($fieldSelect)) {
            $fieldSelect = '*';
        }
        $sql = "SELECT $fieldSelect FROM $tableName";
        $query = $this->db->query($sql);
        if (!empty($query)) {
            return $query->fetch(PDO::FETCH_ASSOC);
        }
        return false;
    }

    public function find($id)
    {
        $tableName = $this->tableFill();
        $fieldSelect = $this->fieldFill();
        if (empty($fieldSelect)) {
            $fieldSelect = '*';
        }
        $sql = "SELECT $fieldSelect FROM $tableName WHERE id = $id";
        $query = $this->db->query($sql);
        if (!empty($query)) {
            return $query->fetch(PDO::FETCH_ASSOC);
        }
        return false;
    }

    public function create($data)
    {
        $tableName = $this->tableFill();
        $query = $this->db->insert( $tableName, $data);
        if (!empty($query)) {
            return true;
        }
        return false;
    }

    public function edit($data, $condition='')
    {
        $tableName = $this->tableFill();
        $query = $this->db->update($tableName, $data, $condition);
        if (!empty($query)) {
            return true;
        }
        return false;
    }
}