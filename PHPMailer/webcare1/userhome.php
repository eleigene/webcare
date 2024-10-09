<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="userhome.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Seymour+One' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Kalam' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Paytone+One' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Abril+Fatface' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Alice' rel='stylesheet'>
    <title>Slideshow Example</title>
    <style>
.float-button {
    position: fixed;
    bottom: 30px;
    right: 30px;
    width: 70px; /* Adjust width as needed */
    height: 70px; /* Adjust height as needed */
    cursor: pointer;
    background-color: rgba(208, 212, 202, 0.4);
    border-radius: 50px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
  }

  .float-button img {
    width: 100%;
    height: 100%;
    object-fit: cover; /* Ensures the image fills the button without stretching */
   
  }

  .float-button1 {
    position: fixed;
    bottom: 110px;
    right: 30px;
    width: 70px; /* Adjust width as needed */
    height: 70px; /* Adjust height as needed */
    background-color: rgba(208, 212, 202, 0.4);
    border-radius: 50px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);

  }

  .float-button1 img {
    width: 100%;
    height: 100%;
    object-fit: cover; /* Ensures the image fills the button without stretching */
  }


 
</style>
</head>
<body>
    <div class="hd1">
        <img class="logo" src="logo.png" alt="Logo">
        <a href="resources.php" class="ht1">Resources</a>
        <a href="#asd" class="ht2">What We Offer</a>
        <a href="#abt" class="ht3">About</a>
        <a href="userhome.php" class="ht4">Home</a>
        <div class="dropdown">
            <div class="profile" onclick="toggleDropdown()">
                <img class="profile1" src="images/profile.jpg" alt="Profile Picture" width="50" height="50" style="border:1px solid black">
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
    <div class="slideshow-container">
        <div class="mySlides fade">
            <img src="images/ss1.png" style="width: 100%" alt="Slide 1">
        </div>
        <div class="mySlides fade">
            <img src="images/ss2.png" style="width: 100%" alt="Slide 2">
        </div>
        <div class="mySlides fade">
            <img src="images/ss3.png" style="width: 100%" alt="Slide 3">
        </div>
        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>
        <div class="alldot" style="text-align:center">
            <span class="dot" onclick="currentSlide(1)"></span> 
            <span class="dot" onclick="currentSlide(2)"></span> 
            <span class="dot" onclick="currentSlide(3)"></span> 
        </div>
    </div>
    <div id="abt" class="uhd3">
        <p class="uhp1">WEBCARE</p>
        <p class="uhp2">This checklist lists various symptoms related to your mental health. Check the box next to each symptom that matches what you’re experiencing. Once you finish, you'll receive personalized recommendations based on your responses. Your answers and results are confidentials.</p>
    </div>
    <div class="hd5">
        <p class="hp2" id="asd">What We Offer</p>
        <img class="hi3" src="images/wwo1.png">
        <img class="hi4" src="images/wwo2.png">
        <img class="hi5" src="images/wwo3.png">
    </div>
    <a href="http://127.0.0.1:5000/" class="float-button">
  <img src="images/m1.png" >
</a>
<a href="checklist.php" class="float-button1">
  <img src="images/m2.png" >
</a>

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

        let slideIndex = 0;
        showSlides();

        function plusSlides(n) {
            slideIndex += n;
            showSlides();
        }

        function currentSlide(n) {
            slideIndex = n - 1;
            showSlides();
        }

        function showSlides() {
            let i;
            let slides = document.getElementsByClassName("mySlides");
            let dots = document.getElementsByClassName("dot");
            if (slideIndex >= slides.length) { slideIndex = 0 }
            if (slideIndex < 0) { slideIndex = slides.length - 1 }
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
                slides[i].classList.remove("active-slide");
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex].style.display = "block";
            slides[slideIndex].classList.add("active-slide");
            dots[slideIndex].className += " active";
        }

        function autoShowSlides() {
            plusSlides(1);
        }

        setInterval(autoShowSlides, 3000); // Change slide every 5 seconds
    </script>
</body>
</html>
