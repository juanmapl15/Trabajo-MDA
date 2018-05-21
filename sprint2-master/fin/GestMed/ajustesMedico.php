<?php
include_once "lib.php";

if (!User::getLoggedUser()){
    header("location: login.php");
}

View::start("Añadir Paciente");
View::navbar();




if(isset($_POST['regist'])){
    $servicio = $_POST['servicio'];
    $Foto = file_get_contents($_FILES['image']['tmp_name']);
    $DNI= User::getLoggedUser()['DNI'];


    $sql = "UPDATE medicos SET Servicio = ?, Foto = ? WHERE DNI = ?";
    $res = DB::execute_sql($sql, array($servicio, $Foto, $DNI));


    if ($res) {
        echo '<script type="text/javascript"> myAlert(5);</script>';
        header("location: miPerfil.php");
    }


}else{
    $value= $_GET['id'];
    $res = DB::execute_sql("SELECT * FROM medicos WHERE DNI = ?",array($value));
    $result = $res->fetch(PDO::FETCH_NAMED);
    $foto = $result["Foto"];
    $picture_src = "data:image/jpeg;base64," . base64_encode($foto);
    echo "$value";
    echo "
<div id='contenido'>
    <div id='wrapper'>
        <h2>Modificar mi perfil: </h2>
        <form action='ajustesMedico.php' method='POST' enctype='multipart/form-data';'>
            <div id='username_div'>
                <label>Servicio</label> <br>
                <input type='text' name='servicio' id='servicio' class='textInput' value=".$result['Servicio']." placeholder='Servicio prestado'>
                <div id='name_error'></div>
            </div>



            <div id='foto_div'><br>
                <label>Foto de perfil:</label> <br>
                <input type='file' name='image'  value=". $picture_src ." >
                <div id='name_error'></div>
            </div>
            <br>

            <div>
                <input type='submit' name='regist' value='Modifcar' class='btno'>
            </div>

        </form>
    </div>
</div>
";
}








View::footer();
View::end();
