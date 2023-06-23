<?php
include_once "../modelo/model_user.php";
$user = new User();

if (isset($_POST['id'])) {
    $id = intval($_POST['id']);

    $result = $user->modificarComment($id);

    if ($result) {
        echo json_encode(['success' => true, 'message' => 'Comment modified ']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to modify comment']);
    }
    exit();
} else {
    header("Location: ../index.php");
    exit();
}
?>
