<?php

namespace Source;

class AlunoModel
{

}


function listing($id = null)
{

    if($id == null){
        $values = [];
        $query = "SELECT alu.id_alu as id_alu, alu.alunom as alunom, alu.aludat as aludat, alu.alucpf as alucpf, alu.alutel as alutel, alu.aluwha as aluwha, alu.alucur as alucur, cur.curdes as curdes, alu.alucad as alucad
        FROM public.tt_aluno alu inner join public.td_cursos cur on alu.alucur = cur.id_cur
        order by alu.alunom";
        return $values = $conn->query($query);
    } else {
        $id_alu = $id;
        $values = [];
        $query = "SELECT alu.id_alu as id_alu, alu.alunom as alunom, alu.aludat as aludat, alu.alucpf as alucpf, alu.alutel as alutel, alu.aluwha as aluwha, alu.alucur as alucur, cur.curdes as curdes, alu.alucad as alucad
        FROM public.tt_aluno alu inner join public.td_cursos cur on alu.alucur = cur.id_cur
        where alu.id_alu = $id_alu";
        return $values = $conn->query($query);
    }
}

function option()
{
    $conn = new PDO('pgsql:host=localhost;dbname=jcl_tecno','postgres', 'gaproject');
    $cursos = [];
    $query = "SELECT * FROM public.td_cursos order by curdes";
    return $cursos = $conn->query($query);
}

if(isset($_POST['form_alunom'])){

    $post_alunom = $_POST['form_alunom'];
    $post_aludat = $_POST['form_aludat'];
    $post_alucpf = $_POST['form_alucpf'];
    $post_alutel = $_POST['form_alutel'];
    $post_aluwha = $_POST['form_aluwha'];
    $post_alucur = $_POST['form_alucur'];
    
    $post_aludat = str_replace('/','-', $post_aludat);

    if($post_alutel == ''){
        $post_alutel = null;
    }
    
    if($post_aluwha == ''){
        $post_aluwha = null;
    }
    
    if($post_alucur == ''){
        $post_alucur = null;
    }

    if($post_alunom != '' && $post_aludat != '' && $post_alucpf != ''){
        $conn = new PDO('pgsql:host=localhost;dbname=jcl_tecno','postgres', 'gaproject');
        $post_aludat = date("d-m-Y", strtotime($post_aludat));
        $post_alucad = date("d-m-Y H:i:s");
        $sql = 'INSERT INTO public.tt_aluno (
            alunom, 
            aludat, 
            alucpf, 
            alutel, 
            aluwha, 
            alucur, 
            alucad)
            VALUES (?, ?, ?, ?, ?, ?, ?)';
        $prepare = $conn->prepare($sql);
        $prepare->bindParam(1, $post_alunom);
        $prepare->bindParam(2, $post_aludat);
        $prepare->bindParam(3, $post_alucpf);
        $prepare->bindParam(4, $post_alutel);
        $prepare->bindParam(5, $post_aluwha);
        $prepare->bindParam(6, $post_alucur);
        $prepare->bindParam(7, $post_alucad);
        $prepare->execute();
        
        //$exec = pg_query($conn, $query);
        if(!$prepare->rowCount()){
            echo "<strong>Falha ao inserir aluno, verifique os dados inseridos ou se caso o aluno já possua cadastro favor atualizar o mesmo!</strong>";
        } else {
            header("Location: http://localhost/index.php"); 
        }
    }
}

if(isset($_POST['form_update'])){

    $post_idalu = $_POST['form_idalu'];
    $post_alunom = $_POST['form_alunom'];
    $post_aludat = $_POST['form_aludat'];
    $post_alucpf = $_POST['form_alucpf'];
    $post_alutel = $_POST['form_alutel'];
    $post_aluwha = $_POST['form_aluwha'];
    $post_alucur = $_POST['form_alucur'];
    
    $post_aludat = str_replace('/','-', $post_aludat);

    if($post_alutel == ''){
        $post_alutel = null;
    }
    
    if($post_aluwha == ''){
        $post_aluwha = null;
    }
    
    if($post_alucur == ''){
        $post_alucur = null;
    }

    if($post_alunom != '' && $post_aludat != '' && $post_alucpf != ''){
        $conn = new PDO('pgsql:host=localhost;dbname=jcl_tecno','postgres', 'gaproject');
        $post_aludat = date("d-m-Y", strtotime($post_aludat));
        $post_alucad = date("d-m-Y H:i:s");
        $sql = 'UPDATE public.tt_aluno SET
            alunom = ?, 
            aludat = ?, 
            alucpf = ?, 
            alutel = ?, 
            aluwha = ?, 
            alucur = ?, 
            alucad = ?
            WHERE id_alu = ?';
        $prepare = $conn->prepare($sql);
        $prepare->bindParam(1, $post_alunom);
        $prepare->bindParam(2, $post_aludat);
        $prepare->bindParam(3, $post_alucpf);
        $prepare->bindParam(4, $post_alutel);
        $prepare->bindParam(5, $post_aluwha);
        $prepare->bindParam(6, $post_alucur);
        $prepare->bindParam(7, $post_alucad);
        $prepare->bindParam(8, $post_idalu);
        $prepare->execute();
        
        //$exec = pg_query($conn, $query);
        if(!$prepare->rowCount()){
            echo "Falha ao atualizar dados do aluno!";
        } else {
            header("Location: http://localhost/index.php"); 
        }
    }
}


?>