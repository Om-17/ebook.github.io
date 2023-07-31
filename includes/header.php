<?php

session_start();
include_once('../classes/DBclass.php');
$genres_obj=new QuerySet('genres');
$genres_result=$genres_obj->limit(10)->get();


?>
<header id="header" class="header  ">
  <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
    <div class="d-flex align-items-center ">

      <i onclick="openNav()" class="bi bi-list mobile-nav-toggle"></i>
      <a href="./" >

        <img src="../assets/img/logo.svg" width="80px" height="70px"   class="img-fluid" alt="">
      </a>
      <a href="./" class="  w-100  h-100 logo d-flex align-items-center">
          <span>&nbsp;BookWise</span>
        </a>
    </div>

    <nav id="navbar" class="navbar">
      <ul>
        <li><a class="nav-link  active" href="./">Home</a></li>
        <?php
        if(isset($_SESSION['user'])){
          if($_SESSION['user']['is_admin']){
            echo ' <li><a class="nav-link" href="'.base_url.'/admin/">Admin</a></li>';
          }
        }
        
        ?>
       
        <li><a class="nav-link " href="#books">Books</a></li>

        <li class=" dropdown"><a  href="genres.php" class="nav-link text-decoration-none"><span>Genres</span> <i
              class="bi bi-chevron-down"></i></a>
              <ul class="genres-dropdown">
                  <?php 
                  $primary_colors = array('red', 'blue', 'green', 'yellow', 'orange', 'purple', 'cyan');
                  $num_primary_colors = count($primary_colors);
                  
                  foreach ($genres_result as $key => $value) {
                    $encrypted_genre_id = base64_encode($value['genre_id']);
                    $color = $primary_colors[$key % $num_primary_colors];                  
                  
                    echo'
  
                    <li class="p-0">
                       <a class="genre-link" style="color: '.$color.'" href="genres.php?genre[]='.$encrypted_genre_id.'">'.$value['genre_name'].'</a>
                    </li>
                    ';
                  }

                  ?>
                  <li class="p-0"><a class=" " href="genres.php">Other</a></li>

             </ul>
        </li>

        <li><a class="nav-link " href="./authors.php">Authors</a></li>
      
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
          <a href="#" class="profile d-flex align-items-center link-dark text-decoration-none fs-5 "
            data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa-solid fa-circle-user fs-2"></i>&nbsp;&nbsp;
            </a>
          <ul style="width:250px" class="dropdown-menu text-small shadow">
            
            <li>
            <h5 class="dropdown-item text-capitalize text-center mb-0" href="#">'.$_SESSION['user']['username'].'
            </h5>
            <h6 class="text-center mb-1"> '.$_SESSION['user']['email'].'</h6>
            
            </li>
            <li>
            <hr class="dropdown-divider">
          </li>
            <li><a class="dropdown-item" href="./mybooks.php">Mybooks</a></li>
          
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
          <a href="./">Home</a>

        </li>
        <li>
          <a href="book.php">books</a>

        </li>
        <li>
          <a href="genres.php">Genres</a>

        </li>
        <li>
          <a href="author.php">Authors</a>

        </li>
      
      
        <button onclick="loginlink()" class="login-btn mt-3 text-decoration-none " href="#about">Login</button>
        <button onclick="signuplink()" class="radial-out-btn  mt-3 text-decoration-none " href="#about"><span>Sign
            Up</span></button>
      </ul>


      <!-- <p style="color: #1c3664; text-align: center">ebook &copy; 2023</p> -->
    </div>
  </div>
</header>

<?php $genres_obj=null; ?>