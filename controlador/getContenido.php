<?php

include_once "../modelo/model_user.php";

$user = new User();

$comentarios = $user->obtenerComentarios();
$contarContenido = $user->contarContenido();

$response = array(
    "comentarios" => $comentarios,
    "count" => $contarContenido
);

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
    echo json_encode($response);
    exit();
} else {
    header("Location: ../index.php");
    exit();
}


// include_once "../modelo/model_user.php";
// $user = new User();

// $comentarios = $user->obtenerComentarios();

// if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
//     echo json_encode($comentarios);
//     exit();
// } else {
//     header("Location: ../index.php");
//     exit();
// }