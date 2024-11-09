<?php
include("connection.php");

// Fetch categories
$sql_categories = "SELECT * FROM category";
$result_categories = mysqli_query($con, $sql_categories);

$categories = [];
if ($result_categories && mysqli_num_rows($result_categories) > 0) {
    while ($category = mysqli_fetch_assoc($result_categories)) {
        $categories[] = $category;
    }
} else {
    echo "Error fetching categories: " . mysqli_error($con);
}

// Close the category result set
mysqli_free_result($result_categories);

// Fetch articles if category ID is provided in the URL
$articles = [];
if (isset($_GET['categoryid'])) {
    $categoryid = $_GET['categoryid']; // Assuming it's passed via URL parameter
    $query = "SELECT a.articleid, a.title, a.link, a.picture
              FROM articles a
              INNER JOIN article_categories ac ON a.articleid = ac.articleid
              WHERE ac.categoryid = $categoryid";

    $result_articles = mysqli_query($con, $query);

    if ($result_articles && mysqli_num_rows($result_articles) > 0) {
        while ($article = mysqli_fetch_assoc($result_articles)) {
            $articles[] = $article;
        }
    } else {
        echo "No articles found for this category.";
    }

    // Close the articles result set
    mysqli_free_result($result_articles);
}

// Close the database connection
mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap 5.3 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        .navbar {
            position: sticky;
            top: 0;
            z-index: 1020;
        }

        .logo {
            width: 50px;
            /* Adjust as needed */
            height: auto;
        }

        .navbar-nav .nav-link {
            font-size: 1rem;
        }


        .dropdown-center {
            position: relative;
        }

        @media (min-width: 768px) {
            #profileDropdownLinks {
                position: absolute;
                left: -100px;
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid m-0 p-0">
        <!-- RESPONSIVE NAVBAR -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light px-5 shadow">
            <a class="navbar-brand" href="#">
                <img src="logo.png" width="50" alt="Logo" class="logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>


            <div class="collapse navbar-collapse flex justify-content-end" id="navbarNav">
                <ul class="navbar-nav text-center d-flex justify-content-center align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="userhome.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="userhome.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="userhome.php">What We Offer</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="resources.php">Resources</a>
                    </li>
                    <!-- User Profile Dropdown -->
                    <div class="dropdown-center">
                        <div class="mx-2 dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img class="rounded-5" src="<?php echo htmlspecialchars($six1); ?>" width="40" height="40">
                        </div>
                        <ul class="dropdown-menu" id="profileDropdownLinks">
                            <li><a class="dropdown-item" href="profile.php">View Profile</a></li>
                            <li><a class="dropdown-item" href="settings.php">Settings</a></li>
                            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                        </ul>
                    </div>

                </ul>
            </div>
        </nav>

        <!-- SECTION -->
        <div class="container-fluid">
            <p class="text-center fs-2 fw-bold text-success mt-4">Self Help Articles</p>
            <div class="container d-flex flex-column mb-3">
                <div class="d-flex flex-wrap justify-content-start align-items-center gap-2">
                    <p class="fs-4 fw-semibold mt-2 pt-2">Categories: </p>
                    <a class="btn btn-outline-success btn-sm"  href="resources.php">All</a>
                    <?php
                    foreach ($categories as $category): ?>
                        <a class="btn btn-outline-success btn-sm" href="categpath.php?categoryid=<?= htmlspecialchars($category['categoryid']) ?>"><?= htmlspecialchars($category['name']) ?></a>
                        <?php
                        ?>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Cards -->
            <div class="container">
                <?php if (count($articles) > 0): ?>
                    <div class="row">
                        <?php foreach ($articles as $article): ?>
                            <div class="col-12 col-md-6 col-lg-4 mb-4">
                                <div class="card h-100 shadow-sm">
                                    <img src="<?= htmlspecialchars($article['picture']) ?>" class="object-fit-cover border w-100" style="height: 200px;">
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title"><?= htmlspecialchars($article['title']) ?></h5>
                                        <a href="redirect.php?articleid=<?= $article['articleid'] ?>&url=<?= urlencode($article['link']) ?>" class="btn btn-success btn-sm mt-auto">
                                            Read More <i class='bx bx-right-arrow-alt'></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p>No articles found.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <!-- Bootstrap 5.3 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>