<?php

session_start();
include_once "../modelo/model_user.php";
$user = new User();

if (isset($_POST['user']) && isset($_POST['pass'])) {

    if (is_numeric($_POST['user'])) {
        $respuesta = $user->obtenerUsuario($_POST['user'], $_POST['pass']);
        if ($respuesta) {
            $_SESSION['nombreUsuario'] = $respuesta['nombre'];
            $_SESSION['codigo_sis'] = $respuesta['codigo_sis'];
            header("Location: ../vista/vista_estudiante.php");
            exit();
        }
    } else {
        $respuesta = $user->obtenerAdmin($_POST['user'], $_POST['pass']);
        if ($respuesta) {
            $_SESSION['nombreUsuario'] = $respuesta['nombre'];
            header("Location: ../vista/vista_admin.php");
            exit();
        }
    }
}

$comentarios = $user->obtenerContenido();
$_SESSION['comentarios'] = $comentarios;

if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || $_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest') {
    header("Location: ../vista/vista_estudiante.php");
    exit();
}

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
    echo json_encode($comentarios);
    exit();
} else {
    header("Location: ../index.php");
    exit();
}

// session_start();
// if (isset($_POST['user']) && isset($_POST['pass'])) {
//     include_once("../modelo/model_user.php");
//     $user = new User();

//     if (is_numeric($_POST['user'])) {
//         $respuesta = $user->obtenerUsuario($_POST['user'], $_POST['pass']);
//         if ($respuesta) {
//             $_SESSION['nombreUsuario'] = $respuesta['nombre'];
//             $_SESSION['codigo_sis'] = $respuesta['codigo_sis'];
//             header("Location: ../vista/vista_estudiante.php");
//             exit();
//         }
//     } else {
//         $respuesta = $user->obtenerAdmin($_POST['user'], $_POST['pass']);
//         if ($respuesta) {
//             $_SESSION['nombreUsuario'] = $respuesta['nombre'];
//             header("Location: ../vista/vista_admin.php");
//             exit();
//         }
//     }

//     $primerComentario = $user->obtenerPrimerComentario();
//     $_SESSION['primerComentario'] = $primerComentario['texto_contenido'];
//     $segundoComentario = $user->obtenerSegundoComentario();
//     $_SESSION['segundoComentario'] = $segundoComentario['texto_contenido'];

//     if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || $_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest') {
//         header("Location: ../vista/vista_estudiante.php");
//         exit();
//     }
// } else if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
//     include_once("../modelo/model_user.php");
//     $user = new User();

//     $primerComentario = $user->obtenerPrimerComentario();
//     $segundoComentario = $user->obtenerSegundoComentario();

//     echo json_encode(array('primerComentario' => $primerComentario['texto_contenido'], 'segundoComentario' => $segundoComentario['texto_contenido']));
//     exit();
// } else {
//     header("Location: ../index.php");
//     exit();
// }