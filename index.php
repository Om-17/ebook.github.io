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

  <?php include_once('./includes/header.php') ?>
  <?php include_once('./loader.php') ?>


  <main>
    <section class="section-home-banner">
      <?php
      if (isset($_SESSION['user'])) {
        // print_r($_SESSION['user']);
      
      }
      ?>
      <div class="row bg-pattern ">
        <div class="col-7 d-flex  align-items-center">
          <div class="left-side ">
            <span>
              sfdgdgdsgsgsg
            </span>
            <h1>
              We provide best eBooks frees
            </h1>
            <p>
              sgdskh dksmhf dhkfmh fkdhm fhkfmhfmhf skhm fihdss ixj ijdgdsd  ihdasdas
            </p>
          </div>
        </div>
        <div class="col-5">
          <div class="right-side">
  <!-- Swiper -->
  <div class="swiper mySwiper">
    <div class="swiper-wrapper">
      <div class="swiper-slide">
        <img src="https://swiperjs.com/demos/images/nature-1.jpg" />
      </div>
      <div class="swiper-slide">
        <img src="https://swiperjs.com/demos/images/nature-2.jpg" />
      </div>
      <div class="swiper-slide">
        <img src="https://swiperjs.com/demos/images/nature-3.jpg" />
      </div>
   
    </div>
    <div class="swiper-pagination"></div>
  </div>
          </div>
        </div>
      </div>


    </section>

  </main>
  <?php include_once('./includes/footer.php') ?>
  <?php include_once('./config/js.config.php') ?>

  <script>
    var swiper = new Swiper(".mySwiper", {
      effect: "coverflow",
      grabCursor: true,
      centeredSlides: true,
      slidesPerView: "auto",
     
      coverflowEffect: {
        rotate: 50,
        stretch: 0,
        depth: 100,
        modifier: 1,
        slideShadows: true,
      },
      autoplay: {
        delay: 2500,
        disableOnInteraction: false,
      },
    });
  </script>

</body>

</html>