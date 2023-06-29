<?php
class Conexion {
    protected $connexion_bd;
    public function __construct() {
        $this->connect();
    }

    private function connect() {
        //aqui cambiar configuracion

        //para usar bd de brandon
        //$host = '192.168.1.11';
        //$pass = '1234';

        //para usar bd de alfredo
        // $host = '192.168.1.10';
        // $pass = '12345678';

        //para usar bd de rian
        //$host = '192.168.1.12'; 
        //$pass = 'admin';

        //mi localhost, comentar si quiero usar bd de otros
        $host = 'localhost';
        $pass = '1234';


        //no cambia
        $db = 'umss';
        $user = 'postgres';
        $port = '5432';

        $dsn = "pgsql:host=$host;port=$port;dbname=$db";

        try {
            $this->connexion_bd = new PDO($dsn, $user, $pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]);
        } catch (PDOException $e) {
            echo 'Fracaso la conexion: ' . $e->getMessage();
        }
    }

    public function getConn() {
        return $this->connexion_bd;
    }
}
