<?php 
session_start();
include_once('../classes/DBclass.php');

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization');
$REQUEST = json_decode(file_get_contents("php://input"),true);

if(isset($REQUEST['status'])){
    // http_response_code(400);
    $status=$REQUEST['status'];
    $mybookobj = new DBclass('mybooks');
    if($status=="All"){
        $mybookparam=[
            "user_id"=>$_SESSION['user']['id']
        ];
      $mybook = $mybookobj->filter($mybookparam);
     
    }
    else{
        $mybookparam=[
            "status"=>$status,
            "user_id"=>$_SESSION['user']['id']
        ];
      $mybook = $mybookobj->filter($mybookparam);

    }
    if(!isset($mybook['message'])){
        $bookobj = new DBclass('books');
        $authorobj = new DBclass('authors');
        $mybookresult = array();
        
        foreach ($mybook as $mybookvalue) {
            $book_result = $bookobj->get("book_id", $mybookvalue['book_id']);
        
            // Retrieve author name for the book
            $author = $authorobj->get("author_id", $book_result['author_id']);
        
            if ($author) {
                $author_name = $author['author_name'];
        
                // Remove unwanted keys from the book result
                $book_result['book_image']=base_url.$book_result['book_image'];
                unset($book_result['book_pdf']);
                unset($book_result['book_summary']);
        
                // Add the author name to the book result
                $book_result['author_name'] = $author_name;
                $book_result['status'] = $mybookvalue['status'];
        
                // Add the modified book result to the array
                $mybookresult[] = $book_result;
            }
        }
      print_r( json_encode($mybookresult));    
       
      }
      else{
      echo json_encode($mybook);    

      }
  
}





$authorobj=null;
$mybookobj=null;
$bookobj=null;




?>