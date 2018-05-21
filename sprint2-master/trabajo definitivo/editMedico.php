<?php
include_once "lib.php";

if (!User::getLoggedUser()){
    header("location: login.php");
}

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $curid = User::getLoggedUser()['DNI'];
    $id = $_GET['id'];

    if ($curid == $id) {
        $servicio = User::getLoggedUser()['Servicio'];

        $res = DB::execute_sql("SELECT Foto FROM medicos WHERE DNI = ?", array($id));
        $row = $res->fetch(PDO::FETCH_NAMED);
        $foto = $row['Foto'];

        View::start("Añadir Paciente");
        View::navbar();

        echo "
            <div id='contenido'>
                <div id='wrapper'>
                    <h2>Actualizar mi perfil</h2>
                    <form method='POST' id='editMedForm' name='medForm' onsubmit='return medValidation()'>
                        <input type='hidden' name='id' id='id' value=" . $id . ">
                        
                        <div id='username_div'>
                            <label>Servicio</label> <br>
                            <input type='text' name='service' id='texto' class='textInput' value=" . $servicio . ">
                            <div style='color: red;' id='text_error'></div>
                        </div>";

        if ($foto == null) {
            $picture_src = "data:image/jpeg;base64," . base64_encode($foto);
            echo "<div id='foto_div'><br>
                                    <label>Foto de perfil</label> <br>
                                    <input type='file' name='image' value=" . $picture_src . " >
                                  </div>";
        } else {
            echo "<br>
                                  <div class='checkbox'>
                                    <label><input type='checkbox' name='delimage' value='Yes'> Deseo eliminar mi foto de perfil actual</label>
                                  </div>";
        }

        echo "
                        <br>
            
                        <div>
                            <input type='submit' class='btn btno' value='Guardar' style='color: white' id='submit'>
                        </div>
                    </form>
                </div>
            </div>
        ";

        View::footer();
        View::end();
    } else {
        header("location: login.php");
    }
} else {
    header("location: login.php");
}
?>