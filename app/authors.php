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
    if (isset($_GET['authors'])) {

        $encrypted_author_id = $_GET['authors'];
        $author_id = array();
        
        foreach ($encrypted_author_id as $key => $value) {
            $author_id[] = base64_decode($value);
        }
        $authorsbookObj = new DBclass('books'); 
      
        foreach ($author_id as $key => $value) {
            
            $authorsbookResult[]= $authorsbookObj->filter(['author_id' => $value]);
        }
        $authorsbookResult = array_filter($authorsbookResult, function ($result) {
            return !isset($result['message']) || $result['message'] !== 'Record not found';
        });
        $authorsbookResult = array_merge_recursive(...$authorsbookResult); 

      
      
    } else {
        $book_obj = new DBclass('books');
        $authorsbookResult=$book_obj->getAll();
        
    }

    $author_obj = new DBclass('authors');
    $allauthor = $author_obj->getAll();

    ?>
    <?php include_once('../loader.php') ?>
    <?php include_once('../config/js.config.php') ?>
    <!-- <pre>
       <?php
       
    //    print_r($authorsbookResult); ?>
       </pre> -->
    <main>
        <div class="container-genre">
            <div class="row w-100 mt-4">
                <div class="col-3 bg-light rounded">
                    <form action="./authors.php" method="GET" class="w-100 filter">
                        <div class="genres-filter">

                            <h5 class="form-label">
                                Authors:
                            </h5>
                            <?php
                            foreach ($allauthor as $key => $value) {
                                $encrypted_author_id = base64_encode($value['author_id']);

                                echo '
                              
                              <div class="form-check">
                                  <input class="form-check-input carsor-pointer" type="checkbox" name="authors[]" value="' . $encrypted_author_id . '" id="authors_search' . $value['author_id'] . '">
                                  <label class="form-check-label carsor-pointer" for="authors_search'. $value['author_id'] . '">
                                     ' . $value['author_name'] . '
                                  </label>
                              </div>
                              
                              ';
                            }
                            ?>


                        </div>
                        <div class="w-100 mt-4">
                            <button type="submit" class="btn w-100 btn-primary">
                                Apply
                            </button>
                        </div>


                    </form>
                </div>
                <div class="col-9">
                    <?php
                    if (!empty($author_id)) {
                        foreach ($author_id as $key => $value) {
                           echo '<script>
                            $("#authors_search'. $value .'").prop("checked", true);
                           </script>';
                                $authors_result= $author_obj->get('author_id',$value);
                              
                                $author_name[]=$authors_result['author_name'];
                    
                        }
                        $author_name_string = implode(', ', $author_name);
                        echo '
                            <div class="heading-section">
                            <h1>' .$author_name_string. '</h1>
                        </div>
                            ';

                    } else {
                        echo '
                            <div class="heading-section pt-0 mt-0">
                                <h1>Books Authors</h1>
                            </div>
                            
                            ';
                    }
                    if (empty($authorsbookResult)) {
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
                    <div class="container-fluid pt-4">
                        
                        <div class="row">
                            <?php
                            foreach ($authorsbookResult as $key => $value) {
                             

                                $authorobj = new  DBclass('authors');
                                $authorname=$authorobj->get("author_id",$value['author_id']);
                                echo '
                                <div class="col-4">
                                    <a class="text-decoration-none" href="./book_details.php?book_id='.$value['book_id'].'">
                                    <div class="book-card mb-4 w-100">
                                        <div class="book-card__cover">
                                            <div class="book-card__book">
                                                <div class="book-card__book-front">
                                                    <img class="book-card__img" src="'.base_url.$value["book_image"].'" />
                                                </div>
                                                <div class="book-card__book-back"></div>
                                                <div class="book-card__book-side"></div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="book-card__title">
                                                <div class="row">
                                                    <h3 class="col-12 text-capitalize text-center text-truncate">
                                                    '.$value['book_title'].'
                                                    </h3>
                                                </div>

                                            </div>
                                            <div class="book-card__author text-capitalize text-center">
                                            '.$authorname['author_name'].'
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
            </div>
        </div>
        <?php

        //   print_r($genresbookResult);
        ?>

        </div>
    </main>

    <?php include_once('../includes/footer.php');
    
    $authorsbookObj =null;
    $book_obj=null;
    $authorobj=null;
    $author_obj=null;
    ?>

</body>

</html>