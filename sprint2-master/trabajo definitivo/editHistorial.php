<?php
include_once "lib.php";

if (!User::getLoggedUser()){
    header("location: login.php");
}

if (isset($_GET['metodo']) && isset($_GET['idoperacion']) && isset($_GET['id']) && is_numeric($_GET['metodo']) && is_numeric($_GET['idoperacion']) && isset($_GET['id'])) {
    $metodo = $_GET['metodo'];
    $id = $_GET['idoperacion'];
    $idpaciente = $_GET['id'];

    if ($metodo > 0 && $metodo < 5) {
        $existid = DB::execute_sql("SELECT COUNT(*) FROM paciente WHERE DNI = ?", array($idpaciente));

        if ($existid -> fetchColumn() > 0) {
            switch ($metodo) {
                case 1:
                    $op = "alergias";

                    break;

                case 2:
                    $op = "historial";

                    break;

                case 3:
                    $op = "antfamiliares";

                    break;

                case 4:
                    $op = "antpersonal";

                    break;
            }

            $existop = DB::execute_sql("SELECT COUNT(*) FROM " . $op . " WHERE id = ? AND idpaciente = ?", array($id, $idpaciente));

            if ($existop -> fetchColumn() > 0) {

                View::start("Editar Historial de Paciente");
                View::navbar();

                switch ($metodo) {
                    case 1:
                        $res = DB::execute_sql("SELECT texto FROM alergias WHERE id = ?", array($id));
                        $res->execute();
                        $row = $res->fetch(PDO::FETCH_NAMED);

                        $title = "Editar alergia";
                        $label = "Información de alergia";

                        break;
                    case 2:
                        $res = DB::execute_sql("SELECT texto FROM historial WHERE id = ?", array($id));
                        $res->execute();
                        $row = $res->fetch(PDO::FETCH_NAMED);

                        $title = "Editar entrada del historial";
                        $label = "Información de entrada";

                        break;
                    case 3:
                        $res = DB::execute_sql("SELECT texto FROM antfamiliares WHERE id = ?", array($id));
                        $res->execute();
                        $row = $res->fetch(PDO::FETCH_NAMED);

                        $title = "Editar antecedente familiar";
                        $label = "Información de antecedente familiar";

                        break;
                    case 4:
                        $res = DB::execute_sql("SELECT texto FROM antpersonal WHERE id = ?", array($id));
                        $res->execute();
                        $row = $res->fetch(PDO::FETCH_NAMED);

                        $title = "Editar antecedente personal";
                        $label = "Información de antecedente personal";

                        break;
                }

                echo '
                    <div id="contenido">
                        <div id="wrapper">
                            <h2>' . $title . '</h2>
                            <form method="POST" id="editHistForm" name="histForm" onsubmit="return histValidation()">
                                <div id="username_div">
                                    <label>' . $label . '</label><br>
                                    <input type="hidden" name="metodo" id="metodo" value=' . $metodo . '>
                                    <input type="hidden" name="id" value=' . $id . '>
                                    <input type="hidden" name="idpaciente" id="id" value=' . $idpaciente . '>
                                    <textarea name="texto" id="texto" rows="10" cols="59">' . $row['texto'] . '</textarea>
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
            } else {
                View::start('Error 405');
                View::navbar();

                $doc = new DOMDocument();
                $doc->loadHTMLFile("methodNotAllowed.html");
                echo $doc->saveHTML();

                View::footer();
            }
        } else {
            View::start('Error 404');
            View::navbar();

            $doc = new DOMDocument();
            $doc->loadHTMLFile("pageNotFound.html");
            echo $doc->saveHTML();

            View::footer();
        }
    } else {
        View::start('Error 405');
        View::navbar();

        $doc = new DOMDocument();
        $doc->loadHTMLFile("methodNotAllowed.html");
        echo $doc->saveHTML();

        View::footer();
    }
} else {
    header("location: login.php");
}
?>