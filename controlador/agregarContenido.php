<?php
include_once "../modelo/model_user.php";

if (isset($_POST['texto_contenido'])) {
    $user = new User();
    $texto_contenido = $_POST['texto_contenido'];

    $result = $user->agregarContenido($texto_contenido);

    if ($result) {
        echo json_encode(['success' => true, 'message' => 'Se agrego contenido ']);
    } else {
        echo json_encode(['success' => false, 'message' => 'No se agrego contenido']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'No hay contenido']);
}
exit();
