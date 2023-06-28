<?php
session_start();
include_once "../modelo/model_user.php";

if (isset($_POST['texto_contenido']) && isset($_SESSION['codigo_sis'])) {
    $user = new User();
    $texto_contenido = $_POST['texto_contenido'];
    $codigo_sis = $_SESSION['codigo_sis'];

    $result = $user->agregarContenidoEstudiante($texto_contenido, $codigo_sis);

    if ($result) {
        echo json_encode(['success' => true, 'message' => 'Se agrego contenido ']);
    } else {
        echo json_encode(['success' => false, 'message' => 'No se agrego contenido']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'No hay contenido']);
}
exit();