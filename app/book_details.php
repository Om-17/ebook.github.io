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

    <?php include_once('../includes/header.php');

    if (isset($_GET['book_id'])) {
        $book_id = $_GET['book_id'];
        $bookObj = new DBclass('books');
        $bookResut = $bookObj->get('book_id', $book_id);
        $authorObj = new DBclass('authors');
        $author_get = $authorObj->get('author_id', $bookResut['author_id']);
        $publisherObj = new DBclass('publishers');
        $genresbookObj = new DBclass('book_genres');
        $genresbookResult = $genresbookObj->filter(['book_id' => $book_id]);
        $mybookobj = new DBclass('mybooks');
        $exist = false;
        $mybookid = NAN;
        $member = 0;
        $publisher_get = $publisherObj->get('publisher_id', $bookResut['publisher_id']);
        if (isset($_SESSION['user'])) {
            $member = $_SESSION['user']['is_member'];
            $exist = $mybookobj->aexists(['book_id' => $book_id, 'user_id' => $_SESSION['user']['id']]);
            if ($exist) {
                $mybookresult1 = $mybookobj->filter(['book_id' => $book_id, 'user_id' => $_SESSION['user']['id']]);
                $mybookid = $mybookresult1[0]['mybook_id'];
            }

            $mybookresult = $mybookobj->filter(['book_id' => $book_id, 'user_id' => $_SESSION['user']['id']]);

            if (!isset($mybookresult['message'])) {
                // print_r($mybookresult);

                $bookstatus = $mybookresult[0]['status'];
                echo '<script type="text/javascript">
                $(document).ready(function () {

                    var status = "' . $bookstatus . '"

                    if(status =="On-Hold"){
                    $("#on_hold").addClass("btn-active");
                    $("#plan_to_read").removeClass("btn-active");
                    $("#dropped").removeClass("btn-active");
                    $("#completed").removeClass("btn-active");
                    }
                   
                    else if(status =="Dropped"){
                    $("#on_hold").removeClass("btn-active");
                    $("#plan_to_read").removeClass("btn-active");
                    $("#dropped").addClass("btn-active");
                    $("#completed").removeClass("btn-active");
                    }
                    else if(status =="Completed"){
                    $("#on_hold").removeClass("btn-active");
                    $("#plan_to_read").removeClass("btn-active");
                    $("#dropped").removeClass("btn-active");
                    $("#completed").addClass("btn-active");
                    }
                    else if(status =="Plan-To-Read"){
                    $("#on_hold").removeClass("btn-active");
                    $("#plan_to_read").addClass("btn-active");
                    $("#dropped").removeClass("btn-active");
                    $("#completed").removeClass("btn-active");
                    }
                   
                });
                
                </script>';
            } else {
                $bookstatus = "";
            }
        }
    } else {
        redirect('/app/home.php');
    }


    ?>
    <?php include_once('../loader.php') ?>

    <script type="text/javascript">
        function backlink() {
            if (history.length === 1) {
                window.location = '<?php echo base_url; ?>'
            } else {
                history.back();
            }

        }
 


        $(document).ready(function() {
            if (!<?php echo isset($_SESSION['user']) ? 'true' : 'false'; ?>) {
                // Redirect to login page
                window.location.href = './login.php';
            }

            var flipbook = $("#read").flipBook({
                //Layout Setting

                pdfUrl: '<?php echo  base_url . $bookResut['book_pdf'] ?>',
                lightBox: true,
                layout: 3,
                currentPage: {
                    vAlign: "bottom",
                    hAlign: "left"
                },
                // startPage:4,
                assets: {
                    preloader: "assets.img/preloader.jpg",
                    overlay: "../assets/img/overlay.png",
                    flipMp3: "../assets/mp3/turnPage.mp3",
                    spinner: "../assets/img/spinner.gif",
                },
                // loadAllPages:true,
                // BTN SETTING
                btnBookmark: {
                    enabled: <?php echo $member; ?>,

                },
                btnPrint: {
                    enabled: <?php echo $member; ?>,
                    hideOnMobile: true
                },
                btnSearch: {
                    enabled: true,
                    title: "Search",
                    icon: "fas fa-search",
                    icon2: "search",
                },
                btnDownloadPages: {
                    enabled: <?php echo $member; ?>,
                    title: "<?php echo $bookResut['book_title'] ?> Download",
                    icon: "fa-download",


                },
                btnDownloadPdf: {
                    enabled: <?php echo $member; ?>,

                },
                btnColor: '#1877F2',
                sideBtnColor: '#1877F2',
                sideBtnSize: 60,
                sideBtnBackground: "rgba(0,0,0,.7)",
                sideBtnRadius: 60,
                btnSound: {
                    vAlign: "top",
                    hAlign: "left"
                },
                btnAutoplay: {
                    vAlign: "top",
                    hAlign: "left"
                },
                // SHARING
                btnShare: {
                    enabled: false,
                    title: "Share",
                    icon: "fa-share-alt"
                },

            });
        });
    </script>
    <main>
        <div class="container">
            <div class="heading-section d-flex justify-content-between align-items-center">

                <a href="javascript:void(0)" class="d-flex justify-content-between align-items-center text-decoration-none " onclick="backlink();">
                    <i class="fa-solid fa-arrow-left " style="font-size: 30px;"></i>
                    <!-- <i class="fa-solid fa-arrow-left fa-beat" style="color: #012f7e;"></i> -->
                    <!-- <i class="bi bi-arrow-left"></i> -->
                </a>

                <h1>Book Details</h1>
                <span></span>
            </div>
            <?php
            // print_r($bookResut);
            echo '
            <div class="card  book-detail-card">
            <div class="card-body">
                <div class="badge">
                    <span>
                        ' . $bookResut['book_type'] . '
                    </span>
                </div>
                <div class="row">
                    <div class="col-md-4 d-flex justify-content-center  align-items-center ">

                        <div class="book-card__cover">
                            <div class="book-card__book">
                                <div class="book-card__book-front">
                                    <img class="book-card__img" alt="' . $bookResut['book_title'] . '" src="' . base_url . $bookResut['book_image'] . '" />
                                </div>
                                <div class="book-card__book-back"></div>
                                <div class="book-card__book-side"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8   ">
                        <div class="product-dtl">
                            <div class="product-info  ">
                                <h2 class="product-name text-capitalize">' . $bookResut['book_title'] . '<span class="fs-6 text-secondary">
                                        - ' . $author_get['author_name'] . '
                                    </span></h2>
                                <div class="row ">
                                    <div class="col p-0">
                                        <span class="book-info">Book Language:&nbsp; <span class="text-capitalize">' . $bookResut['book_language'] . '</span></span>
                                    </div>
                                    <div class="col p-0">
                                        <span class="book-info">Book Total Pages:&nbsp; <span>' . $bookResut['total_pages'] . '</span></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col p-0">
                                        <span class="book-info">Publisher Name:&nbsp;
                                            <span>' . $publisher_get['publisher_name'] . '</span></span><br>
                                    </div>
                                    <div class="col p-0">

                                        <span class="book-info">Publish Year:&nbsp; <span>' . $bookResut['publish_year'] . '</span></span><br>
                                    </div>
                                    </div>
                                    <div class="d-flex flex-wrap mb-3">
                                    <span class="book-info">Genres:&nbsp;</span>
                                    
                                    ';
            // print_r($genresbookResult);
            foreach ($genresbookResult as $key => $value) {
                // echo( $value['genre_id']);
                $genresObj = new DBclass('genres');
                $genre_result = $genresObj->get('genre_id', $value['genre_id']);
                $encrypted_genre_id = base64_encode($value['genre_id']);

                echo '
                                    <a class="book-genres mt-1 text-decoration-none" href="./genres.php?genre[]=' . $encrypted_genre_id . '">' . $genre_result['genre_name'] . '</a>
                                    
                                    ';
            }


            echo '
                               </div>

                                <!-- <div class="reviews-counter">
                                    <div class="rate">
                                        <input type="radio" id="star5" name="rate" value="5"  />
                                        <label for="star5" title="text">5 stars</label>
                                        <input type="radio" id="star4" name="rate" value="4"  />
                                        <label for="star4" title="text">4 stars</label>
                                        <input type="radio" id="star3" name="rate" value="3"  />
                                        <label for="star3" title="text">3 stars</label>
                                        <input type="radio" id="star2" name="rate" value="2" />
                                        <label for="star2" title="text">2 stars</label>
                                        <input type="radio" id="star1" name="rate" value="1" />
                                        <label for="star1" title="text">1 star</label>
                                    </div>
                                    <span>3 Reviews</span>
                                </div> -->

                            </div>
                            <div class="d-flex align-items-center ">

                                <p class="book-description">
                                   ' . $bookResut['book_summary'] . '

                                </p>
                            </div>

                            <div class="d-flex position-relative justify-content-end">
                             
                                ';

            if ($bookResut['book_type'] != "Premiere") {

                echo '
                <div class="wishdropdown">

                <button class="wishdropbtn" ><i id="mybookicon" class="fa fa-plus"></i></button>

                <div class="wishdropdown-content">
                   
                <button class="btn " type="button" id="plan_to_read" name="plan_to_read">Plan To Read</button>
                         
                <button class="btn" type="button" id="on_hold" name="on_hold">On-Hold</button>
              
               <button class="btn" type="button" id="dropped" name="dropped">Dropped</button>
             
               
               <button class="btn" type="button" id="completed" name="completed">Completed</button>
               
                <button class="btn btn-remove " type="button" id="remove" name="remove">Remove</button>
                 

                  
              </div>
            </div>
                <button id="read"  class="m-0 read-book-btn login-btn">Read Book</>
                
                ';
            } else {
                if (isset($_SESSION['user'])) {
                    if ($_SESSION['user']['is_member']) {
                        echo '
                        <div class="wishdropdown">

                        <button class="wishdropbtn" ><i id="mybookicon" class="fa fa-plus"></i></button>

                        <div class="wishdropdown-content">
                          
                              <button class="btn " type="button" id="plan_to_read" name="plan_to_read">Plan To Read</button>
                         
                             <button class="btn" type="button" id="on_hold" name="on_hold">On-Hold</button>
                           
                            <button class="btn" type="button" id="dropped" name="dropped">Dropped</button>
                          
                            
                            <button class="btn" type="button" id="completed" name="completed">Completed</button>
                            
                                 <button class="btn btn-remove " type="button" id="remove" name="remove">Remove</button>
                              
                          
                      </div>
                    </div>
                        <button id="read"  class="m-0 read-book-btn login-btn">Read Book</button>';
                    } else {
                        echo '
                                        <a  href="./membership.php" class="btn btn-warning">Subscribe</a>
                                        ';
                    }
                } else {
                    echo '
                                        <a  href="./membership.php" class="btn btn-warning">Subscribe</a>
                                        ';
                }
            }

            if (isset($_SESSION['user'])) {
                if ($_SESSION['user']['is_member']) {
                    echo '
                                <button class="btn btn-outline-primary download-btn" onclick="downloadPDF()">Download</button>
                                  ';
                }
            }

            echo '
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container mt-3">
                    <nav>
                        <div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab"
                                data-bs-target="#book-description" type="button" role="tab" aria-controls="book-description"
                                aria-selected="true">Book Storyline</button>
                         
                            <!-- <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Contact</button> -->
                        </div>
                    </nav>
                    <div class="tab-content p-3 border bg-light" id="nav-tabContent">
                        <div class="tab-pane fade active show" id="book-description" role="tabpanel"
                            aria-labelledby="nav-home-tab">
                            <p class="">
                                 ' . $bookResut['book_summary'] . '
                                </p>
                        </div>
                        <div class="tab-pane fade active show" id="book-review" role="tabpanel"
                            aria-labelledby="nav-home-tab">
                        </div>

                    </div>

                </div>
            </div>
        </div>

        ';

            if (isset($_SESSION['user'])) {
                if ($_SESSION['user']['is_member']) {
                    echo '
                    <script type="text/javascript">
        function downloadPDF() {
            // Create a new invisible link element
          const link = document.createElement("a")
          link.style.display = "none"
          
          // Set the URL of the PDF file you want to download
          link.href = "' . base_url . $bookResut['book_pdf'] . '"
          link.download = "' . $bookResut['book_title'] . '.pdf"
  
        
          // Append the link to the document body
          document.body.appendChild(link)
          
          // Trigger the click event on the link element
          link.click()
          
          // Clean up by removing the link element
          document.body.removeChild(link)
        }
        // mybook ajax 
       
        </script>
            
            ';
                }
            }


            ?>
            <script>
                $(document).ready(function() {

                    if (<?php echo $exist ? 'true' : 'false'; ?>) {

                        $('#mybookicon').removeClass('fa-plus');
                        $("#remove").addClass("d-block")
                        $("#remove").removeClass("d-none")
                        $('#mybookicon').addClass('fa-edit');
                    } else {
                        $('#mybookicon').addClass('fa-plus');
                        $('#mybookicon').removeClass('fa-edit');
                    }

                });

                function submitForm(status) {

                    const actionUrl = "../api/add_mybook.php"

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
                            "book_id": <?php echo "" . $bookResut["book_id"] . ""; ?>,
                            "status": status,
                        }),

                        success: function(response) {
                            toastr.options = {
                                closeButton: true,
                                timeOut: 1500,
                                positionClass: 'toast-bottom-right'
                            };
                            $('#mybookicon').removeClass('fa-plus');
                            $('#mybookicon').addClass('fa-edit');
                            // console.log("exculated");
                            if (response.last_id) {
                                $("#remove").addClass("d-block")
                                $("#remove").removeClass("d-none")
                                toastr.success("<?php echo "" . $bookResut['book_title'] . " Sucessfully Added"; ?>");
                                // console.log(response.message);
                            } else {
                                $("#remove").addClass("d-block")
                                $("#remove").removeClass("d-none")
                                toastr.success("<?php echo '' . $bookResut['book_title'] . ' Sucessfully Updated'; ?>");

                            }
                        },
                        error: function(xhr, status, error) {
                            toastr.options = {
                                closeButton: true,
                                timeOut: 1500,
                                positionClass: 'toast-bottom-right'
                            };
                            toastr.error("something went wrong please try again");

                        }
                    });
                    return false;
                }

                $("#plan_to_read").click(function(e) {
                    e.preventDefault();
                    $("#on_hold").removeClass("btn-active");
                    $("#plan_to_read").addClass("btn-active");
                    $("#dropped").removeClass("btn-active");
                    $("#completed").removeClass("btn-active");
                    submitForm("Plan-To-Read");

                });

                $("#on_hold").click(function(e) {
                    e.preventDefault();
                    $("#on_hold").addClass("btn-active");
                    $("#plan_to_read").removeClass("btn-active");
                    $("#dropped").removeClass("btn-active");
                    $("#completed").removeClass("btn-active");
                    submitForm("On-Hold");
                });

                $("#dropped").click(function(e) {
                    e.preventDefault();
                    $("#on_hold").removeClass("btn-active");
                    $("#plan_to_read").removeClass("btn-active");
                    $("#dropped").addClass("btn-active");
                    $("#completed").removeClass("btn-active");
                    submitForm("Dropped");
                });

                $("#completed").click(function(e) {
                    e.preventDefault();
                    $("#on_hold").removeClass("btn-active");
                    $("#plan_to_read").removeClass("btn-active");
                    $("#dropped").removeClass("btn-active");
                    $("#completed").addClass("btn-active");
                    submitForm("Completed");
                });

                function remove_mybook() {

                    const actionUrl = "../api/remove_mybook.php"

                    $.ajax({
                        url: actionUrl,
                        headers: {
                            "Access-Control-Allow-Origin": "*",
                            "Content-Type": "application/json, charset=utf-8"
                        },
                        method: "POST",
                        dataType: "json",
                        data: JSON.stringify({
                            "book_id": <?php echo "" . $bookResut["book_id"] . ""; ?>,

                        }),

                        success: function(response) {
                            toastr.options = {
                                closeButton: true,
                                timeOut: 1500,
                                positionClass: 'toast-bottom-right'
                            };

                            if (response.status) {
                                $('#mybookicon').addClass('fa-plus');
                                $('#mybookicon').removeClass('fa-edit');
                                $("#remove").addClass("d-none")
                                $("#remove").removeClass("d-block")
                                $("#on_hold").removeClass("btn-active");
                                $("#plan_to_read").removeClass("btn-active");
                                $("#dropped").removeClass("btn-active");
                                $("#completed").removeClass("btn-active");
                                toastr.success("<?php echo "" . $bookResut['book_title'] . " Sucessfully Removed"; ?>")
                            }
                        },
                        error: function(xhr, status, error) {
                            toastr.error("something went wrong please try again")

                        }

                    });

                }
                $("#remove").click(function(e) {
                    e.preventDefault();

                    remove_mybook();
                });
            </script>
        </div>
    </main>

    <?php include_once('../includes/footer.php');
    $authorObj = null;
    $bookObj = null;
    $genresbookObj = null;
    $genresObj = null;
    $mybookobj = null;
    $publisherObj = null;


    ?>
  <?php include_once('../includes/footer.php'); ?>

</body>

</html>