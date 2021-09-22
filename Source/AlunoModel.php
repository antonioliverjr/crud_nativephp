<?php

namespace Source;

use Source\Model\Models;

class AlunoModel extends Models
{
    protected static $dbname = "public.tt_aluno";

    public function getAluAll()
    {
        $query = $this->read("SELECT * FROM ".self::$dbname." inner join public.td_cursos on alucur = id_cur order by alunom");
        return $query->fetchAll();
    }

    public function getAluId(int $id)
    {
        $query = $this->read("SELECT * FROM ".self::$dbname." inner join public.td_cursos on alucur = id_cur WHERE id_alu = :id", "id={$id}");
        return $query->fetch();
    }

    public function findAluCpf(string $cpf): ?bool
    {
        $query = $this->read("SELECT * FROM ".self::$dbname." WHERE alucpf = :cpf", "cpf={$cpf}");
        return $query->rowCount();
    }

    public function insertAlu(array $data)
    {
        if(!isset($data)){
            $this->fail = "Favor informar os dados a cadastrar ou atualizar!";
            return null;
        }
        
        if(isset($data['id_alu'])){
            //Aqui realiza Update
            $query = $this->update(self::$dbname, $data, "id_alu = :id_alu", "id_alu={$data['id_alu']}");
            return $query;
        } else {
            //Aqui realiza novo cadastro
            $query = $this->findAluCpf($data['alucpf']);
            
            if($query){
                $this->fail = "CPF já está cadastrado, favor verificar!";
                return null;
            }

            $data['alucad'] = date("d-m-Y H:i:s");
            $coluns = implode(", ", array_keys($data));
            $value = ":".implode(", :", array_keys($data));
            $query = $this->insert("INSERT INTO ".self::$dbname." ($coluns) VALUES ($value)", json_encode($data));
            return $query;
        }

        $this->fail = "Não há dados para inserir ou atualizar!";
        return null;
        
    }

}

?>