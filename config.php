<?php 
ob_start();

$Dir= (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
require_once('initialize.php');
require_once('models/DBconnection.php');
function redirect($url=''){
    if(!empty($url)){
        echo'<script type="text/javascript">
        location.href="'.base_url. $url .'"
        </script>"';
    }
}
function validate_image($file){
    if(!empty($file)){
        $ex= explode("?",$file);
        $file= $ex[0];
        $param= isset($ex[1]) ? $ex[1] : '';
        if(is_file(base_url.$file)){
            return base_url.$file.$param;
        }
    }
}

function check_admin(){
    
if (isset($_SESSION['user'])) {
    if ($_SESSION['user']['is_admin'] != 1) {
  
      header('Location: ../app/login.php');
  
      exit();
    }
  }
  if (!isset($_SESSION['user'])) {
  
    header('Location: ../app/login.php');
  
    exit();
  
  }
}

function check_user(){
    if (!isset($_SESSION['user'])) {
  
        header('Location: ./login.php');
      
        exit();
      
      }
}

ob_end_flush();
?>