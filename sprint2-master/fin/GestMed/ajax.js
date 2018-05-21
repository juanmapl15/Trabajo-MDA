jQuery(document).ready(function ($) {
    var x = $("#page").val();

    jQuery(function() {
        jQuery('#hist').click();
    });

    $(".noReload").click(function (e) {

        swal({
            title: 'Cargando...'
        });
        swal.showLoading();

        $.ajax({
            url: $(this).attr("href")
        })

        .done(function(php) {
            $("#page").empty().append(php);
        })

        .fail(function() {
            console.log("Error");
        })

        .always(function() {
            console.log("Completado");
            swal.close();
        });

        return false;
    });
});

$(document).ready(function() {
    var $submit = $("#submit");
    var $texto = $("#texto");

    $texto.keyup(function() {
        $("#text_error").text("");
        $texto.css('border-color', 'transparent');

        $submit.removeAttr('disabled');
        $submit.css('cursor', 'pointer');
    });

    /* Add Hist */
    $(document).on('submit', '#addPacientForm', function() {
        event.preventDefault();

        if (pacientValidation()) {
            var formData = new FormData(this);

            swal({
                title: "¿Está seguro de que desea registrar este usuario como paciente?",
                type: "question",
                showCancelButton: true,
                confirmButtonText: "Registrar",
                cancelButtonText: "Cancelar",
                confirmButtonClass: 'btn btn-info',
                cancelButtonClass: 'btn btn-default',
                reverseButtons: true
            }).then(function (result) {
                if (result.value) {
                    swal({
                        title: 'Registrando...'
                    });
                    swal.showLoading();

                    $.ajax({
                        type: 'POST',
                        url: 'createPacient.php',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(data) {
                            if(data !== "") {
                                swal.close();

                                swal({
                                    type: "error",
                                    title: "Error al registrar paciente",
                                    confirmButtonText: "Aceptar"
                                });
                            } else {
                                swal.close();

                                swal({
                                    type: "success",
                                    title: "Paciente registrado con éxito",
                                    confirmButtonText: "Aceptar"
                                }).then(function (result) {
                                    window.location = 'index.php';

                                    swal({
                                        title: 'Volviendo a la página principal...'
                                    });
                                    swal.showLoading();
                                });
                            }
                        }
                    });
                }
            });
        }
    });

    /* Add Hist */
    $(document).on('submit', '#addHistForm', function() {
        event.preventDefault();

        if (histValidation()) {
            var formData = new FormData(this);
            var metodo = $("#metodo").val();
            var id = $("#id").val();

            swal({
                title: "¿Está seguro de que desea añadir esta información?",
                type: "question",
                showCancelButton: true,
                confirmButtonText: "Añadir",
                cancelButtonText: "Cancelar",
                confirmButtonClass: 'btn btn-info',
                cancelButtonClass: 'btn btn-default',
                reverseButtons: true
            }).then(function (result) {
                if (result.value) {
                    swal({
                        title: 'Añadiendo...'
                    });
                    swal.showLoading();

                    $.ajax({
                        type: 'POST',
                        url: 'createHistorial.php',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(data) {
                            console.log(data);
                            if(data !== "") {
                                swal.close();

                                swal({
                                    type: "error",
                                    title: "Error al añadir la información al historial",
                                    confirmButtonText: "Aceptar"
                                });
                            } else {
                                var simpMess = "";

                                switch (metodo) {
                                    case '1':
                                        simpMess = "Información de alergia añadida con éxito"

                                        break;
                                    case '2':
                                        simpMess = " Información de entrada añadida con éxito"

                                        break;
                                    case '3':
                                        simpMess = "Información de antecedente familiar añadida con éxito";

                                        break;
                                    case '4':
                                        simpMess = "Información de antecedente personal añadida con éxito";

                                        break;
                                }

                                swal.close();

                                swal({
                                    type: "success",
                                    title: simpMess,
                                    confirmButtonText: "Aceptar"
                                }).then(function (result) {
                                    window.location = 'profile.php?id=' + id;

                                    swal({
                                        title: 'Volviendo al perfil del paciente...'
                                    });
                                    swal.showLoading();
                                });
                            }
                        }
                    });
                }
            });
        }
    });

    /* Edit Hist */
    $(document).on('submit', '#editHistForm', function() {
        event.preventDefault();

        if (histValidation()) {
            var formData = new FormData(this);
            var metodo = $("#metodo").val();
            var id = $("#id").val();

            swal({
                title: "¿Está seguro de que desea guardar los cambios?",
                type: "question",
                showCancelButton: true,
                confirmButtonText: "Guardar",
                cancelButtonText: "Cancelar",
                confirmButtonClass: 'btn btn-info',
                cancelButtonClass: 'btn btn-default',
                reverseButtons: true
            }).then(function (result) {
                if (result.value) {
                    swal({
                        title: 'Actualizando...'
                    });
                    swal.showLoading();

                    $.ajax({
                        type: 'POST',
                        url: 'updateHistorial.php',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(data) {
                            if(data !== "") {
                                swal.close();

                                swal({
                                    type: "error",
                                    title: "Error al actualizar la información del historial",
                                    confirmButtonText: "Aceptar"
                                });
                            } else {
                                var simpMess = "";

                                switch (metodo) {
                                    case '1':
                                        simpMess = "Información de alergia actualizada con éxito"

                                        break;
                                    case '2':
                                        simpMess = " Información de entrada actualizada con éxito"

                                        break;
                                    case '3':
                                        simpMess = "Información de antecedente familiar actualizada con éxito";

                                        break;
                                    case '4':
                                        simpMess = "Información de antecedente personal actualizada con éxito";

                                        break;
                                }

                                swal.close();

                                swal({
                                    type: "success",
                                    title: simpMess,
                                    confirmButtonText: "Aceptar"
                                }).then(function (result) {
                                    window.location = 'profile.php?id=' + id;

                                    swal({
                                        title: 'Volviendo al perfil del paciente...'
                                    });
                                    swal.showLoading();
                                });
                            }

                            $submit.attr('disabled', 'disabled');
                            $submit.css({'cursor': 'default', 'color': 'white'});
                            $texto.focusout();
                        }
                    });
                }
            });
        }
    });

    /* Delete Hist */
    $(document).on('click', '.delete', function() {
        var link = $(this);

        var id = $(this).attr("data-id");
        var metodo = $(this).attr("data-metodo");
        var idoperacion = $(this).attr("data-idoperacion");

        var confMess = "";
        var string = "";
        var simpMess = "";

        switch (metodo) {
            case '1':
                confMess = "¿Está seguro de que desea eliminar esta alergia?";
                string = "esta alergia";
                simpMess = "Alergia eliminada con éxito";

                break;
            case '2':
                confMess = "¿Está seguro de que desea eliminar esta entrada?";
                string = "esta entrada";
                simpMess = "Entrada eliminada con éxito";

                break;
            case '3':
                confMess = "¿Está seguro de que desea eliminar este antecedente familiar?";
                string = "este antecedente familiar";
                simpMess = "Antecedente familiar eliminado con éxito";

                break;
            case '4':
                confMess = "¿Está seguro de que desea eliminar este antecedente personal?";
                string = "este antecedente personal";
                simpMess = "Antecedente personal eliminado con éxito";

                break;
        }

        swal({
            title: confMess,
            text: "Esta acción es irreversible. Esto eliminará completamente " + string + ".",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DB524B",
            confirmButtonText: "Eliminar",
            cancelButtonText: "Cancelar",
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            reverseButtons: true
        }).then(function(result) {
            if (result.value) {
                swal({
                    title: 'Eliminando...'
                });
                swal.showLoading();

                $.ajax({
                    type: "POST",
                    url: "deleteHistorial.php",
                    data: {
                        id: id,
                        metodo: metodo,
                        idoperacion: idoperacion
                    },
                    success: function(data) {
                        if(data !== "") {
                            swal.close();

                            swal({
                                type: "error",
                                title: "Error al eliminar la información del historial",
                                confirmButtonText: "Aceptar"
                            });
                        } else {
                            link.closest('tr').remove();

                            swal.close();

                            swal({
                                type: "success",
                                title: simpMess,
                                confirmButtonText: "Aceptar"
                            });
                        }
                    }
                });
            }
        })
    });
});