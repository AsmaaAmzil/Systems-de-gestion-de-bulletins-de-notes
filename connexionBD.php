<?php
class ConnexionBD {
    private static $instance = null;
    private $conBD;
    private $host = "localhost";
    private $dbname = "gesNotes";
    private $username = "root";
    private $password = '';
   

    private function __construct() {
        try {
            $this->conBD = new PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->username, $this->password);
            // Set the PDO error mode to exception
            $this->conBD->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage() . ' Numéro : ' . $e->getCode());
        }
    }

    public static function getInstance(){
        if (self::$instance == null) {
            self::$instance = new ConnexionBD();
        }
        return self::$instance->conBD;
    }
}
?>
