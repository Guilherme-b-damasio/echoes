<?php
namespace App\config;
require("../vendor/autoload.php");

use PDO;
use PDOException;
use Dotenv\Dotenv;

class db {
    protected $conn;

    function __construct()
    {
        $dotenv = Dotenv::createImmutable("../");
        $dotenv->load();
        $user = $_ENV['USER'];
        $dbname = $_ENV['DBNAME'];
        
        try {
            $dsn = "mysql:host=localhost;dbname=$dbname;charset=utf8mb4";
            $this->conn = new PDO($dsn, $user, "");
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          } catch(PDOException $e) {
              echo 'ERROR: ' . $e->getMessage();
          }
    }

    public function conn(){
        return $this->conn;
    }
}