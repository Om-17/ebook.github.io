<?php
// $Dir= (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

// include(__DIR__.'/config.php');
// include_once('./DBconnection.php');
// include('../config.php');

// echo $_ENV['_URL_'];
// echo $Dir;

// echo();
// // $user->first_name = "adreja";
// $user->last_name = "om";
// // $user->username = "om178";
// $user->password = "password";
// $user->email = "om178@gmail.com";
// $user->mobile_no = 1234567890;
// $mes=$user->create();
// print_r($mes);
session_start();
?>

<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <?php include_once('./config/css.config.php') ?>
  <title>eBooks</title>
  <style>


  </style>
</head>

<body>
  <?php include_once('./config/js.config.php') ?>

  <?php include_once('./includes/header.php') ?>
  <?php include_once('./loader.php') ?>


  <main>
    <section>
      <?php
      if (isset($_SESSION['user'])) {
        // print_r($_SESSION['user']);

      }
      ?>
     

    </section>

  </main>
  <?php include_once('./includes/footer.php') ?>

</body>

</html>