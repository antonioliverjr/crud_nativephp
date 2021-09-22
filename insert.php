<?php

use Source\AlunoModel;

require __DIR__."/Source/autoload.php";

$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

$cadastro = new AlunoModel();
$cadastro->data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
if(isset($cadastro->data)){
    if(isset($id)){
        $cadastro->data['id_alu'] = $id;
    }
    $result = $cadastro->insertAlu($cadastro->data);
    if($result > 0){
        header("Location: insert.php?id=$result");
    }
}

if(isset($id)){
    $alunos = new \Source\AlunoModel();
    $alunos = $alunos->getAluId($id);
}

$cursos = new \Source\CursoModel();
$cursos = $cursos->getCurAll();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Nativo</title>
</head>
<body>
    <h1 class="text-center">Cadastrar Alunos</h1>
        <form action="<?php if(isset($id)){echo 'insert.php?id='.$alunos->id_alu;}else{echo 'insert.php';} ?>" method="post">  
        <div class="form-row justify-content-center">
            <div class="form-row col-md-6">
                <div class="form-group col-md-12">
                    <label>Nome</label>
                    <input class="form-control" type="text" name="alunom" id="alunom" value="<?= $alunos->alunom ?? ''?>" required>
                </div>
                <div class="form-group col-md-6">
                    <label>Data de Nascimento</label>
                    <input class="form-control" type="date" name="aludat" id="aludat" value="<?= $alunos->aludat ?? ''?>" required>
                </div>
                <div class="form-group col-md-6">
                    <label>CPF</label>
                    <input class="form-control" type="text" name="alucpf" id="alucpf" value="<?= $alunos->alucpf ?? ''?>" maxlength="11" required>
                </div>
                <div class="form-group col-md-6">
                    <label>Telefone</label>
                    <input class="form-control" type="text" name="alutel" id="alutel" value="<?= $alunos->alutel ?? ''?>" maxlength="11">
                </div>
                <div class="form-group col-md-6">
                    <label>Whatsapp</label>
                    <input class="form-control" type="text" name="aluwha" id="aluwha" value="<?= $alunos->aluwha ?? ''?>" maxlength="11">
                </div>
                <div class="form-group col-md-12">
                    <label>Curso Pretendido</label>
                    <select class="custom-select" name="alucur" id="form_alucur" required>
                        <option value="">Selecionar</option>
                        <?php
                        foreach($cursos as $curso){
                        ?>
                        <option value="<?php echo $curso->id_cur; ?>" <?php if(isset($id)){if($curso->id_cur == $alunos->alucur){echo "selected";}} ?>><?php echo $curso->curdes; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                    <a class="btn btn-dark" href="cursos.php">+</a>
                </div>
                <div class="form-group col-12 mt-4 text-center">
                    <input class="btn btn-success mr-2" type="submit" value="Cadastrar">
                    <a class="btn btn-dark" href="index.php">Voltar</a>
                </div>
            </div>
        </div>
    </form>
</body>
</html>