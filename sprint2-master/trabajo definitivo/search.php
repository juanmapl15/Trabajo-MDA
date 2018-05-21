<?php
include_once 'lib.php';

View::start("Buscar");
View::navbar();
User::session_start();
echo '<div style="height: 63vh">' . User::search() . '</div>';
View::footer();
?>


