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
    <title>Mental Health Assessment</title>
    <!-- Bootstrap 5.3 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- <link rel="stylesheet" href="home.css"> -->
    <!-- <link rel="stylesheet" href="userhome.css"> -->
    <!-- <link rel="stylesheet" href="checklist1.css"> -->
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Seymour+One' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Kalam' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Paytone+One' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Rowdies' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Satisfy' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Calistoga' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=New+Amsterdam' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Assisstant' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Kanit' rel='stylesheet'>
    <style>
        /* NAVBAR */
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

        /* Table Data */
        /* Custom CSS for responsive table cells */
        @media (max-width: 767.98px) {

            /* Bootstrap's breakpoint for "sm" and below */
            .left-td,
            .right-td {
                width: 100% !important;
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid p-0 m-0">
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
                            <li><a class="dropdown-item" href="settings.php">Settings</a></li>
                            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                        </ul>
                    </div>

                </ul>
            </div>
        </nav>

        <!-- CONTENT AND CHECKBOXES -->
        <div class="container mt-4">
            <img src="images/ci4.png" class="img-fluid rounded-4">
            <p class="cp1">This checklist lists various symptoms related to your mental health. Check the box next to each symptom that matches what you’re experiencing. Once you finish, you'll receive personalized recommendations based on your responses. Your answers and results are confidentials.</p>
            <form id="assessmentForm">
                <div id="checkboxes"></div>
                <div class="d-flex justify-content-center">
                    <button class="btn btn-success btn-sm w-25 mb-2" type="button" id="submitBtn" onclick="assessMentalHealth()">Submit</button>
                </div>
            </form>
        </div>

        <!-- NEW Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Your Result Are Ready!</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="modalResults">
                        <!-- append result here (pagka call ng API) -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleDropdown() {
            var dropdownContent = document.getElementById("dropdownContent");
            dropdownContent.style.display = dropdownContent.style.display === "block" ? "none" : "block";
        }

        window.onclick = function(event) {
            if (!event.target.matches('.profile1')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                for (var i = 0; i < dropdowns.length; i++) {
                    if (dropdowns[i].style.display === "block") {
                        dropdowns[i].style.display = "none";
                    }
                }
            }
        }

        let symptomsData = [];
        let checkedSymptoms = new Set();

        // Load Checkbox Lists
        async function fetchData() {
            try {
                const response = await fetch('https://webcare-chatbot.onrender.com/get_data');
                const data = await response.json();
                symptomsData = data;
                updateCheckboxes();
            } catch (error) {
                console.error('Error fetching data:', error);
            }
        }

        function updateCheckboxes() {
            const checkboxesDiv = document.getElementById('checkboxes');
            checkboxesDiv.innerHTML = '';

            const categories = symptomsData.reduce((acc, item) => {
                if (!acc[item.category]) {
                    acc[item.category] = [];
                }
                acc[item.category].push(item);
                return acc;
            }, {});

            const tableContainer = document.createElement('div');
            tableContainer.classList.add('table-responsive');

            const table = document.createElement('table');
            table.classList.add('table', 'table-bordered', 'symptoms-table');

            const tbody = document.createElement('tbody');
            const categoryKeys = Object.keys(categories);
            const halfIndex = Math.ceil(categoryKeys.length / 2);

            for (let i = 0; i < halfIndex; i++) {
                const row = document.createElement('tr');

                const leftCategory = categoryKeys[i];
                const leftTd = createCategoryColumn(categories[leftCategory]);
                // Add classes for responsive design
                leftTd.classList.add('d-flex', 'flex-column', 'd-md-table-cell', 'left-td', 'border-top', 'border-end-0', 'border-bottom-0', 'border-start-0');

                row.appendChild(leftTd);

                const rightCategory = categoryKeys[i + halfIndex];
                if (rightCategory) {
                    const rightTd = createCategoryColumn(categories[rightCategory]);
                    // Add classes for responsive design
                    rightTd.classList.add('d-flex', 'flex-column', 'd-md-table-cell', 'right-td', 'border-top', 'border-end-0', 'border-bottom-0', 'border-start-0');
                    row.appendChild(rightTd);
                }

                tbody.appendChild(row);
            }


            table.appendChild(tbody);
            tableContainer.appendChild(table);
            checkboxesDiv.appendChild(tableContainer);
        }


        function createCategoryColumn(categoryItems) {
            const td = document.createElement('td');
            td.classList.add('flex');

            const header = document.createElement('h3');
            header.classList.add('text-success', 'fw-bold');
            header.textContent = categoryItems[0].category;
            td.appendChild(header);

            categoryItems.forEach(item => {
                const isChecked = checkedSymptoms.has(item.symptom);
                const label = document.createElement('label');
                label.innerHTML = `<input type="checkbox" name="symptom" value="${item.symptom}" ${isChecked ? 'checked' : ''}> ${item.symptom}`;
                // label.style.display = 'flex';
                label.classList.add('d-flex');
                td.appendChild(label);
            });

            return td;
        }

        // function assessMentalHealth() {
        //     const form = document.getElementById("assessmentForm");
        //     const checkboxes = form.querySelectorAll('input[name="symptom"]:checked');
        //     const symptoms = Array.from(checkboxes).map(cb => cb.value);

        //     fetch('https://webcare-chatbot.onrender.com/submit', {
        //             method: 'POST',
        //             headers: {
        //                 'Content-Type': 'application/json'
        //             },
        //             body: JSON.stringify({
        //                 symptoms
        //             })
        //         })
        //         .then(response => response.json())
        //         .then(result => {
        //             const modal = document.getElementById("myModal");
        //             const modalResults = document.getElementById("modalResults");
        //             modalResults.innerHTML = `<div class="rd1"><div class="dd1"><img src="./images/ri1.png" class="ri1"><p class="rp1">You might have a symptom of </p> <p class="rp2">${result.disorder}</p></div><div class="l1"></div><div class="dd2"><img src="./images/ri2.png" class="ri2"><p class="rp3">Possible Conditions <p class="rp4">${result.condition}</p></p></div><div class="l2"></div><div class="dd3"><img src="./images/ri3.png" class="ri3"><p class="rp5">Interventions </p><p class="rp6">${result.intervention}</p></div></div><p class="rp7">Support Links: <a href="${result.links}">${result.links}</a></p>`;
        //             modal.style.display = "block";
        //         })
        //         .catch(error => console.error('Error processing data:', error));
        // }

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
                    const modalResults = document.getElementById("modalResults");
                    modalResults.innerHTML = `
                <div class="d-flex flex-wrap justify-content-center gap-2">
                    <div class="card" style="width: 18rem;">
                        <img src="./images/ri1.png" class="card-img-top img-fluid" >
                        <div class="card-body">
                            <p class="card-text text-decoration-underline fw-semibold">You might have a symptom of</p>
                            <p class="card-text">${result.disorder}</p>
                        </div>
                    </div>

                     <div class="card" style="width: 18rem;">
                        <img src="./images/ri2.png" class="card-img-top img-fluid" >
                        <div class="card-body">
                            <p class="card-text text-decoration-underline fw-semibold">Possible Conditions</p>
                            <p class="card-text">${result.condition}</p>
                        </div>
                    </div>

                    <div class="card" style="width: 18rem;">
                        <img src="./images/ri3.png" class="card-img-top img-fluid" >
                        <div class="card-body">
                            <p class="card-text text-decoration-underline fw-semibold">Interventions</p>
                            <p class="card-text">${result.intervention}</p>
                        </div>
                    </div>

                </div>
                <p class="text-center mt-4">Support Links: <a href="${result.links}">${result.links}</a></p>
            `;

                    // Open the new Bootstrap modal
                    const newModal = new bootstrap.Modal(document.getElementById('exampleModal'));
                    newModal.show();
                })
                .catch(error => console.error('Error processing data:', error));
        }

        function closeModal() {
            var modal = document.getElementById("myModal");
            modal.style.display = "none";
        }

        document.getElementById('checkboxes').addEventListener('change', (event) => {
            if (event.target.name === 'symptom') {
                if (event.target.checked) {
                    checkedSymptoms.add(event.target.value);
                } else {
                    checkedSymptoms.delete(event.target.value);
                }
            }
        });

        // Load the Checkboxes
        document.addEventListener('DOMContentLoaded', fetchData);
    </script>
    <!-- Bootstrap 5.3 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>