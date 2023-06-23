<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Foro</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card bg-primary text-white">
                    <div class="card-header">
                        <span class="custom-header">Usuario</span>
                    </div>
                    <div class="card-body bg-light text-dark">
                        <?php
                        session_start();
                        if (isset($_SESSION['nombreUsuario'])) {
                            echo "<p><strong>Nombre: </strong>" . $_SESSION['nombreUsuario'] . "</p>";
                        } else {
                            echo "<p>Inicia session.</p>";
                        }
                        ?>
                    </div>
                </div>
                <!-- boton verde -->
                <div class="text-center mt-3">
                    <button type="button" class="btn btn-success" data-toggle="modal"
                        data-target="#addNewModal">+</button>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5 comment-container">
        <!-- Contenido dinamico -->
    </div>

    <!-- modal para agregar nuevo contenido. -->
    <div class="modal fade" id="addNewModal" tabindex="-1" role="dialog" aria-labelledby="addNewLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addNewLabel">Agregar Contenido Nuevo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addContentForm">
                        <div class="form-group">
                            <label for="texto_contenido">Contenido Para Publicar</label>
                            <input type="text" class="form-control" id="texto_contenido" name="texto_contenido"
                                required>
                        </div>
                        <button type="submit" class="btn btn-primary">Publicar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script>
    setInterval(function() {
        $.get("../controlador/getContenido.php", function(data) {
            var contenidos = JSON.parse(data);
            $('.comment-container').empty();
            contenidos.forEach(function(contenido, index) {
                var contenidoHTML = `<div class="col-md-6 offset-md-3"><div class="card bg-success text-white">
                        <div class="card-header d-flex justify-content-between">
                            <span class="custom-header">Contenido ${index + 1} </span>
                            <button class="eleminar-contenido btn btn-danger" data-id="${contenido.id_contenido}">X</button>
                        </div>
                        <div class="card-body bg-light text-dark">
                            <p class="custom-comment" id="comment${index + 1}">
                                ${contenido.texto_contenido}
                            </p>
                            <p class="student-id ml-auto small text-right">Codigo Sis: ${contenido.codigo_sis}</p>
                        </div>
                    </div></div>`;
                $('.comment-container').append(
                    contenidoHTML);
            });

            $('.eleminar-contenido').on('click', function() {
                var commentId = $(this).data('id');
                var parentCard = $(this).closest('.card');

                console.log(commentId);

                $.ajax({
                    url: '../controlador/eliminarContenido.php',
                    method: 'POST',
                    data: {
                        id: commentId
                    },
                    success: function(response) {
                        var parsedResponse = JSON.parse(response);
                        if (parsedResponse.success) {
                            // alert('Se elimino el contenido');
                            parentCard.remove();
                        } else {
                            alert('Error en la eliminacion de contenido.');
                        }
                    }
                });
            });
        });
    }, 1000); // 2000 = 2 segs
    </script>

    <!-- manejar el envío de formularios -->
    <script>
    $(document).ready(function() {
        $("#addContentForm").submit(function(e) {
            e.preventDefault();
            var texto_contenido = $("#texto_contenido").val();

            $.ajax({
                type: "POST",
                url: "../controlador/agregarContenido.php",
                data: {
                    texto_contenido: texto_contenido
                },
                success: function(data) {
                    location.reload();
                },
                error: function() {
                    alert('Fracaso agregar contenido nuevo.');
                }
            });
        });
    });
    </script>

</body>
<style>
.custom-header {
    font-size: 25px;
    font-weight: bold;
}

.custom-comment {
    font-size: 20px;
}

.card {
    margin-bottom: 20px;
}
</style>

</html>