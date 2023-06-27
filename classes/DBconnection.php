<?php
// $Dir= (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
if(!defined('DB_HOST'))
{
  require_once("../initialize.php");
}

class Database extends PDO {
  private $host = DB_HOST;
  private $db_name = DB_NAME;
  private $username = DB_USER;
  private $password = DB_PASSWORD;
  public function __construct()
  {
      parent::__construct("mysql:host=$this->host;dbname=$this->db_name", $this->username, $this->password);
      $this->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      // always disable emulated prepared statement when using the MySQL driver
      $this->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  }
}
class  DBconnection{
  public $conn;

 public  function __construct(){
    if(!isset($this->conn)){
      $this->conn = new Database();
      if(!isset($this->conn)){
        echo "Database connection failed";
        exit;
      }
    }
    
  }
 
}

?>