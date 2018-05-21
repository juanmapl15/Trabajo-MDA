<?php
include_once "lib.php";

if (!User::getLoggedUser()){
    header("location: login.php");
}

$metodo = $_POST['metodo'];
$id = $_POST['id'];
$idoperacion=$_POST['idoperacion'];

switch ($metodo) {
    case 1:
        $res = DB::execute_sql("DELETE FROM alergias WHERE id = ?", array($idoperacion));

        break;
    case 2:
        $res = DB::execute_sql("DELETE FROM historial WHERE id = ?", array($idoperacion));

        break;
    case 3:
        $res = DB::execute_sql("DELETE FROM antfamiliares WHERE id = ?", array($idoperacion));

        break;
    case 4:
        $res = DB::execute_sql("DELETE FROM antpersonal WHERE id = ?", array($idoperacion));

        break;
}
?>