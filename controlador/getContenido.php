<?php

include_once "../modelo/model_user.php";

$user = new User();

$comentarios = $user->obtenerContenido();
$contarContenido = $user->contarContenido();

for ($i = 0; $i < count($comentarios); $i++) {
    $comentarios[$i]['isAdmin'] = is_null($comentarios[$i]['codigo_sis']);
}

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
