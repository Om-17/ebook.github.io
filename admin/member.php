<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>member - bookwise</title>
    <meta content="" name="description">
    <meta content="" name="keywords">


    <?php include_once('./config/css.config.php') ?>
</head>

<body>


    <?php
    include_once('./includes/header.php');


    $memberobj = new DBclass('member');
    $result = $memberobj->getAll();

    $request_method = $_SERVER["REQUEST_METHOD"];

    include_once('./includes/sidebar.php');
    include_once('../loader.php');
    ?>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Member</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="./index.php">Home</a></li>
                    <li class="breadcrumb-item active">Member</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section ">

            <div class="row  mt-3">
                <div class="col-12">
                    <div class="card recent-sales overflow-auto">

                        <div class="filter">


                            <div class="card-body pt-4">

                                <table class="table table-hover  datatable">
                                    <thead>
                                        <tr>

                                            <th scope="col">SR.NO.</th>
                                            <th scope="col">Payment ID</th>
                                            <th scope="col">User</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Month Duration</th>
                                            <th scope="col">Start Date</th>
                                            <th scope="col">Expiry Date</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>

                                        </tr>
                                    </thead>
                                    <tbody class="table-body">
                                        <?php
                                        foreach ($result as $key => $value) {
                                            $user_obj = new DBClass("users");
                                            $result_user = $user_obj->get('id', $value['user_id']);
                                            ?>
                                            <script>
                                            $(document).ready(() => {
                                                $("#status<?php echo $key;?>").val("<?php echo $value['status'];?>");
                                            });
                                            </script>
                                            <?php
                                            echo "
                     <tr>
                        
                        <td>" . $key + 1 . "</td>
                        <td>" . $value['payment_id'] . "</td>
                        <td>" . $result_user['first_name'] . " " . $result_user['last_name'] . "</td> 
                        <td>" . $value['price'] . "</td> 
                        <td>" . $value['month_duration'] .  " Month</td> 
                        <td>" . $value['start_date'] . "</td> 
                        <td>" . $value['expiry_date'] . "</td> 
                        <td>";
                        if($value['status']=="Active"){
                          echo "<span class='badge rounded-pill bg-success'>Active</span>";  
                        } 
                        else{
                          echo "<span class='badge rounded-pill bg-danger'>Expired</span>";  

                        }
                        echo "</td> 
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
                                           <form method="post" class="d-flex mb-0" action="./member.php">
                                           <input type="number" name="delete_id" value=' . $value["id"] . ' hidden>
                                           <input type="number" name="user_id" value=' . $value["user_id"] . ' hidden>
                                          
                                           <button type="submit" class="btn btn-danger">Delete</button>
                                     </form>
                                     </div>
                                   </div>
                           </div>
                       </div>';
                                      
                                            // update model  
                                            echo "
                            <div class=\"modal fade\" id=\"updatemodal{$key}\" tabindex=\"-1\" aria-labelledby=\"addgenresModal\" aria-hidden=\"true\">
                                <div class=\"modal-dialog modal-lg  modal-dialog-centered\">
                                    <div class=\"modal-content\">
                                        <div class=\"modal-header\">
                                            <h1 class=\"modal-title fs-5\">Update Member</h1>
                                            <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"modal\" aria-label=\"Close\"></button>
                                        </div>
                                        <form method=\"POST\" action=\"./member.php\" id=\"publisherform\" class=\"needs-validation\" novalidate>
                                            <div class=\"modal-body\">
                                           <input type=\"number\" name=\"user_id\" value=\"{$value['user_id']}\" hidden>
                                            
                                               <input type=\"number\" name=\"id\" value=\"{$value['id']}\" hidden >
                                             <div class=\"row\">
                                             
                                                <div class=\"col-12 col-lg-4 col-xl-4 col-md-6 \">
                                                <div class=\"form-floating mb-3\">
                                                    <input type=\"text\" class=\"form-control\" name=\"payment_id\" value=\"{$value['payment_id']}\"  id=\"payment_id\" placeholder=\"Payment ID\"  readonly>
                                                    <label for=\"payment_id\">Payment ID</label>
                                                </div>
                                                </div>
                                            
                                                <div class=\"col-12 col-lg-4 col-xl-4 col-md-6 \">
                                                <div class=\"form-floating mb-3\">
                                                    <input type=\"text\" class=\"form-control\" value=\"{$result_user['first_name']} {$result_user['last_name']}\"  id=\"user_name\" placeholder=\"User Name\"  readonly>
                                                    <label for=\"user_name\">User Name</label>
                                                </div>
                                                </div>
                                                <div class=\"col-12 col-lg-4 col-xl-4 col-md-6 \">
                                                <div class=\"form-floating mb-3\">
                                                    <input type=\"text\" class=\"form-control\" value=\"{$value['price']}\"  id=\"price\" placeholder=\"Price\"  readonly>
                                                    <label for=\"price\">Price</label>
                                                </div>
                                                </div>
                                                <div class=\"col-12 col-lg-4 col-xl-4 col-md-6 \">
                                                <div class=\"form-floating mb-3\">
                                                    <input type=\"text\" class=\"form-control\" value=\"{$value['month_duration']}\"  id=\"month\" placeholder=\"month\"  readonly>
                                                    <label for=\"month\">Month Duration</label>
                                                </div>
                                                </div>
                                                <div class=\"col-12 col-lg-4 col-xl-4 col-md-6 \">
                                                <div class=\"form-floating mb-3\">
                                                    <input type=\"date\" class=\"form-control\" value=\"{$value['start_date']}\"  id=\"start_date\" placeholder=\"Start date\" readonly >
                                                    <label for=\"start_date\">Start Date</label>
                                                </div>
                                                </div>
                                                <div class=\"col-12 col-lg-4 col-xl-4 col-md-6 \">
                                                <div class=\"form-floating mb-3\">
                                                    <input type=\"date\" class=\"form-control\" value=\"{$value['expiry_date']}\"  id=\"expiry_date\" placeholder=\"Expiry Date\" readonly  >
                                                    <label for=\"expiry_date\">Expiry Date</label>
                                                </div>
                                                </div>
                                                <div class=\"col-12 col-lg-4 col-xl-4 col-md-6 \">
                                                <select class=\" form-select\" name=\"status\"> id=\"status{$key}\">
                                                <option value=\"Active\">Active</option>
                                                <option value=\"Expired\">Expired</option>
                                                </select> 
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

        </section>

    </main><!-- End #main -->



    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <?php include_once('./config/js.config.php') ?>
    <script>
        $('#member').removeClass('collapsed')
    </script>
    <?php


    if ($request_method == 'POST') {
        $userobj=new DBClass('user');
       
            // update record 
            if (isset($_REQUEST['id'])) {

                $id = $_REQUEST['id'];
                $user_id=$_REQUEST['user_id'];

                $status= $_REQUEST['status'];
                $param = array(
                    'status' => $status
                );
                if( $status =="Active"){
            $res=$userobj->update($id,$user_id,["is_member"=>1]);

                }
                else{
            $res=$userobj->update($id,$user_id,["is_member"=>0]);

                }
                $message = $memberobj->update('id', $id, $param);

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
                    window.location.href='./member.php'

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
            window.location.href='./member.php'
            
          },100)
          })
    
          </script>";
                }
            }

     
        // delete 
        if (isset($_REQUEST['delete_id'])) {
            $id = $_REQUEST['delete_id'];
            $user_id=$_REQUEST['user_id'];
            // echo $id;
            $message = $memberobj->delete('id', $id);
            $res=$userobj->update($id,$user_id,["is_member"=>0]);
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
                    window.location.href='./member.php'

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
        toastr.success('something is going wrong" . $message['error'] . "');
        setTimeout(function(){
            window.location.href='./member.php'
          
        },100)
        })
  
        </script>";
            }
        }
        exit();
    }
    //   $author = null;

    ?>
    
</body>

</html>

<?php
$allpublisher = null;
$publisher = null;

?>