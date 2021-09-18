<?php

namespace Source\Model;

use Source\Database\Connect;

abstract class Models
{
    public function read(string $select, string $params = null): ?\PDOStatement
    {
        try{
            $stmt = Connect::getConn()->prepare($select);
            $stmt->execute();
            return $stmt;
        }catch (\PDOException $exception){
            $this->fail = $exception;
            return null;
        }
    }

    public function insert()
    {

    }

    public  function update()
    {

    }

    public function delete()
    {

    }
}