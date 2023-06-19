<?php 
    class Conexion {
        protected $connexion_bd;
        public function __construct(){
            $this->connect();
        }

        private function connect() {
            //aqui cambiar configuracion
            $host = 'localhost';
            $db   = 'umss';
            $user = 'postgres';
            $pass = '12345678';
            $port = '5432';
        
            $dsn = "pgsql:host=$host;port=$port;dbname=$db";
        
            try {
                $this->connexion_bd = new PDO($dsn, $user, $pass, [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES   => false,
                ]);
        
            } catch(PDOException $e) {
                echo 'Fracaso la conexion: ' . $e->getMessage();
            }
        }
        

        public function getConn() {
            return $this->connexion_bd;
        }
    }
