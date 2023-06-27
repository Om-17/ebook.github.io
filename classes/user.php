<?php 
require_once('../interface/interface.php');
require_once('../config.php');

class User extends DBconnection implements ModelsInterface
{
  public $first_name;
  public $username;
  public $password;
  public $email;
  public $last_name;
  public $mobile_no;
  public $is_admin = false;
  public function create()
  {
    $context = array();

    if (!isset($this->first_name) || empty($this->first_name)) {
      $context["error"] = "First name is required.";
      return $context;
    }
    if (!isset($this->username) || empty($this->username)) {
      $context["error"] = "Username is required.";
      return $context;

    }
    if (!isset($this->password) || empty($this->password)) {
      $context["error"] = "Password is required.";
      return $context;

    }
    if (!isset($this->email) || empty($this->email)) {
      $context["error"] = "Email is required.";
      return $context;
    }
    // Username already exists

    $usersql = "SELECT * FROM users WHERE username = :username";
    $stmt = $this->conn->prepare($usersql);
    $stmt->bindParam(':username', $this->username);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
      // Username already exists
      $context["error"] = "Username already exists";
      return $context;
    }
    // email already exists

    $emailsql = "SELECT * FROM users WHERE email = :email";
    $stmt = $this->conn->prepare($emailsql);
    $stmt->bindParam(':email', $this->email);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
      $context["error"] = "Email already exists";
      return $context;
    }


    $sql = "INSERT INTO users (first_name, last_name, username, password, email,mobile_no,is_admin)
            VALUES (:first_name, :last_name, :username, :password, :email,:mobile_no,:is_admin)";

    // prepare statement
    $stmt = $this->conn->prepare($sql);

    $stmt->bindValue(':first_name', $this->first_name);
    $stmt->bindValue(':username', $this->username);
    $stmt->bindValue(':password', password_hash($this->password, PASSWORD_DEFAULT));
    $stmt->bindValue(':email', $this->email);
    $stmt->bindValue(':is_admin', $this->is_admin);

    // optinal field
    if (isset($this->last_name)) {
      $stmt->bindValue(':last_name', $this->last_name);
    } else {
      $stmt->bindValue(':last_name', null, PDO::PARAM_NULL);
    }
    if (isset($this->mobile_no)) {
      $stmt->bindValue(':mobile_no', $this->mobile_no);
    } else {
      $stmt->bindValue(':mobile_no', null, PDO::PARAM_NULL);
    }

    $stmt->execute();
    $this->conn = null;
    $context['message'] = "User created successfully";
    return $context;

  }
  public function get($field, $value)
  {
    $sql = "SELECT * FROM users WHERE $field = :value";

    $stmt = $this->conn->prepare($sql);

    $stmt->bindParam(':value', $value);

    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $this->conn = null;
    return $result;

  }
  public function getAll()
  {

    $sql = "SELECT * FROM users";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $this->conn = null;
    return $result;
  }
  public function update($field, $fieldvalue, $params)
  {

    $sql = "UPDATE users SET ";

    $numParams = count($params);
    $i = 0;
    foreach ($params as $key => $value) {
      $sql .= $key . " = :" . $key;
      if ($i < $numParams - 1) {
        $sql .= ", ";
      }
      $i++;
    }
    $sql .= " WHERE $field = :fieldvalue";
    // echo $sql;
    $stmt = $this->conn->prepare($sql);
    $stmt->bindValue(':fieldvalue', $fieldvalue);

    foreach ($params as $key => $value) {
      $stmt->bindValue(':' . $key, $value);
    }
    $stmt->execute();

    return $stmt;
  }

  public function filter($filter_conditions)
  {
    
    $context = [];


    $sql = "SELECT * FROM users WHERE ";
    $conditions = [];

    foreach ($filter_conditions as $column => $value) {
      $conditions[] = "$column = :$column";
    }

    $sql .= implode(" AND ", $conditions);

    $stmt = $this->conn->prepare($sql);

    foreach ($filter_conditions as $column => $value) {
      $stmt->bindValue(":$column", $value);
    }

    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $conn = null;
    if ($results == null) {
      $context['message'] = "Not found recond";
      return $context;
    }
    return $results;
  }
  public function manyfieldsearch($params)
  {
    
    $sql = "SELECT * FROM users WHERE ";
    $i = 0;
    foreach ($params as $key => $value) {
      if ($i > 0) {
        $sql .= " OR ";
      }
      $sql .= "LOWER($key) LIKE LOWER(:$key)";
      $i++;
    }
    $stmt = $this->conn->prepare($sql);
    foreach ($params as $key => $value) {
      $stmt->bindValue(":$key", "%$value%", PDO::PARAM_STR);
    }
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($results == null) {
      $context['message'] = "Not found recond";
      return $context;
    }
    return $results;
 
  }
  public function search($search)
  {


    // $sql = "SELECT * FROM users WHERE LOWER(first_name) LIKE LOWER(:search) OR LOWER(last_name) LIKE LOWER(:search)";
    // $sql = "SELECT * FROM users WHERE LOWER(first_name) LIKE :search OR LOWER(username) LIKE LOWER(:search1)";
    $sql = "SELECT * FROM users WHERE LOWER(first_name) LIKE LOWER(:search) OR LOWER(last_name) LIKE LOWER(:search1) OR LOWER(email) LIKE LOWER(:search2) OR LOWER(username) LIKE LOWER(:search3)";


    $stmt = $this->conn->prepare($sql);

    $stmt->bindValue(':search', '%' . $search . '%');
    $stmt->bindValue(':search1', '%' . $search . '%');
    $stmt->bindValue(':search2', '%' . $search . '%');
    $stmt->bindValue(':search3', '%' . $search . '%');
    // print_r($stmt);
    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_CLASS);

    // $conn = null;

    if ($results == null) {
      $context['message'] = "Not found recond";
      return $context;
    }

    return $results;
  }
}

?>