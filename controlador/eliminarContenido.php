<?php
include_once "../modelo/model_user.php";

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
exit();
