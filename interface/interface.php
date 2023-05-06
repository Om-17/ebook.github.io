<?php
require('../config/DBconnection.php');

abstract class AbstractDB{
    public $conn;
    public function __construct() {
        $this->conn =new Database();

      }
    public function __destruct(){
        // close connection database 
        $this->conn=null;
      }
}

interface ModelsInterface{

    public function create();
    public function get($field, $value);
    public function getAll();
    public function update($field, $fieldvalue, $params);
    public function filter($filter_conditions);
    public function search($search);


}

?>