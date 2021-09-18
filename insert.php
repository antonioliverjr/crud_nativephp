<?php
require __DIR__."/Source/autoload.php";

$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

if(isset($id)){
    //$values = $base;
    //$values = listing($id);
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
        <form action="" method="post">  
        <div class="form-row justify-content-center">
            <div class="form-row col-md-6">
                <div class="form-group col-md-12">
                    <label>Nome</label>
                    <input class="form-control" type="text" name="form_alunom" id="alunom" required>
                </div>
                <div class="form-group col-md-6">
                    <label>Data de Nascimento</label>
                    <input class="form-control" type="date" name="form_aludat" id="alunom" required>
                </div>
                <div class="form-group col-md-6">
                    <label>CPF</label>
                    <input class="form-control" type="text" name="form_alucpf" id="alunom" maxlength="11" required>
                </div>
                <div class="form-group col-md-6">
                    <label>Telefone</label>
                    <input class="form-control" type="text" name="form_alutel" id="alunom" maxlength="11">
                </div>
                <div class="form-group col-md-6">
                    <label>Whatsapp</label>
                    <input class="form-control" type="text" name="form_aluwha" id="alunom" maxlength="11">
                </div>
                <div class="form-group col-md-12">
                    <label>Curso Pretendido</label>
                    <select class="custom-select" name="form_alucur" id="form_alucur" required>
                    <option value="">Selecionar</option>
                        <?php
                        foreach($cursos as $curso){
                        ?>
                        <option value="<?php echo $curso->id_cur; ?>"><?php echo $curso->curdes; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group col-12 mt-4 text-center">
                    <input class="btn btn-success mr-2" type="submit" value="Cadastrar">
                    <a class="btn btn-dark" href="http://localhost/index.php">Voltar</a>
                </div>
            </div>
        </div>
    </form>
</body>
</html>