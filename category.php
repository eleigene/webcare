<!DOCTYPE html>
<html>
  <head>
    <title>Responsive Admin Dashboard | CodingLab</title>
    <link rel="stylesheet" href="mresources.css">
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
            <i class='bx bx-category-alt'></i>
            <span class="links_name">Category</span>
          </a>
        </li>
        <li>
          <a href="#logout">
            <i class='bx bx-log-out'></i>
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
        <div class="bd1">
          <form method="POST" action="addcategory.php" enctype="multipart/form-data">
            <button class="bbut1" name="addnew"><i class='bx bx-plus-medical'></i> Add New Article</button>  
          </form>
          
          <form id="deleteForm" action="deletecategory.php" method="POST">
            <button class="bbut2" type="submit" name="deleteAll" onclick="return confirm('Are you sure you want to delete selected category?');">Delete Selected</button>            
            <p class="bp1">Manage Articles</p>
        </div>
          
          <table class="book-table">
            <thead>
              <tr>
                <th><input type="checkbox" id="selectAll"></th>
                <th>Category</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            <?php
              include('connection.php');

              // Query to join article_categories, category, and articles
              $query = "
                SELECT name
                FROM category 
              
              ";

              $result = mysqli_query($con, $query);

              while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo '<td><input type="checkbox" name="ids[]" value="'.$row['name'].'"></td>';
                echo "<td>" . $row['name'] . "</td>"; // Name from category
                echo '<input type="hidden" name="bookid" value="' . $row['name'] . '">';
                echo '<td class="action">
                        <a href="editcategory.php?bookid=' . $row['name'] . '" class="edb"><i class="bx bxs-edit"></i></a>
                        <a href="single-delete.php?deleteid=' . $row['name'] . '" class="delb"><i class="bx bxs-trash"></i></a>
                      </td>';
                echo "</tr>";
              }
            ?>
            </tbody>
          </table>
        </form>
      </div>
    </div>
  </section>

  <script>
    // Select or Deselect all checkboxes
    document.getElementById('selectAll').onclick = function() {
      let checkboxes = document.getElementsByName('ids[]');
      for (let checkbox of checkboxes) {
        checkbox.checked = this.checked;
      }
    }
  </script>
</body>
</html>
