<!DOCTYPE html>
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
    <style>
        .checkboxes label {
            display: block;
            margin-bottom: 10px;
            font-family: 'Lato', sans-serif;
        }

        .cd1 {
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .cp1 {
            font-size: 18px;
            line-height: 1.5;
            margin-bottom: 20px;
            font-family: 'Raleway', sans-serif;
        }

        #results {
            margin-top: 160px;
            padding: 20px;
            background-color: #e0f7fa;
            border-radius: 10px;
            font-family: 'Kalam', cursive;
            font-size: 16px;
            line-height: 1.5;
        }

        #results h2 {
            font-family: 'Paytone One', sans-serif;
            color: #00796b;
        }

        button {
            display: block;
            margin-top: 40px;
            padding: 10px 20px;
            background-color: #00796b;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-family: 'Seymour One', sans-serif;
        }

        button:hover {
            background-color: #004d40;
        }

        .checkboxes {
            margin-top: 700px;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fff;
            margin: 5% auto;
            padding: 30px;
            border: 1px solid #888;
            width: 80%;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            animation: fadeIn 0.5s, slideUp 0.5s;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes slideUp {
            from {
                transform: translateY(50px);
            }

            to {
                transform: translateY(0);
            }
        }

        /* Additional Styles for Modal Content */
        .modal-content h2 {
            font-family: 'Paytone One', sans-serif;
            color: #00796b;
            text-align: center;
            margin-bottom: 20px;
        }

        .modal-content p {
            font-family: 'Lato', sans-serif;
            font-size: 16px;
            line-height: 1.6;
            color: #333;
        }

        .modal-content p span {
            font-weight: bold;
            color: #00796b;
        }
    </style>
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
        <p class="cp1">This checklist lists various symptoms related to your mental health. Check the box next to each symptom that matches what you’re experiencing. Once you finish, you'll receive personalized recommendations based on your responses. Your answers and results are confidential.</p>

        <!-- Symptom Checklist -->
        <form id="assessmentForm">
            <div class="checkboxes" id="checkboxes"></div>
            <button type="button" onclick="assessMentalHealth()">Submit</button>
        </form>
    </div>

    <!-- The Modal -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Results</h2>
            <div id="modalResults"></div>
        </div>
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

        async function fetchData() {
            try {
                const response = await fetch('https://webcare-chatbot.onrender.com/get_data');
                const data = await response.json();
                populateCheckboxes(data);
            } catch (error) {
                console.error('Error fetching data:', error);
            }
        }

        function populateCheckboxes(data) {
            const checkboxesDiv = document.getElementById('checkboxes');
            data.forEach(item => {
                const label = document.createElement('label');
                label.innerHTML = `<input type="checkbox" name="symptom" value="${item.symptom}"> ${item.symptom}`;
                checkboxesDiv.appendChild(label);
            });
        }

        function assessMentalHealth() {
            const form = document.getElementById("assessmentForm");
            const checkboxes = form.querySelectorAll('input[name="symptom"]:checked');
            const symptoms = Array.from(checkboxes).map(cb => cb.value);

            fetch('https://webcare-chatbot.onrender.com/submit', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        symptoms
                    })
                })
                .then(response => response.json())
                .then(result => {
                    const modal = document.getElementById("myModal");
                    const modalResults = document.getElementById("modalResults");
                    modalResults.innerHTML = `<p><span>Condition:</span> ${result.condition}</p><p><span>Disorder:</span> ${result.disorder}</p><p><span>Intervention:</span> ${result.intervention}</p>`;
                    modal.style.display = "block";
                })
                .catch(error => console.error('Error processing data:', error));
        }

        function closeModal() {
            var modal = document.getElementById("myModal");
            modal.style.display = "none";
        }

        document.addEventListener('DOMContentLoaded', fetchData);
    </script>
</body>

</html>