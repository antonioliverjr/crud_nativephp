<?php

use Source\Support\Pager;

include __DIR__."/templates/header.php";

$curso = new \Source\CursoModel();
$curTot = $curso->getCurTotal();
$getPage = filter_input(INPUT_GET, "page", FILTER_VALIDATE_INT);

$pager = new Pager("?page=");
$pager->pager($curTot->total, 5, $getPage, 2);

$cursos = $curso->getCurAll($pager->limit(), $pager->offset());

$data = filter_input(INPUT_POST, "form_curso", FILTER_SANITIZE_STRING);
if(isset($data))
{
    $newCurso = new \Source\CursoModel();
    $result = $newCurso->insertCur($data);
    if($result > 0){
        header("Location: http://localhost/cursos.php");
    }else{
        echo "<p>{$newCurso->fail}</p>";
    }
}

?>

    <title>CRUD Nativo</title>
</head>
<body>
    <h1 class="text-center">Cadastrar Cursos</h1>
        <form action="cursos.php" method="post">
        <div class="form-row justify-content-center">
            <div class="form-row col-md-6">
                <div class="form-group col-md-12">
                    <label>Nome</label>
                    <input class="form-control" type="text" name="form_curso" id="form_curso" required>
                </div>
                <div class="form-group col-12 mt-4 text-center">
                    <button class="btn btn-success mr-2" type="submit">Cadastrar</button>
                    <a class="btn btn-dark" href="http://localhost/insert.php">Voltar</a>
                </div>
            </div>
        </div>
        </form>
        <div class="row justify-content-center">
            <table class="table table-dark text-center col-sm-6">
                <thead>
                    <tr>
                        <td>Id</td>
                        <td>Nome do Curso</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($cursos as $curso){
                    ?>
                        <tr>
                            <td>
                                <?php echo $curso->id_cur; ?>
                            </td>
                            <td>
                                <?php echo $curso->curdes; ?>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="row justify-content-center">
        <?php
            echo $pager->render();
        ?>
        </div>
        
    <?php
        include __DIR__."/templates/footer.php";
    ?>
</body>
</html>