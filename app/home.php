

<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <?php include_once('../config/css.config.php') ?>
  <title>eBooks</title>
  <style>


  </style>
</head>

<body>

  <?php include_once('../includes/header.php');
  $bookObj = new DBclass('books');
  $booksresult = $bookObj->getAll();

  
  
  ?>
  <?php include_once('../loader.php') ?>


  <main>
    <section class="section-home-banner">

      <div class="row bg-pattern ">
        <div class="col-md-12 col-lg-7 col-xxl-7 col-xl-7 col-sm-12 col-xs-12 d-flex  align-items-center">
          <div class="left-side ">
            <h1 class="animate fadeInLeft one">
              We provide the Bestsellings Author books
            </h1>
            <!-- <span>
            Reading is essential
            </span> -->
            <p class="animate fadeInLeft two">
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
                <div class="swiper-slide swiper-slide-banner">
                  <img src="../assets/img/book1.jpg" class="img-fluid" />
                </div>
                <div class="swiper-slide swiper-slide-banner">
                  <img src="../assets/img/book2.jpg" class="img-fluid" />
                </div>
                <div class="swiper-slide swiper-slide-banner">
                  <img src="../assets/img/book3.png" class="img-fluid" />
                </div>
                <div class="swiper-slide swiper-slide-banner">
                  <img src="../assets/img/book4.jpg" class="img-fluid" />
                </div>
                <div class="swiper-slide swiper-slide-banner">
                  <img src="../assets/img/book5.jpg" class="img-fluid" />
                </div>
                <div class="swiper-slide swiper-slide-banner">
                  <img src="../assets/img/book6.jpg" class="img-fluid" />
                </div>


              </div>
              <div class="swiper-pagination"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="w-100 elementor-shape">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" preserveAspectRatio="none">
          <path class="elementor-shape-fill" d="M421.9,6.5c22.6-2.5,51.5,0.4,75.5,5.3c23.6,4.9,70.9,23.5,100.5,35.7c75.8,32.2,133.7,44.5,192.6,49.7
c23.6,2.1,48.7,3.5,103.4-2.5c54.7-6,106.2-25.6,106.2-25.6V0H0v30.3c0,0,72,32.6,158.4,30.5c39.2-0.7,92.8-6.7,134-22.4
c21.2-8.1,52.2-18.2,79.7-24.2C399.3,7.9,411.6,7.5,421.9,6.5z"></path>
        </svg>
      </div>

    </section>
    <section>
      <br />
      <br />
      <br />
      <br />

      <div class="w-100 text-center ">

        <h1>
          Trending Books
        </h1>
        <!-- <div class="book-card">
          <div class="book-card__cover">
            <div class="book-card__book">
              <div class="book-card__book-front">
                <img class="book-card__img" src="../assets/img/book1.jpg" />
              </div>
              <div class="book-card__book-back"></div>
              <div class="book-card__book-side"></div>
            </div>
          </div>
          <div>
            <div class="book-card__title">
              Harry Potter e a Pedra Filosofal
            </div>
            <div class="book-card__author">
              J. K. Rowling
            </div>
          </div>

        </div> -->

      </div>
      <div class="w-100 container">
        <div class="swiper tending_book_swiper  ">
          <div class="swiper-wrapper" style="height:500px; margin-top: 50px;">
            <?php 
                foreach ($booksresult as $key => $value) {
                  $authorobj=new  DBclass('authors');
                  $authorname=$authorobj->get("author_id",$value['author_id']);
                  echo '
                  <div class="swiper-slide" style="margin-right:20px;">
                  <a href="./book_details.php?book_id='.$value['book_id'].'" class="card card-book ">
                  <div class="badge">
                    <span>
                      '.$value['book_type'].'
                    </span>
                  </div>
                  <div class="book_image">
  
                    <img class="" src="'.base_url.$value["book_image"].'" />
                    
                  </div>
                  <div class="card-body card-book-body text-center">
                    <div class="row">
                      <h3 class="col-12 text-capitalize  text-truncate">
                       '.$value['book_title'].'
                      </h3>
                    </div>
  
                    <span>
                     '.$authorname['author_name'].'
                    </span>
                  </div>
                </a>
                  </div>
                  ';
                }
              
              ?>
            



          </div>
          <div class="swiper-button-next"></div>
          <div class="swiper-button-prev"></div>
          <div class="swiper-pagination"></div>
        </div>
      </div>
    </section>

    <section  class="container">
    <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
      <h1 class="display-4 fw-normal text-body-emphasis">Pricing</h1>
      <p class="fs-5 text-body-secondary">Quickly build an effective pricing table for your potential customers with this Bootstrap example. It’s built with default Bootstrap components and utilities with little customization.</p>
    </div>
    <main>
    <div class="row row-cols-1 row-cols-md-3 mb-3 text-center">
      <div class="col">
        <div class="card mb-4 rounded-3 shadow-sm">
          <div class="card-header py-3">
            <h4 class="my-0 fw-normal">Free</h4>
          </div>
          <div class="card-body">
            <h1 class="card-title pricing-card-title">$0<small class="text-body-secondary fw-light">/mo</small></h1>
            <ul class="list-unstyled mt-3 mb-4">
              <li>10 users included</li>
              <li>2 GB of storage</li>
              <li>Email support</li>
              <li>Help center access</li>
            </ul>
            <button type="button" class="w-100 btn btn-lg btn-outline-primary">Sign up for free</button>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card mb-4 rounded-3 shadow-sm">
          <div class="card-header py-3">
            <h4 class="my-0 fw-normal">Pro</h4>
          </div>
          <div class="card-body">
            <h1 class="card-title pricing-card-title">$15<small class="text-body-secondary fw-light">/mo</small></h1>
            <ul class="list-unstyled mt-3 mb-4">
              <li>20 users included</li>
              <li>10 GB of storage</li>
              <li>Priority email support</li>
              <li>Help center access</li>
            </ul>
            <button type="button" class="w-100 btn btn-lg btn-primary">Get started</button>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card mb-4 rounded-3 shadow-sm border-primary">
          <div class="card-header py-3 text-bg-primary border-primary">
            <h4 class="my-0 fw-normal">Enterprise</h4>
          </div>
          <div class="card-body">
            <h1 class="card-title pricing-card-title">$29<small class="text-body-secondary fw-light">/mo</small></h1>
            <ul class="list-unstyled mt-3 mb-4">
              <li>30 users included</li>
              <li>15 GB of storage</li>
              <li>Phone and email support</li>
              <li>Help center access</li>
            </ul>
            <button type="button" class="w-100 btn btn-lg btn-primary">Contact us</button>
          </div>
        </div>
      </div>
    </div>

  </main>
    </section>


  </main>
  <?php include_once('../includes/footer.php') ?>
  <?php include_once('../config/js.config.php') ?>

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
    var swiper = new Swiper(".tending_book_swiper", {



      slidesPerView: "auto",

      spaceBetween: 30,
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      autoplay: {
        delay: 2500,
        disableOnInteraction: false,
        pauseOnMouseEnter: true,
      },
    });
  </script>

</body>

</html>
<?php 
$bookObj=null;
$authorobj=null;

?>