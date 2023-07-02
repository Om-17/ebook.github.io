<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php include_once('../config/css.config.php') ?>
    <title>eBooks</title>

</head>

<body>

    <?php include_once('../includes/header.php') ;
    if(isset($_GET['book_id'])){
        $book_id = $_GET['book_id'];
        $bookObj=new MasterClass('books');
        $bookResut= $bookObj->get('book_id',$book_id);
        $authorObj=new MasterClass('authors');
        $author_get= $authorObj->get('author_id',$bookResut['author_id']);
        $publisherObj=new MasterClass('publishers');
        $genresbookObj=new MasterClass('book_genres');
        $genresbookResult=$genresbookObj->filter(['book_id'=>$book_id]);

        $publisher_get= $publisherObj->get('publisher_id',$bookResut['publisher_id']);
    }
    else{
        redirect('./app/home.php');
    }
    
    
    ?>
    <?php include_once('../loader.php') ?>

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
                        '.$bookResut['book_type'].'
                    </span>
                </div>
                <div class="row">
                    <div class="col-md-4 d-flex justify-content-center  align-items-center ">

                        <div class="book-card__cover">
                            <div class="book-card__book">
                                <div class="book-card__book-front">
                                    <img class="book-card__img" alt="'.$bookResut['book_title'].'" src="'.base_url.$bookResut['book_image'].'" />
                                </div>
                                <div class="book-card__book-back"></div>
                                <div class="book-card__book-side"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8   ">
                        <div class="product-dtl">
                            <div class="product-info  ">
                                <h2 class="product-name text-capitalize">'.$bookResut['book_title'].'<span class="fs-6 text-secondary">
                                        - '.$author_get['author_name'].'
                                    </span></h2>
                                <div class="row ">
                                    <div class="col p-0">
                                        <span class="book-info">Book Language:&nbsp; <span class="text-capitalize">'.$bookResut['book_language'].'</span></span>
                                    </div>
                                    <div class="col p-0">
                                        <span class="book-info">Book Total Pages:&nbsp; <span>'.$bookResut['total_pages'].'</span></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col p-0">
                                        <span class="book-info">Publisher Name:&nbsp;
                                            <span>'.$publisher_get['publisher_name'].'</span></span><br>
                                    </div>
                                    <div class="col p-0">

                                        <span class="book-info">Publish Year:&nbsp; <span>'.$bookResut['publish_year'].'</span></span><br>
                                    </div>
                                    </div>
                                    <div class="d-flex flex-wrap mb-3">
                                    <span class="book-info">Genres:&nbsp;</span>
                                    
                                    ';
                                    // print_r($genresbookResult);
                                foreach ($genresbookResult as $key => $value) {
                                    // echo( $value['genre_id']);
                                    $genresObj=new MasterClass('genres');
                                    $genre_result=$genresObj->get('genre_id',$value['genre_id']);

                                    echo '
                                    <span class="book-genres mt-1">'.$genre_result['genre_name'].'</span>
                                    
                                    ';
                                }
                                
                                // <span class="book-genres align-middle">Adventure</span>
                                
                                echo'
                               </div>

                                <!-- <div class="reviews-counter">
                                    <div class="rate">
                                        <input type="radio" id="star5" name="rate" value="5" checked />
                                        <label for="star5" title="text">5 stars</label>
                                        <input type="radio" id="star4" name="rate" value="4" checked />
                                        <label for="star4" title="text">4 stars</label>
                                        <input type="radio" id="star3" name="rate" value="3" checked />
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
                                   '.$bookResut['book_summary'].'

                                </p>
                            </div>

                            <div class="d-flex justify-content-end">


                                <button class="m-0 read-book-btn login-btn">Read Book</button>
                                <button class="btn btn-outline-primary download-btn">Download</button>

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
                                 '.$bookResut['book_summary'].'
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
            
            
            ;
            ?>

        </div>
    </main>
    <?php include_once('../config/js.config.php') ?>

    <?php include_once('../includes/footer.php') ?>

</body>

</html>