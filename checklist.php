<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mental Health Assessment</title>
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="userhome.css">
    <link rel="stylesheet" href="checklist1.css">
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
        .category-section {
    margin-bottom: 20px;
}

.category-section label {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
    cursor: pointer;
}

.category-section input[type="checkbox"] {
    margin-right: 10px; /* Space between checkbox and label */
    cursor: pointer;
    width: 20px; /* Set a specific width for better alignment */
    height: 20px; /* Set a specific height for better alignment */
}

        body {
            background-color: #F5F7F5;
            font-family: 'Lato', sans-serif;
        }

        .cd1 {
            background-color: #FFFFFF;
            margin: 0 auto;
            width: 1100px;
            box-shadow: 0 4px 8px rgba(0, 0.2, 0.2, 0.3);
            border-radius: 40px;
            padding: 20px;
            position: relative;
            top: 100px;
        }

        .cp1 {
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 20px;
            font-family: 'Raleway', sans-serif;
            color: #325343;
        }

        .ci1 {
            width: 100%;
            display: block;
            margin-bottom: 20px;
            border-top-left-radius: 40px;
            border-top-right-radius: 40px;
        }

        .symptoms-table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        .symptoms-table td {
            vertical-align: top;
            width: 50%;
            padding: 20px;
        }

        .category-header {
            font-size: 18px;
            font-family: 'Rowdies', sans-serif;
            color: #00796b;
            margin-bottom: 10px;
            padding-bottom: 5px;
            border-bottom: 1px solid #ccc;
        }

        .category-section {
            margin-bottom: 20px;
        }

        .category-section label {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            cursor: pointer;
        }

        .category-section input[type="checkbox"] {
            margin-right: 10px;
            transform: scale(1.2);
            cursor: pointer;
        }

        button {
            display: block;
            margin: 40px auto;
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
            height: 430px;
            background-color: #fff;
            position: absolute;
            top: 30px;
            left: 197px;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 70%;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
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


        .mr{
            /* position: absolute;
            top: 120px;
            left: 50px; */
            text-align:center;
            font-family: 'Lato', sans-serif;
            font-size: 16px;
            color: black;
        }
    
            .resi {
    font-size: 40px; /* Change this to your desired size */
    text-align: center; /* Center the text */
    margin: 10px 0; /* Optional: add some margin for spacing */
    font-family: 'Satisfy', sans-serif;
}
.rd1 p {
    margin: 0;
    padding: 0;
}
        .rd1{
            background-color: #ADBC9F;
            height: 300px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .dd1{
            width: 350px;
            height: 300px;
            position: absolute;
            margin-top: 0px;
            margin-left: 0px;
            display: flex;
            justify-content: center; /* Center horizontally */
    align-items: center; /* Center vertically */
    text-align: center;
        }
        .l1{
            border-left: 2px solid black;
            height: 290px;
            position: absolute;
            margin-top: 5px;
            margin-left: 350px;
        }
        .dd2{
            width: 350px;
            height: 300px;
            position: absolute;
            margin-top: 0px;
            margin-left: 352px;
            display: flex;
            justify-content: center; /* Center horizontally */
    align-items: center; /* Center vertically */
    text-align: center;
        }
        .l2{
            border-left: 2px solid black;
            height: 290px;
            position: absolute;
            margin-top: 5px;
            margin-left: 702px;
        }
        .dd3{
            padding: px;
            width: 340px;
            height: 300px;
            position: absolute;
            margin-top: 0px;
            margin-left: 709px;
            display: flex;
            justify-content: center; /* Center horizontally */
    align-items: center; /* Center vertically */
    text-align: center;
        }
        .rp1{
            color: #1E201E;
            position: absolute;
            top: 120px;
            text-align: center;
        }
        .rp2 {
            position: absolute;
            top: 140px;
            font-family: 'Assisstant', sans-serif;
}
.rp3{
    color: #1E201E;
            position: absolute;
            top: 120px;
            text-align: center;
        }
        .rp4 {
    position: absolute;
    top: 140px;
    font-family: 'Assisstant', sans-serif;

}
.rp5{
    color: #1E201E;
            position: absolute;
            top: 120px;
            text-align: center;
        }
        .rp6 {
            position: absolute;
            top: 140px;
            font-family: 'Assisstant', sans-serif;
}
.rp7{
    font-size: 20px;
}
.ri1{
    position: absolute;
    top: 25px;
    height: 80px;
    width: 80px;
}
.ri2{
    position: absolute;
    top: 23px;
    height: 85px;
    weight: 85px;
}
.ri3{
    position: absolute;
    top: 25px;
    height: 85px;
    weight: 85px;
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

    <div class="cd1">
        <img src="images/ci4.png" class="ci1">
        <p class="cp1">This checklist lists various symptoms related to your mental health. Check the box next to each symptom that matches what you’re experiencing. Once you finish, you'll receive personalized recommendations based on your responses. Your answers and results are confidentials.</p>
        <form id="assessmentForm">
            <div id="checkboxes"></div>
            <button type="button" id="submitBtn" onclick="assessMentalHealth()">Submit</button>
        </form>
    </div>

    <div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <p class="resi">Your Result Are Ready!</p>
        <p class="mr" id="modalResults"></p>
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

        async function fetchData() {
            try {
                const response = await fetch('http://localhost:5000/get_data');
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

            const table = document.createElement('table');
            table.classList.add('symptoms-table');
            const tbody = document.createElement('tbody');
            const categoryKeys = Object.keys(categories);
            const halfIndex = Math.ceil(categoryKeys.length / 2);

            for (let i = 0; i < halfIndex; i++) {
                const row = document.createElement('tr');
                const leftCategory = categoryKeys[i];
                const leftTd = createCategoryColumn(categories[leftCategory]);
                row.appendChild(leftTd);

                const rightCategory = categoryKeys[i + halfIndex];
                if (rightCategory) {
                    const rightTd = createCategoryColumn(categories[rightCategory]);
                    row.appendChild(rightTd);
                }

                tbody.appendChild(row);
            }

            table.appendChild(tbody);
            checkboxesDiv.appendChild(table);
        }

        function createCategoryColumn(categoryItems) {
            const td = document.createElement('td');
            td.classList.add('category-column');

            const header = document.createElement('h3');
            header.classList.add('category-header');
            header.textContent = categoryItems[0].category;
            td.appendChild(header);

            categoryItems.forEach(item => {
                const isChecked = checkedSymptoms.has(item.symptom);
                const label = document.createElement('label');
                label.innerHTML = `<input type="checkbox" name="symptom" value="${item.symptom}" ${isChecked ? 'checked' : ''}> ${item.symptom}`;
                 label.style.display = 'flex';
                td.appendChild(label);
            });

            return td;
        }

        function assessMentalHealth() {
            const form = document.getElementById("assessmentForm");
            const checkboxes = form.querySelectorAll('input[name="symptom"]:checked');
            const symptoms = Array.from(checkboxes).map(cb => cb.value);

            fetch('http://localhost:5000/submit', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ symptoms })
            })
            .then(response => response.json())
            .then(result => {
                const modal = document.getElementById("myModal");
                const modalResults = document.getElementById("modalResults");
                modalResults.innerHTML = `<div class="rd1"><div class="dd1"><img src="./images/ri1.png" class="ri1"><p class="rp1">You might have a symptom of </p> <p class="rp2">${result.disorder}</p></div><div class="l1"></div><div class="dd2"><img src="./images/ri2.png" class="ri2"><p class="rp3">Possible Conditions <p class="rp4">${result.condition}</p></p></div><div class="l2"></div><div class="dd3"><img src="./images/ri3.png" class="ri3"><p class="rp5">Interventions </p><p class="rp6">${result.intervention}</p></div></div><p class="rp7">Support Links: <a href="${result.links}">${result.links}</a></p>`;
                modal.style.display = "block";
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

        document.addEventListener('DOMContentLoaded', fetchData);
    </script>
</body>
</html>
