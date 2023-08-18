<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php include_once('../config/css.config.php') ?>
    <title>eBooks</title>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
  <script type="text/javascript" src="../assets/vendor/rarorpay/chechout.js"></script>


</head>

<body>
    <?php include_once('../config/js.config.php') ?>
    <?php include_once('../includes/header.php');
   
    ?>
    <?php include_once('../loader.php') ?>

    <main>
        <div class="container-genre">
        
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
                       // console.log(data);
                      
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
   <section class="container">
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
               <ul class="list-unstyled mt-3 mb-4">
                  <li>Free Forever</li>
                  <br>
                  <li>Read free books</li>
                  <br>
                  <li>Wishlist books</li>
                  
                
                </ul>
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


        </div>
    </main>
</body>
</html>