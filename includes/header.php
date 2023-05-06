<header id="header" class="header  ">
  <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
    <div class="d-flex align-items-center ">

      <i onclick="openNav()" class="bi bi-list mobile-nav-toggle"></i>
      <a href="./index.php" >

        <img src="./assets/img/logo.svg" width="80px" height="70px"   class="img-fluid" alt="">
      </a>
      <a href="./index.php" class="  w-100  h-100 logo d-flex align-items-center">
          <span>BookHub</span>
        </a>
    </div>

    <nav id="navbar" class="navbar">
      <ul>
        <li><a class="nav-link  active" href="#hero">Home</a></li>
        <li class=" dropdown"><a href="#" class="nav-link text-decoration-none"><span>Genres</span> <i
              class="bi bi-chevron-down"></i></a>
          <ul>
            <li><a class="nav-link " href="#">Drop Down 1</a></li>
            <!-- <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-right"></i></a>
                <ul>
                  <li><a href="#">Deep Drop Down 1</a></li>
                  <li><a href="#">Deep Drop Down 2</a></li>
                  <li><a href="#">Deep Drop Down 3</a></li>
                  <li><a href="#">Deep Drop Down 4</a></li>
                  <li><a href="#">Deep Drop Down 5</a></li>
                </ul>
              </li> -->

            <li><a class="nav-link " href="#">Drop Down 2</a></li>
            <!-- <hr> -->
            <li><a class="nav-link " href="#">Drop Down 3</a></li>
            <li><a class="nav-link " href="#">Drop Down 4</a></li>
          </ul>
        </li>

        <li><a class="nav-link " href="#about">Authors</a></li>
        <li><a class="nav-link " href="#services">Trending</a></li>
        <li><a class="nav-link " href="#contact">Contact us</a></li>
        <!-- <li class=" dropdown "><a href="#" class="nav-link text-decoration-none h-100 w-100 "><i class=" fas fs-3 fa-user"></i></a>
            <ul>
              <li><a class="nav-link " href="#">Drop Down 1</a></li>
            

              <li><a class="nav-link " href="#">Drop Down 2</a></li>
              <hr>
              <li><a class="nav-link " href="#">Drop Down 3</a></li>
              <li><a class="nav-link " href="#">Drop Down 4</a></li>
            </ul>
          </li> -->
        <?php

        if (!isset($_SESSION['user'])) {
          echo '
          <li><button onclick="loginlink()" class="login-btn  text-decoration-none " href="#about">Login</button></li>
          <li><button onclick="signuplink()" class="radial-out-btn  text-decoration-none " href="#about"><span>Sign
                Up</span></button></li>  
          
          ';
        }

        ?>


      </ul>
      <?php 
      if (isset($_SESSION['user'])) {
          echo ' 
          <div class="flex-shrink-0 dropdown">
          <a href="#" class="profile d-flex align-items-center link-dark text-decoration-none fs-5 dropdown-toggle"
            data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa-solid fa-circle-user fs-2"></i>&nbsp;&nbsp;'.$_SESSION['user']['username'].'
            </a>
          <ul class="dropdown-menu text-small shadow">
            
            <li><a class="dropdown-item" href="#">Mybook</a></li>
            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="./logout.php">Log out</a></li>
          </ul>
        </div>
           ';
        } 
        ?>
    </nav>
    
    <!-- .navbar -->
    <div id="mySidenav" class="sidenav">
      <ul class="text-center">

        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()"><i class="bi bi-x-lg"></i></a>
        <li>
          <a href="#">Home</a>

        </li>
        <li>
          <a href="#">Genres</a>

        </li>
        <li>
          <a href="#">Authors</a>

        </li>
        <li>

          <a href="#">Trending</a>
        </li>
        <li>
          <a hr◘ef="#">Contact us</a>

        </li>
        <button onclick="loginlink()" class="login-btn mt-3 text-decoration-none " href="#about">Login</button>
        <button onclick="signuplink()" class="radial-out-btn  mt-3 text-decoration-none " href="#about"><span>Sign
            Up</span></button>
      </ul>


      <!-- <p style="color: #1c3664; text-align: center">ebook &copy; 2023</p> -->
    </div>
  </div>
</header>