<?php
require_once('../config.php');
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

class MasterModel extends DBconnection
{
  private $table;
  public function __construct($tablename)
  {
    parent::__construct();
    $this->table = $tablename;
  }

  // public function create($params)
  // {
  //     $context = [];

  //     $columns = array_keys($params);
  //     $values = array_values($params);

  //     $columnNames = implode(", ", $columns);
  //     $placeholders = implode(", :", $columns);

  //     $sql = "INSERT INTO $this->table ($columnNames) VALUES (:$placeholders)";

  //     try {
  //         $stmt = $this->conn->prepare($sql);

  //         foreach ($params as $key => &$value) {
  //             $stmt->bindValue(":$key", $value);
  //         }

  //         $stmt->execute();

  //         $context = array(
  //             "message" => "Record created successfully.",
  //             "status" => true
  //         );
  //     } catch (\Throwable $th) {
  //         $errorMessage = $th->getMessage();
  //         // Handle the error as per your requirements
  //         $context = array(
  //             "error" => $errorMessage,
  //             "status" => false
  //         );
  //     }

  //     return $context;
  // }
  public function create($params)
  {
    $context = [];

    $columns = array_keys($params);
    $values = array_values($params);

    $columnNames = implode(", ", $columns);
    $placeholders = implode(", :", $columns);

    $sql = "INSERT INTO $this->table ($columnNames) VALUES (:$placeholders)";

    try {
      $stmt = $this->conn->prepare($sql);

      foreach ($params as $key => &$value) {
        $stmt->bindParam(":$key", $value);
      }

      $stmt->execute();

      $context = array(
        "message" => "Record created successfully.",
        "status" => true
      );
    } catch (\Throwable $th) {
      $errorMessage = $th->getMessage();
      // Handle the error as per your requirements
      $context = array(
        "error" => $errorMessage,
        "status" => false
      );
    } finally {
      $stmt->closeCursor();
    }

    return $context;
  }

  public function update($field, $fieldvalue, $params)
  {
    $context = [];
    $sql = "UPDATE $this->table SET ";

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
    echo $sql;

    try {
      $stmt = $this->conn->prepare($sql);

      $stmt->bindValue(':fieldvalue', $fieldvalue);

      foreach ($params as $key => $value) {
        $stmt->bindValue(':' . $key, $value);
      }

      $stmt->execute();

      $context = array(
        "message" => "Successfully Updated",
        "status" => true
      );
    } catch (\Throwable $th) {
      $errorMessage = $th->getMessage();
      // Handle the error as per your requirements
      $context = array(
        "error" => $errorMessage,
        "status" => false
      );
    }
    return $context;
  }
  public function query($sql)
  {
      // Execute the query
      $result = $this->conn->query($sql);
  
      // Fetch the result
      $data = $result->fetchAll(PDO::FETCH_ASSOC);
  
      // Close the result cursor
      $result->closeCursor();
  
      // Return the result data
      return $data;
  }
  
  public function exists($field, $fieldValue)
  {
    $sql = "SELECT COUNT(*) FROM $this->table WHERE $field = :fieldValue";

    try {
      $stmt = $this->conn->prepare($sql);
      $stmt->bindParam(":fieldValue", $fieldValue);
      $stmt->execute();

      $result = $stmt->fetchColumn();

      if ($result > 0) {
        return true; // Record exists
      } else {
        return false; // Record does not exist
      }
    } catch (\Throwable $th) {
      // Handle the error as per your requirements
      return false;
    } finally {
      $stmt->closeCursor();
    }
  }
  public function count($filterConditions)
  {
      // Construct the SQL query
      $query = "SELECT COUNT(*) AS count FROM {$this->table}";
  
      // Add the filter conditions to the query
      if (!empty($filterConditions)) {
          $conditions = [];
          foreach ($filterConditions as $field => $value) {
              $conditions[] = "{$field} = {$value}";
          }
          $query .= " WHERE " . implode(" AND ", $conditions);
      }
     
      // Execute the query
      $result = $this->conn->query($query);
  
      // Fetch the result
      $row = $result->fetch(PDO::FETCH_ASSOC);
  
      // Close the result cursor
      $result->closeCursor();
  
      // Return the count value
      return $row['count'];
  }
  
  
  public function get($field, $value)
  {
    $sql = "SELECT * FROM $this->table WHERE $field = :value";

    $stmt = $this->conn->prepare($sql);

    $stmt->bindParam(':value', $value);

    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    return $result;
  }

  public function getAll()
  {

    $sql = "SELECT * FROM $this->table";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    return $result;
  }

  // public function filter($filter_conditions)
  // {

  //   $context = [];


  //   $sql = "SELECT * FROM $this->table WHERE ";
  //   $conditions = [];

  //   foreach ($filter_conditions as $column => $value) {
  //     $conditions[] = "$column = :$column";
  //   }

  //   $sql .= implode(" AND ", $conditions);

  //   $stmt = $this->conn->prepare($sql);

  //   foreach ($filter_conditions as $column => $value) {
  //     $stmt->bindValue(":$column", $value);
  //   }

  //   $stmt->execute();
  //   $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

  //   $conn = null;
  //   if ($results == null) {
  //     $context['message'] = "Not found recond";
  //     return $context;
  //   }
  //   return $results;
  // }
  // public function filter($filter_conditions)
  // {
  //   $context = [];

  //   $sql = "SELECT * FROM $this->table WHERE ";
  //   $conditions = [];

  //   foreach ($filter_conditions as $field => $value) {
  //     $conditions[] = $this->generateCondition($field, $value);
  //   }

  //   $sql .= implode(" AND ", $conditions);

  //   $stmt = $this->conn->prepare($sql);

  //   foreach ($filter_conditions as $field => $value) {
  //     $this->bindValueWithLookup($stmt, $field, $value);
  //   }

  //   $stmt->execute();
  //   $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

  //   $this->conn = null;

  //   if ($results == null) {
  //     $context['message'] = "Record not found";
  //     return $context;
  //   }

  //   return $results;
  // }

  // private function generateCondition($field, $value)
  // {
  //   $lookups = [
  //     'exact' => '=',
  //     'iexact' => 'ILIKE',
  //     'contains' => 'LIKE',
  //     'startswith' => 'LIKE',
  //     'endswith' => 'LIKE',
  //     'gt' => '>',
  //     'lt' => '<',
  //     'gte' => '>=',
  //     'lte' => '<=',
  //     // Add more lookups as needed
  //   ];

  //   $parts = explode('__', $field);
  //   $column = $parts[0];
  //   $lookup = 'exact';

  //   if (count($parts) > 1 && isset($lookups[$parts[1]])) {
  //     $lookup = $parts[1];
  //   }

  //   if ($lookup === 'exact') {
  //     return "$column = :$field";
  //   } elseif (in_array($lookup, ['startswith', 'endswith'])) {
  //     return "$column {$lookups[$lookup]} :$field";
  //   } else {
  //     return "$column {$lookups[$lookup]} :$field";
  //   }
  // }

  // private function bindValueWithLookup($stmt, $field, $value)
  // {
  //   $parts = explode('__', $field);
  //   $column = $parts[0];

  //   if (count($parts) > 1) {
  //     $lookup = $parts[1];
  //     switch ($lookup) {
  //       case 'iexact':
  //         $stmt->bindValue(":$field", $value, PDO::PARAM_STR);
  //         break;
  //       case 'contains':
  //         $stmt->bindValue(":$field", "%$value%", PDO::PARAM_STR);
  //         break;
  //       case 'startswith':
  //         $stmt->bindValue(":$field", "$value%", PDO::PARAM_STR);
  //         break;
  //       case 'endswith':
  //         $stmt->bindValue(":$field", "%$value", PDO::PARAM_STR);
  //         break;
  //       case 'gt':
  //       case 'lt':
  //       case 'gte':
  //       case 'lte':
  //         $stmt->bindValue(":$field", $value, PDO::PARAM_INT);
  //         break;
  //       // Add more lookup cases as needed
  //       default:
  //         throw new Exception("Invalid lookup: $lookup");
  //     }
  //   } else {
  //     $stmt->bindValue(":$field", $value);
  //   }
  // }

  public function filter($filter_conditions)
  {
    $context = [];

    $sql = "SELECT * FROM $this->table WHERE ";
    $conditions = [];

    foreach ($filter_conditions as $field => $value) {
      $conditions[] = $this->generateCondition($field, $value);
    }

    $sql .= implode(" AND ", $conditions);

    $stmt = $this->conn->prepare($sql);

    foreach ($filter_conditions as $field => $value) {
      $this->bindValueWithLookup($stmt, $field, $value);
    }

    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);


    if ($results == null) {
      $context['message'] = "Record not found";
      return $context;
    }

    return $results;
  }

  private function generateCondition($field, $value)
  {
    $lookups = [
      'exact' => '=',
      'iexact' => 'ILIKE',
      'contains' => 'LIKE',
      'icontains' => 'ILIKE',
      'startswith' => 'LIKE',
      'istartswith' => 'ILIKE',
      'endswith' => 'LIKE',
      'iendswith' => 'ILIKE',
      'gt' => '>',
      'lt' => '<',
      'gte' => '>=',
      'lte' => '<=',
      'in' => 'IN',
      'isnull' => 'IS NULL',
      'range' => 'BETWEEN',
      'regex' => 'REGEXP',
      'iregex' => 'REGEXP',
      'week_day' => 'EXTRACT(DOW FROM ',
      'iso_week_day' => 'EXTRACT(ISODOW FROM ',
      'year' => 'EXTRACT(YEAR FROM ',
      'iso_year' => 'EXTRACT(ISOYEAR FROM ',
      'month' => 'MONTH(',
      'day' => 'EXTRACT(DAY FROM ',
      'hour' => 'EXTRACT(HOUR FROM ',
      'minute' => 'EXTRACT(MINUTE FROM ',
      'second' => 'EXTRACT(SECOND FROM ',
      'week' => 'EXTRACT(WEEK FROM ',
      'quarter' => 'EXTRACT(QUARTER FROM ',
      'time' => 'TIME(',
      // Add more lookups as needed
    ];

    $parts = explode('__', $field);
    $column = $parts[0];
    $lookup = 'exact';

    if (count($parts) > 1 && isset($lookups[$parts[1]])) {
      $lookup = $parts[1];
    }

    if (in_array($lookup, ['contains', 'icontains', 'startswith', 'istartswith', 'endswith', 'iendswith', 'regex', 'iregex'])) {
      return "$column {$lookups[$lookup]} :$field";
    } elseif (in_array($lookup, ['in', 'range'])) {
      return "$column {$lookups[$lookup]} (:{$field}_values)";
    } elseif ($lookup === 'isnull') {
      return "$column {$lookups[$lookup]}";
    } elseif (in_array($lookup, ['week_day', 'iso_week_day', 'year', 'iso_year', 'month', 'day', 'hour', 'minute', 'second', 'week', 'quarter', 'time'])) {
      return "{$lookups[$lookup]}$column) = :$field";
    } else {
      return "$column {$lookups[$lookup]} :$field";
    }
  }

  private function bindValueWithLookup($stmt, $field, $value)
  {
    $parts = explode('__', $field);
    $column = $parts[0];

    if (count($parts) > 1) {
      $lookup = $parts[1];
      switch ($lookup) {
        case 'iexact':
        case 'icontains':
        case 'istartswith':
        case 'iendswith':
          $stmt->bindValue(":$field", $value, PDO::PARAM_STR);
          break;
        case 'contains':
        case 'startswith':
        case 'endswith':
        case 'regex':
        case 'iregex':
          $stmt->bindValue(":$field", "%$value%", PDO::PARAM_STR);
          break;
        case 'gt':
        case 'lt':
        case 'gte':
        case 'lte':
          $stmt->bindValue(":$field", $value, PDO::PARAM_INT);
          break;
        case 'in':
        case 'range':
          $stmt->bindValue(":{$field}_values", $value, PDO::PARAM_STR);
          break;
        case 'week_day':
        case 'iso_week_day':
        case 'year':
        case 'iso_year':
        case 'month':
        case 'day':
        case 'hour':
        case 'minute':
        case 'second':
        case 'week':
        case 'quarter':
        case 'time':
          // echo $value,$field;
          $stmt->bindValue(":$field", $value, PDO::PARAM_STR);
          break;
        default:
          throw new Exception("Invalid lookup: $lookup");
      }
    } elseif ($value === null) {
      $stmt->bindValue(":$field", null, PDO::PARAM_NULL);
    } else {
      $stmt->bindValue(":$field", $value);
    }
  }

  public function manyfieldsearch($params)
  {
    $sql = "SELECT * FROM $this->table WHERE ";
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
  public function search($search, $params)
  {
    $context = [];

    $columns = array_keys($params);
    $values = array_values($params);

    $columnNames = implode(", ", $columns);
    $placeholders = implode(" LIKE :search OR ", $columns);

    $sql = "SELECT $columnNames FROM $this->table WHERE $placeholders LIKE :search";

    try {
      $stmt = $this->conn->prepare($sql);

      foreach ($params as $key => &$value) {
        $stmt->bindParam(":$key", $value);
      }

      $searchValue = "%$search%";
      $stmt->bindParam(":search", $searchValue);

      $stmt->execute();

      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

      $context = array(
        "data" => $result,
        "status" => true
      );
    } catch (\Throwable $th) {
      $errorMessage = $th->getMessage();
      // Handle the error as per your requirements
      $context = array(
        "error" => $errorMessage,
        "status" => false
      );
    } finally {
      $stmt->closeCursor();
    }

    return $context;
  }
  public function delete($field, $fieldValue)
  {
    $context = [];

    $sql = "DELETE FROM $this->table WHERE $field = :fieldValue";

    try {
      $stmt = $this->conn->prepare($sql);
      $stmt->bindParam(":fieldValue", $fieldValue);
      $stmt->execute();

      $context = array(
        "message" => "Record deleted successfully.",
        "status" => true
      );
    } catch (\Throwable $th) {
      $errorMessage = $th->getMessage();
      // Handle the error as per your requirements
      $context = array(
        "error" => $errorMessage,
        "status" => false
      );
    } finally {
      $stmt->closeCursor();
    }

    return $context;
  }
  public function __destruct(){
    $this->conn=null;
  }
}

class QuerySet extends DBconnection
{
  private $table;
  private $conditions = [];
  private $orderBy = [];
  private $limit = null;
  private $offset = null;

  public function __construct($table)
  {
    parent::__construct();
    $this->table = $table;
  }

  public function filter($conditions)
  {
    $this->conditions = array_merge($this->conditions, $conditions);
    return $this;
  }

  public function orderBy($column, $direction = 'asc')
  {
    $this->orderBy[] = [$column, $direction];
    return $this;
  }

  public function limit($limit)
  {
    $this->limit = $limit;
    return $this;
  }

  public function offset($offset)
  {
    $this->offset = $offset;
    return $this;
  }

  public function get()
  {
    $sql = "SELECT * FROM $this->table";
    $params = [];

    if (!empty($this->conditions)) {
      $whereClause = $this->buildWhereClause($this->conditions, $params);
      $sql .= " WHERE $whereClause";
    }

    if (!empty($this->orderBy)) {
      $orderByClause = $this->buildOrderByClause($this->orderBy);
      $sql .= " ORDER BY $orderByClause";
    }

    if ($this->limit !== null) {
      $sql .= " LIMIT $this->limit";
    }

    if ($this->offset !== null) {
      $sql .= " OFFSET $this->offset";
    }

    $stmt = $this->conn->prepare($sql);
    $stmt->execute($params);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $results;
  }

  private function buildWhereClause($conditions, &$params)
  {
    $whereClause = "";
    foreach ($conditions as $field => $value) {
      $operator = "=";
      if (strpos($field, '__') !== false) {
        [$field, $operator] = explode('__', $field);
      }

      $placeholder = ":$field";
      $whereClause .= ($whereClause === "") ? "WHERE " : "AND ";
      $whereClause .= "$field $operator $placeholder";
      $params[$placeholder] = $value;
    }
    return $whereClause;
  }

  private function buildOrderByClause($orderBy)
  {
    $orderByClause = "";
    foreach ($orderBy as $item) {
      [$column, $direction] = $item;
      $orderByClause .= ($orderByClause === "") ? "" : ", ";
      $orderByClause .= "$column $direction";
    }
    return $orderByClause;
  }
}
// $querySet = new QuerySet('your_table');
// $results = $querySet
//     ->filter(['name' => 'John', 'age__gte' => 25])
//     ->orderBy('age', 'desc')
//     ->limit(10)
//     ->offset(5)
//     ->get();
