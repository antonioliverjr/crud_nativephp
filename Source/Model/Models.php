<?php

namespace Source\Model;

use Source\Database\Connect;

/**
 *
 */
abstract class Models
{

    /**
     * @param string $select
     * @param string|null $params
     * @return \PDOStatement|null
     */
    public function read(string $select, string $params = null): ?\PDOStatement
    {
        try{
            parse_str($params, $params);
            
            if($params){
                if(isset($params['limit'])){
                    if($params['limit'] > 0 && $params['offset'] == 0){
                        $stmt = Connect::getConn()->prepare($select." limit(:limit)");
                    } elseif($params['limit'] > 0 && $params['offset'] > 0){
                        $stmt = Connect::getConn()->prepare($select." limit(:limit) offset(:offset)");
                    } else {
                        $stmt = Connect::getConn()->prepare($select);
                    }

                    if($params['limit'] == 0){
                        unset($params['limit']);
                    }
                    if($params['offset'] == 0){
                        unset($params['offset']);
                    }
                } else {
                    $stmt = Connect::getConn()->prepare($select);
                }

                foreach ($params as $key => $value) {
                    $type = (is_numeric($value) ? \PDO::PARAM_INT : \PDO::PARAM_STR);
                    $stmt->bindValue(":{$key}", $value, $type);
                }
            }else{
                $stmt = Connect::getConn()->prepare($select);
            }
            
            $stmt->execute();
            return $stmt;
        }catch (\PDOException $exception){
            $this->fail = $exception;
            return null;
        }
    }

    /**
     * @param string $select
     * @param string $data
     * @return int|null
     */
    public function insert(string $select, string $data): ?int
    {
        try{
            $stmt = Connect::getConn()->prepare($select);
            if(is_object(json_decode($data))){
                $data = json_decode($data, true);
            }
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

    /**
     * @param string $entity
     * @param array $data
     * @param string $terms
     * @param string $params
     * @return int|null
     */
    public  function update(string $entity, array $data, string $terms, string $params): ?int
    {
        try{
            $values = [];
            foreach($data as $key => $key){
                $values[] = "{$key} = :{$key}";
            }
            parse_str($params, $params);
            $values = implode(", ", $values);
            $stmt = Connect::getConn()->prepare("UPDATE {$entity} SET {$values} WHERE {$terms}");
            $stmt->execute(array_merge($data, $params));
            return Connect::getConn()->lastInsertId();
        }catch (\PDOException $exception){
            $this->fail = $exception;
            return null;
        }
    }

    /**
     * @param string $entity
     * @param array $data
     * @return int|null
     */
    public function delete(string $entity, array $data): ?int
    {
        try{
            $values = [];
            foreach($data as $key => $key){
                $values[] = "{$key} = :{$key}";
            }
            $values = implode(", ", $values);
            $stmt = Connect::getConn()->prepare("DELETE FROM {$entity} WHERE {$values}");
            $stmt->execute($data);
            return $stmt->rowCount();
        }catch (\PDOException $exception){
            $this->fail = $exception;
            return null;
        }
    }
}