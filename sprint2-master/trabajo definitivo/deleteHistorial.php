<?php
include_once "lib.php";

if (!User::getLoggedUser()){
    header("location: login.php");
}

if (isset($_POST['idoperacion']) && isset($_POST['id']) && isset($_POST['metodo'])) {
    $metodo = $_POST['metodo'];
    $id = $_POST['idoperacion'];
    $idpaciente = $_POST['id'];

    switch ($metodo) {
        case 1:
            $res = DB::execute_sql("DELETE FROM alergias WHERE id = ?", array($id));

            break;
        case 2:
            $res = DB::execute_sql("DELETE FROM historial WHERE id = ?", array($id));

            break;
        case 3:
            $res = DB::execute_sql("DELETE FROM antfamiliares WHERE id = ?", array($id));

            break;
        case 4:
            $res = DB::execute_sql("DELETE FROM antpersonal WHERE id = ?", array($id));

            break;
    }
} else {
    header("location: login.php");
}
?>