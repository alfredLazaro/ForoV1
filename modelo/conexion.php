<?php
class Conexion {
    protected $connexion_bd;
    public function __construct() {
        $this->connect();
    }

    private function connect() {
        //aqui cambiar configuracion
        //$host = '192.168.1.11'; //el alfredo/rian en su compu para mi bd
        //$host = '192.168.1.10'; //para usar bd de alfredo
        //$host = '192.168.1.12'; //para usar bd de rian
        $host = 'localhost';
        $db = 'umss';
        $user = 'postgres';
        $pass = '1234';
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

//pg_hba.conf
//al ultimo
// host 	all 		all 		192.168.1.10/32 	md5
// host 	all 		all 		192.168.1.12/32 	md5