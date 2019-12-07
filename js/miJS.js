
function sideVarCollapse() {
$(document).ready(function () {
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
    });
});
}

function creaSelect() {

    $(document).ready(function () {
        $("#numMembros").blur(function () {

            var params = {
                "numMembro": $(numMembros).val()
            };

            $.ajax({
                data: params,
                url: 'creaSelectUsuarios.php',
                dataType: 'html',
                type: 'post',
                success: function (response) {
                    //mostramos salida del PHP
                    jQuery("#selectUsuarios").html(response);

                }
            });
            $("#botonCrearEquipo").removeAttr("disabled");
        });

        $('button.verHistorial').click(function () {

            var params = {
                "tar": $(this).val()
            };
            $.ajax({
                // la URL para la petición
                url: 'obtenHistorial.php',
                // la información a enviar                                
                data: params,
                // especifica si será una petición POST o GET
                type: 'post',
                // el tipo de información que se espera de respuesta
                dataType: 'html',
                // código a ejecutar si la petición es satisfactoria;
                success: function (respuesta) {
                    $('#modalTarefas').html(respuesta);
                },
                // código a ejecutar si la petición falla;
                error: function (xhr, status) {
                    alert('Error o obter o historial.');
                },
            });
        });
    });
}

function creaHistorial() {

    $(document).ready(function () {
        $('button.verHistorial').click(function () {

            var params = {
                "tar": $(this).val()
            };
            $.ajax({
                // la URL para la petición
                url: 'obtenHistorial.php',
                // la información a enviar                                
                data: params,
                // especifica si será una petición POST o GET
                type: 'post',
                // el tipo de información que se espera de respuesta
                dataType: 'html',
                // código a ejecutar si la petición es satisfactoria;
                success: function (respuesta) {
                    $('.modalTarefas').html(respuesta);
                },
                // código a ejecutar si la petición falla;
                error: function (xhr, status) {
                    alert('Error o obter o historial.');
                },
            });
        });
    });
}