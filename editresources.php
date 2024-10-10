<?php
include('connection.php');

// Get the article ID from the query string
if (isset($_GET['bookid'])) {
    $articleid = $_GET['bookid'];

    // Query to retrieve the article details
    $query = "
        SELECT a.title, a.link, a.picture, ac.categoryid, c.name 
        FROM articles a 
        JOIN article_categories ac ON a.articleid = ac.articleid 
        JOIN category c ON ac.categoryid = c.categoryid 
        WHERE a.articleid = $articleid;
    ";

    $result = mysqli_query($con, $query);
    $article = mysqli_fetch_assoc($result);
} else {
    header("Location: mresources.php"); // Redirect if no article ID
    exit();
}

// Initialize a variable to hold success message
$successMessage = "";

// Handle form submission for updating the article
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $link = mysqli_real_escape_string($con, $_POST['link']);
    $categoryid = mysqli_real_escape_string($con, $_POST['category']);
    
    // Initialize a variable for the picture path
    $picturePath = $article['picture']; // Default to the existing picture path

    // Check if a new file is uploaded
    if (isset($_FILES['bfile']) && $_FILES['bfile']['error'] == UPLOAD_ERR_OK) {
        // Define the directory to store uploaded images
        $targetDir = "upload/"; // Ensure this directory exists and is writable
        $fileName = basename($_FILES['bfile']['name']);
        $targetFilePath = $targetDir . $fileName;

        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES['bfile']['tmp_name'], $targetFilePath)) {
            // Update the picture path with the new file path
            $picturePath = $targetFilePath;
        } else {
            // Handle error if file upload fails
            echo "<script>alert('File upload failed. Please try again.');</script>";
        }
    }

    // Update the article with the new details
    $updateQuery = "
        UPDATE articles 
        SET title = '$title', link = '$link', picture = '$picturePath' 
        WHERE articleid = $articleid;
    ";

    // Execute the update query
    if (mysqli_query($con, $updateQuery)) {
        // Update category if needed
        $updateCategoryQuery = "
            UPDATE article_categories 
            SET categoryid = $categoryid 
            WHERE articleid = $articleid;
        ";

        mysqli_query($con, $updateCategoryQuery);
        
        // Set success message
        $successMessage = "Article updated successfully!";
        // Redirect to resources page with a success flag
        header("Location: mresources.php?success=1");
        exit();
    } else {
        echo "<script>alert('Error updating article: " . mysqli_error($con) . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Article</title>
    <link rel="stylesheet" href="addarticle.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div class="sidebar">
        <div class="logo-details">
            <img src="logo.png" class="logo">
            <span class="logo_name">WebCare</span>
        </div>
        <ul class="nav-links">
        <li>
          <a href="dashboard.php">
            <i class='bx bxs-dashboard'></i>
            <span class="links_name">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="mresources.php" class="active">
          <i class='bx bxs-folder-open'></i>
            <span class="links_name">Resources</span>
          </a>
        </li>
        <li>
          <a href="category.php">
            <i class='bx bx-category-alt' ></i>
            <span class="links_name">Category</span>
          </a>
        </li>
        <li>
        <a href="admin-setting.php">
            <i class='bx bx-log-out' ></i>
            <span class="links_name">Setting</span>
          </a>
        </li>
        
        <li>
        <a href="logout.php">
            <i class='bx bx-log-out' ></i>
            <span class="links_name">Log out</span>
          </a>
        </li>
      </ul>

    </div>

    <section class="home-section">
        <nav>
            <div class="sidebar-button">
                <span class="dashboard">Edit Article</span>
            </div>
        </nav>

        <div class="home-content">
            <div class="content-box">
                <form method="POST" action="" enctype="multipart/form-data">
                    <p class="abp1">EDIT ARTICLE</p>
                    <input type="text" class="bname" name="title" value="<?php echo htmlspecialchars($article['title']); ?>" required>
                    <input type="text" class="bauthor" name="link" value="<?php echo htmlspecialchars($article['link']); ?>" required>
                    <select name="category" required>
                        <option value="" disabled>Select Category</option>
                        <?php
                        // Fetch categories from the database
                        $category_query = "SELECT categoryid, name FROM category";
                        $category_result = mysqli_query($con, $category_query);

                        // Display category options
                        while ($category_row = mysqli_fetch_assoc($category_result)) {
                            echo '<option value="' . $category_row['categoryid'] . '"' . ($category_row['categoryid'] == $article['categoryid'] ? ' selected' : '') . '>' . htmlspecialchars($category_row['name']) . '</option>';
                        }
                        ?>
                    </select>
                    <div class="file-container">
                        <label for="file" class="custom-button">Upload Picture</label>
                        <input type="file" id="bfile" class="file-input" name="bfile">
                    </div>
                    <input type="submit" class="submit" name="submit" value="Update">
                    <input type="button" class="cancel" onclick="window.location.href='mresources.php'" value="Cancel">
                </form>
            </div>
        </div>
    </section>

    <script>
        // Check for success message and alert the user
        <?php if (isset($_GET['success'])): ?>
            alert("<?php echo $successMessage; ?>");
        <?php endif; ?>
    </script>
</body>
</html>
