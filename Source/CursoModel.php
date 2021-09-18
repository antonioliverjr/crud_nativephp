<?php

namespace Source;

use Source\Model\Models;

class CursoModel extends Models
{
    protected static $dbname = 'public.td_cursos';

    /**
     *
     */
    public function getCurAll()
    {
        $query = $this->read("SELECT * FROM ".self::$dbname);
        return $query->fetchAll();
    }

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