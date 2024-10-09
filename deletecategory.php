<?php
// Include the database connection file
include('connection.php');

if (isset($_POST['deleteAll'])) {
    // Check if any categories were selected
    if (isset($_POST['ids']) && is_array($_POST['ids'])) {
        // Get the IDs of the selected categories
        $ids = $_POST['ids'];
        
        // Prepare the SQL DELETE statement
        $ids_string = implode("','", $ids); // Create a string for the IN clause
        $query = "DELETE FROM category WHERE name IN ('$ids_string')";
        
        // Execute the query
        if (mysqli_query($con, $query)) {
            // Success message
            echo "<script>alert('Categories deleted successfully.'); window.location.href='category.php';</script>";
        } else {
            // Error message
            echo "<script>alert('Error deleting categories: " . mysqli_error($con) . "'); window.location.href='category.php';</script>";
        }
    } else {
        // No categories selected
        echo "<script>alert('Please select at least one category to delete.'); window.location.href='category.php';</script>";
    }
} else {
    // If the deleteAll button was not pressed
    echo "<script>alert('Invalid request.'); window.location.href='category.php';</script>";
}
?>
