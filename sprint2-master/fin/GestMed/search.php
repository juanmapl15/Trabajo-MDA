<?php
include_once 'lib.php';
View::start("buscar");
View::navbar();
User::session_start();
User::search();
if(!isset($_GET['inputValue']) ){


}

?>


