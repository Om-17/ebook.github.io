<?php
// $Dir= (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

require_once('../config.php');

// $username= DB_USER;
// $password=DB_PASSWORD;
// $dns='mysql:host='.DB_HOST.';dbname='.DB_NAME;
// try{
//   // $conn = new PDO("mysql:host=$servername;dbname=student", $username, $password);
// $connect = new PDO($dns, $username, $password);
// $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// }
// catch (PDOException $e){
//   die("there is an issue: ".$e -> getMessage());
// }

class Database extends PDO {
  private $host = DB_HOST;
  private $db_name = DB_NAME;
  private $username = DB_USER;
  private $password = DB_PASSWORD;
  public $conn;
  public function __construct()
  {
      parent::__construct("mysql:host=$this->host;dbname=$this->db_name", $this->username, $this->password);
      $this->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      // always disable emulated prepared statement when using the MySQL driver
      $this->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  }
}

?>