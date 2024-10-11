<?php
include('connection.php');

// Get the category ID from the query string
if (isset($_GET['bookid'])) {
    $categoryName = $_GET['bookid'];

    // Query to retrieve the category details
    $query = "SELECT name FROM category WHERE name = '$categoryName'";
    $result = mysqli_query($con, $query);
    $category = mysqli_fetch_assoc($result);

    if (!$category) {
        header("Location: category.php"); // Redirect if no category found
        exit();
    }
} else {
    header("Location: category.php"); // Redirect if no category ID
    exit();
}

// Update category if form is submitted
if (isset($_POST['update'])) {
    $newCategoryName = mysqli_real_escape_string($con, $_POST['category_name']);
    $query = "UPDATE category SET name = '$newCategoryName' WHERE name = '$categoryName'";
    
    if (mysqli_query($con, $query)) {
        header('Location: category.php?success=1');
        exit();
    } else {
        echo "<script>alert('Error updating category: " . mysqli_error($con) . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Category</title>
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
          <a href="mresources.php" >
          <i class='bx bxs-folder-open'></i>
            <span class="links_name">Resources</span>
          </a>
        </li>
        <li>
          <a href="category.php" class="active">
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
                <span class="dashboard">Edit Category</span>
            </div>
        </nav>

        <div class="home-content">
            <div class="content-box">
                <form method="POST" action="">
                    <p class="abp1">EDIT CATEGORY</p>
                    <input type="text" class="bname" name="category_name" value="<?php echo htmlspecialchars($category['name']); ?>" required>
                    <input type="submit" class="submit" name="update" value="Update">
                    <input type="button" class="cancel" onclick="window.location.href='category.php'" value="Cancel">
                </form>
            </div>
        </div>
    </section>

    <script>
        // Check for success message and alert the user
        <?php if (isset($_GET['success'])): ?>
            alert("Category updated successfully!");
        <?php endif; ?>
    </script>
</body>
</html>
