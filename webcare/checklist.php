<html>
    <head>
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="userhome.css">
    <link rel="stylesheet" href="checklist.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Seymour+One' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Kalam' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Paytone+One' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet'>
    </head>
    </head>
    <body>
    <div class="hd1">
        <img class="logo" src="logo.png" alt="Logo">
        <a href="resources.php" class="ht1">Resources</a>
        <a href="userhome.php#asd" class="ht2">What We Offer</a>
        <a href="userhome.php#abt" class="ht3">About</a>
        <a href="userhome.php" class="ht4">Home</a>
        <div class="dropdown">
            <div class="p" onclick="toggleDropdown()">
                <img class="p1" src="images/profile.jpg" alt="Profile Picture" width="50" height="50" style="border:1px solid black">
                <i class="arrow-down"></i>
            </div>
            <div class="dropdown-content" id="dropdownContent">
                <a href="profile.php">View Profile</a>
                <a href="settings.php">Settings</a>
                <a href="logout.php">Logout</a>
            </div>
        </div>
    </div>
    <div class="hd2"></div>
    <div class="cd1">
        <img src="images/ci1.png" class="ci1">
        <img src="images/ci2.png" class="ci2">
        <img src="images/ci3.png" class="ci3">
        <p class="cp1">This checklist lists various symptoms related to your mental health. Check the box next to each symptom that matches what you’re experiencing. Once you finish, you'll receive personalized recommendations based on your responses. Your answers and results are confidentials.</p>
        <p></p>
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
            if (!event.target.matches('.p1')) {
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