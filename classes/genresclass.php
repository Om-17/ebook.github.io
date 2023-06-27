<?php
class Genres extends DBconnection
{
  public $genre_name;

  public function create()
  {
    $context = array();

    $usersql = "SELECT * FROM genres WHERE genre_name = :genre_name";
    $stmt = $this->conn->prepare($usersql);
    $stmt->bindParam(':genre_name', $this->genre_name);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
      // genre already exists
      $context["error"] = "genre already exists";
      return $context;
    }
    $sql = "INSERT INTO genres (genre_name)
    VALUES (:genre_name)";

    // prepare statement
    $stmt = $this->conn->prepare($sql);

    $stmt->bindValue(':genre_name', $this->genre_name);
    $stmt->execute();
  
    $context['message'] = "Genre created successfully";
    return $context;
  }
  public function getAll()
  {

    $sql = "SELECT * FROM genres";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  
    return $result;
  }
  public function get($field, $value)
  {
    $sql = "SELECT * FROM genres WHERE $field = :value";

    $stmt = $this->conn->prepare($sql);

    $stmt->bindParam(':value', $value);

    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    return $result;
  }
  public function update($field, $fieldvalue, $params)
  {
  }
  public function filter($filter_conditions)
  {
  }

  public function search($search)
  {
  }
  public function delete($field, $fieldvalue)
  {
  }
}


?>