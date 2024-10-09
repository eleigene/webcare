<?php
	include ("connection.php");
if (isset($_GET['deleteid'])) {
        $id = $_GET['deleteid'];
        $sql1 = mysqli_query($con, "DELETE FROM articles WHERE articleid = $id");
		
        header("Location: mresources.php");
}
?>