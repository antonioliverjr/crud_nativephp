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

    /*public function insertCur($data): ?bool
    {

        $curdes = filter_var($data, FILTER_SANITIZE_STRING);
        $db = Connect::getConn();
        $stmt = $db->prepare("INSERT INTO public.td_cursos (curdes) VALUES ($curdes)");
        var_dump($stmt);

        if($cursos != 0){
            return true;
        } else {
            return false;
        }
    }*/

}