<?php
include_once "lib.php";

if (!User::getLoggedUser()){
    header("location: login.php");
}

if (isset($_POST['metodo']) && isset($_POST['id']) && isset($_POST['texto'])) {
    $metodo = $_POST['metodo'];
    $idpaciente = $_POST['id'];
    $idmedico = User::getLoggedUser()['DNI'];
    $texto = $_POST['texto'];

    switch ($metodo) {
        case 1:
            $res = DB::execute_sql("INSERT INTO alergias(idpaciente, idmedico, texto) VALUES (?,?,?)", array($idpaciente, $idmedico, $texto));

            break;
        case 2:
            $res = DB::execute_sql("INSERT INTO historial(idpaciente, idmedico, texto) VALUES (?,?,?)", array($idpaciente, $idmedico, $texto));

            break;
        case 3:
            $res = DB::execute_sql("INSERT INTO antfamiliares(idpaciente, idmedico, texto) VALUES (?,?,?)", array($idpaciente, $idmedico, $texto));

            break;
        case 4:
            $res = DB::execute_sql("INSERT INTO antpersonal(idpaciente, idmedico, texto) VALUES (?,?,?)", array($idpaciente, $idmedico, $texto));

            break;
    }
} else {
    header("location: login.php");
}
?>