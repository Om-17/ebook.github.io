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

  <?php include_once('../config/js.config.php') ?>
  <!-- <script type="text/javascript" src="../assets/vendor/rarorpay/chechout.js"></script> -->
  <?php include_once('../includes/header.php');
  include_once('../config.php');

  $bookObj = new DBclass('books');
  $trendbookresult = $bookObj->filter(['trending_book'=>1]);
$recent_book_obj=new QuerySet('books');
$recent_book=$recent_book_obj->orderBy('book_id','DESC')->limit(10)->get();
 



  ?>
  <?php include_once('../loader.php') ?>


  <main>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
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
            Explore the Literary Gems that have Touched Millions of Hearts and Minds.
            </p>
            <div class=" w-100 d-flex get-started">

              <a href="./books.php" class="text-decoration-none login-btn m-0 animate fadeIn three">Get Started</a>
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
  

      </div>
      <div class="w-100 container">
        <div class="swiper tending_book_swiper  ">
          <div class="swiper-wrapper" style="height:500px; margin-top: 50px;">
            <?php
            foreach ($trendbookresult as $key => $value) {
              $authorobj = new  DBclass('authors');
              $authorname = $authorobj->get("author_id", $value['author_id']);
              echo '
                  <div class="swiper-slide" style="margin-right:20px;">
                  <a href="./book_details.php?book_id=' . $value['book_id'] . '" class="card card-book ">
                  <div class="badge">
                    <span>
                      ' . $value['book_type'] . '
                    </span>
                  </div>
                  <div class="book_image">
  
                    <img class="" src="' . base_url . $value["book_image"] . '" />
                    
                  </div>
                  <div class="card-body card-book-body text-center">
                    <div class="row">
                      <h3 class="col-12 text-capitalize  text-truncate">
                       ' . $value['book_title'] . '
                      </h3>
                    </div>
  
                    <span>
                     ' . $authorname['author_name'] . '
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
    <div class="w-100 elementor-recent-shape">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" preserveAspectRatio="none">
          <path class="elementor-shape-fill" d="M421.9,6.5c22.6-2.5,51.5,0.4,75.5,5.3c23.6,4.9,70.9,23.5,100.5,35.7c75.8,32.2,133.7,44.5,192.6,49.7
c23.6,2.1,48.7,3.5,103.4-2.5c54.7-6,106.2-25.6,106.2-25.6V0H0v30.3c0,0,72,32.6,158.4,30.5c39.2-0.7,92.8-6.7,134-22.4
c21.2-8.1,52.2-18.2,79.7-24.2C399.3,7.9,411.6,7.5,421.9,6.5z"></path>
        </svg>
      </div>
    <section class="bg-recent">
      <br />
      <br />
      <br />
      <br />

      <div class="w-100 text-center ">
  
        <h1 class="text-white">
          Recent Books
        </h1>
  

      </div>
      <div class="w-100 container">
        <div class="swiper tending_book_swiper  ">
          <div class="swiper-wrapper" style="height:500px; margin-top: 50px;">
            <?php
            foreach ($recent_book as $key => $value) {
              $authorobj = new  DBclass('authors');
              $authorname = $authorobj->get("author_id", $value['author_id']);
              echo '
                  <div class="swiper-slide" style="margin-right:20px;">
                  <a href="./book_details.php?book_id=' . $value['book_id'] . '" class="card card-book ">
                  <div class="badge">
                    <span>
                      ' . $value['book_type'] . '
                    </span>
                  </div>
                  <div class="book_image">
  
                    <img class="" src="' . base_url . $value["book_image"] . '" />
                    
                  </div>
                  <div class="card-body card-book-body text-center">
                    <div class="row">
                      <h3 class="col-12 text-capitalize  text-truncate">
                       ' . $value['book_title'] . '
                      </h3>
                    </div>
  
                    <span>
                     ' . $authorname['author_name'] . '
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
 <script>
    
     function rzp_6_monthpay() {
      if (!<?php echo isset($_SESSION['user']) ? 'true' : 'false'; ?>) {
        // Redirect to login page
        window.location.href = './login.php';
      }
 
    
      else{

      var options = {
        "key": "<?php echo rzp_api_key; ?>", // Enter the Key ID generated from the Dashboard
        "amount": "99900", // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
        "currency": "INR",
        "name": "<?php echo company_name; ?>",
        "handler": function(response) {
          console.log(response);
          // alert(response.razorpay_payment_id);
          var actionUrl = '<?php echo base_url;?>/api/payment.php'
                $.ajax({
                    url: actionUrl,
                    headers: {
                        'Access-Control-Allow-Origin': '*',
                        'Content-Type': 'application/json, charset=utf-8',
                    },
                    method: 'POST',
                    dataType: 'json',
                    data: JSON.stringify({
                        "payment_id":response.razorpay_payment_id ,
                        "price": "<?php echo base64_encode(799);?>",
                        "duration": "<?php echo base64_encode(6)?>",
                        "user_id":"<?php  if (isset($_SESSION['user'])){ echo base64_encode($_SESSION['user']['id']);} ?>"

                        
                    }),
                    success: function (data) {
                        console.log(data);
                        toastr.options = {
                                    closeButton: true,
                                    timeOut: 6000,
                                    positionClass: 'toast-top-right'
                                };
                                if (data?.status==1){
                                  toastr.success("Successfully" ," You are now Prime Member.");
                                  window.location.reload();

                                }
                                else{
                                  toastr.error("Payment Failed");
                                }
                           
                          

                    },
                    error: function (data) {
                       
                      toastr.options = {
                                    closeButton: true,
                                    timeOut: 6000,
                                    positionClass: 'toast-top-right'
                                };
                      toastr.error("Payment Failed");
                    },
                   
                });

        },
        "prefill": {
          "name": "<?php if (isset($_SESSION['user'])) {
                      echo $_SESSION['user']['first_name'];
                    } ?>",
          "email": "<?php if (isset($_SESSION['user'])) {
                      echo $_SESSION['user']['email'];
                    } ?>",

        },
        "notes": {
        
          "duration_month": "6"
        },
        "theme": {
          "color": "#3399cc"
        }
      };
      var rzp1 = new Razorpay(options);
      rzp1.on('payment.failed', function(response) {
        console.error("error",response);
        // console.error("error",response.error);
        alert(response.error.reason);
        // toastr.options = {
        //                             closeButton: true,
        //                             timeOut: 6000,
        //                             positionClass: 'toast-top-right'
        //                         };
        //   toastr.error(response.error.reason,response.error.description);
        // rzp1.close();
        // window.location.reload();
        // alert(response.error.code);
     
      });

      rzp1.open();
    }

    };
     function rzp_1_monthpay() {
      if (!<?php echo isset($_SESSION['user']) ? 'true' : 'false'; ?>) {
        // Redirect to login page
        window.location.href = './login.php';
      }
 
    
      else{

      var options = {
        "key": "<?php echo rzp_api_key; ?>", // Enter the Key ID generated from the Dashboard
        "amount": "19900", // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
        "currency": "INR",
        "name": "<?php echo company_name; ?>",
        "handler": function(response) {
          console.log(response);
          // alert(response.razorpay_payment_id);
          var actionUrl = '<?php echo base_url;?>/api/payment.php'
                $.ajax({
                    url: actionUrl,
                    headers: {
                        'Access-Control-Allow-Origin': '*',
                        'Content-Type': 'application/json, charset=utf-8',
                    },
                    method: 'POST',
                    dataType: 'json',
                    data: JSON.stringify({
                        "payment_id":response.razorpay_payment_id ,
                        "price": "<?php echo base64_encode(199);?>",
                        "duration": "<?php echo base64_encode(1)?>",
                        "user_id":"<?php  if (isset($_SESSION['user'])){ echo base64_encode($_SESSION['user']['id']);} ?>"

                        
                    }),
                    success: function (data) {
                        console.log(data?.status);
                       
                            toastr.options = {
                                    closeButton: true,
                                    timeOut: 6000,
                                    positionClass: 'toast-top-right'
                                };
                                if (data?.status==1){
                                  toastr.success("Successfully" ," You are now Prime Member.");
                                  window.location.reload();
                                }
                                else{
                                  toastr.error("Payment Failed");
                                }
                          

                    },
                    error: function (data) {
                      toastr.options = {
                                    closeButton: true,
                                    timeOut: 6000,
                                    positionClass: 'toast-top-right'
                                };
                      toastr.error("Payment Failed");

                    },
                   
                });

        },
        "prefill": {
          "name": "<?php if (isset($_SESSION['user'])) {
                      echo $_SESSION['user']['first_name'];
                    } ?>",
          "email": "<?php if (isset($_SESSION['user'])) {
                      echo $_SESSION['user']['email'];
                    } ?>",

        },
        "notes": {
        
          "duration_month": "6"
        },
        "theme": {
          "color": "#3399cc"
        }
      };
      var rzp1 = new Razorpay(options);
      rzp1.on('payment.failed', function(response) {
        console.error("error",response);
        // console.error("error",response.error);
        alert(response.error.reason);
        // toastr.options = {
        //                             closeButton: true,
        //                             timeOut: 6000,
        //                             positionClass: 'toast-top-right'
        //                         };
        //   toastr.error(response.error.reason,response.error.description);
        // rzp1.close();
        // window.location.reload();
        // alert(response.error.code);
     
      });

      rzp1.open();
    }

    };
    function alreadymember(){
          toastr.options = {
                                    closeButton: true,
                                    timeOut: 2000,
                                    positionClass: 'toast-top-right'
                                };
          toastr.warning("Already Member Here");
    }
</script>
<div class="w-100 elementor-price-shape">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" preserveAspectRatio="none">
          <path class="elementor-shape-fill" d="M421.9,6.5c22.6-2.5,51.5,0.4,75.5,5.3c23.6,4.9,70.9,23.5,100.5,35.7c75.8,32.2,133.7,44.5,192.6,49.7
c23.6,2.1,48.7,3.5,103.4-2.5c54.7-6,106.2-25.6,106.2-25.6V0H0v30.3c0,0,72,32.6,158.4,30.5c39.2-0.7,92.8-6.7,134-22.4
c21.2-8.1,52.2-18.2,79.7-24.2C399.3,7.9,411.6,7.5,421.9,6.5z"></path>
        </svg>
      </div>
    <section class="container">
      <br>
      <br>
      <br>
      <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
        <h3 style="font-size: 46px;" class="display-4  fw-normal text-body-emphasis">Membership Prices</h3>
        <p class="fs-5 text-body-secondary">Choose your membership plan.</p>
      </div>
      <main>
        <div class="row row-cols-1 row-cols-md-3 mb-3 text-center">
          <div class="col">
            <div class="card mb-4 rounded-3 shadow-sm">
              <div class="card-header py-3">
                <h4 class="my-0 fw-normal">Free</h4>
              </div>
              <div class="card-body">
                <h1 class="card-title pricing-card-title">₹0<small class="text-body-secondary fw-light">/mo</small></h1>
                <ul class="list-unstyled mt-3 mb-4">
                  <li>Free Forever</li>
                  <br>
                  <li>Read free books</li>
                  <br>
                  <li>Wishlist books</li>
                  
                
                </ul>
                <a  href="./login.php" class="w-100 btn btn-lg btn-outline-primary">Sign up for free</a>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card mb-4 rounded-3 shadow-sm">
              <div class="card-header py-3">
                <h4 class="my-0 fw-normal">Pro</h4>
              </div>
              <div class="card-body">
                <h1 class="card-title pricing-card-title">₹199<small class="text-body-secondary fw-light">/mo</small></h1>
                <ul class="list-unstyled mt-3 mb-4">
                  <li>1 Month Membership</li>
                  <li>Read and download books</li>
                  <li>Exclusive books</li>
                  <li>Bookmark Books</li>
                  <li>Wishlist books</li>

                </ul>
                <?php
      if (isset($_SESSION['user'])){
         if( $_SESSION['user']['is_member']){
          echo '
        <button type="button" class="w-100 btn btn-lg btn-primary" onclick="alreadymember();">Pay Now</button>
        
        ';
         }
         else{
          echo '
          <button type="button" class="w-100 btn btn-lg btn-primary" onclick="rzp_1_monthpay();">Pay Now</button>
          
          ';
        }
      } 
      else{
        echo '
        <button type="button" class="w-100 btn btn-lg btn-primary" onclick="rzp_1_monthpay();">Pay Now</button>
        
        ';
      }
      ?>

              </div>
            </div>
          </div>
          <div class="col">
            <div class="card mb-4 rounded-3 shadow-sm border-primary">
              <div class="card-header py-3 text-bg-primary border-primary">
                <h4 class="my-0 fw-normal">Prime</h4>
              </div>
              <div class="card-body">
                <h1 class="card-title pricing-card-title">₹999<small class="text-body-secondary fw-light">/6mo</small></h1>
                <ul class="list-unstyled mt-3 mb-4">
                <li>6 Months Membership</li>
                  <li>Read and download books</li>
                  <li>Exclusive books</li>
                  <li>Bookmark Books</li>

                  <li>Wishlist books</li>
                </ul>
                <?php
      if (isset($_SESSION['user'])){
         if( $_SESSION['user']['is_member']){
          echo '
        <button type="button" class="w-100 btn btn-lg btn-primary" onclick="alreadymember();">Pay Now</button>
        
        ';
         }
         else{
          echo '
          <button type="button" class="w-100 btn btn-lg btn-primary" onclick="rzp_6_monthpay();">Pay Now</button>
          
          ';
        }
      } 
      else{
        echo '
        <button type="button" class="w-100 btn btn-lg btn-primary" onclick="rzp_6_monthpay();">Pay Now</button>
        
        ';
      }
      ?>


              </div>
            </div>
          </div>
        </div>

      </main>
    </section>
  </main>
  
   

  <?php include_once('../includes/footer.php'); ?>

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
 centeredSlides: true,
  loop: true,
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
$bookObj = null;
$authorobj = null;

?>