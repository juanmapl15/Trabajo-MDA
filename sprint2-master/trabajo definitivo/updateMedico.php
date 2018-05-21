<?php
include_once "lib.php";

if (!User::getLoggedUser()){
    header("location: login.php");
}

if (isset($_POST['service'])) {
    $id = User::getLoggedUser()['DNI'];
    $servicio = $_POST['service'];

    if (isset($_POST['delimage']) && $_POST['delimage'] == 'Yes') {
        $res = DB::execute_sql("UPDATE medicos SET Servicio = ?,  Foto = ? WHERE DNI = ?", array($servicio, null, $id));
    }

    if(isset($_FILES['image'])) {
        if (!file_exists($_FILES['image']['tmp_name'])) {
            $foto = null;
            $res = DB::execute_sql("UPDATE medicos SET Servicio = ?,  Foto = ? WHERE DNI = ?", array($servicio, $foto, $id));
        } else {
            $imgcheck = getimagesize($_FILES['image']['tmp_name']);

            if (!$imgcheck) {
                echo 'No es una imagen válida';
            } else {
                $foto = file_get_contents($_FILES['image']['tmp_name']);

                $res = DB::execute_sql("UPDATE medicos SET Servicio = ?,  Foto = ? WHERE DNI = ?", array($servicio, $foto, $id));
            }
        }
    }
} else {
    header("location: login.php");
}