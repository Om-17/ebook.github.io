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
    $book_obj = new DBclass('books');

    $book_result = $book_obj->getAll();

    ?>
    <?php include_once('../loader.php') ?>

    <main>
        <div class="container-genre">
            <div class="heading-section p-0 mt-3">
                <h1>Books</h1>
            </div>
            <div class="container">
                <div class="row ">
                    <?php
                    foreach ($book_result as $key => $value) {

                        $authorobj = new  DBclass('authors');
                        $authorname = $authorobj->get("author_id", $value['author_id']);
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
                                            ' . $authorname['author_name'] . '
                                            </div>
                                        </div>

                                    </div>
                                    </a>
                                    
                                </div>
                          
                                
                                ';
                    }

                    ?>

                </div>

            </div>
        </div>
    </main>
  <?php include_once('../includes/footer.php'); ?>

</body>

</html>