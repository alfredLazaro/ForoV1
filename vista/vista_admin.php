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
            </div>
        </div>
    </div>

    <div class="row mt-5 comment-container">
        <!-- Contenido dinamico -->
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        setInterval(function() {
            $.get("../controlador/ajaxGetContenido.php", function(data) {
                var comments = JSON.parse(data);
                $('.comment-container').empty();
                comments.forEach(function(comment, index) {
                    var commentHtml = `<div class="col-md-6 offset-md-3"><div class="card bg-success text-white">
                        <div class="card-header d-flex justify-content-between">
                            <span class="custom-header">Contenido ${index + 1}</span>
                            <button class="eleminar-contenido btn btn-danger" data-id="${comment.id_contenido}">X</button>
                        </div>
                        <div class="card-body bg-light text-dark">
                            <p class="custom-comment" id="comment${index + 1}">
                                ${comment.texto_contenido}
                            </p>
                        </div>
                    </div></div>`;
                    $('.comment-container').append(
                        commentHtml);
                });

                $('.eleminar-contenido').on('click', function() {
                    var commentId = $(this).data('id');
                    var parentCard = $(this).closest('.card');

                    $.ajax({
                        url: '../controlador/eliminarContenido.php',
                        method: 'POST',
                        data: {
                            id: commentId
                        },
                        success: function(response) {
                            var parsedResponse = JSON.parse(response);
                            if (parsedResponse.success) {
                                alert('Comment deleted successfully!');
                                parentCard.remove();
                            } else {
                                alert('Error deleting comment.');
                            }
                        }
                    });
                });
            });
        }, 2000); // 2000 = 2 segs
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