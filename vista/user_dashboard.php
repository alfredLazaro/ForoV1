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
                <!-- <div class="card"> -->
                <div class="card bg-primary text-white">
                    <div class="card-header">
                        <!-- <strong style="text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;">Usuario</strong> -->
                        <span class="custom-header">Usuario</span>
                    </div>
                    <!-- <div class="card-body"> -->
                    <div class="card-body bg-light text-dark">
                        <?php
                        session_start();
                        if (isset($_SESSION['nombreUsuario'])) {
                            echo "<p><strong>Nombre: </strong>" . $_SESSION['nombreUsuario'] . "</p>";
                            echo "<p><strong>Codigo SIS: </strong>" . $_SESSION['codigo_sis'] . "</p>";
                        } else {
                            echo "<p>No user information found. Please log in.</p>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-6 offset-md-3">
            <!-- <div class="card"> -->
            <div class="card bg-success text-white">
                <div class="card-header">
                    <!-- <strong style="text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;">Primer Comentario</strong> -->
                    <span class="custom-header">Primer Comentario</span>
                </div>
                <!-- <div class="card-body"> -->
                <div class="card-body bg-light text-dark">
                    <p class="custom-comment" id="firstComment"><?php echo $_SESSION['primerComentario']; ?></p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row mt-5">
        <div class="col-md-6 offset-md-3">
            <!-- <div class="card"> -->
            <div class="card bg-success text-white">
                <div class="card-header">
                    <!-- <strong style="text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;">Segundo Comentario</strong> -->
                    <span class="custom-header">Segundo Comentario</span>
                </div>
                <!-- <div class="card-body"> -->
                <div class="card-body bg-light text-dark">
                <p class="custom-comment" id="secondComment">
                    <?php echo isset($_SESSION['segundoComentario']) ? $_SESSION['segundoComentario'] : "No second comment found."; ?>
                </p>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        setInterval(function(){

            $.get("../controlador/verificarUsuario.php", function(data){

                //$('#firstComment').text(data);
                var comments = JSON.parse(data);

                $('#firstComment').text(comments.primerComentario);
                $('#secondComment').text(comments.segundoComentario);
            });
        }, 2000);// 2000 = 2 segs
        //}, 30000);// 30000 = 30 segs
    </script>

</body>
<style>
    .custom-header {
        font-size: 20px;
        font-weight: bold;
        /* text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black; */
        text-shadow: 
            -1.3px -1.3px 0 #000,  
            1.3px -1.3px 0 #000,
            -1.3px 1.3px 0 #000,
            1.3px 1.3px 0 #000;
    }
    .custom-comment {
        font-size: 20px;
    }
</style>

</html>
