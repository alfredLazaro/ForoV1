<?php
include_once "../modelo/model_user.php";

if (isset($_POST['id'])) {
    $user = new User();
    $result = $user->eliminarContenido($_POST['id']);
    echo json_encode(['success' => $result]);
}
