<?php

include_once "../modelo/model_user.php";
$user = new User();

$comentarios = $user->obtenerComentarios();

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
    echo json_encode($comentarios);
    exit();
} else {
    header("Location: ../index.php");
    exit();
}
