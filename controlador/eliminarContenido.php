<?php
include_once "../modelo/model_user.php";
$user = new User();

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
    if (isset($_POST['id']) && isset($_POST['nuevoTexto'])) {
        $id = intval($_POST['id']);
        $nuevoTexto = $_POST['nuevoTexto'];

        $resultado = $user->modificarComment($id, $nuevoTexto);

        if ($resultado) {
            echo json_encode(['success' => true, 'message' => 'Comment modified successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to modify comment']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Incomplete data']);
    }
    exit();
} else {
    header("Location: ../index.php");
    exit();
}

/* include_once "../modelo/model_user.php";

if (isset($_POST['id'])) {
    $user = new User();
    $id = intval($_POST['id']);

    $result = $user->eliminarContenido($id);

    //echo $id;
    //var_dump($_POST);
    error_log(print_r($_POST, true));

    if ($result) {
        echo json_encode(['success' => true, 'message' => 'Comment deleted ']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to delete comment']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'No ID provided']);
}
exit(); --> */
