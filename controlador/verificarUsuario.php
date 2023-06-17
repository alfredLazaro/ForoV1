<?php

    // session_start();

    // if (isset($_POST['user']) && isset($_POST['pass'])) {
    //     include_once("../modelo/model_user.php");
    //     $user = new User();
    //     $respuesta = $user->obtenerUsuario($_POST['user'], $_POST['pass']);
    //     $_SESSION['nombreUsuario'] = $respuesta['nombre'];
    //     $_SESSION['codigo_sis'] = $respuesta['codigo_sis'];
    //     $primerComentario = $user->obtenerPrimerComentario();
    //     $_SESSION['primerComentario'] = $primerComentario['texto_contenido'];
    //     $segundoComentario = $user->obtenerSegundoComentario();
    //     $_SESSION['segundoComentario'] = $segundoComentario['texto_contenido'];
    //     if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || $_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest') {
    //         header("Location: ../vista/user_dashboard.php");
    //         exit();
    //     }
    // } else if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
    //     // this is an AJAX request
    //     include_once("../modelo/model_user.php");
    //     $user = new User();
    //     $respuesta = $user->obtenerUsuario($_SESSION['nombreUsuario'], $_SESSION['codigo_sis']);
    //     $primerComentario = $user->obtenerPrimerComentario();
    //     $segundoComentario = $user->obtenerSegundoComentario();

    //     // Use json_encode to output both comments as a JSON object.
    //     echo json_encode(array('nombreUsuario' => $respuesta['nombre'], 'codigo_sis' => $respuesta['codigo_sis'], 'primerComentario' => $primerComentario['texto_contenido'], 'segundoComentario' => $segundoComentario['texto_contenido']));
    //     exit();
    // } else {
    //     header("Location: ../index.php");
    //     exit();
    // }


    session_start();

    if (isset($_POST['user']) && isset($_POST['pass'])) {
        include_once("../modelo/model_user.php");
        $user = new User();
        $respuesta = $user->obtenerUsuario($_POST['user'], $_POST['pass']);
        $_SESSION['nombreUsuario'] = $respuesta['nombre'];
        $primerComentario = $user->obtenerPrimerComentario();
        $_SESSION['primerComentario'] = $primerComentario['texto_contenido'];
        $segundoComentario = $user->obtenerSegundoComentario();
        $_SESSION['segundoComentario'] = $segundoComentario['texto_contenido'];
        if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || $_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest') {
            header("Location: ../vista/user_dashboard.php");
            exit();
        }
    } else if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
        // this is an AJAX request
        include_once("../modelo/model_user.php");
        $user = new User();
        $primerComentario = $user->obtenerPrimerComentario();
        $segundoComentario = $user->obtenerSegundoComentario();

        // Use json_encode to output both comments as a JSON object.
        echo json_encode(array('primerComentario' => $primerComentario['texto_contenido'], 'segundoComentario' => $segundoComentario['texto_contenido']));
        exit();
    } else {
        header("Location: ../index.php");
        exit();
    }








    // session_start();

    // if(isset($_POST['user']) && isset($_POST['pass'])){
    //     include_once("../modelo/model_user.php");
    //     $user = new User();
    //     $respuesta = $user-> obtenerUsuario($_POST['user'],$_POST['pass']);
    //     $_SESSION['nombreUsuario'] = $respuesta['nombre'];
    //     $_SESSION['primerComentario'] = $user-> obtenerPrimerComentario();
    //     $_SESSION['segundoComentario'] = $user-> obtenerSegundoComentario();
    // } else if ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {

    //     include_once("../modelo/model_user.php");
    //     $user = new User();
    //     $primerComentario = $user-> obtenerPrimerComentario();
    //     echo $primerComentario;
    //     exit();

    // } else {
    //     header("Location: ../index.php");
    // }

    // session_start(); 

    // if(isset($_POST['user']) && isset($_POST['pass'])){
    //     include_once("../modelo/model_user.php");
    //     $user = new User();
    //     $respuesta = $user->obtenerUsuario($_POST['user'],$_POST['pass']);
    //     var_dump($respuesta);
        
    //     if (!empty($respuesta)) {
    //         $_SESSION['nombreUsuario'] = $respuesta['nombre'];
    //         $_SESSION['codigo_sis'] = $respuesta['codigo_sis'];

    //         //primer contenido
    //         $primerComentario = $user->obtenerPrimerComentario();
    //         $_SESSION['primerComentario'] = $primerComentario['texto_contenido'];
    //         //segundo contenido
    //         $segundoComentario = $user->obtenerSegundoComentario();
    //         $_SESSION['segundoComentario'] = $segundoComentario['texto_contenido'];
            
    //         header("Location: ../vista/user_dashboard.php");

            
    //     } else {
    //         $_SESSION['login_error'] = 'Usuario o contraseña incorrectos';
    //         header("Location: ../index.php");
    //     }
    // } else {
    //     header("Location: ../index.php");
    // }


    // if(isset($_POST['user']) && isset($_POST['pass'])){
    //     include_once("../modelo/model_user.php");
    //     $user = new User();
    //     $respuesta = $user-> obtenerUsuario($_POST['user'],$_POST['pass']);
    //     var_dump($respuesta);
    //     $_SESSION['nombreUsuario'] = $respuesta['nombre_usuario'];
    // } else {
    //     header("Location: ../index.php");
    // }