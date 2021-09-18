<?php

require __DIR__."/Source/autoload.php";

$alunos = new \Source\AlunoModel();
$alunos = $alunos->getAluAll();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FSPHP CRUD</title>
</head>
<body>
    <h1 class="text-center">Alunos Cadastrados</h1>
    <div class="text-center">
        <a href="./insert.php" type="button" class="btn btn-primary mb-2">Cadastrar</a>
    </div>
    <table class="table table-hover table-dark">
        <thead>
            <tr>
                <th width="20%" class="text-center">Nome</th>
                <th width="15%" class="text-center">Telefone</th>
                <th width="15%" class="text-center">Whatsapp</th>
                <th width="20%" class="text-center">Curso Pretendido</th>
                <th width="20%" class="text-center">Data Cadastrado</th>
                <th width="10%" class="text-center">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($alunos as $aluno){
            ?>
            <tr>
                <td scope="row" class="text-center">
                    <span><?= $aluno->alunom ?></span>
                </td>
                <td class="text-center">
                    <span><?= $aluno->alutel ?></span>
                </td>
                <td class="text-center">
                    <span><?= $aluno->aluwha ?></span>
                </td>
                <td class="text-center">
                    <span><?= $aluno->curdes ?></span>
                </td>
                <td class="text-center">
                    <span><?= $aluno->alucad ?></span>
                </td>
                <td class="d-flex">
                    <a href="./insert.php?id=<?=$aluno->id_alu?>" type="button" class="btn btn-success mr-2">Atualizar</a>
                    <a href="./date/delete.php?id=<?=$aluno->id_alu?>" type="button" class="btn btn-danger">Excluir</a>
                </td>
            </tr>
            <?php 
            }
            ?>
        </tbody>
    </table>
</body>
</html>