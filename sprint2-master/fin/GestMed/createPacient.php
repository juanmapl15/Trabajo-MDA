<?php
include_once "lib.php";

if (!User::getLoggedUser()){
    header("location: login.php");
}

$idmedico= User::getLoggedUser()['DNI'];

$dni = $_POST['dni'];
$nombre = $_POST['name'];
$edad = $_POST['age'];
$ciudad = $_POST['city'];
$telefono = $_POST['telephone'];

if(!file_exists($_FILES['image']['tmp_name'])) {
    $foto = null;
    $res = DB::execute_sql("INSERT INTO paciente(DNI, Nombre, Edad, Ciudad, Telefono, Foto, Mimedico) VALUES (?,?,?,?,?,?,?)", array($dni, $nombre, $edad, $ciudad, $telefono, $foto, $idmedico));
} else {
    $imgcheck = getimagesize($_FILES['image']['tmp_name']);

    if(!$imgcheck) {
        echo 'No es una imagen válida';
    } else {
        $foto = file_get_contents ($_FILES['image']['tmp_name']);

        $res = DB::execute_sql("INSERT INTO paciente(DNI, Nombre, Edad, Ciudad, Telefono, Foto, Mimedico) VALUES (?,?,?,?,?,?,?)", array($dni, $nombre, $edad, $ciudad, $telefono, $foto, $idmedico));
    }
}
?>