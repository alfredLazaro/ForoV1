<?php
require_once "conexion.php";
class User extends Conexion {
    private $sentenceSQL;

    public function User() {
        parent::__construct();
    }

    public function cerrarConexion() {
        $this->sentenceSQL = null;
        $this->connexion_bd = null;
    }

    public function obtenerUsuario($user, $pass) {
        //echo 'test';
        //$sql = "SELECT * FROM estudiantes WHERE UPPER(codigo_sis) = UPPER(:codigo_sis) AND contrasena = :contrasena";
        $sql = "SELECT * FROM estudiantes WHERE codigo_sis = :codigo_sis AND contrasena = :contrasena";
        $sentenceSQL = $this->connexion_bd->prepare($sql);
        $sentenceSQL->execute(array(":codigo_sis" => $user, ":contrasena" => $pass));
        $respuesta = $sentenceSQL->fetchAll(PDO::FETCH_ASSOC);
        $sentenceSQL->closeCursor();
        //echo "User obtained";
        return $respuesta[0];
    }

    public function obtenerAdmin($user, $pass) {
        $sql = "SELECT * FROM administradores WHERE nombre = :nombre AND contrasena = :contrasena";
        $sentenceSQL = $this->connexion_bd->prepare($sql);
        $sentenceSQL->execute(array(":nombre" => $user, ":contrasena" => $pass));
        $respuesta = $sentenceSQL->fetchAll(PDO::FETCH_ASSOC);
        $sentenceSQL->closeCursor();
        return $respuesta[0];
    }

    /* eliminar un  comentario de  */
    public function eliminarComentario($id) {
        $sql = "DELETE FROM comentarios WHERE id_comentario= :id ";
        $sentenceSQL = $this->connexion_bd->prepare($sql);
        $sentenceSQL->execute(array(":id" => $id));
        //$respuesta = $sentenceSQL->fetchAll(PDO::FETCH_ASSOC);
        $sentenceSQL->closeCursor();
        //return $respuesta[0];
    }

    public function modificarComment($id, $nuevoTexto) {
        $sql = "UPDATE contenido SET texto_contenido = :nuevoTexto WHERE id_contenido = :id";
        $sentenceSQL = $this->connexion_bd->prepare($sql);
        $sentenceSQL->bindParam(':nuevoTexto', $nuevoTexto, PDO::PARAM_STR);
        $sentenceSQL->bindParam(':id', $id, PDO::PARAM_INT);
        $sentenceSQL->execute();
        $sentenceSQL->closeCursor();
    }

    // public function obtenerComentarios() {
    //     $sql = "SELECT id_contenido, texto_contenido FROM contenido ORDER BY id_contenido";
    //     $sentenceSQL = $this->connexion_bd->prepare($sql);
    //     $sentenceSQL->execute();
    //     $respuesta = $sentenceSQL->fetchAll(PDO::FETCH_ASSOC);
    //     $sentenceSQL->closeCursor();
    //     return $respuesta;
    // }

    // public function obtenerComentarios() {
    //     $sql = "SELECT contenido.id_contenido, contenido.texto_contenido, estudiantes.codigo_sis 
    //             FROM contenido 
    //             INNER JOIN estudiantes ON estudiantes.codigo_sis = contenido.codigo_sis
    //             ORDER BY contenido.id_contenido";
    //     $sentenceSQL = $this->connexion_bd->prepare($sql);
    //     $sentenceSQL->execute();
    //     $respuesta = $sentenceSQL->fetchAll(PDO::FETCH_ASSOC);
    //     $sentenceSQL->closeCursor();
    //     return $respuesta;
    // }

    public function obtenerComentarios() {
        $sql = "SELECT id_contenido, texto_contenido, codigo_sis FROM contenido ORDER BY id_contenido";
        $sentenceSQL = $this->connexion_bd->prepare($sql);
        $sentenceSQL->execute();
        $respuesta = $sentenceSQL->fetchAll(PDO::FETCH_ASSOC);
        $sentenceSQL->closeCursor();
        return $respuesta;
    }


    // mas logica para eliminar contenido
    public function eliminarContenido($id) {
        $sql = "DELETE FROM contenido WHERE id_contenido = :id";
        $stmt = $this->connexion_bd->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }


    public function agregarContenido($texto_contenido) {
        $sql = "INSERT INTO contenido (texto_contenido) VALUES (:texto_contenido)";
        $stmt = $this->connexion_bd->prepare($sql);
        $stmt->bindParam(':texto_contenido', $texto_contenido);
        return $stmt->execute();
    }

    public function contarContenido() {
        $sql = "SELECT COUNT(*) FROM contenido";
        $stmt = $this->connexion_bd->prepare($sql);
        $stmt->execute();
        $count = $stmt->fetchColumn();
        $stmt->closeCursor();
        return $count;
    }
}
