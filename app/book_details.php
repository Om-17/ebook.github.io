<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php include_once('../config/css.config.php') ?>
    <title>eBooks</title>

</head>

<body>

    <?php include_once('../includes/header.php');
    if (isset($_GET['book_id'])) {
        $book_id = $_GET['book_id'];
        $bookObj = new MasterClass('books');
        $bookResut = $bookObj->get('book_id', $book_id);
        $authorObj = new MasterClass('authors');
        $author_get = $authorObj->get('author_id', $bookResut['author_id']);
        $publisherObj = new MasterClass('publishers');
        $genresbookObj = new MasterClass('book_genres');
        $genresbookResult = $genresbookObj->filter(['book_id' => $book_id]);
        $mybookobj = new MasterClass('mybooks');
        $exist= $mybookobj ->exists('book_id',$book_id);
        $publisher_get = $publisherObj->get('publisher_id', $bookResut['publisher_id']);
    } else {
        redirect('./app/home.php');
    }


    ?>
    <?php include_once('../loader.php') ?>
    <?php include_once('../config/js.config.php') ?>

    <main>
        <div class="container">
            <div class="heading-section">
                <h1>Book Details</h1>
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
                $genresObj = new MasterClass('genres');
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
                                <div class="wishdropdown">

                                    <button class="wishdropbtn" ><i id="mybookicon" class="fa fa-plus"></i></button>

                                    <div class="wishdropdown-content">
                                        <form  method="post" id="plan_to_read_form">
                                          <input type="number" name="book_id" value="' . $bookResut['book_id'] . '" hidden>
                                          <button class="btn" type="submit" name="plan_to_read">Plan To Read</button>
                                        </form>
                                        <form  method="post" id="on_hold_form">
                                          <input type="number" name="book_id" value="' . $bookResut['book_id'] . '" hidden>
                                          <button class="btn" type="submit" name="on_hold">On-Hold</button>
                                        </form>
                                        <form  method="post" id="dropped_form">
                                          <input type="number" name="book_id" value="' . $bookResut['book_id'] . '" hidden>
                                          <button class="btn" type="submit" name="dropped">Dropped</button>
                                        </form>
                                        <form  method="post" id="completed_form">
                                          <input type="number" name="book_id" value="' . $bookResut['book_id'] . '" hidden>
                                          <button class="btn" type="submit" name="completed">Completed</button>
                                        </form>
                                  </div>
                                </div>
                                <button class="m-0 read-book-btn login-btn">Read Book</button>
                                <button class="btn btn-outline-primary download-btn" onclick="downloadPDF()">Download</button>

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
                            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab"
                                data-bs-target="#book-review" type="button" role="tab" aria-controls="book-review"
                                aria-selected="false">Book Review</button>
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

        <script>
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



            ?>
            <script>
                $(document).ready(function () {
                    if (<?php echo $exist ? 'true' : 'false'; ?>) {
                        // Redirect to login page
                        $('#mybookicon').removeClass('fa-plus');
                        $('#mybookicon').addClass('fa-edit');
                    }
                    else{
                        $('#mybookicon').addClass('fa-plus');
                        $('#mybookicon').removeClass('fa-edit');
                    }

                });
                function submitForm(formId, status) {
                    const form = $("#" + formId);
                    const actionUrl = "../api/add_mybook.php"
                    const formData = form.serialize();
                    if (!<?php echo isset($_SESSION['user']) ? 'true' : 'false'; ?>) {
                        // Redirect to login page
                        window.location.href ='./login.php';
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

                        success: function (response) {
                            toastr.options = {
                                    closeButton: true,
                                    timeOut: 15000,
                                    positionClass: 'toast-bottom-right'
                                };
                            // Handle success response here
                            if (response.last_id) {
                               
                                toastr.success("<?php echo "".$bookResut['book_title']." Sucessfully Added"; ?>");
                                console.log(response.message);
                            }
                            else {
                                $('#mybookicon').addClass('fa-edit');
                                $('#mybookicon').removeClass('fa-plus');
                                toastr.success("<?php echo ''.$bookResut['book_title'].' Sucessfully Updated'; ?>");

                            }
                        },
                        error: function (xhr, status, error) {
                            // Handle error response here
                            console.error(error);
                        }
                    });
                    return false;
                }

                // Attach event listeners to the forms
                $("#plan_to_read_form").submit(function (e) {
                    e.preventDefault();
                    submitForm("plan_to_read_form", "Plan-To-Read");
                });

                $("#on_hold_form").submit(function (e) {
                    e.preventDefault();
                    submitForm("on_hold_form", "On-Hold");
                });

                $("#dropped_form").submit(function (e) {
                    e.preventDefault();
                    submitForm("dropped_form", "Dropped");
                });

                $("#completed_form").submit(function (e) {
                    e.preventDefault();
                    submitForm("completed_form", "Completed");
                });
            </script>
        </div>
    </main>

    <?php include_once('../includes/footer.php') ?>

</body>

</html>