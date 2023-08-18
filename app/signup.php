<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php 
session_start();
    
    include_once('../config/css.config.php');
if (isset($_SESSION['user']))
{
    redirect('/app/home.php');
    exit();
}
    ?>
    <title>eBooks</title>
</head>

<body>
    <?php include_once('../config/js.config.php'); ?>
    <?php include_once('../loader.php') ?>

    <main>
        <section class="section-login d-flex align-items-center min-vh-100 py-3 py-md-0">
            <div class="container">
                <div class="card login-card signup-card p-xl-5  p-lg-1">
                    <div class="back-link">
                        <a href="./login.php">
                            <i class="fa-solid fa-arrow-left"></i>
                            <!-- <i class="fa-solid fa-arrow-left fa-beat" style="color: #012f7e;"></i> -->
                            <!-- <i class="bi bi-arrow-left"></i> -->
                        </a>
                    </div>
                    <div class="row no-gutters">
                        <div class="col-md-6  d-flex align-items-center  justify-content-center ">
                            <img src="../assets/img/signup-icon.svg" alt="login" class="col-sm-8 col-xl-11 col-lg-12 col-md-12 login-card-img   img-fluid">

                        </div>
                        <div class="col-md-6 d-flex align-items-center">

                            <div class="card-body ">
                                <!-- <div class="brand-wrapper">
                <img src="assets/images/logo.svg" alt="logo" class="logo">
              </div> -->
                                <h1 class="login-card-header mb-4 ">Sign Up</h1>
                                <!-- <p class="login-card-description">Sign into your account</p> -->
                                <form id="signupform" class="needs-validation" novalidate method="post">
                                    <div class="p-2 ">
                                        <div class="row">
                                            <div class="col-xl-6 col-md-12 p-0 mb-3">
                                                <div class=" form-floating ">
                                                    <input type="text" class="form-control" name="first_name" id="fname" placeholder="eg : john">
                                                    <label for="fname">First Name*</label>
                                                </div>
                                                <div id="fname-invalid" class="invalid-feedback">

                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-md-12  px-1 mb-3">
                                                <div class="form-floating ">
                                                    <input type="text" class="form-control" name="last_name" id="lname" placeholder="eg : joson ">
                                                    <label for="lname">Last Name*</label>
                                                </div>
                                                <div id="lname-invalid" class="invalid-feedback">

                                                </div>
                                            </div>

                                        </div>
                                        <div class="mb-3">

                                            <div class="form-floating ">
                                                <input type="email" class="form-control" id="email" placeholder="name@example.com">
                                                <label for="email">Email address*</label>
                                            </div>
                                            <div id="email-invalid" class="invalid-feedback">

                                            </div>
                                        </div>
                                        <div class="mb-3">

                                            <div class="form-floating ">
                                                <input type="text" class="form-control " id="username" placeholder="Username">
                                                <label for="username">Username*</label>
                                            </div>
                                            <div id="username-invalid" class="invalid-feedback">

                                            </div>
                                        </div>

                                        <div class="mb-3">

                                            <div class="form-floating">
                                                <input type="password" class="form-control " id="password" placeholder="Xyz@1234">
                                                <label for="password">Password*</label>

                                            </div>
                                            <div id="password-invalid" class="invalid-feedback">

                                            </div>
                                        </div>
                                        <div class="mb-3">

                                            <div class="form-floating">
                                                <input type="password" class="form-control" id="confirm_password" placeholder="Xyz@1234">
                                                <label for="confirm_password">Comfirm Password*</label>
                                            </div>
                                            <div id="cpassword-invalid" class="invalid-feedback">

                                            </div>
                                        </div>
                                        <div class="d-flex mt-3 mb-2">

                                            <button type="submit" class="w-100 m-0 login-btn ">Create Account</button>
                                        </div>

                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>

    </main>
    <script>
        $(document).ready(function() {
            var loader = $('.loader')

            $('#fname').keypress(function() {

                $('#fname').removeClass('is-invalid')

                $('#fname-invalid').removeClass("d-block")

            });
            $('#lname').keypress(function() {

                $('#lname').removeClass('is-invalid')

                $('#lname-invalid').removeClass("d-block")

            });
            $('#email').keypress(function() {
                if (isValidEmail($(this).val())) {

                    $('#email').removeClass('is-invalid')
                    $('#email-invalid').html('')
                    $('#email-invalid').removeClass("d-block")
                } else {
                    $('#email').addClass('is-invalid')
                    $('#email-invalid').html('Email is invalid');
                    $('#email-invalid').addClass("d-block")


                }
             
            });
            $('#username').keypress(function() {

                $('#username').removeClass('is-invalid')

                $('#username-invalid').removeClass("d-block")

            });
            $('#password').keyup(function() {
                var password = $(this).val();
                console.log("p");
                var pattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*()_+|~=\-\\[\]{};:'",.<>/?])(?=.*[a-zA-Z]).{8,}$/;

                if (pattern.test(password)) {

                    $('#password').removeClass('is-invalid')
                    $('#password-invalid').html('')
                    $('#password-invalid').removeClass("d-block")
                } else {
                    $('#password').addClass('is-invalid')
                    $('#password-invalid').html('Password must contain at least one uppercase letter, one lowercase letter, one number, one special character, and be at least 8 characters long');
                    $('#password-invalid').addClass("d-block")


                }
            });
            $('#confirm_password').keyup(function() {
                var cpassword = $('#confirm_password').val();
                var password = $('#password').val();
                if (password == cpassword) {
                    $('#confirm_password').removeClass('is-invalid')
                    $('#cpassword-invalid').html('')
                    $('#cpassword-invalid').removeClass("d-block")

                } else {

                    $('#confirm_password').addClass('is-invalid')
                    $('#cpassword-invalid').html('confirm password can not match the password');
                    $('#cpassword-invalid').addClass("d-block")


                }
            })

            function isValidEmail(email) {

                var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return emailPattern.test(email);
            }
            $('#signupform').submit(function(e) {

                e.preventDefault();
                var form = $(this);
                var username = $('#username').val();
                var password = $('#password').val();
                var email = $('#email').val();
                var fname = $('#fname').val();
                var lname = $('#lname').val();
                var confirm_password = $('#confirm-password').val();
                if (fname === '') {
                    $('#fname').addClass('is-invalid')
                    $('#fname-invalid').text('First Name is Required.')
                    $('#fname-invalid').addClass("d-block")
                    return;
                }
                if (lname === '') {
                    $('#lname').addClass('is-invalid')
                    $('#lname-invalid').text('Last Name is Required.')
                    $('#lname-invalid').addClass("d-block")
                    return;
                }
                if (email === '') {
                    $('#email').addClass('is-invalid')
                    $('#email-invalid').text('Email is Required.')
                    $('#email-invalid').addClass("d-block")
                    return;
                }
                if (!isValidEmail(email)) {
                    $('#email').addClass('is-invalid')
                    $('#email-invalid').text('Email is invalid.')
                    $('#email-invalid').addClass("d-block")
                    return;
                }
                if (username === '') {
                    $('#username').addClass('is-invalid')
                    $('#username-invalid').text('Username is Required.')
                    $('#username-invalid').addClass("d-block")
                    return;
                }
                if (password === '') {

                    $('#password').addClass('is-invalid')
                    $('#password-invalid').text('Password is Required.')
                    $('#password-invalid').addClass("d-block")

                    return;
                }
                var pattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*()_+|~=\-\\[\]{};:'",.<>/?])(?=.*[a-zA-Z]).{8,}$/;
                if (!pattern.test(password)) {
                    $('#password-invalid').html("")
                    $('#password').addClass('is-invalid')
                    $('#password-invalid').html('Password must contain at least one uppercase letter, one lowercase letter, one number, one special character, and be at least 8 characters long');
                    $('#password-invalid').addClass("d-block")
                    return
                }
                var cpassword = $('#confirm_password').val();

                if (password != cpassword) {

                    $('#confirm-password').addClass('is-invalid')
                    $('#cpassword-invalid').text('Confirm password can not match the password');
                    $('#cpassword-invalid').addClass("d-block")

                    return;
                }


                console.log(username, password);
                var actionUrl = 'http://localhost:80/ebook/api/api-signup.php'
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
                        "password": password,
                        "email": email,
                        "first_name": fname,
                        "last_name": lname,
                    }),
                    beforeSend: function() {
                        loader.show();
                    },
                    // data:form.serialize(),
                    // serializes the form's elements.
                    success: function(data) {
                        console.log(data.results);
                        toastr.options = {
                            closeButton: true,
                            timeOut: 5000,
                            positionClass: 'toast-top-right'
                        };
                        toastr.success('Successful user created');
                        setTimeout(function() {
                            window.location.href = "./login.php";

                        }, 1000)


                    },
                    error: function(data) {
                        setTimeout(() => {

                            toastr.options = {
                                closeButton: true,
                                timeOut: 5000,
                                positionClass: 'toast-top-right'
                            };
                            toastr.error(data.responseJSON.error, "Error");
                            console.log(data.responseJSON.error);

                        }, 1000);

                    },
                    complete: function() {
                        setTimeout(() => {
                            loader.hide();

                        }, 1000);
                    }
                });
                return true;

            })

        });
    </script>
</body>

</html>