<?php
include("connection.php");

if (isset($_GET['articleid']) && isset($_GET['url'])) {
    $articleid = intval($_GET['articleid']);
    $url = $_GET['url'];

    // Update the click count
    $sql = "UPDATE articles SET visit_count = visit_count + 1 WHERE articleid = $articleid";
    if (mysqli_query($con, $sql)) {
        // Redirect to the article URL
        header("Location: " . $url);
        exit();
    } else {
        echo "Error updating click count: " . mysqli_error($con);
    }
} else {
    echo "Invalid request.";
}

mysqli_close($con);
?>
