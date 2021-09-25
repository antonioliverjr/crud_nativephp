<?php

use Source\AlunoModel;

include __DIR__."/templates/header.php";

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
    <title>CRUD Nativo</title>
</head>
<body>
    <h1 class="text-center"><?php if(isset($id)){echo "Atualizar Cadastro";}else {echo "Cadastrar Aluno";}?></h1>
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
                <div class="form-group col-md-12 d-flex">
                    <div style="width: 90%;">
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
                    </div>
                    <div class="text-center p-4" style="width: 10%;">
                        <a class="btn btn-dark" href="cursos.php">+</a>
                    </div>
                </div>
                <div class="form-group col-12 mt-4 text-center">
                    <input class="btn btn-success mr-2" type="submit" value="<?php if(isset($id)){echo "Atualizar";}else {echo "Cadastrar";}?>">
                    <a class="btn btn-dark" href="index.php">Voltar</a>
                </div>
            </div>
        </div>
    </form>
    <?php
        include __DIR__."/templates/footer.php";
    ?>
</body>
</html>