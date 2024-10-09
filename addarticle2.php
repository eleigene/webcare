<?php
include("connection.php");
session_start();

if (isset($_POST['submit'])) {
    $title = $_POST['bname'];
    $author = $_POST['bauthor'];  // Assuming `author` is the URL link
    $category = $_POST['bcategory'];  // Category from dropdown

    // First, check if the category exists
    $category_check_query = "SELECT categoryid FROM category WHERE categoryid = '$category'";
    $category_check_result = mysqli_query($con, $category_check_query);

    if (mysqli_num_rows($category_check_result) > 0) {
        // Category exists, proceed with the insert

        // Check if an image is uploaded
        if (isset($_FILES['bfile']['tmp_name']) && !empty($_FILES['bfile']['tmp_name'])) {
            $imageloc = $_FILES['bfile']['tmp_name'];

            // Validate and sanitize the uploaded file
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
            $fileExtension = strtolower(pathinfo($_FILES['bfile']['name'], PATHINFO_EXTENSION));

            if (!in_array($fileExtension, $allowedExtensions)) {
                echo "Invalid file format. Please upload a valid image.";
                exit;
            }

            $uploadDirectory = 'upload/'; // Specify your upload directory
            $uploadedFileName = uniqid() . '.' . $fileExtension;
            $uploadedFilePath = $uploadDirectory . $uploadedFileName;

            if (move_uploaded_file($imageloc, $uploadedFilePath)) {
                // Insert article data into the `articles` table
                $sql = "INSERT INTO articles (title, link, picture) VALUES ('$title', '$author', '$uploadedFilePath')";

                if (mysqli_query($con, $sql)) {
                    // Get the last inserted article ID
                    $articleid = mysqli_insert_id($con);

                    // Insert into `article_categories` table
                    $sql_category = "INSERT INTO article_categories (articleid, categoryid) VALUES ('$articleid', '$category')";
                    if (mysqli_query($con, $sql_category)) {
                        header("Location: mresources.php");
                    } else {
                        echo "Error adding article to category: " . mysqli_error($con);
                    }
                } else {
                    echo "Error: " . mysqli_error($con);
                }
            } else {
                echo "Error uploading file.";
                exit;
            }
        } else {
            echo "Please select an image file.";
            exit;
        }
    } else {
        echo "Invalid category ID. Please select a valid category.";
        exit;
    }
}

if (isset($_POST['cancel'])) {
    header("Location: mresources.php");
}
?>
