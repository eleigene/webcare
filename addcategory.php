<!DOCTYPE html>
<?php
	include ("connection.php");
	
	$sql=mysqli_query($con,"SELECT name FROM category");
	$sql_run=mysqli_fetch_assoc($sql);
	$categ = $sql_run['name'];
	
?>
<html>
  <head>
    <title> Responsiive Admin Dashboard | CodingLab </title>
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
        </li>
        <li>
        </li>
		<li>
        </li>
		<li>
        </li>
		<li>
        </li>
		<li>
        </li>
		<li>
        </li>
		<li>
        </li>
		<li>
        </li>
		<li>
        </li>
		<li>
          <a href="#">
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
		<form method="POST" action="addcategory2.php" enctype="multipart/form-data">
		<p class="abp1"> ADD Category </p>
		<input type="text" class="bname" name="bname" value="Category">
		<div class="file-container">
		<input type="file" id="bfile" class="file-input" name="bfile">
		</div>
		<input type="submit" class="submit" name="submit" value="Add">
		<input type="submit" class="cancel" name="cancel" value="Cancel">
		</form>
		</div>
	</div>
		
  </section>

</body>
</html>