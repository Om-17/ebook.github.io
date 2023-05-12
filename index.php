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
        <div class="col-md-12 col-lg-7 col-xxl-7 col-xl-7 col-sm-12 col-xs-12 d-flex  align-items-center">
          <div class="left-side ">
            <h1 class="animate fadeInLeft one">
              We provide the Bestsellings Author books
            </h1>
            <!-- <span>
            Reading is essential
            </span> -->
            <p  class="animate fadeInLeft two">
              sgdskh dksmhf dhkfmh fkdhm fhkfmhfmhf skhm fihdss ixj ijdgdsd ihdasdas
            </p>
            <div class=" w-100 d-flex get-started">

              <button type=" button" class="login-btn m-0 animate fadeIn three ">Get Started</button>
            </div>
          </div>
        </div>
     
      <div class=" col-md-12 col-lg-5 col-xxl-5 col-xl-5 col-sm-12 col-xs-12">
        <div class="right-side">
          <!-- Swiper -->
          <div class="swiper mySwiper ">
            <div class="swiper-wrapper">
              <div class="swiper-slide">
                <img src="./assets/img/book1.jpg" class="img-fluid" />
              </div>
              <div class="swiper-slide">
                <img src="./assets/img/book2.jpg" class="img-fluid" />
              </div>
              <div class="swiper-slide">
                <img src="./assets/img/book3.png" class="img-fluid" />
              </div>
              <div class="swiper-slide">
                <img src="./assets/img/book4.jpg" class="img-fluid" />
              </div>
              <div class="swiper-slide">
                <img src="./assets/img/book5.jpg" class="img-fluid" />
              </div>
              <div class="swiper-slide">
                <img src="./assets/img/book6.jpg" class="img-fluid" />
              </div>


            </div>
            <div class="swiper-pagination"></div>
          </div>
        </div>
      </div>
      </div>
      <div class="w-100 elementor-shape">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" preserveAspectRatio="none">
<path class="elementor-shape-fill"   d="M421.9,6.5c22.6-2.5,51.5,0.4,75.5,5.3c23.6,4.9,70.9,23.5,100.5,35.7c75.8,32.2,133.7,44.5,192.6,49.7
c23.6,2.1,48.7,3.5,103.4-2.5c54.7-6,106.2-25.6,106.2-25.6V0H0v30.3c0,0,72,32.6,158.4,30.5c39.2-0.7,92.8-6.7,134-22.4
c21.2-8.1,52.2-18.2,79.7-24.2C399.3,7.9,411.6,7.5,421.9,6.5z"></path>
</svg>
      </div>
    </section>
    <section>

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