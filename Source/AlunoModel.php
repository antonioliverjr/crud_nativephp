<?php

namespace Source;

use Source\Model\Models;

/**
 *
 */
class AlunoModel extends Models
{

    /**
     * @var string
     */
    protected static $dbname = "public.tt_aluno";

    /**
     * @return array|false
     * @param int $limit
     * @param int $offset
     */
    public function getAluAll(int $limit = 0, int $offset = 0): array
    {
        $query = $this->read("SELECT * FROM ".self::$dbname." inner join public.td_cursos on alucur = id_cur order by alunom", "limit={$limit}&offset={$offset}");
        return $query->fetchAll();
    }

    public function getAluTotal(): ?array
    {
        return $this->read("SELECT COUNT(id_alu) FROM ".self::$dbname)->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     * @param int $id
     * @return null|\stdClass
     */
    public function getAluId(int $id): ?\stdClass
    {
        $query = $this->read("SELECT * FROM ".self::$dbname." inner join public.td_cursos on alucur = id_cur WHERE id_alu = :id", "id={$id}");
        return $query->fetch();
    }

    /**
     * @param string $cpf
     * @return bool|null
     */
    public function findAluCpf(string $cpf): ?bool
    {
        $query = $this->read("SELECT * FROM ".self::$dbname." WHERE alucpf = :cpf", "cpf={$cpf}");
        return $query->rowCount();
    }

    /**
     * @param array $data
     * @return int|string|null
     */
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

    /**
     * @param $id_alu
     * @return int|null
     */
    public function destroy($id_alu): ?int
    {
        $id['id_alu'] = $id_alu;
        $query = $this->delete(self::$dbname, $id);
        return $query ?? 1;
    }

}

?>