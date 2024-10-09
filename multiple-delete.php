<?php
  include('connection.php');

  if (isset($_POST['deleteAll'])) {
    if (isset($_POST['ids'])) {
      // Get the array of selected article ids
      $ids = implode(",", $_POST['ids']);

      // Delete query for the selected articles
      $query = "DELETE FROM articles WHERE articleid IN ($ids)";
      $result = mysqli_query($con, $query);

      if ($result) {
        echo "
          <script>
            alert('Selected articles have been deleted successfully.');
            window.location.href='mresources.php';
          </script>
        ";
      } else {
        echo "
          <script>
            alert('Failed to delete selected articles.');
            window.location.href='mresources.php';
          </script>
        ";
      }
    } else {
      // No articles selected
      echo "
        <script>
          alert('No articles selected for deletion.');
          window.location.href='mresources.php';
        </script>
      ";
    }
  }
?>
