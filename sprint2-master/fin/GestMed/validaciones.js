function pacientValidation() {
    var name= document.forms['pacientForm']['name'].value;
    var dni = document.forms['pacientForm']['dni'].value;
    var age = document.forms['pacientForm']['age'].value;
    var city = document.forms['pacientForm']['city'].value;
    var telef = document.forms['pacientForm']['telephone'].value;

    if (name.length < 4 || name.length > 100) {
        $("[name=name]").css("border", "2px solid red");
        $("#name_error").text("El nombre del paciente tiene que ser mayor que 4 y menor que 100");
        return false;
    }

    if (dni.length < 8 || dni.length > 8) {
        $("[name=dni]").css("border", "2px solid red");
        $("#dni_error").text("El DNI debe tener 8 dígitos");
        return false;
    }

    if (parseInt(age) < 0 || parseInt(age) > 120) {
        $("[name=age]").css("border", "2px solid red");
        $("#age_error").text("La edad debe ser postiva y menor de 120");
        return false;
    }

    if (city.length < 4 || city.length > 60) {
        $("[name=city]").css("border", "2px solid red");
        $("#city_error").text("La ciudad debe tener al menos 4 y menos de 60 carácteres");
        return false;
    }

    if (telef.length < 9|| telef.length > 9) {
        $("[name=telephone]").css("border", "2px solid red");
        $("#telephone_error").text("El teléfono debe tener 9 dígitos");
        return false;
    }

    return true;
}

function histValidation() {
    var texto = document.forms['histForm']['texto'].value;

    console.log(texto.length);

    console.log("OK");

    if(texto.length === 0) {
        $("[name=texto]").css("border", "2px solid red");
        $("#text_error").text("El campo no puede quedar vacío");
        return false;
    } else {
        $("[name=texto]").css("border", "none");
        $("#text_error").text("");
        return true;
    }
}