<?php
session_start();

header('Content-Type: application/json');

if (isset($_SESSION['nombreUsuario'])) {
    echo json_encode([
        'nombreUsuario' => $_SESSION['nombreUsuario']
    ]);
} else {
    echo json_encode([
        'nombreUsuario' => ''
    ]);
}
