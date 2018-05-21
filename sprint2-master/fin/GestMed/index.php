<?php
include_once 'lib.php';
if (!User::getLoggedUser()){
    header("location: login.php");
}

View::start("GestMed");
View::navbar();
?>


<div class="container">
    <br>
    <div>
        <h2 class="title-home milky">Bienvenido a GestMed</h2>
    </div>
    <br><br><br><br>
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <div class="item active image-carousel">
                <img  src="Imagenes/Aplicaciones-El-medico-en-el-bolsillo.jpg" class="image-height image-carousel" alt="App">
                <div class="carousel-caption">
                    <h3 mark class="text-carousel">NUEVO</h3>
                    <p>Descargate nuestra APP</p>
                </div>
            </div>

            <div class="item image-carousel">
                <img class="image-height image-carousel" src="Imagenes/16-11-36chequeosmedicos%202.jpg" alt="Medico">
            </div>

            <div class="item image-carousel">
                <img class="image-carousel" src="Imagenes/Herobanner-Centros-Medicos.jpg" alt="Pediatria">
            </div>
        </div>

        <!-- Left and right controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>
 <br>
 <br>
<div class="container">
    <div class="grid-container">
        <div class="cardind grid-item">
        <i class="fa fa-cloud"></i>
        <div class="card-body">
            <h4 class="card-title letter-space">HISTORIAS CLINICAS</h4>
            <p class="card-text">Las historias clínicas de los pacientes fácilmente accesibles. Gestionadas de forma segura y confidencial.</p>
            <a href="#" class="btn btn-primary">Buscar Historias Clínicas </a>
        </div>
    </div>

    <div class="cardind">
        <i class="fa fa-mouse-pointer" style="padding-top: 6px"></i>
        <div class="card-body">
            <h4 class="card-title letter-space">TUS CITAS A UN CLICK</h4>
            <p class="card-text texto-width-card">Con solo un click tendras al alcance de tu mano, el horario completo con respecto a tus citas del día.</p>
            <a href="#" class="btn btn-primary">Ver Citas</a>
        </div>

    </div>

    <div class="cardind">
        <i class="fa fa-rss"></i>
        <div class="card-body">
            <h4 class="card-title letter-space"> ULTIMAS NOTICIAS</h4>
            <p class="card-text">Gestiona tu agenda y citas médica cómodamente desde cualquier punto y dispositivo.</p>
            <a href="#" class="btn btn-primary">Ver Noticias</a>
        </div>
    </div>
    </div>
</div>

<?php
View::footer();
View::end();
?>

