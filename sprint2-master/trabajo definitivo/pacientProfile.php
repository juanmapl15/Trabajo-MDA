<?php
include_once "lib.php";

if (!User::getLoggedUser()){
    header("location: login.php");
}

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $idUsuario = User::getLoggedUser()['DNI'];
    $num = $_GET['id'];

    $existid = DB::execute_sql("SELECT COUNT(*) FROM paciente WHERE DNI = ?", array($num));

    if ($existid -> fetchColumn() > 0) {
        View::start("Perfil");
        View::navbar();

        if (isset($_POST['hacer'])) {
            $tempUsuario = $idUsuario;
            $accionPaciente = $_POST['hacer'];

            if ($accionPaciente == "quitar") {
                $tempUsuario = "";
            }
            $sql = "UPDATE paciente SET Mimedico = ? WHERE DNI = ?";
            DB::execute_sql($sql, array($tempUsuario, $num));

        }
        $res = DB::execute_sql("SELECT * FROM paciente WHERE DNI = ?", array($num));
        $result = $res->fetch(PDO::FETCH_NAMED);
        $foto = $result["Foto"];
        $picture_src = "data:image/jpeg;base64," . base64_encode($foto);
        ?>
        <div class="limite" style="width: 100%">
            <div style="width: 30%">
                <div class="card" style="margin: 8px 5px 25px 30px    ">
                    <?php echo "<img  style='margin-top: 10px; height: 250px; max-width: 300px  ' src='$picture_src'>"; ?>
                    <h2><?php echo $result["Nombre"]; ?></h2>
                    <p class="title">Ciudad: <?php echo $result["Ciudad"]; ?></p>
                    <p class="title">Edad: <?php echo $result["Edad"]; ?></p>
                    <p class="title">Telf: <?php echo $result["Telefono"]; ?></p>
                    <div class="onoffswitch">

                        <?php

                        $temp = "pacientProfile.php?id=" . $num;
                        echo "<form action=$temp method='post'>";

                        $medico = $result["Mimedico"];

                        if ($medico == $idUsuario) {
                            //el paciente pertenece al medico actual muestro el check Quitar
                            echo '<input type="hidden" name="hacer" value="quitar" >';
                            echo '<input type="checkbox"  onclick="this.form.submit()" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch" checked>';

                        } else {
                            echo '<input type="hidden" name="hacer" value="añadir" >';
                            echo '<input type="checkbox"  onclick="this.form.submit()" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch" >';
                        }
                        ?>


                        <label class="onoffswitch-label" for="myonoffswitch">
                            <span class="onoffswitch-inner"></span>
                            <span class="onoffswitch-switch"></span>
                        </label>


                        </form>

                    </div>

                </div>
            </div>

            <div>
                <?php
                echo '
                <ul class="tamhref ulprofile">
                    <li class="li-profile" style="float: left"><a class="noReload lia" style="text-decoration: none" href="alergias.php?id=' . $num . '"> Alergias </a></li>
                    <li class="li-profile" style="float: left"><a id="hist" class="noReload lia" style="text-decoration: none" href="historial.php?id=' . $num . '"> Historial </a></li>
                    <li class="li-profile" style="float: left"><a class="noReload lia" style="text-decoration: none" href="familiares.php?id=' . $num . '">Antecedentes Familiares</a></li>
                    <li class="li-profile" style="float: left"><a a class="noReload lia" style="text-decoration: none" href="personales.php?id=' . $num . '">Antecedentes Personales</a></li>
                </ul>
                ';
                ?>
                <div id="page" class="margin"
                ">
            </div>
        </div>

        </div >


        </div>

        </div>

        <?php
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