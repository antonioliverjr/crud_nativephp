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
    public function getCurAll(): ?array
    {
        $query = $this->read("SELECT * FROM ".self::$dbname);
        return $query->fetchAll();
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