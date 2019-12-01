        function creaSelect() {

            $(document).ready(function() {
                $('#sidebarCollapse').on('click', function() {
                    $('#sidebar').toggleClass('active');
                });
                $("#numMembros").blur(function() {



                    var params = {
                        "numMembro": $(numMembros).val()
                    };


                    $.ajax({
                        data: params,
                        url: 'creaSelectUsuarios.php',
                        dataType: 'html',
                        type: 'post',
                        success: function(response) {
                            //mostramos salida del PHP
                            jQuery("#selectUsuarios").html(response);

                        }
                    });
                    $("#botonCrearEquipo").removeAttr("disabled");
                });

            });
        }