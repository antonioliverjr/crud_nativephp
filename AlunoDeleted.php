<?php

use Source\AlunoModel;

require __DIR__."/Source/autoload.php";

$id = filter_input(INPUT_POST, "id_alu", FILTER_VALIDATE_INT);
if(isset($id)){
    $id_alu = new AlunoModel();
    return  $id_alu->destroy($id);
}
return false;