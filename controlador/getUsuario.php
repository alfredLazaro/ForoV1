<?php
session_start();

header('Content-Type: application/json');

if (isset($_SESSION['nombreUsuario']) && isset($_SESSION['codigo_sis'])) {
    echo json_encode([
        'nombreUsuario' => $_SESSION['nombreUsuario'],
        'codigo_sis' => $_SESSION['codigo_sis']
    ]);
} else {
    echo json_encode([
        'nombreUsuario' => '',
        'codigo_sis' => ''
    ]);
}
