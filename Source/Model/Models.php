<?php

namespace Source\Model;

use Source\Database\Connect;

abstract class Models
{
    public function read(string $select, string $params = null): ?\PDOStatement
    {
        try{
            $stmt = Connect::getConn()->prepare($select);
            if($params){
                parse_str($params, $params);
                foreach ($params as $key => $value) {
                    $type = (is_numeric($value) ? \PDO::PARAM_INT : \PDO::PARAM_STR);
                    $stmt->bindValue(":{$key}", $value, $type);
                }
            }
            $stmt->execute();
            return $stmt;
        }catch (\PDOException $exception){
            $this->fail = $exception;
            return null;
        }
    }

    public function insert(string $select, string $data): ?int
    {
        try{
            $stmt = Connect::getConn()->prepare($select);
            parse_str($data, $data);
            foreach ($data as $key => $value){
                $type = (is_numeric($value) ? \PDO::PARAM_INT : \PDO::PARAM_STR);
                $stmt->bindValue(":{$key}", $value, $type);
            }
            $stmt->execute();
            return Connect::getConn()->lastInsertId();
        }catch (\PDOException $exception){
            $this->fail = $exception;
            return null;
        }
    }

    public  function update()
    {

    }

    public function delete()
    {

    }
}