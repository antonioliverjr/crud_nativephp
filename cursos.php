<?php
require __DIR__."/Source/autoload.php";

$cursos = new \Source\CursoModel();
$cursos = $cursos->getCurAll();

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

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <table>
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
</body>
</html>