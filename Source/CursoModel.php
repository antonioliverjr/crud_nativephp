<?php

namespace Source;

use Source\Model\Models;

/**
 *
 */
class CursoModel extends Models
{
    /**
     * @var string
     */
    protected static $dbname = 'public.td_cursos';

    /**
     * @retun null|array
     */
    public function getCurAll(int $limit = 0, int $offset = 0): ?array
    {
        $query = $this->read("SELECT * FROM ".self::$dbname, "limit={$limit}&offset={$offset}");
        return $query->fetchAll();
    }

    public function getCurTotal()
    {
        return $this->read("SELECT COUNT(id_cur) as total FROM ". self::$dbname)->fetch();
    }

    /**
     * @param $data
     * @return int|null
     */
    public function insertCur($data): ?int
    {
        $curdes = filter_var($data, FILTER_SANITIZE_STRING);
        $curdes = trim($curdes);

        if(isset($curdes)){
            $query = $this->read("SELECT * FROM ".self::$dbname." WHERE curdes = :curdes", "curdes={$curdes}");
            if($query->rowCount() > 0){
                $this->fail = "Este curso aparenta já está cadastrado!";
                return null;
            }
        }

        $query = $this->insert("INSERT INTO ".self::$dbname." (curdes) VALUES (:curdes)", "curdes={$data}");
        return $query;
    }

}