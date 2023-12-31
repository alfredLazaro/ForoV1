<?php
    require_once("conexion.php");
    class User extends Conexion{
        private $sentenceSQL;
        public function User(){
            parent::__construct();
        }
        public function cerrarConexion(){
            $this->sentenceSQL=null;
            $this->connexion_bd=null;
        } 
        public function obtenerUsuario($user, $pass) {
            //echo 'test';
            //$sql = "SELECT * FROM estudiantes WHERE UPPER(codigo_sis) = UPPER(:codigo_sis) AND contrasena = :contrasena";
            $sql = "SELECT * FROM estudiantes WHERE codigo_sis = :codigo_sis AND contrasena = :contrasena";
            $sentenceSQL = $this->connexion_bd->prepare($sql);
            $sentenceSQL->execute(array(":codigo_sis"=>$user, ":contrasena"=>$pass));
            $respuesta = $sentenceSQL->fetchAll(PDO::FETCH_ASSOC);
            $sentenceSQL->closeCursor();
            //echo "User obtained";
            return $respuesta[0];
        }

        public function obtenerPrimerComentario() {
            $sql = "SELECT texto_contenido FROM contenido ORDER BY id_contenido LIMIT 1";
            $sentenceSQL = $this->connexion_bd->prepare($sql);
            $sentenceSQL->execute();
            $respuesta = $sentenceSQL->fetch(PDO::FETCH_ASSOC);
            $sentenceSQL->closeCursor();
            return $respuesta;
        }

        public function obtenerSegundoComentario() {
            $sql = "SELECT texto_contenido FROM contenido ORDER BY id_contenido LIMIT 1 OFFSET 1";
            $sentenceSQL = $this->connexion_bd->prepare($sql);
            $sentenceSQL->execute();
            $respuesta = $sentenceSQL->fetch(PDO::FETCH_ASSOC);
            $sentenceSQL->closeCursor();
            return $respuesta;
        }

        public function obtenerAdmin($user, $pass) {
            $sql = "SELECT * FROM administradores WHERE nombre = :nombre AND contrasena = :contrasena";
            $sentenceSQL = $this->connexion_bd->prepare($sql);
            $sentenceSQL->execute(array(":nombre"=>$user, ":contrasena"=>$pass));
            $respuesta = $sentenceSQL->fetchAll(PDO::FETCH_ASSOC);
            $sentenceSQL->closeCursor();
            return $respuesta[0];
        }

        /* eliminar un  comentario de  */
        public function eliminarComentario($id){
            $sql = "DELETE FROM comentarios WHERE id_comentario= :id ";
            $sentenceSQL = $this->connexion_bd->prepare($sql);
            $sentenceSQL->execute(array(":id"=>$id));
            //$respuesta = $sentenceSQL->fetchAll(PDO::FETCH_ASSOC);
            $sentenceSQL->closeCursor();
            //return $respuesta[0];
        }

        public function modificarComment($id,$nuevoTexto){
            $sql = "UPDATE contenido SET texto_contenido = :nuevoTexto WHERE id_contenido = :id";
            $sentenceSQL = $this->connexion_bd->prepare($sql);
            $sentenceSQL->bindParam(':nuevoTexto', $nuevoTexto, PDO::PARAM_STR);
            $sentenceSQL->bindParam(':id', $id, PDO::PARAM_INT);
            $sentenceSQL->execute();
            $sentenceSQL->closeCursor();
        }
    }
