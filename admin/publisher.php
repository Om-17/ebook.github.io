
<?php
include_once('./includes/header.php');


$allpublisher = new MasterClass('publishers');
$result = $allpublisher->getAll();

$request_method = $_SERVER["REQUEST_METHOD"];


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Authors - bookwise</title>
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
      <h1>Publishers</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="./index.php">Home</a></li>
          <li class="breadcrumb-item active">Publishers</li> 
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section ">
      <button class="btn  rounded-circle add-btn" data-bs-toggle="modal" title="Add Genres"
        data-bs-target="#addmodal"><i class="bi bi-plus  fs-3"></i></button>
      <div class="row  mt-3">
        <div class="col-12">
          <div class="card recent-sales overflow-auto">

            <div class="filter">


              <div class="card-body pt-4">
                <!-- <h5 class="card-title">Genres </h5> -->

                <table class="table table-hover  datatable">
                  <thead>
                    <tr >

                      <th scope="col">SR.NO.</th>
                      <th scope="col">Publishers Name</th>
                      <th scope="col">Action</th>

                    </tr>
                  </thead>
                  <tbody class="table-body">
                    <?php
                    foreach ($result as $key => $value) {

                      echo "
                     <tr>
                        
                        <td>" . $key +1 . "</td>
                        <td>" . $value['publisher_name'] . "</td> 
                        <td>
                      <div class='d-flex'>
                        <button class='btn btn-warning text-white edit-btn  p-0'  data-bs-toggle='modal' 
                        data-bs-target='#updatemodal{$key}'><i class='px-2 fs-5 ri-edit-2-line'></i></button>
                        <button class='btn  btn-danger p-0 delete-btn p-0' data-bs-toggle='modal' data-bs-target='#deletemodal{$key}'><i class='px-2 fs-5 bi bi-trash'></i></button>
                       
                        </div>
                        </td>
                     </tr>
              
                    ";
                       // delete model 
                    
                       echo '
                       <div class="modal fade" id="deletemodal' . $key . '" tabindex="-1" aria-labelledby="addgenresModal" aria-hidden="true">
                           <div class="modal-dialog modal-dialog-centered modal-confirm">
                           <div class="modal-content">
                                     <div class="modal-header flex-column">
                                       <div class="icon-box">
                                       <i class="bi bi-x"></i>
                                       </div>						
                                       <h4 class="modal-title w-100">Are you sure?</h4>	
                                        <button type="button" class="btn-close close fs-1" data-bs-dismiss="modal" aria-label="Close"></button>
                                           
                                               </div>
                                     <div class="modal-body">
                                       <p>Do you really want to delete these records? This process cannot be undone.</p>
                                     </div>
                                     <div class="modal-footer justify-content-center">
                                           <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                           <form method="post" class="d-flex mb-0" action="./publisher.php">
                                           <input type="number" name="delete_id" value=' . $value["publisher_id"] . ' hidden>
                                          
                                           <button type="submit" class="btn btn-danger">Delete</button>
                                     </form>
                                     </div>
                                   </div>
                           </div>
                       </div>';
                     // update model  
                      echo "
                            <div class=\"modal fade\" id=\"updatemodal{$key}\" tabindex=\"-1\" aria-labelledby=\"addgenresModal\" aria-hidden=\"true\">
                                <div class=\"modal-dialog modal-dialog-centered\">
                                    <div class=\"modal-content\">
                                        <div class=\"modal-header\">
                                            <h1 class=\"modal-title fs-5\">Add Publisher</h1>
                                            <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"modal\" aria-label=\"Close\"></button>
                                        </div>
                                        <form method=\"POST\" action=\"./publisher.php\" id=\"publisherform\" class=\"needs-validation\" novalidate>
                                            <div class=\"modal-body\">
                                               <input type=\"number\" name=\"id\" value=\"{$value['publisher_id']}\" hidden >
                                                <div class=\"form-floating mb-3\">
                                                    <input type=\"text\" class=\"form-control\" name=\"publisher_name\" value=\"{$value['publisher_name']}\"  id=\"publisher_name\" placeholder=\"Publisher name\" required>
                                                    <label for=\"publisher_name\">Publisher Name</label>
                                                    <div class=\"invalid-feedback\">
                                                        Publisher name is required
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
          <div class="modal  fade" id="addmodal" tabindex="-1" aria-labelledby="addgenresModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="addgenresModal">Add publisher</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="./publisher.php" class="needs-validation" novalidate>
                  <div class="modal-body">
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" name="publisher_name" id="publisher_name"
                        placeholder="Publisher name" required>
                      <label for="publisher_name">Publisher Name</label>
                      <div class="invalid-feedback">
                        Publisher name is required
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
   $('#publisher').removeClass('collapsed') 
  </script>
  <?php


  if ($request_method == 'POST') {
    $publisher= new MasterClass('publishers');
    if (isset($_POST['publisher_name'])) {
      
      $publisher_name = $_POST['publisher_name'];
     
      // update record 
      if(isset($_REQUEST['id'])){

        $id= $_REQUEST['id'];

        
        $param= array(
          'publisher_name'=>$publisher_name
        ); 
        $message=$publisher->update('publisher_id',$id,$param);
        if($message['status']){
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
                    window.location.href='./publisher.php'

                  },900)
                })
          },2000)
          </script>";
        }
        else{
          echo "<script>
          $(document).ready(function () {
            toastr.options = {
              closeButton: true,
              timeOut: 5000,
              positionClass: 'toast-top-right'
          };
          toastr.success('something is going wrong');
          setTimeout(function(){
            window.location.href='./publisher.php'
            
          },100)
          })
    
          </script>";
        }
      
      }
    
      // create record 
      else{
        $param= array(
            'publisher_name'=>$publisher_name
          );
        $message = $publisher->create($param);
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
                window.location.href='./publisher.php'
                
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
            window.location.href='./publisher.php'
            
              },100)
        })
  
        </script>";
        }
       
      }
    
    }
    // delete 
    if(isset($_REQUEST['delete_id'])){
      $id=$_REQUEST['delete_id'];
      // echo $id;
     $message= $publisher->delete('publisher_id',$id);
      if($message['status']){
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
                    window.location.href='./publisher.php'

                },900)
              })
        },2000)
        </script>";
      }
      else{
        echo "<script>
        $(document).ready(function () {
          toastr.options = {
            closeButton: true,
            timeOut: 5000,
            positionClass: 'toast-top-right'
          };
        toastr.success('something is going wrong" . $message['error'] . "');
        setTimeout(function(){
            window.location.href='./publisher.php'
          
        },100)
        })
  
        </script>";
      }
    }
    exit();
  }
//   $author = null;

  ?>
   <script>
    $('#publishers').removeClass('collapsed') 
  </script>
</body>

</html> 