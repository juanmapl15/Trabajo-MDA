<?php
include_once "lib.php";

if (!User::getLoggedUser()){
    header("location: login.php");
}

View::start("Registrar Paciente");
View::navbar();

echo '
    <div id="contenido">
        <div id="wrapper">
            <h2>Registrar nuevo paciente</h2>
            <form action="addPacient.php" method="POST" enctype="multipart/form-data" id="addPacientForm" name="pacientForm" onsubmit="return pacientValidation()" >
                <div id="username_div">
                    <label>Nombre</label> <br>
                    <input type="text" name="name" id="name" class="textInput" placeholder="Nombre del paciente..." required> 
                    <div style="color: red;" id="name_error"></div>
                </div>
                
                <div id="dni_div"><br>
                    <label>DNI</label><br>
                    <input type="text" name="dni" id="dni" class="textInput" placeholder="DNI del paciente..." required>
                    <div style="color: red;" id="dni_error"></div>
                </div>
                
                <div id="age_div"><br>
                    <label>Edad</label><br>
                    <input type="number" name="age" id="age" class="textInput" placeholder="Edad del paciente..." required>
                    <div  style="color: red;" id="age_error"></div>
                </div>
    
                <div id="telephone_div"><br>
                    <label>Teléfono</label> <br>
                    <input type="tel" name="telephone" id="telephone" class="textInput" placeholder="Teléfono del paciente..." required>
                    <div  style="color: red;" id="telephone_error"></div>
                </div>
    
                <div id="ciudad_div"><br>
                    <label>Ciudad</label> <br>
                    <input type="text" name="city" id="city" class="textInput" placeholder="Ciudad de residencia del paciente...">
                    <div style="color: red;" id="city_error"></div>
                </div>
    
                <div id="foto_div"><br>
                    <label>Foto de perfil:</label> <br>
                    <input type="file" name="image" id="image">
                    <div id="name_error"></div>
                </div>
                
                <br>
    
                <div>
                    <input type="submit" class="btn btno" value="Registrar" style="color: white" id="submit">
                </div>
                
                <div id="error"></div>
            </form>
        </div>
    </div>
';

View::footer();
View::end();
?>