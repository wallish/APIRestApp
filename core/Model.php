<?php

class Model extends Database
{
    public $string;
    private static $adapter;

    public function __construct()
    {
        self::$adapter = Database::getInstance();
        self::$adapter->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getAdapter()
    {
        return self::$adapter;
    }

    public function getColumns($table)
    {
        $reponse = $this->getAdapter()->prepare('DESCRIBE '.$table);
        $reponse->execute();

        return $reponse->fetchAll(PDO::FETCH_COLUMN);
    }

    public function insert($data, $table)
    {
        $fields = $this->getColumns($table);

        foreach ($data as $field => $value) {
            if (!in_array($field, array_values($fields))) {
                unset($data[$field]);
            }else {
                $filterField[] = $field;
            }

        }


        $queryFields = implode(', ', array_values($filterField));
        $queryData = implode("', '", array_values($data));
        $query = 'INSERT INTO '.$table.' ('.$queryFields.") VALUES ('".$queryData."')";

        try {
            $reponse = $this->getAdapter()->prepare($query);
            $reponse->execute();
            $this->getAdapter()->lastInsertId();
            $result = ['code' => DB_SUCCESS_ADD, 'id' => $this->getAdapter()->lastInsertId(), 'message' => []];
        } catch (PDOException $e) {
            echo 'Error'.$e->getMessage();
            $result = ['code' => -1, 'id' => $data['id'], 'message' => $e->getMessage()];
        }

        return $result;
    }

    public function update($data, $table)
    {
        $fields = $this->getColumns($table);
        $querySet = '';
        foreach ($data as $field => $value) {
            if (!in_array($field, $fields)) {
                unset($data[$field]);
            }
        }

        $queryFields = implode(', ', array_keys($data));
        $queryData = implode("', '", array_values($data));

        foreach ($data as $key => $value) {
            $querySet .= $key."='".$value."',";
        }

        $query = 'UPDATE '.$table.' SET '.substr($querySet, 0, -1)." WHERE jeu_id='".$data['id']."'";

        try {
            $reponse = $this->getAdapter()->prepare($query);
            $reponse->execute();
            $result = ['code' => DB_SUCCESS_UPDATE, 'id' => $data['id'], 'message' => []];
        } catch (PDOException $e) {
            echo 'Error'.$e->getMessage();
            echo $query;
            $result = ['code' => -1, 'id' => $data['id'], 'message' => $e->getMessage()];
        }

        return $result;
    }

    public function delete($where, $table)
    {
        if (!$where) {
            die('missing where');
        }

        $fields = $this->getColumns($table);
        $querySet = '';
        foreach ($where as $field => $value) {
            if (!in_array($field, $fields)) {
                unset($where[$field]);
            }
        }

        $queryFields = implode(', ', array_keys($where));
        $queryData = implode("', '", array_values($where));

        foreach ($where as $key => $value) {
            $querySet .= $key."='".$value."'";
        }

        $query = 'DELETE FROM '.$table.' WHERE '.$querySet;

        try {
            $reponse = $this->getAdapter()->prepare($query);
            $reponse->execute();
            $result = ['code' => DB_SUCCESS_DELETE, 'id' => $where, 'message' => []];
        } catch (PDOException $e) {
            echo 'Error'.$e->getMessage();
            echo $query;
            $result = ['code' => -1, 'id' => $where, 'message' => $e->getMessage()];
        }

        return $result;
    }

    public function save($data, $table)
    {
        if (!isset($data['id'])) {
            $result = $this->insert($data, $table);
        } else {
            $result = $this->update($data, $table);
        }

        return $result;
    }
}
