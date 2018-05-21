<?php
include_once "lib.php";

if (!User::getLoggedUser()){
    header("location: login.php");
}

$metodo = $_POST['metodo'];
$id = $_POST['id'];
$texto = $_POST['texto'];

switch($metodo) {
    case 1:
        $res = DB::execute_sql("UPDATE alergias SET texto = '$texto' WHERE id = ?", array($id));

        break;
    case 2:
        $res = DB::execute_sql("UPDATE historial SET texto = '$texto' WHERE id = ?", array($id));

        break;
    case 3:
        $res = DB::execute_sql("UPDATE antfamiliares SET texto = '$texto' WHERE id = ?", array($id));

        break;
    case 4:
        $res = DB::execute_sql("UPDATE antpersonal SET texto = '$texto' WHERE id = ?", array($id));

        break;
}
?>