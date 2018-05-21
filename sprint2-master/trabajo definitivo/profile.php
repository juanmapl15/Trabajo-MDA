<?php
include_once "lib.php";

if (!User::getLoggedUser()) {
    header("location: login.php");
}

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $idmedico = User::getLoggedUser()['DNI'];
    $idusuario = $_GET['id'];

    $existid = DB::execute_sql("SELECT COUNT(*) FROM medicos WHERE DNI = ?", array($idusuario));

    if ($existid -> fetchColumn() > 0) {
        View::start("Perfil");
        View::navbar();

        //Información de mi perfil
        $res = DB::execute_sql("SELECT * FROM medicos WHERE DNI = ?", array($idusuario));
        $result = $res->fetch(PDO::FETCH_NAMED);
        $foto = $result["Foto"];
        $picture_src = "data:image/jpeg;base64," . base64_encode($foto);
        ?>
        <div>
            <div class="editb">
                <?php
                if ($idmedico === $idusuario) {
                    echo '<a href="editMedico.php?id=' . $idusuario . '"><button type="button" style="float: right; max-width: 200px; border-radius: 10px; margin-right: 20px">Editar perfil</button></a>';
                }
                ?>
            </div>
            <div class="card-container">
                <div class="card-doctor" style="margin: 8px 5px 25px 30px    ">
                    <?php echo "<img class='doctor-image' style='margin-top: 10px; height: 250px; max-width: 300px  ' src='$picture_src'>"; ?>
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
            $consulta = DB::execute_sql("SELECT * FROM paciente where Mimedico = ?", array($idusuario));
            $consulta->setFetchMode(PDO::FETCH_NAMED);
            User::imprimeSearch($consulta, 3);
            echo "</div>";


            View::footer();
            View::end();
    } else {
        View::start('Error 404');
        View::navbar();

        $doc = new DOMDocument();
        $doc->loadHTMLFile("pageNotFound.html");
        echo $doc->saveHTML();

        View::footer();
    }
} else {
    header("location: login.php");
}
?>
