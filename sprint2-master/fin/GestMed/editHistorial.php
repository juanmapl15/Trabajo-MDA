<?php
include_once "lib.php";

$id = $_GET['idoperacion'];
$idpaciente = $_GET['id'];
$metodo = $_GET['metodo'];

if (!User::getLoggedUser()){
    header("location: login.php");
}

View::start("Editar Historial de Paciente");
View::navbar();

switch($metodo) {
    case 1:
        $res = DB::execute_sql("SELECT texto FROM alergias WHERE id=?", array($id));
        $res -> execute();
        $row = $res -> fetch(PDO::FETCH_NAMED);

        $title = "Editar alergia";
        $label = "Información de alergia";

        break;
    case 2:
        $res = DB::execute_sql("SELECT texto FROM historial WHERE id=?", array($id));
        $res -> execute();
        $row = $res -> fetch(PDO::FETCH_NAMED);

        $title = "Editar entrada del historial";
        $label = "Información de entrada";

        break;
    case 3:
        $res = DB::execute_sql("SELECT texto FROM antfamiliares WHERE id=?", array($id));
        $res -> execute();
        $row = $res -> fetch(PDO::FETCH_NAMED);

        $title = "Editar antecedente familiar";
        $label = "Información de antecedente familiar";

        break;
    case 4:
        $res = DB::execute_sql("SELECT texto FROM antpersonal WHERE id=?", array($id));
        $res -> execute();
        $row = $res -> fetch(PDO::FETCH_NAMED);

        $title = "Editar antecedente personal";
        $label = "Información de antecedente personal";

        break;
}

echo '
    <div id="contenido">
        <div id="wrapper">
            <h2>'.$title.'</h2>
            <form method="POST" id="editHistForm" name="histForm" onsubmit="return histValidation()">
                <div id="username_div">
                    <label>'.$label.'</label><br>
                    <input type="hidden" name="metodo" id="metodo" value='.$metodo.'>
                    <input type="hidden" name="id" value='.$id.'>
                    <input type="hidden" name="idpaciente" id="id" value='.$idpaciente.'>
                    <textarea name="texto" id="texto" rows="10" cols="59">'.$row['texto'].'</textarea>
                    <div style="color: red;" id="text_error"></div>
                </div>
                <div>
                    <input type="submit" class="btn btno" value="Guardar" style="cursor: default; color: white" id="submit" disabled>
                </div>
            </form>
        </div>
    </div>
';

View::footer();
View::end();
?>