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
    if (isset($_REQUEST['genre'])) {

        $encrypted_genre_id = $_REQUEST['genre'];
        $genre_id = array();
        
        foreach ($encrypted_genre_id as $key => $value) {
            $genre_id[] = base64_decode($value);
        }
        $genresbookObj = new MasterClass('book_genres');
        $genresbookResult = array();
        foreach ($genre_id as $key => $value) {

            $genresbookResult[] = $genresbookObj->filter(['genre_id' => $value]);
        }
        $genresbookResult = array_filter($genresbookResult, function ($result) {
            return !isset($result['message']) || $result['message'] !== 'Record not found';
        });

        // book unique filter
        $uniqueBookIds = array();
        $uniqueGenres = array();
        $book_result = array();
        if (!empty($genresbookResult)) {
            $book_obj = new MasterClass('books');
            foreach ($genresbookResult as $key => $value) {

           
                $book_id = $value[0]['book_id'];
                if (!in_array($book_id, $uniqueBookIds)) {
                    $uniqueBookIds[] = $book_id;
                    $uniqueGenres[] = $value;
                    if(isset($_REQUEST['language'])){
                        $book_language=$_REQUEST['language'];
                        if($_REQUEST['language'] =='all'){

                            $book_result[] = $book_obj->get('book_id', $book_id);
                        }
                        elseif($_REQUEST['language'] =='hindi'){
                            $book_result[] = $book_obj->filter(['book_id'=>$book_id,'book_language'=>$book_language]);

                        }
                        else{
                         
                            $book_result[] = $book_obj->filter(['book_id'=>$book_id,'book_language'=>$book_language]);

                        }

                    }
                    else{

                        $book_result[] = $book_obj->get('book_id', $book_id);
                        
                    }
                }
            }
        }
               // end
        // print_r($book_result);
        // all genres    
      
    } else {
        $book_obj = new MasterClass('books');
        if(isset($_REQUEST['language'])){
            $book_language=$_REQUEST['language'];
            if(isset($_REQUEST['language'])){
                if($_REQUEST['language']=='all'){

                    $book_result = $book_obj->getAll();
                }
                else{
                 
                    $book_result = $book_obj->filter(['book_language'=>$book_language]);
                    if(isset($book_result['message'])){
                        $book_result=[];
                    }
                }

            }
           

        }
        else{

            $book_result=$book_obj->getAll();
        }
        // redirect('./app/home.php');
    }

    $genres_obj = new MasterClass('genres');
    $allgenres = $genres_obj->getAll();

    ?>
    <?php include_once('../loader.php') ?>

    <main>
        <div class="container-genre">
            <div class="row w-100 mt-4">
                <div class="col-3 bg-light rounded">
                    <form action="./genres.php" method="GET" class="w-100 filter">
                        <div class="language-filter mb-4">
                            <h5 class="form-label">
                                Language:
                            </h5>
                            <div>
                                <select name="language" class="form-select">
                                    <option selected value="all">Any</option>
                                    <option value="english">English</option>
                                    <option value="hindi">Hindi</option>
                                    <option value="gujarati">Gujarati</option>

                                </select>
                            </div>
                        </div>
                        <div class="genres-filter">

                            <h5 class="form-label">
                                Genres:
                            </h5>
                            <?php
                            foreach ($allgenres as $key => $value) {
                                $encrypted_genre_id = base64_encode($value['genre_id']);

                                echo '
                              
                              <div class="form-check">
                                  <input class="form-check-input carsor-pointer" type="checkbox" name="genre[]" value="' . $encrypted_genre_id . '" id="genres_search' . $key . '">
                                  <label class="form-check-label carsor-pointer" for="genres_search' . $key . '">
                                     ' . $value['genre_name'] . '
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

                    if (!empty($genre_id)) {
                        foreach ($genre_id as $key => $value) {
                            $genres_result= $genres_obj->get('genre_id',$value);
                          
                            $genre_name[]=$genres_result['genre_name'];
                        }
                        $genre_name_string = implode(', ', $genre_name);
                        echo '
                            <div class="heading-section">
                            <h1>' .$genre_name_string. '</h1>
                        </div>
                            ';

                    } else {
                        echo '
                            <div class="heading-section pt-0 mt-0">
                                <h1>Book Genres</h1>
                            </div>
                            
                            ';
                    }
                    if (empty($book_result)) {
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
                            foreach ($book_result as $key => $value) {
                                
                                $authorobj=new  MasterClass('authors');
                                $authorname=$authorobj->get("author_id",$value['author_id']);
                                echo '
                                <div class="col-4">
                                    <a class="text-decoration-none" href="./book_details.php?book_id='.$value['book_id'].'">
                                    <div class="book-card position-relative w-100">
                                        <div class=" badge position-absolute  bg-danger">
                                        <span>'.$value['book_type'].'</span>
                                        </div>
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
    <?php include_once('../config/js.config.php') ?>

    <?php include_once('../includes/footer.php') ?>

</body>

</html>