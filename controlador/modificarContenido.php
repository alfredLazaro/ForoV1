<?php
include_once "../modelo/model_user.php";

if (isset($_POST['id']) && isset($_POST['texto_contenido'])) {
    $user = new User();
    $id = $_POST['id'];
    $texto_contenido = $_POST['texto_contenido'];

    $result = $user->modificarContenido($id, $texto_contenido);

    if ($result) {
        echo json_encode(['success' => true, 'message' => 'Se modifico contenido ']);
    } else {
        echo json_encode(['success' => false, 'message' => 'No se modifico contenido']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'No hay contenido']);
}
exit();
