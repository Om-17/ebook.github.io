<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php include_once('../config/css.config.php') ?>
    <title>Bookswise-Mybook</title>

</head>


<body class="mybook-bg">

    <?php include_once('../includes/header.php');
    check_user();


    ?>
    <?php include_once('../loader.php') ?>
    <?php include_once('../config/js.config.php') ?>


    <main>
        <div class="w-100  tab-header">

            <div class=" w-100">

                <h1 class="pt-4 pb-4 w-100 text-white text-center ">Hi, <span class="text-capitalize"><?php echo $_SESSION['user']['first_name'] . ' ' . $_SESSION['user']['last_name'] ?></span></h1>
                <div class="nav nav-tabs w-100  " id="nav-tab" role="tablist">
                    <button class="nav-link active" id="all_tab" data-bs-toggle="tab" data-bs-target="#all_tab_card" type="button" role="tab" aria-controls="all_tab_card" aria-selected="true"><i class="fa-solid fa-book"></i><span class="d-none d-md-block">&nbsp;&nbsp;All</span></button>
                    <button class="nav-link" id="plan_to_read_tab" data-bs-toggle="tab" data-bs-target="#plan_to_read_tab_card" type="button" role="tab" aria-controls="plan_to_read_tab_card" aria-selected="false"><i class="fa-solid fa-book-bookmark"></i><span class="d-none d-md-block">&nbsp;&nbsp;Plan to Read</span></button>
                    <button class="nav-link" id="on_hold_tab" data-bs-toggle="tab" data-bs-target="#on_hold_tab_card" type="button" role="tab" aria-controls="on_hold_tab_card" aria-selected="false"><i class="fa-solid fa-hourglass-half"></i><span class="d-none d-md-block">&nbsp;&nbsp;On-Hold</span></button>
                    <button class="nav-link" id="dropped_tab" data-bs-toggle="tab" data-bs-target="#dropped_tab_card" type="button" role="tab" aria-controls="dropped_tab_card" aria-selected="false"><i class="fa-solid fa-circle-xmark"></i><span class="d-none d-md-block">&nbsp;&nbsp;Dropped</span></button>
                    <button class="nav-link" id="completed_tab" data-bs-toggle="tab" data-bs-target="#completed_tab_card" type="button" role="tab" aria-controls="completed_tab_card" aria-selected="false"><i class="fa-sharp fa-solid fa-circle-check"></i><span class="d-none d-md-block">&nbsp;&nbsp;Completed</span></button>
                </div>
            </div>

        </div>

        <div class="mybook-container">

            <div class="tab-content p-3 " id="nav-tabContent">
                <div class="tab-pane fade active show" id="all_tab_card" role="tabpanel" aria-labelledby="plan_to_read_tab_card">
                    <div id="allbookContainer" class="row bookContainer ">


                    </div>
                </div>
                <div class="tab-pane fade  " id="plan_to_read_tab_card" role="tabpanel" aria-labelledby="plan_to_read_tab_card">
                    <!-- <p>plan to read</p> -->
                    <div id="planbookContainer" class="row bookContainer"></div>
                </div>
                <div class="tab-pane fade  " id="on_hold_tab_card" role="tabpanel" aria-labelledby="on_hold_tab_card">
                    <!-- <p>on hold</p> -->
                    <div id="onholdContainer" class="row bookContainer"></div>
                </div>
                <div class="tab-pane fade  " id="dropped_tab_card" role="tabpanel" aria-labelledby="dropped_tab_card">
                    <!-- <p>dropped</p> -->
                    <div id="droppedContainer" class="row bookContainer"></div>
                </div>
                <div class="tab-pane fade  " id="completed_tab_card" role="tabpanel" aria-labelledby="completed_tab_card">
                    <!-- <p>completed</p> -->
                    <div id="completeContainer" class="row bookContainer"></div>
                </div>

            </div>

        </div>
        </div>


    </main>

    <?php include_once('../includes/footer.php') ?>

    <script type="text/javascript">
        // default all book api 
        $(document).ready(function() {
            const actionUrl = "../api/get_mybook.php"

            $.ajax({
                url: actionUrl,
                headers: {
                    "Access-Control-Allow-Origin": "*",
                    "Content-Type": "application/json, charset=utf-8"
                },
                method: "POST",
                dataType: "json",
                data: JSON.stringify({
                    "status": 'All',
                }),

                success: function(response) {
                    const allbookContainer = document.getElementById('allbookContainer');
                    const planbookContainer = document.getElementById('planbookContainer');
                    const onholdContainer = document.getElementById('onholdContainer');
                    const droppedContainer = document.getElementById('droppedContainer');
                    const completeContainer = document.getElementById('completeContainer');

                    if (!response.message) {
                     
                            allbookContainer.innerHTML = returnCards(response,'All');

                       
                    } else {
                     
                            allbookContainer.innerHTML = notfound();

                    
                    }

                },
                error: function(xhr, status, error) {
                    // Handle error response here
                    console.error(error);
                }
            });

            return false;
     


        });
        // end default all book api




        var currentTab = "all_tab";
        // call the api and render book 
        function mybook(btnid, status) {
            const form = $("#" + btnid);
            const actionUrl = "../api/get_mybook.php"
            const formData = form.serialize();
            if (!<?php echo isset($_SESSION['user']) ? 'true' : 'false'; ?>) {
                // Redirect to login page
                window.location.href = './login.php';
            }

            $.ajax({
                url: actionUrl,
                headers: {
                    "Access-Control-Allow-Origin": "*",
                    "Content-Type": "application/json, charset=utf-8"
                },
                method: "POST",
                dataType: "json",
                data: JSON.stringify({
                    "status": status,
                }),

                success: function(response) {
                    const allbookContainer = document.getElementById('allbookContainer');
                    const planbookContainer = document.getElementById('planbookContainer');
                    const onholdContainer = document.getElementById('onholdContainer');
                    const droppedContainer = document.getElementById('droppedContainer');
                    const completeContainer = document.getElementById('completeContainer');

                    if (!response.message) {
                        if (status == "All") {
                            console.log(status);
                            allbookContainer.innerHTML = returnCards(response,status);

                        }
                        if (status == "On-Hold") {

                            onholdContainer.innerHTML = returnCards(response,status);

                        }
                        if (status == "Plan-To-Read") {
                            planbookContainer.innerHTML = returnCards(response,status);

                        }
                        if (status == "Dropped") {
                            droppedContainer.innerHTML = returnCards(response,status);

                        }
                        if (status == "Completed") {
                            completeContainer.innerHTML = returnCards(response,status);

                        }
                    } else {
                        if (status == "All") {
                            allbookContainer.innerHTML = notfound();

                        }
                        if (status == "On-Hold") {
                            onholdContainer.innerHTML = notfound();

                        }
                        if (status == "Plan-To-Read") {
                            planbookContainer.innerHTML = notfound();

                        }
                        if (status == "Dropped") {
                            droppedContainer.innerHTML = notfound();

                        }
                        if (status == "Completed") {
                            completeContainer.innerHTML = notfound();

                        }
                    }

                },
                error: function(xhr, status, error) {
                    // Handle error response here
                    

                    console.error(error);
                }
            });

            return false;
        }
        //end function

        // not found component function
        function notfound() {
            return ` <div class="w-100 not-found">
                            <div class="d-flex not-found-img justify-content-center">
                                  <img style="width:400px ;" src="../assets/img/not-found.svg" alt="">
                             </div>
                            <div class="not-found-heading">
                                  <h2>
                                    Not Found Book
                                  </h2>
                            </div>
                    </div>`;
        }   
        //end 
        // render bookcard
        function returnCards(valuesCards,status) {

            return valuesCards.map(value => `
          
 
            <div class="col-12 col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 col-xxl-3 col-xxxl-3 position-relative">
      
                        <div class="mybookdropdown ">
                                   
                            <i onclick="mybookdropdownFunction(${value.book_id},'${value.status}','${status}');"   class=" mybookdropbtn fa-solid fa-ellipsis-vertical"></i>
                                    
                                <div id="mybookDropdown${status}${value.book_id}" class="mybookdropdown-content">
                                    
                                     <button class="btn " type="button" id="plantoread${value.book_id}${status}" onclick="ChangeMyBook('Plan-To-Read',${value.book_id})" name="plan_to_read">Plan To Read</button>
                                      

                                         <button class="btn" type="button" id="on_hold${value.book_id}${status}" onclick="ChangeMyBook( 'On-Hold',${value.book_id})" name="on_hold">On-Hold</button>
                                        

                                         <button class="btn" type="button" id="dropped${value.book_id}${status}" onclick="ChangeMyBook( 'Dropped',${value.book_id})"   name="dropped">Dropped</button>
                                        
                                        
                                             <button class="btn"   type="button"  id="completed${value.book_id}${status}"  onclick="ChangeMyBook('Completed',${value.book_id})"  name="completed">Completed</button>
                                       
                                </div>
                            </div>
                    <a class="text-decoration-none card-container" href="./book_details.php?book_id=${value.book_id}">
                        <div class="book-card position-relative w-100">
                            <div class="badge bg-danger">
                                <span>${value.book_type}</span>
                            </div>
                           
                            <div class="book-card__cover">
                                <div class="book-card__book">
                                    <div class="book-card__book-front">
                                        <img class="book-card__img img-fluid" src="${value.book_image}" />
                                    </div>
                                    <div class="book-card__book-back"></div>
                                    <div class="book-card__book-side"></div>
                                </div>
                            </div>
                            <div>
                                <div class="book-card__title">
                                    <div class="row">
                                        <h3 class="col-12 text-capitalize text-center text-truncate">
                                            ${value.book_title}
                                        </h3>
                                    </div>
                                </div>
                                <div class="book-card__author text-capitalize text-center">
                                    ${value.author_name} <!-- Display the author name here -->
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
               
            `).join('');
        }

        // end bookcard
// change the book status
function ChangeMyBook(bookstatus, bookid) {



const actionUrl = "../api/add_mybook.php"



$.ajax({
    url: actionUrl,
    headers: {
        "Access-Control-Allow-Origin": "*",
        "Content-Type": "application/json, charset=utf-8"
    },
    method: "POST",
    dataType: "json",
    data: JSON.stringify({
        "book_id": bookid,
        "status": bookstatus,
    }),

    success: function(response) {
        toastr.options = {
            closeButton: true,
            timeOut: 1500,
            positionClass: 'toast-bottom-right'
        };

        if (response.last_id) {
            
            toastr.success("Sucessfully Added");
            // console.log(response.message);
        } else {
            // console.log("status ", bookstatus)
            // console.log("tabname ", currentTab)
           

            if (bookstatus == "On-Hold" || currentTab == "on_hold_tab") {

                mybook("on_hold_tab", "On-Hold");

            }

            if (bookstatus == "Plan-To-Read" || currentTab == "plan_to_read_tab") {
            
                mybook("plan_to_read_tab", "Plan-To-Read");

            }
            if (bookstatus == "All" || currentTab == "all_tab") {
                mybook("all_tab", "All");

            }
            if (bookstatus == "Dropped" || currentTab == "dropped_tab") {

                mybook("dropped_tab", "Dropped");

            }

            if (bookstatus == "Completed" || currentTab == "completed_tab") {

                mybook("completed_tab", "Completed");

            }

            toastr.success("Sucessfully Updated to " + bookstatus);

        }
    },
    error: function(xhr, status, error) {
        // Handle error response here
        console.error(error);
        toastr.error("Internal Server Error");

    }
});

}
// end change book status

        // tab click api call 
        $("#plan_to_read_tab").click(function(e) {
            e.preventDefault();
            currentTab = "plan_to_read_tab";
            mybook("plan_to_read_tab", "Plan-To-Read");
        });
        $("#all_tab").click(function(e) {
            e.preventDefault();
            currentTab = "all_tab";

            mybook("all_tab", "All");
        });

        $("#on_hold_tab").click(function(e) {
            e.preventDefault();
            currentTab = "on_hold_tab";

            mybook("on_hold_tab", "On-Hold");
        });

        $("#dropped_tab").click(function(e) {
            e.preventDefault();
            currentTab = "dropped_tab";

            mybook("dropped_tab", "Dropped");
        });

        $("#completed_tab").click(function(e) {
            e.preventDefault();
            currentTab = "completed_tab";

            mybook("completed_tab", "Completed");
        });
        //end
    </script>
  <?php include_once('../includes/footer.php'); ?>

</body>

</html>