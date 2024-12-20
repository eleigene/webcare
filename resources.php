<?php
include("connection.php");
session_start();
if (!isset($_SESSION['auth_user'])) {
    exit(); // Ensure that the rest of the page does not load
}

// Fetch articles
$sql = "SELECT articleid, title, picture, link FROM articles";
$result = mysqli_query($con, $sql);

$articles = [];
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $articles[] = $row;
    }
} else {
    echo "Error fetching articles: " . mysqli_error($con);
}

// Fetch categories
$categories = [];
$sql_categories = "SELECT * FROM category";
$result_categories = mysqli_query($con, $sql_categories);
if ($result_categories && mysqli_num_rows($result_categories) > 0) {
    while ($category = mysqli_fetch_assoc($result_categories)) {
        $categories[] = $category;
    }
} else {
    echo "Error fetching categories: " . mysqli_error($con);
}

mysqli_close($con);
?>
<?php
include("connection.php");
session_start();
if (!isset($_SESSION['auth_user'])) {
    
    exit(); // Ensure that the rest of the page does not load
}
if (isset($_SESSION['login_success'])) {
    
    unset($_SESSION['login_success']);
}
$userID = $_SESSION['auth_user']['UserName'];
$userid = $_SESSION['auth_user']['ID']; // Fixed typo

// Fetch the logged-in user's data
$sql1 = "SELECT * FROM user WHERE userid ='$userid'";
$result1 = mysqli_query($con, $sql1);

if ($result1 && mysqli_num_rows($result1) > 0) {
    // Fetch the data if available
    while ($rows = mysqli_fetch_assoc($result1)) {
        $first1 = $rows['username'];
        $two1 = $rows['email'];
        $six1 = $rows['profile'];
    }
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="userhome.css">
    <link rel="stylesheet" href="resources.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Seymour+One' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Kalam' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Paytone+One' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Rubik' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Epilogue' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Fraunces' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.1.0/css/boxicons.min.css">
    <title>Resources</title>
</head>
<body>
    <div class="hd1">
        <img class="logo" src="logo.png" alt="Logo">
        <a href="resources.php" class="ht1">Resources</a>
        <a href="userhome.php#asd" class="ht2">What We Offer</a>
        <a href="userhome.php#abt" class="ht3">About</a>
        <a href="userhome.php" class="ht4">Home</a>
        <div class="dropdown">
            <div class="profile" onclick="toggleDropdown()">
            <img class="profile1" src="<?php echo htmlspecialchars($six1); ?>" width="50" height="50" style="border:1px solid black" width="50" 
     height="50" 
     style="border:1px solid black">
                <i class="arrow-down"></i>
            </div>
            <div class="dropdown-content" id="dropdownContent">
                <a href="settings.php">Settings</a>
                <a href="logout.php">Logout</a>
            </div>
        </div>
    </div>
    <div class="hd2"></div>
    <div class="rt1">Self Help Articles</div>
    <div class="rt2">Category</div>
    <div class="rcd1">
    <div class="content">
        <div class="hmm"><a href="resources.php" style="color: black; text-decoration: none">All</a></div>
        <?php 
        $topPosition = 50; // Initial top position
        foreach ($categories as $category): ?>
            <div class="hello" style="top: <?= $topPosition ?>px;">
                <a href="categpath.php?categoryid=<?= htmlspecialchars($category['categoryid']) ?>" style="color: black; text-decoration: none;"><?= htmlspecialchars($category['name']) ?></a>
            </div>
            <?php $topPosition += 50; // Increment the top position ?>
        <?php endforeach; ?>
    </div>
</div>

<div class="content">
    <?php if (count($articles) > 0): ?>
        <?php foreach ($articles as $article): ?>
            <div class="box">
                <img class="image" src="<?= htmlspecialchars($article['picture']) ?>">
                <div class="title"><?= htmlspecialchars($article['title']) ?></div>
                <a class="link" href="redirect.php?articleid=<?= $article['articleid'] ?>&url=<?= urlencode($article['link']) ?>">Read More<i class='bx bx-right-arrow-alt'></i></a>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No articles found.</p>
    <?php endif; ?>
</div>


    <script>
        function toggleDropdown() {
            var dropdownContent = document.getElementById("dropdownContent");
            if (dropdownContent.style.display === "block") {
                dropdownContent.style.display = "none";
            } else {
                dropdownContent.style.display = "block";
            }
        }

        window.onclick = function(event) {
            if (!event.target.matches('.profile1')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                for (var i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.style.display === "block") {
                        openDropdown.style.display = "none";
                    }
                }
            }
        }
    </script>
</body>
</html>
