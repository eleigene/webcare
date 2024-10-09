<?php
// Include the database connection file
include('connection.php');

// Check if the deleteid parameter is set in the URL
if (isset($_GET['deleteid'])) {
    // Sanitize the input to prevent SQL injection
    $category_name = mysqli_real_escape_string($con, $_GET['deleteid']);
    
    // Prepare the SQL DELETE statement
    $query = "DELETE FROM category WHERE name = '$category_name'";
    
    // Execute the query
    if (mysqli_query($con, $query)) {
        // Success message
        echo "<script>alert('Category deleted successfully.'); window.location.href='category.php';</script>";
    } else {
        // Error message
        echo "<script>alert('Error deleting category: " . mysqli_error($con) . "'); window.location.href='category.php';</script>";
    }
} else {
    // If deleteid is not set
    echo "<script>alert('Invalid request.'); window.location.href='category.php';</script>";
}
?>
