<?php
include_once('./includes/header.php');
include_once('../classes/genresclass.php');


$genres = new Genres();
$result = $genres->getAll();

$request_method = $_SERVER["REQUEST_METHOD"];


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Genres - bookwise</title>
  <meta content="" name="description">
  <meta content="" name="keywords">


  <?php include_once('./config/css.config.php') ?>
</head>

<body>

  <?php

  include_once('./includes/sidebar.php');
  include_once('../loader.php');
  ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Genres</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="./index.php">Home</a></li>
          <li class="breadcrumb-item active">Genres</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section ">
      <button class="btn  rounded-circle add-btn" data-bs-toggle="modal" title="Add Genres"
        data-bs-target="#addmodal"><i class="bi bi-plus fs-3"></i></button>
      <div class="row  mt-3">
        <div class="col-12">
          <div class="card recent-sales overflow-auto">

            <div class="filter">


              <div class="card-body pt-4">
                <!-- <h5 class="card-title">Genres </h5> -->

                <table class="table table-hover  datatable">
                  <thead>
                    <tr>

                      <th scope="col">SR.NO.</th>
                      <th scope="col">Genres Name</th>
                      <th scope="col">Action</th>

                    </tr>
                  </thead>
                  <tbody class="table-body">
                    <?php
                    foreach ($result as $key => $value) {

                      echo "
                     <tr>
                        
                        <td>" . $key + 1 . "</td>
                        <td>" . $value['genre_name'] . "</td>
                        <td>
                      <div class='d-flex'>
                        <button class='btn btn-warning text-white edit-btn  p-0'  data-bs-toggle='modal' 
                        data-bs-target='#updatemodal{$key}'><i class='px-2 fs-5 ri-edit-2-line'></i></button>
                        <form  method='post' class='d-flex mb-0' action='./genres.php'>
                        <input type='number' name='delete_id' value='{$value['genre_id']}' hidden >
                        <button class='btn btn-danger p-0 delete-btn ' type='submit'><i class='px-2 fs-5 bi bi-trash'></i></button>
                        </form>
                        </div>
                        </td>
                     </tr>
              
                    ";
                      echo "
                            <div class=\"modal fade\" id=\"updatemodal{$key}\" tabindex=\"-1\" aria-labelledby=\"addgenresModal\" aria-hidden=\"true\">
                                <div class=\"modal-dialog modal-dialog-centered\">
                                    <div class=\"modal-content\">
                                        <div class=\"modal-header\">
                                            <h1 class=\"modal-title fs-5\">Update Genres</h1>
                                            <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"modal\" aria-label=\"Close\"></button>
                                        </div>
                                        <form method=\"POST\" action=\"./genres.php\" id=\"genreform\" class=\"needs-validation\" novalidate>
                                            <div class=\"modal-body\">
                                               <input type=\"number\" name=\"id\" value=\"{$value['genre_id']}\" hidden >
                                                <div class=\"form-floating mb-3\">
                                                    <input type=\"text\" class=\"form-control\" name=\"genre_name\" value=\"{$value['genre_name']}\"  id=\"genre_name\" placeholder=\"Genres name\" required>
                                                    <label for=\"genre_name\">Genres Name</label>
                                                    <div class=\"invalid-feedback\">
                                                        Genres name is required
                                                    </div>
                                                </div>
                                            </div>
                                            <div class=\"modal-footer\">
                                                <button type=\"button\" class=\"btn btn-danger\" data-bs-dismiss=\"modal\">Close</button>
                                                <button type=\"submit\" class=\"btn btn-primary\">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>";


                    }

                    ?>

                  </tbody>
                </table>

              </div>

            </div>
          </div>
          <!-- add modal  -->
          <div class="modal  fade  " id="addmodal" tabindex="-1" aria-labelledby="addgenresModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="addgenresModal">Add Genres</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="./genres.php" id="genreform" class="needs-validation" novalidate>
                  <div class="modal-body">
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" name="genre_name" id="genre_name"
                        placeholder="Genres name" required>
                      <label for="genre_name">Genres Name</label>
                      <div class="invalid-feedback">
                        Genres name is required
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
              </div>
              </form>
            </div>
          </div>
          <!-- close add modal  -->
    </section>

  </main><!-- End #main -->



  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

  <?php include_once('./config/js.config.php') ?>
  <script>
    $('#genres').removeClass('collapsed') 
  </script>
  <?php


  if ($request_method == 'POST') {
    $master = new MasterClass('genres');
    if (isset($_POST['genre_name'])) {

      $genre_name = $_POST['genre_name'];
      $genres = new Genres();
      // update record 
      if (isset($_REQUEST['id'])) {

        $id = $_REQUEST['id'];

        $param = array(
          'genre_name' => $genre_name
        );
        $message = $master->update('genre_id', $id, $param);
        if ($message['status']) {
          echo "<script>
          $(document).ready(function () {
            console.log('" . $message['message'] . "');
            setTimeout(function(){
              toastr.options = {
                      closeButton: true,
                      timeOut: 5000,
                      positionClass: 'toast-top-right'
                  };
                  toastr.success('" . $message['message'] . "');
                  setTimeout(function(){
                    window.location.href='./genres.php'
                  },900)
                })
          },2000)
          </script>";
        } else {
          echo "<script>
          $(document).ready(function () {
            toastr.options = {
              closeButton: true,
              timeOut: 5000,
              positionClass: 'toast-top-right'
          };
          toastr.success('something is going wrong');
          setTimeout(function(){
            
            window.location.href='./genres.php'
          },100)
          })
    
          </script>";
        }

      }

      // create record 
      else {
        $genres->genre_name = $genre_name;
        $message = $genres->create();
        if (isset($message['message'])) {

          echo "<script>
        $(document).ready(function () {
          console.log('" . $message['message'] . "');
          setTimeout(function(){
            toastr.options = {
                    closeButton: true,
                    timeOut: 5000,
                    positionClass: 'toast-top-right'
                };
                toastr.success('" . $message['message'] . "');
                window.location.href='./genres.php'
              
              })
        },2000)
        </script>";
        }
        if (isset($message['error'])) {

          echo "<script>
        $(document).ready(function () {
          toastr.options = {
            closeButton: true,
            timeOut: 5000,
            positionClass: 'toast-top-right'
        };
        toastr.success('" . $message['error'] . "');
          setTimeout(function(){
            
                window.location.href='./genres.php'
              },100)
        })
  
        </script>";
        }

      }

    }
    // delete 
    if (isset($_REQUEST['delete_id'])) {
      $id = $_REQUEST['delete_id'];
      // echo $id;
      $message = $master->delete('genre_id', $id);
      if ($message['status']) {
        echo "<script>
        $(document).ready(function () {
          console.log('" . $message['message'] . "');
          setTimeout(function(){
            toastr.options = {
                    closeButton: true,
                    timeOut: 5000,
                    positionClass: 'toast-top-right'
                };
                toastr.success('" . $message['message'] . "');
                setTimeout(function(){
                window.location.href='./genres.php'

                },900)
              })
        },2000)
        </script>";
      } else {
        echo "<script>
        $(document).ready(function () {
          toastr.options = {
            closeButton: true,
            timeOut: 5000,
            positionClass: 'toast-top-right'
          };
        toastr.success('something is going wrong');
        setTimeout(function(){
          window.location.href='./genres.php'
          
        },100)
        })
  
        </script>";
      }
    }
    exit();
  }
  $master = null;

  $genres = null;
  ?>
</body>

</html>