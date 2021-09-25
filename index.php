<?php
include __DIR__."/templates/header.php";
/*
use Source\Database\Connect;

$conn = Connect::getConn();
$result = $conn->prepare("select * from dbo.testedb");
$result->execute();
$result = $result->fetchAll(\PDO::FETCH_ASSOC);
var_dump($result);
*/
$alunos = new \Source\AlunoModel();
$alunos = $alunos->getAluAll();



?>
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
                    <button type="button" class="btn btn-danger button-deleted" value="<?=$aluno->id_alu?>">Excluir</button>
                </td>
            </tr>
            <?php 
            }
            ?>
        </tbody>
    </table>
    <?php
        include __DIR__."/templates/footer.php";
    ?>
    <script src="./assets/js/main.js"></script>
</body>
</html>
    