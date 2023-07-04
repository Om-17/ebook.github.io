<?php include_once('../config.php');
if (isset($_SESSION['User']))
{
    header('Location: home.php');
    exit();
}
?>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php include_once('../config/css.config.php') ?>
    <title>eBooks</title>
</head>

<body>

    <?php include_once('../config/js.config.php') ?>
    <?php include_once('../loader.php') ?>
    <main>
        <section class="section-login d-flex align-items-center min-vh-100 py-3 py-md-0">
            <div id="toast"></div>
            <div class="container">
                <div class="card login-card p-xl-5 p-lg-3">
                    <div class="back-link">
                        <a href="javascript:void(0)" onclick="homelink()">
                            <i class="fa-solid fa-arrow-left"></i>
                            <!-- <i class="fa-solid fa-arrow-left fa-beat" style="color: #012f7e;"></i> -->
                            <!-- <i class="bi bi-arrow-left"></i> -->
                        </a>
                    </div>
                    <div class="row no-gutters">
                        <div class="col-md-6  d-flex align-items-center  justify-content-center ">
                        <?php 
                        
                        echo'   
                        <img src="'.base_url.'/assets/img/login-icon.svg" alt="login"
                                class="col-sm-8 col-xl-11 col-lg-11 col-md-12 login-card-img   img-fluid">'

                                ?>
                        </div>
                        <div class="col-md-6 d-flex align-items-center">

                            <div class="card-body ">
                                <!-- <div class="brand-wrapper">
                <img src="assets/images/logo.svg" alt="logo" class="logo">
              </div> -->
                                <h1 class="login-card-header mb-4 ">Login</h1>
                                <!-- <p class="login-card-description">Sign into your account</p> -->
                                <form id='loginform' method="post">
                                    <div class="p-2 ">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="username" name="username"
                                                placeholder="John17">
                                            <label for="username">Username</label>
                                        </div>
                                        <div class="form-floating">
                                            <input type="password" class="form-control" name="password" id="password"
                                                placeholder="Password">
                                            <label for="password">Password</label>
                                        </div>
                                        <div class="d-flex mt-3 mb-2">

                                            <button type="submit" class="w-100 m-0 login-btn ">Login</button>
                                        </div>

                                    </div>
                                </form>
                                <div class="d-flex row align-items-center justify-content-between">

                                    <!-- <a href="#"
                                        class=" col-lg-4 col-xl-4 col-xxl-4 col-md-12 col-sm-12 col-xs-12 forgot-password-link">Forgot
                                        password?</a> -->
                                    <p
                                        class=" col-lg-8 col-xl-8 col-xxl-8 col-md-12 col-sm-12 col-xs-12 login-card-footer-text mt-2 h6">
                                        Don't have an account? <a href="./signup"
                                            class=" register-text text-reset">Register here</a></p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>

    </main>
    <script>
        $(document).ready(function () {
            var loader = $('.loader')
            $('#loginform').submit(function (e) {
                e.preventDefault();
                var form = $(this);
                var username = $('#username').val();
                var password = $('#password').val();

                console.log(username, password);
                var actionUrl = 'http://localhost:80/ebook/api/api-login.php'
                $.ajax({
                    url: actionUrl,
                    headers: {
                        'Access-Control-Allow-Origin': '*',
                        'Content-Type': 'application/json, charset=utf-8',
                    },
                    method: 'POST',
                    dataType: 'json',
                    data: JSON.stringify({
                        "username": username,
                        "password": password
                    }),
                    beforeSend: function() {
                loader.show();
            },
                    // data:form.serialize(),
                    // serializes the form's elements.
                    success: function (data) {
                        console.log(data.results);
                        setTimeout(function(){
                            toastr.options = {
                                    closeButton: true,
                                    timeOut: 5000,
                                    positionClass: 'toast-top-right'
                                };
                                toastr.success('Login successful');
                                    if(data.results.is_admin==1){
                                        console.log('yser')
                                        window.location.href = "../admin/index.php";
                                    }
                                    else{
                                        window.location.href = "./";

                                    }

                                },1000) 

                    },
                    error: function (data) {
                        setTimeout(() => {
                            
                            toastr.options = {
                                closeButton: true,
                                timeOut: 5000,
                                positionClass: 'toast-top-right'
                            };
                            toastr.error("Error", data.responseJSON.error);
                            console.log(data);
                            
                        }, 1000);

                    },
                    complete: function() {
                        setTimeout(() => {
                            loader.hide();
                            
                        }, 1000);
            }
                });
                return false;

            })

        });
    </script>

</body>

</html>