<?php
include("connection.php"); // Include your database connection file

if (isset($_POST['submit'])) {
    // Get the form inputs
    $categoryName = $_POST['bname'];
    
    // Check if the category name is not empty
    if (!empty($categoryName)) {
        // Prepare the SQL statement to insert the new category
        $sql = "INSERT INTO category (name) VALUES ('$categoryName')";
        
        // Execute the query
        if (mysqli_query($con, $sql)) {
            // If successful, redirect to the resources page or show a success message
            header("Location: category.php"); // Redirect to the resources page
            exit;
        } else {
            // If there was an error, display it
            echo "Error: " . mysqli_error($con);
        }
    } else {
        echo "Category name cannot be empty.";
    }
}

// Handle the cancel button (optional)
if (isset($_POST['cancel'])) {
    header("Location: category.php"); // Redirect to the resources page
    exit;
}
?>
