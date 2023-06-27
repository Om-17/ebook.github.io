<?php
include_once('../config.php');
require_once('../classes/masterclass.php');
session_start();
$book_title = $_POST['book_title'];
$url='./admin/book.php';
$genres = $_POST['genres'];
$author_id = $_POST['author_id'];
$publisher_id = $_POST['publisher_id'];
$book_language = $_POST['book_language'];
$publish_date = $_POST['publish_date'];
if (isset($_POST['book_rating'])) {
    $book_rating = $_POST['book_rating'];
} else {
    $book_rating = 0;
}
$book_summary = $_POST['book_summary'];
$book_page = $_POST['book_page'];
$book_type = $_POST['book_type'];
$book_image = NAN;
$book_pdf = NAN;


$book_obj = new MasterClass('books');
$extist = $book_obj->exists("book_title", $book_title);
print_r($genres);
echo "extist " . $extist;


if ($extist == 0) {
    if (isset($_FILES['book_image'])) {
        $errors = array();
        $file_image = $_FILES['book_image'];
        $target_dir = base_app . "/media/uploads/books_image/";
        $file_size = $_FILES['book_image']['size'];
        $file_ext = explode("/", strtolower($file_image['type']));
        $extensions = array("jpeg", "jpg", "png");

        if (in_array($file_ext[1], $extensions, true) != 1) {
            $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
        }


        $target_path = $target_dir . basename($_FILES['book_image']['name']);

        if (empty($errors) == true) {
            if (move_uploaded_file($_FILES['book_image']['tmp_name'], $target_path)) {
                echo "File uploaded successfully!";
            } else {
                echo "Sorry, file not uploaded, please try again!";
            }
        } else {
            print_r($errors);
        }
        $book_image = "/media/uploads/books_image/" . basename($_FILES['book_image']['name']);

    }
    if (isset($_FILES['book_pdf'])) {
        $errors = array();
        $target_dir = base_app . "/media/uploads/books_pdf/";
        $file_size = $_FILES['book_pdf']['size'];
        $file_pdf = $_FILES['book_pdf'];
        $extensions = array("pdf");
        $file_ext = explode("/", strtolower($file_pdf['type']));
        $target_path = $target_dir . basename($_FILES['book_pdf']['name']);

        if (in_array($file_ext[1], $extensions, true) != 1) {
            $errors[] = "extension not allowed, please choose a PDF file.<br/>";
        }
        if (empty($errors) == true) {
            if (move_uploaded_file($_FILES['book_pdf']['tmp_name'], $target_path)) {
                echo "File uploaded successfully!</br>";
            } else {
                echo "Sorry, file not uploaded, please try again! <br/>";
            }
        } else {
            print_r($errors);
        }

        $book_pdf = "/media/uploads/books_pdf/" . basename($_FILES['book_pdf']['name']);
        ;

    }
    $params = [
        "book_title" => $book_title,
        "book_summary" => $book_summary,
        "author_id" => $author_id,
        "book_language" => $book_language,
        "total_page" => $book_page,
        "rating" => $book_rating,
        "book_type" => $book_type,
        "publisher_id" => $publisher_id,
        "publish_date" => $publish_date,
        "book_image" => $book_image,
        "book_pdf" => $book_pdf
    ];
    $result = $book_obj->create($params);
    print_r($result);
    if ($result['status'] == 1) {
        $_SESSION["message"] = "Book is created successfully";

        $book_genres = new MasterClass('book_genres');
        foreach ($genres as $value) {
            $genrecountparam = [
                "genre_id" => $value
            ];
            $count_genres = $book_genres->count($genrecountparam) + 1;
            $genres_param = [
                "book_id" => $result['last_id'],
                "genre_id" => $value,
                "counter" => $count_genres
            ];

            echo "Genres count: " . $count_genres;
            $book_genres->create($genres_param);
        }
        redirect($url);

        
    } else {
        $_SESSION["error"] = "Something went wrong";
        redirect($url);
    }


} else {
    $_SESSION["error"] = "Book is already Exist here !";
    redirect($url);

}


?>