<?php 

define("DB_HOST",'localhost');
define("DB_USER",'root');
define("DB_PASSWORD",'');
define("DB_NAME",'ebookdb');
define("CUR_PATH","D:/xampp/htdocs/ebook/");
$Dir= (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
// define("_URL_",(empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");

?>