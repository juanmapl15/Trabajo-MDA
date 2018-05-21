<?php
include_once "lib.php";

if (!User::getLoggedUser()){
    header("location: index.php");
}

if (isset($_GET['id']) && is_numeric($_GET['id'])) {

    $id = $_GET['id'];

    $existid = DB::execute_sql("SELECT COUNT(*) FROM paciente WHERE DNI = ?", array($id));

    if ($existid -> fetchColumn() > 0) {

        $query = DB::execute_sql("SELECT id,idmedico,idpaciente,texto FROM antfamiliares WHERE idpaciente=?", array($id));
        $query->setFetchMode(PDO::FETCH_NAMED);
        $tabla = $query->fetchAll(); // No sé por qué se pone, pero funciona sin esto también

        if (count($tabla)) {
            echo "<table id='tabla'>";
            echo "<a href='addHistorial.php?metodo=3&id=$id'><button type='button' class='btn btn-success'><i class='glyphicon glyphicon-plus'></icon>Añadir antecedente familiar</button></a>";
            foreach ($tabla as $row) {
                echo "<tr>";
                foreach ($row as $field => $value) {
                    if ($field == 'id') {
                        $idoperacion = $value;
                    }
                    if ($field == 'idmedico') {
                        $medico = $value;
                    }
                    if ($field == 'texto') {
                        echo "<td>$value</td>";
                        if ($medico == User::getLoggedUser()['DNI']) {
                            echo "<td class='botones'><a href='editHistorial.php?metodo=3&id=$id&idoperacion=$idoperacion'><button type='button' class='btn btn-info'><i class='glyphicon glyphicon-pencil'></icon></button></a></td> ";
                            echo "<td class='botones'><a href='#' class='delete' data-id='$id' data-metodo='3' data-idoperacion='$idoperacion'><button type='button' class='btn btn-danger'><i class='glyphicon glyphicon-trash'></icon></button></a></td> ";
                        }
                    }
                }
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "<a href='AddHistorial.php?metodo=3&id=$id'><button type='button' class='btn btn-success'><i class='glyphicon glyphicon-plus'></icon>Añadir antecedente familiar</button></a>";
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
    header("location: login.php");
}

