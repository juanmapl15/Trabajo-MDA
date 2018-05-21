<?php
include_once "lib.php";

if (!User::getLoggedUser()){
    header("location: login.php");
}

View::start("Perfil");
View::navbar();

$idUsuario = $_GET['id'];

//Informacion de mi perfil
$res = DB::execute_sql("SELECT * FROM medicos WHERE DNI = ?",array($idUsuario));
$result = $res->fetch(PDO::FETCH_NAMED);
$foto = $result["Foto"];
$picture_src = "data:image/jpeg;base64," . base64_encode($foto);
?>

<div>
    <div class="editb">
       <?php echo '
        <a href="ajustesMedico.php?id='.$idUsuario.'"><button type="button" style="float: right; max-width: 200px; border-radius: 10px; margin-right: 20px">Editar perfil</button></a>'; ?>
    </div>
    <div  class="card-container">
        <div class="card-doctor" style="margin: 8px 5px 25px 30px    ">
            <?php  echo "<img class='doctor-image' style='margin-top: 10px; height: 250px; max-width: 300px  ' src='$picture_src'>"; ?>
            <div class="card-doctor-letters">
                <h2 class="doctor-title"><?php echo $result["Nombre"]; ?></h2>
                <p class="subtitle-doctor">Servicio: <?php echo $result["Servicio"]; ?></p>
                <p class="subtitle-doctor">DNI: <?php echo $result["DNI"]; ?></p>
                <p class="subtitle-doctor">NColegiado: <?php echo $result["NColegiado"]; ?></p>
            </div>

        </div>
    </div>





<?php
//TABLA DE MIS PACIENTES
$consulta = DB::execute_sql("SELECT * FROM paciente where Mimedico = ?", array($idUsuario));
$consulta->setFetchMode(PDO::FETCH_NAMED);
User::imprimeSearch($consulta,3);
echo "</div>";


    View::footer();
    View::end()
?>

