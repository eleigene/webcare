<!DOCTYPE html>
<?php
	include ("connection.php");
	
	$sql=mysqli_query($con,"SELECT name FROM category");
	$sql_run=mysqli_fetch_assoc($sql);
	$categ = $sql_run['name'];
	
?>
<html>
  <head>
    <title>Add Article</title>
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
            <span class="links_name">Home</span>
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
			<span class="dashboard">Resources</span>
		</div>
	</nav>

    <div class="home-content">
		<div class="content-box">
		<form method="POST" action="addarticle2.php" enctype="multipart/form-data">
		<p class="abp1"> ADD ARTICLE </p>
		<input type="text" class="bname" name="bname" value="Title">
		<input type="text" class="bauthor" name="bauthor" value="Link">
    <select name="bcategory" required>
        <option value="" disabled selected>Select Category</option>
        <?php
        // Fetch categories from the database
        $category_query = "SELECT categoryid, name FROM category";
        $category_result = mysqli_query($con, $category_query);

        // Display category options
        while ($category_row = mysqli_fetch_assoc($category_result)) {
            echo '<option value="' . $category_row['categoryid'] . '">' . $category_row['name'] . '</option>';
        }
        ?>
    </select>
		<div class="file-container">
		<label for="file" class="custom-button"> Upload Picture </label>
		<input type="file" id="bfile" class="file-input" name="bfile">
		</div>
		<input type="submit" class="submit" name="submit" value="Add">
		<a href="dashboard.php"class="cancel" value="Cancel">Cancel</a>
		</form>
		</div>
	</div>
		
  </section>

  <script>
   let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".sidebarBtn");
sidebarBtn.onclick = function() {
  sidebar.classList.toggle("active");
  if(sidebar.classList.contains("active")){
  sidebarBtn.classList.replace("bx-menu" ,"bx-menu-alt-right");
}else
  sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
}

</body>
</html>