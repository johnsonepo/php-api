<?php

namespace app\api;

use PDO;
use PDOException;

class Model extends \app\config\Database {
    protected static $instance;
    protected $table;
    protected $select = '*';
    protected $where = '';
    protected $orderBy = '';

    protected function __construct() {
        parent::__construct();
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new static();
        }
        return self::$instance;
    }

    public function table($tableName) {
        $this->table = $tableName;
        return $this;
    }

    public function select($fields) {
        $this->select = $fields;
        return $this;
    }

    public function where($column, $value) {
        $this->where .= ($this->where === '') ? " WHERE $column = ?" : " AND $column = ?";
        return $this;
    }

    public function orderBy($column, $direction) {
        $this->orderBy = " ORDER BY $column $direction";
        return $this;
    }

    public function getAll() {
        $sql = "SELECT {$this->select} FROM {$this->table}{$this->where}{$this->orderBy}";
        try {
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new \PDOException("Error fetching data: " . $e->getMessage());
        }
    }

    public function create($data) {
        $columns = implode(', ', array_keys($data));
        $placeholders = rtrim(str_repeat('?, ', count($data)), ', ');
        $values = array_values($data);
        $sql = "INSERT INTO {$this->table} ($columns) VALUES ($placeholders)";
        try {
            $stmt = $this->getConnection()->prepare($sql);
            return $stmt->execute($values);
        } catch (PDOException $e) {
            throw new \PDOException("Error creating record: " . $e->getMessage());
        }
    }

    public function update($data) {
        $setClause = implode(' = ?, ', array_keys($data)) . ' = ?';
        $values = array_values($data);
        $sql = "UPDATE {$this->table} SET $setClause{$this->where}";
        try {
            $stmt = $this->getConnection()->prepare($sql);
            return $stmt->execute($values);
        } catch (PDOException $e) {
            throw new \PDOException("Error updating record: " . $e->getMessage());
        }
    }

    public function delete() {
        $sql = "DELETE FROM {$this->table}{$this->where}";
        try {
            $stmt = $this->getConnection()->prepare($sql);
            return $stmt->execute();
        } catch (PDOException $e) {
            throw new \PDOException("Error deleting record: " . $e->getMessage());
        }
    }
}
