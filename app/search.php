<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php include_once('../config/css.config.php') ?>
    <?php include_once('../config/js.config.php') ?>
    <title>eBooks</title>
    <style>


    </style>
</head>

<body>


    <?php include_once('../config/js.config.php') ?>
    <?php include_once('../includes/header.php');
    include_once('../config.php');
    include_once('../classes/DBclass.php');
    if (isset($_GET["search"])) {
        $search = $_GET["search"];
        $sql = 'SELECT b.book_title AS book_title, b.book_type  ,b.book_image, b.book_id, bg.genre_id AS genre_id, a.author_name AS author_name FROM books b LEFT JOIN book_genres bg ON b.book_id = bg.book_id LEFT JOIN authors a ON b.author_id = a.author_id WHERE LOWER(b.book_title) LIKE LOWER("%' . $search . '%") OR LOWER(a.author_name) LIKE LOWER("%' . $search . '%");
';
        // echo $sql;
        $seachobj = new DBClass("books");
        $result = $seachobj->query($sql);
        $uniqueBooks = array();
        foreach ($result as $book) {
            if (!isset($uniqueBooks[$book['book_id']])) {
               
                $uniqueBooks[$book['book_id']] = $book;
            }
        }
        
        $uniqueResult = array_values($uniqueBooks);
      
    } else {
        redirect("/app/home.php");
    }
    ?>
    <main>
        <div class="container-genre">
            <div class="heading-section p-0 mt-3">
                <h1>Search for <?php echo $search; ?></h1>
            </div>
            <div class="container">
                <div class="row ">
                    <?php
                    foreach ($uniqueResult as $key => $value) {

                        echo '
                                <div class="col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-3 col-xxl-3 col-xxxl-3">
                                    <a class="text-decoration-none" href="./book_details.php?book_id=' . $value['book_id'] . '">
                                    <div class="book-card position-relative w-100">
                                        <div class=" badge position-absolute  bg-danger">
                                        <span>' . $value['book_type'] . '</span>
                                        </div>
                                        <div class="book-card__cover">
                                            <div class="book-card__book">
                                                <div class="book-card__book-front">
                                                    <img class="book-card__img img-fluid" src="' . base_url . $value["book_image"] . '" />
                                                </div>
                                                <div class="book-card__book-back"></div>
                                                <div class="book-card__book-side"></div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="book-card__title">
                                                <div class="row">
                                                    <h3 class="col-12 text-capitalize text-center text-truncate">
                                                    ' . $value['book_title'] . '
                                                    </h3>
                                                </div>

                                            </div>
                                            <div class="book-card__author text-capitalize text-center">
                                            ' . $value['author_name'] . '
                                            </div>
                                        </div>

                                    </div>
                                    </a>
                                    
                                </div>
                          
                                
                                ';
                    }

                    if (empty($result)) {
                        echo '
                              <div class="w-100 not-found">
                                <div class="d-flex not-found-img justify-content-center">
                                  <img style="width:400px ;" src="../assets/img/not-found.svg" alt="">
                                </div>
                                <div class="not-found-heading">
                                  <h2>
                                    Not Found Book
                                  </h2>
                                </div>
                              </div>
                            ';
                    }
                    ?>

                </div>

            </div>
        </div>
    </main>

</body>

</html>