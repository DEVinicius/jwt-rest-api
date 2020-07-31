<?php

namespace Source\Models;

use PDO;

class Database extends PDO{
    private $conn;

    public function __construct()
    {
        $this->conn = connect();
    }

    private function setParams($query, array $parameters)
    {
        
        foreach ($parameters as $key => $value) {
            $this->setParam($query, $key, $value);
        }
    }

    private function setParam($query, $key, $value)
    {
        $query->bindParam($key, $value);
    }

    public function query_database(string $rawQuery, array $params)
    {
        
        $query = $this->conn->prepare($rawQuery);

        $this->setParams($query, $params);

        $query->execute();

        return $query;
    }

    public function select($rawQuery, array $params)
    {
        $result = $this->query_database($rawQuery, $params);

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
}