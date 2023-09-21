<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Book - bookwise</title>
    <meta content="" name="description">
    <meta content="" name="keywords">


    <?php include_once('./config/css.config.php') ?>
    <?php
    include_once('./includes/header.php');



    $authorObj = new DBclass('authors');
    $author_result = $authorObj->getAll();
    $genres = new DBclass('genres');
    $genres_result = $genres->getAll();
    $publishers = new DBclass('publishers');
    $publishers_result = $publishers->getAll();
    $books = new DBclass('books');
    $book_result = $books->getAll();
    $request_method = $_SERVER["REQUEST_METHOD"];


    ?>
</head>

<body>

    <?php include_once('./config/js.config.php') ?>

    <?php

    include_once('./includes/sidebar.php');
    include_once('../loader.php');
    ?>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Books</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="./index.php">Home</a></li>
                    <li class="breadcrumb-item active">Books</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section ">

            <button class="btn  rounded-circle add-btn" data-bs-toggle="modal" title="Add Book" data-bs-target="#addmodal"><i class="bi bi-plus  fs-3"></i></button>
            <div class="row  mt-3">
                <div class="col-12">
                    <div class="card recent-sales overflow-auto">

                        <div class="filter">


                            <div class="card-body pt-4">
                                <!-- <h5 class="card-title">Genres </h5> -->

                                <table class="table table-hover  datatable">
                                    <thead>
                                        <tr>

                                            <th scope="col">SR.NO.</th>
                                            <th scope="col">Book Name</th>
                                            <th scope="col">Author Name</th>
                                            <th scope="col">Book Language</th>
                                            <th scope="col">Book Type</th>
                                            <th scope="col">Book Rating</th>
                                            <th scope="col">Action</th>

                                        </tr>
                                    </thead>
                                    <tbody class="table-body">
                                        <?php
                                        foreach ($book_result as $key => $value) {
                                            $get_author = $authorObj->get('author_id', $value['author_id']);
                                            $get_publisher = $publishers->get('publisher_id', $value['publisher_id']);
                                            echo "
                                           
                                            <tr>
                                                <td>" . ($key + 1) . "</td>
                                                <td ><p class='text-capitalize'>" . $value['book_title'] . "</p></td>
                                                <td ><p class='text-capitalize'>" . $get_author['author_name'] . "</p></td>
                                                <td ><p class='text-capitalize'>" . $value['book_language'] . "</p></td>
                                                <td ><p class='text-capitalize'>" . $value['book_type'] . "</p></td>
                                                <td ><p class='text-capitalize'>" . $value['rating']. "</p></td>
                                                <td>
                                                    <div class='d-flex'>
                                                        <button class='btn btn-warning text-white edit-btn p-0' data-bs-toggle='modal' data-bs-target='#updatemodal{$key}'><i class='px-2 fs-5 ri-edit-2-line'></i></button>
                                                        <button class='btn  btn-danger p-0 delete-btn p-0' data-bs-toggle='modal' data-bs-target='#deletemodal{$key}'><i class='px-2 fs-5 bi bi-trash'></i></button>
                                                       
                                                          
                                                     </div>
                                                </td>
                                            </tr>
                                            
                                            ";

                                            //    delete model 
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
                                                                <form method="post" class="d-flex mb-0" action="../process/admin-book.php">
                                                                <input type="number" name="delete_id" value=' . $value["book_id"] . ' hidden>
                                                               
                                                                <button type="submit" class="btn btn-danger">Delete</button>
                                                    			</form>
                                                    			</div>
                                                    		</div>
                                                </div>
                                            </div>';

                                            // update model 

                                            echo '
                                            
                                           
                                            <div class="modal fade" id="updatemodal' . $key . '" tabindex="-1" aria-labelledby="addgenresModal" aria-hidden="true">
                                                <div class="modal-dialog modal-lg modal-dialog-top">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="addgenresModal">
                                                            Update Book</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form method="post" action="../process/book-update.php" enctype="multipart/form-data" class="form needs-validation w-100" >
                                                            
                                                              <input type="text"
                                                                class="form-control" name="book_id" value="'.$value['book_id'].'"  placeholder="book_id" hidden>
                                                             
                                                            <div class="modal-body d-flex">
                                                          
                                                 ';




                                            $book_genresobj = new DBclass('book_genres');
                                            $genres_book = $book_genresobj->filter(['book_id' => $value['book_id']]);
                                            $genres_id = [];
                                            foreach ($genres_book as $genres_value) {
                                                if (isset($genres_value['genre_id'])){

                                                    if ($genres_value['genre_id'] != '' && !is_null($genres_value['genre_id'])){
    
                                                        $genres_id[] = $genres_value['genre_id'];
                                                    }
                                                }
                                            } ?>

                                            <script type="text/javascript">
                                                $(document).ready(function() {
                                                    var multiSelectField = $("#multgenres<?php echo $key ?>");

                                                    // Default selected values (array)
                                                    var defaultGenres = <?php echo json_encode($genres_id); ?>;
                                                    for (var i in defaultGenres) {
                                                        var optionVal = defaultGenres[i];
                                                        multiSelectField.find("option[value=" + optionVal + "]").prop("selected", "selected");
                                                    }
                                                    multiSelectField.multiSelect('refresh');
                                                    // i = 0, size = defaultGenres.length;

                                                    // Set the default selected values
                                                    // multiSelectField.val(<?php echo json_encode($genres_id); ?>);

                                                    // Trigger the change event to update the UI
                                                    // multiSelectField.multiSelect('refresh');
                                                });
                                            </script>

                                        <?php echo '
                                                                <div class="row w-100 m-0">
                                                                    <div class="col-12 col-sm-12 col-xs-12 col-md-6 col-lg-4 col-xl-4 col-xxl-4 col-xxxl-4">
                                                                        <div class="did-floating-label-content">
                                                                            <input class="did-floating-input form-control" type="text" name="book_title" value="' . $value["book_title"] . '"  required placeholder=" ">
                                                                            <label class="did-floating-label">Book Title</label>
                                                                            <div class="invalid-feedback">
                                                                                Book Title is required
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                            
                                                                
                                                                    <script type="text/javascript">
                                                                    $(document).ready(() => {
                                                                        $("#author_id' . $key . '").val("' . $get_author["author_id"] . '");
                                                                        $("#publisher_id' . $key . '").val("' . $get_publisher["publisher_id"] . '");
                                                                        $("#book_language' . $key . '").val("' . $value["book_language"] . '");
                                                                        $("#book_type' . $key . '").val("' . $value["book_type"] . '");
                                                                        $("#book_rating' . $key . '").val("' . $value["rating"] . '");
                                                                        var currentYear = new Date().getFullYear();
                                                                        $("#yearpicker' . $key . '").val("' . $value["publish_year"] . '");
                                                                        $("#yearpicker' . $key . '").datepicker({
                                                                          format: "yyyy",
                                                                          viewMode: "years",
                                                                          minViewMode: "years",
                                                                          endDate: currentYear.toString(),
                                                                          autoclose: true
                                                                        });
                                                                        $("#trending_book' . $key . '").prop("checked",' . $value['trending_book'] . ')
                                                                  
                                                                    });
                                                                </script>
                                                                    <div class="col-12 col-sm-12 col-xs-12 col-md-6 col-lg-4 col-xl-4 col-xxl-4 col-xxxl-4 ">
                                                                 
                                                                        <div class="did-floating-label-content">
                                                                            <select class="did-floating-select"  name="author_id" onchange="this.setAttribute(\'value\', this.value);"  id="author_id' . $key . '" required>';

                                            // Print author options
                                            foreach ($author_result as $authorvalue) {
                                                echo "<option value='{$authorvalue['author_id']}'>{$authorvalue['author_name']}</option>";
                                            }

                                            echo '
                                                                            </select>
                                                                            <label class="did-floating-label">Select Author</label>
                                                                        </div>
                                            
                                                                    </div>
                                                                   
                                                                    <div class="col-12 col-sm-12 col-xs-12 col-md-6 col-lg-4 col-xl-4 col-xxl-4 col-xxxl-4 ">
                                            
                                                                        <div class="did-floating-label-content">
                                                                            <select class="did-floating-select" name="publisher_id"   onchange="this.setAttribute(\'value\', this.value);"  id="publisher_id' . $key . '" required>';

                                            // Print publisher options
                                            foreach ($publishers_result as  $publishersvalue) {

                                                echo "<option value='{$publishersvalue['publisher_id']}'>{$publishersvalue['publisher_name']}</option>";
                                            }

                                            echo '
                                                                            </select>
                                                                            <label class="did-floating-label">Select Publisher</label>
                                                                        </div>
                                            
                                                                    </div>
                                                                   
                                                                    <div class="col-12 col-sm-12 col-xs-12 col-md-6 col-lg-4 col-xl-4 col-xxl-4 col-xxxl-4 ">
                                            
                                                                        <div class="did-floating-label-content">
                                                                            <select class="did-floating-select" name="book_language" id="book_language' . $key . '"  onchange="this.setAttribute(\'value\', this.value);"  required>
                                                                                <option value="english">English</option>
                                                                                <option value="hindi">Hindi</option>
                                                                                <option value="gujarat">Gujarati</option>
                                                                            </select>
                                                                            <label class="did-floating-label">Select Book Language</label>
                                                                        </div>
                                            
                                                                    </div>
                                            
                                                                    <div class="col-12 col-sm-12 col-xs-12 col-md-6 col-lg-4 col-xl-4 col-xxl-4 col-xxxl-4 ">
                                            
                                                                        <div class="did-floating-label-content">
                                                                            <input class="did-floating-input form-control" value="' . $value['total_pages'] . '" type="number" min="0" name="book_page" required placeholder=" ">
                                                                            <label class="did-floating-label">Book Pages</label>
                                                                            <div class="invalid-feedback">
                                                                                Book pages is required
                                                                            </div>
                                                                        </div>
                                            
                                                                    </div>
                                            
                                                                    <div class="col-12 col-sm-12 col-xs-12 col-md-6 col-lg-4 col-xl-4 col-xxl-4 col-xxxl-4 ">
                                            
                                                                        <div class="did-floating-label-content">
                                                                            <select class="did-floating-select" name="book_rating" id="book_rating' . $key . '"  onchange="this.setAttribute(\'value\', this.value);" required>
                                                                                <option value="1">1</option>
                                                                                <option value="2">2</option>
                                                                                <option value="3">3</option>
                                                                                <option value="4">4</option>
                                                                                <option value="5">5</option>
                                                                            </select>
                                                                            <label class="did-floating-label">Book Rating</label>
                                                                        </div>
                                            
                                                                    </div>
                                            
                                                                    <div class="col-12 col-sm-12 col-xs-12 col-md-6 col-lg-4 col-xl-4 col-xxl-4 col-xxxl-4 ">
                                            
                                                                  
                                                                    <div class="did-floating-label-content">
                                                                        <input class="did-floating-input form-control" id="yearpicker' . $key . '"
                                                                            type="number" name="publish_year" placeholder=" ">
                                                                        <label class="did-floating-label">Publish Year</label>
                    
                                                                    </div>
                    
                                                                
                                                                    </div>
                                            
                                                                    <div class="col-12 col-sm-12 col-xs-12 col-md-6 col-lg-4 col-xl-4 col-xxl-4 col-xxxl-4 ">
                                            
                                                                        <div class="did-floating-label-content">
                                                                            <select class="did-floating-select" name="book_type" id="book_type' . $key . '" onchange="this.setAttribute(\'value\', this.value);" required>
                                                                                <option value="Free">Free</option>
                                                                                <option value="Premiere">Premiere</option>
                                                                            </select>
                                                                            <label class="did-floating-label">Book Type</label>
                                                                        </div>
                                            
                                                                    </div>
                                                                    <div class="col-0 col-sm-0 col-xs-0 col-md-0 col-lg-4 col-xl-4 col-xxl-4 col-xxxl-4 ">
                                            
                                                                        
                                                                    </div>
                                                                  

                                                                    <div
                                                                    class=" col-12 col-sm-12 col-xs-12 col-md-6 col-lg-4 col-xl-4 col-xxl-4 col-xxxl-4 ">
                                                                    <div class="did-floating-label-content">
                    
                                                                        <label for="book_image" class="form-label p-0 mb-1 "
                                                                            style="font-size:16px">Book Image</label>
                                                                        <input class="form-control form-control-sm" name="book_image"
                                                                            id="book_image" accept=".jpg .png .jpeg "type="file">
                                                                            <a target="_blank" href="' . base_url . $value['book_image'] . '" >View Book Image</a>

                                                                    </div>
                                                                </div>
                                                                <div
                                                                    class=" col-12 col-sm-12 col-xs-12 col-md-6 col-lg-4 col-xl-4 col-xxl-4 col-xxxl-4 ">
                                                                    <div class="">
                    
                                                                        <label for="book_pdf" class="form-label p-0 mb-1 "
                                                                            style="font-size:16px">Book PDF</label>
                                                                        <input class="form-control form-control-sm" name="book_pdf"
                                                                            id="book_pdf" accept=".pdf" type="file">
                                                                            <a target="_blank" href="' . base_url . $value['book_pdf'] . '" >View Book PDF</a>
                                                                    </div>
                                                                </div>
                                                                <div
                                                                    class=" col-12 col-sm-12 col-xs-12 col-md-6 col-lg-4 col-xl-4 col-xxl-4 col-xxxl-4 ">
                                                                    <label class="form-check-label" for="trending_book' . $key . '">Trending Book</label>
                                                                    <div class="form-check form-switch mt-1">
                                                                        <input class="form-check-input" type="checkbox" role="switch"
                                                                        id="trending_book' . $key . '" value="1" name="trending_book">
                                                                    </div>

                                                                </div>

                                                                
                                                                <div class="mb-3 col-12 col-sm-12 col-xs-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6 col-xxxl-6">
                                                
                                                                <div class="multiSelect w-100" >
                                                                
                                                                <label for="book_pdf" class="form-label p-0 mb-1 "
                                                                style="font-size:16px">Book Genres</label>
                                                                    <select multiple id="multgenres' . $key . '" name="genres[]"  class="w-100"  required>';

                                            // Print genres options
                                            foreach ($genres_result as $genres_value) {

                                                echo "<option value='{$genres_value['genre_id']}'  >{$genres_value['genre_name']}</option>";
                                            }

                                            echo '
                                                                    </select>
                                                                </div>
                                                                <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                                                                    <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="iconX">
                                                                        <g stroke-linecap="round" stroke-linejoin="round">
                                                                            <line x1="18" y1="6" x2="6" y2="18"></line>
                                                                            <line x1="6" y1="6" x2="18" y2="18"></line>
                                                                        </g>
                                                                    </symbol>
                                                                </svg>
                                                            </div>
                                                                <div
                                                                    class=" col-12 col-sm-12 col-xs-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6 col-xxxl-6 ">
                    
                    
                                                                    <label for="floatingTextarea' . $key . '">Book Summary</label>
                                                                    <textarea class="form-control did-floating-input" id="floatingTextarea' . $key . '"
                                                                        name="book_summary" style="height: 210px">' . $value['book_summary'] . ' </textarea>
                    
                    
                                                                </div>
                                                                   
                                                                </div>
                                                                
                                                            </div>
                                                               
                                                               
                                                            
                    
                                                           
                                                              
    
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                                </div>
                                                        </form>
                                                     </div>
                                                </div>
                                              
                                                </div>';
                                        }



                                        ?>


                                    </tbody>
                                </table>

                            </div>

                        </div>
                    </div>
                    <!--
                    <script type="text/javascript">
                         $(document).ready(()=>{
                                                                       
                                                                       $("#author_id' . $key . '").val("' . $get_author["author_id"] . '");
                                                                       $("#publisher_id' . $key . '").val("' . $get_pulishers["publisher_id"] . '");
                                                                   })
                                                                   
                                                                   </script> -->
                    <!-- add modal  -->
                    <div class="modal  fade  " id="addmodal" tabindex="-1" aria-labelledby="addgenresModal" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-top">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="addgenresModal">Add Book</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body d-flex ">
                                    <form method="post" action="../process/admin-book.php" enctype="multipart/form-data" class="form needs-validation w-100 m-0" id="bookform">
                                        <div class="row w-100 m-0">
                                            <div class=" col-4 col-sm-12 col-xs-12 col-md-6 col-lg-4 col-xl-4 col-xxl-4 col-xxxl-4">
                                                <div class="did-floating-label-content">
                                                    <input class="did-floating-input form-control" type="text" name="book_title" required placeholder=" ">
                                                    <label class="did-floating-label">Book Title</label>
                                                    <div class="invalid-feedback">
                                                        Book Title is required
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="mb-3 col-4 col-sm-12 col-xs-12 col-md-6 col-lg-4 col-xl-4 col-xxl-4 col-xxxl-4">

                                                <div class="multiSelect1">
                                                    <select multiple class="multiSelect_field" name="genres[]" data-placeholder="Add Genres" required>
                                                        <!-- <option disabled value='' selected></option> -->
                                                        <?php
                                                        // print_r($genres_result);
                                                        foreach ($genres_result as $key => $value) {
                                                            echo " <option value='{$value['genre_id']}'>{$value['genre_name']}</option>";
                                                        } ?>


                                                    </select>
                                                </div>
                                                <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                                                    <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="iconX">
                                                        <g stroke-linecap="round" stroke-linejoin="round">
                                                            <line x1="18" y1="6" x2="6" y2="18"></line>
                                                            <line x1="6" y1="6" x2="18" y2="18"></line>
                                                        </g>
                                                    </symbol>
                                                </svg>
                                            </div>

                                            <div class=" col-4 col-sm-12 col-xs-12 col-md-6 col-lg-4 col-xl-4 col-xxl-4 col-xxxl-4 ">

                                                <div class="did-floating-label-content">
                                                    <select class="did-floating-select" onclick="this.setAttribute('value', this.value);" name="author_id" onchange="this.setAttribute('value', this.value);" value="" required>
                                                        <option disabled value='' selected></option>

                                                        <?php
                                                        // print_r($genres_result);
                                                        foreach ($author_result as $key => $value) {
                                                            echo " <option value='{$value['author_id']}'>{$value['author_name']}</option>";
                                                        } ?>
                                                    </select>
                                                    <label class="did-floating-label">Select Author</label>
                                                </div>

                                            </div>
                                            <div class=" col-4 col-sm-12 col-xs-12 col-md-6 col-lg-4 col-xl-4 col-xxl-4 col-xxxl-4 ">

                                                <div class="did-floating-label-content">
                                                    <select class="did-floating-select" name="publisher_id" onclick="this.setAttribute('value', this.value);" onchange="this.setAttribute('value', this.value);" value="" required>
                                                        <option disabled value='' selected></option>

                                                        <?php
                                                        // print_r($genres_result);
                                                        foreach ($publishers_result as $key => $value) {
                                                            echo " <option value='{$value['publisher_id']}'>{$value['publisher_name']}</option>";
                                                        } ?>
                                                    </select>
                                                    <label class="did-floating-label">Select Publisher</label>
                                                </div>

                                            </div>

                                            <div class=" col-4 col-sm-12 col-xs-12 col-md-6 col-lg-4 col-xl-4 col-xxl-4 col-xxxl-4 ">

                                                <div class="did-floating-label-content">
                                                    <select class="did-floating-select" name="book_language" onclick="this.setAttribute('value', this.value);" onchange="this.setAttribute('value', this.value);" value="" required>
                                                        <option disabled value='' selected></option>

                                                        <option value="english">English</option>
                                                        <option value="hindi">Hindi</option>
                                                        <option value="gujarat">Gujarati</option>

                                                    </select>
                                                    <label class="did-floating-label">Select Book Language</label>
                                                </div>

                                            </div>
                                            <div class=" col-4 col-sm-12 col-xs-12 col-md-6 col-lg-4 col-xl-4 col-xxl-4 col-xxxl-4 ">

                                                <div class="did-floating-label-content">
                                                    <input class="did-floating-input form-control" type="number" min="0" name="book_page" required placeholder=" ">
                                                    <label class="did-floating-label">Book Pages</label>
                                                    <div class="invalid-feedback">
                                                        Book pages is required
                                                    </div>
                                                </div>

                                            </div>
                                            <div class=" col-4 col-sm-12 col-xs-12 col-md-6 col-lg-4 col-xl-4 col-xxl-4 col-xxxl-4 ">

                                                <div class="did-floating-label-content">
                                                    <select class="did-floating-select" name="book_rating" onclick="this.setAttribute('value', this.value);" onchange="this.setAttribute('value', this.value);" value="" required>
                                                        <option disabled value='' selected></option>

                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>

                                                    </select>
                                                    <label class="did-floating-label">Book Rating</label>

                                                </div>

                                            </div>
                                            <div class=" col-4 col-sm-12 col-xs-12 col-md-6 col-lg-4 col-xl-4 col-xxl-4 col-xxxl-4 ">

                                                <div class="did-floating-label-content">
                                                    <input class="did-floating-input form-control" id="yearpicker" type="number" name="publish_year" placeholder=" ">
                                                    <label class="did-floating-label">Publish Year</label>

                                                </div>

                                            </div>
                                            <div class=" col-4 col-sm-12 col-xs-12 col-md-6 col-lg-4 col-xl-4 col-xxl-4 col-xxxl-4 ">

                                                <div class="did-floating-label-content">
                                                    <select class="did-floating-select" name="book_type" onclick="this.setAttribute('value', this.value);" onchange="this.setAttribute('value', this.value);" value="" required>
                                                        <option disabled value='' selected></option>

                                                        <option value="Free">Free</option>
                                                        <option value="Premiere">Premiere</option>

                                                    </select>
                                                    <label class="did-floating-label">Select Book Type</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row w-100 m-0">
                                            <div class=" col-4 col-sm-12 col-xs-12 col-md-6 col-lg-4 col-xl-4 col-xxl-4 col-xxxl-4 ">
                                                <div class="did-floating-label-content">

                                                    <label for="book_image" class="form-label p-0 mb-1 " style="font-size:16px">Book Image</label>
                                                    <input class="form-control form-control-sm" name="book_image" id="book_image"accept=".jfif,.png,.jpeg,.jpg" type="file">
                                                </div>
                                            </div>
                                            <div class=" col-4 col-sm-12 col-xs-12 col-md-6 col-lg-4 col-xl-4 col-xxl-4 col-xxxl-4 ">
                                                <div class="did-floating-label-content">

                                                    <label for="book_pdf" class="form-label p-0 mb-1 " style="font-size:16px">Book PDF</label>
                                                    <input class="form-control form-control-sm" name="book_pdf" id="book_pdf" accept=".pdf" type="file">
                                                </div>
                                            </div>
                                            <div class=" col-4 col-sm-12 col-xs-12 col-md-6 col-lg-4 col-xl-4 col-xxl-4 col-xxxl-4 ">
                                                <label class="form-check-label" for="flexSwitchCheckChecked">Trending Book</label>
                                                <div class="form-check form-switch mt-1">
                                                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" value="1" name="trending_book">
                                                </div>
                                            </div>
                                            <div class=" col-12 col-sm-12 col-xs-12 col-md-6 col-lg-12 col-xl-12 col-xxl-12 col-xxxl-12 ">


                                                <label for="floatingTextarea2">Book Summary</label>
                                                <textarea class="form-control did-floating-input" id="floatingTextarea2" name="book_summary" style="height: 100px"></textarea>


                                            </div>


                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- close add modal  -->
        </section>

    </main><!-- End #main -->



    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    <script>
        $('#books').removeClass('collapsed')
    </script>

    <?php
    if (isset($_SESSION['message'])) {

        echo "<script>
    $(document).ready(function () {
        toastr.options = {
          closeButton: true,
          timeOut: 5000,
          positionClass: 'toast-top-right'
        };
    toastr.success('" . $_SESSION['message'] . "');
    });
    </script>";
        unset($_SESSION['message']);
    }
    if (isset($_SESSION['error'])) {

        echo "<script>
    $(document).ready(function () {
        toastr.options = {
          closeButton: true,
          timeOut: 5000,
          positionClass: 'toast-top-right'
        };
    toastr.error('" . $_SESSION['error'] . "');
});
</script>";
        unset($_SESSION['error']);
    }
    ?>

</body>

</html>
<?php 

$authorObj=null;
$book_genresobj=null;
$books=null;
$publishers=null;
$genres=null;

?>