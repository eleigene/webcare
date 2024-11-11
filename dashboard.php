
<!DOCTYPE html>
<html>
  <head>
    <title>Home</title>
    <link rel="stylesheet" href="style.css">
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
          <a href="dashboard.php" class="active">
            <i class='bx bxs-dashboard'></i>
            <span class="links_name">Home</span>
          </a>
        </li>
        <li>
          <a href="mresources.php">
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
        <span class="dashboard">Welcome</span>
      </div>
    </nav>
<div class="home-content">
      <h1>Welcome, Admin!</h1>
      <p>You’ve successfully logged in. Here, you can manage the articles and organize them into categories, making the site easier for users to navigate. It’s a simple way to keep the content up-to-date.</p>
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