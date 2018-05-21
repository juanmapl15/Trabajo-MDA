<?php
include_once 'lib.php';

if (User::getLoggedUser()){
    header("location: index.php");
}

echo '<link rel="stylesheet" href="login.css">';

$msg = "";

if (isset($_POST['submit'])) {
    $DNI = $_POST['DNI'];
    $Password = $_POST['Password'];

    $exist = User::login($DNI, $Password);

    if ($exist) {
        header("Location: index.php");
    } else {
        $_SESSION['message'] = 'Credenciales introducidas no válidas';
        header('location: index.php?error="1"');

    }
} else {
    View::start('GestMed: Inicio de Sesión');
echo '
    <div id="fullscreen_bg" class="fullscreen_bg"/>

<div class="container" style="margin-top: 10%">
   
	<form class="form-signin" method="post" style="background-color: white; padding: 50px; border-radius: 15px">
		 <h1 class="form-signin-heading text-dark" style="font-size: 50px; margin: -10px 0 35px 0 ; color: black">Iniciar Sesión</h1> ';
    if (isset($_SESSION['message']))
    {
        $show = $_SESSION['message'];
        echo  '<h4 style="color: red">'.$show.' </h4> ';
        unset($_SESSION['message']);
    }
		 echo'
		<input name="DNI" type="text" style="margin-bottom: 10px; border: #104603 1px solid"  class="form-control" placeholder="DNI" required="" autofocus="">
		<input type="password" name="Password"  class="form-control"  style="margin-bottom: 10px; border: #104603 1px solid"  placeholder="Contraseña" required="">
		<button class="btn btn-lg btn-success btn-block" name="submit"  type="submit"><b>Acceder</b> 
    </button>
	</form> 

</div>
';
    View::end();
}
?>