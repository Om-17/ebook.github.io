
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php include_once('./config/css.config.php') ?>
    <title>eBooks</title>
</head>

<body>
    <?php include_once('./config/js.config.php') ?>
    <?php include_once('./loader.php') ?>

    <main>
        <section class="section-login d-flex align-items-center min-vh-100 py-3 py-md-0">
            <div class="container">
                <div class="card login-card signup-card p-xl-5  p-lg-1">
                    <div class="back-link">
                        <a href="./login">
                            <i class="fa-solid fa-arrow-left"></i>
                            <!-- <i class="fa-solid fa-arrow-left fa-beat" style="color: #012f7e;"></i> -->
                            <!-- <i class="bi bi-arrow-left"></i> -->
                        </a>
                    </div>
                    <div class="row no-gutters">
                        <div class="col-md-6  d-flex align-items-center  justify-content-center ">
                            <img src="./assets/img/signup-icon.svg" alt="login"
                                class="col-sm-8 col-xl-11 col-lg-12 col-md-12 login-card-img   img-fluid">

                        </div>
                        <div class="col-md-6 d-flex align-items-center">

                            <div class="card-body ">
                                <!-- <div class="brand-wrapper">
                <img src="assets/images/logo.svg" alt="logo" class="logo">
              </div> -->
                                <h1 class="login-card-header mb-4 ">Sign Up</h1>
                                <!-- <p class="login-card-description">Sign into your account</p> -->
                                <form action="#!">
                                    <div class="p-2 ">
                                        <div class="row">
                                            <div class="col-xl-6 col-md-12">
                                                <div class=" form-floating mb-3">
                                                    <input type="text" class="form-control" id="fname"
                                                        placeholder="eg : john">
                                                    <label for="fname">First Name</label>
                                                </div>

                                            </div>
                                            <div class="col-xl-6 col-md-12">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="lname"
                                                        placeholder="eg : joson ">
                                                    <label for="lname">Last Name</label>
                                                </div>

                                            </div>

                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="email" class="form-control" id="email"
                                                placeholder="name@example.com">
                                            <label for="email">Email address</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="password" class="form-control" id="password"
                                                placeholder="Xyz@1234">
                                            <label for="password">Password</label>
                                        </div>
                                        <div class="form-floating">
                                            <input type="password" class="form-control" id="confirm-password"
                                                placeholder="Xyz@1234">
                                            <label for="confirm-password">Comfirm Password</label>
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

</body>

</html>