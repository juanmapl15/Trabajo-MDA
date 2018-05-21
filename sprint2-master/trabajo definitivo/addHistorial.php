<?php
include_once "lib.php";

if (!User::getLoggedUser()){
    header("location: login.php");
}

if (isset($_GET['metodo']) && isset($_GET['id']) && is_numeric($_GET['metodo']) && is_numeric($_GET['id'])) {
    $metodo = $_GET['metodo'];
    $id = $_GET['id'];

    if ($metodo > 0 && $metodo < 5) {
        $existid = DB::execute_sql("SELECT COUNT(*) FROM paciente WHERE DNI = ?", array($id));

        if ($existid -> fetchColumn() > 0) {
            View::start("Añadir Historial de Paciente");
            View::navbar();

            switch ($metodo) {
                case 1:
                    $title = "Añadir nueva alergia";
                    $label = "Información de alergia";
                    $placeholder = "Añadir alergia...";

                    break;
                case 2:
                    $title = "Añadir nueva entrada al historial";
                    $label = "Información de entrada";
                    $placeholder = "Añadir entrada...";

                    break;
                case 3:
                    $title = "Añadir nuevo antecedente familiar";
                    $label = "Información de antecedente familiar";
                    $placeholder = "Añadir antecedente familiar...";

                    break;
                case 4:
                    $title = "Añadir nuevo antecedente personal";
                    $label = "Información de antecedente personal";
                    $placeholder = "Añadir antecedente personal...";

                    break;
            }

            echo '
                <div id="contenido">
                    <div id="wrapper">
                        <h2>' . $title . '</h2>
                        <form method="POST" id="addHistForm" name="histForm" onsubmit="return histValidation()">
                            <div id="text_div">
                                <label>' . $label . '</label><br>
                                <input type="hidden" name="metodo" id="metodo" value=' . $metodo . '>
                                <input type="hidden" name="id" id="id" value=' . $id . '>
                                <textarea name="texto" id="texto" rows="10" cols="59" placeholder="' . $placeholder . '"></textarea>
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