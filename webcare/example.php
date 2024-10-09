<?php
include("connection.php");

// Step 1: Get the category ID from the URL or wherever it's coming from
if (isset($_GET['categoryid'])) {
    $categoryid = $_GET['categoryid']; // Assuming it's passed via URL parameter
    // Step 2: Query to retrieve articles for the specified category
    $query = "SELECT a.articleid, a.title, a.link, a.picture
              FROM articles a
              INNER JOIN article_categories ac ON a.articleid = ac.articleid
              WHERE ac.categoryid = $categoryid";

    $result = mysqli_query($con, $query);

    if ($result) {
        // Step 3: Display the articles
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div>";
            echo "<h2>" . htmlspecialchars($row['title']) . "</h2>";
            echo "<p><a href='" . htmlspecialchars($row['link']) . "'>Link</a></p>";
            echo "<img src='" . htmlspecialchars($row['picture']) . "' alt='Article Image'>";
            echo "</div>";
        }
    } else {
        echo "Error: " . mysqli_error($con);
    }

    // Step 4: Free result set
    mysqli_free_result($result);
}

// Step 5: Close the database connection
mysqli_close($con);
?>