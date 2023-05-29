<?php
include 'connect2.php';
session_start();
if(!isset($_SESSION['admin-name'])){
    header('location: login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--this external file to the icon in page-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="CSS/page-of-doctor.css">
    <title>Hospital Information System</title>
</head>

<body>
    <!-- Header -->
    <header>
        <div class="logo_image"> <img src="CSS/images/logo2.png" alt="HIS Logo" width="80" height="80"> </div>
        <a href="#" class="logo">Hospital Information System</a>
        <nav class="navigation">
            <a href="#map">The Map</a>
            <a href="#search-bar">Search</a>
            <a href="#schedule">Your Schedule</a>
            <a href="#contact">Contact</a>
            <a href="Policies.html">Policies</a>
        </nav>
    </header>

    <!-- the main -->
    <section class="main">
        <div>
            <h2>Hello, Doctor: <strong><?php echo $_SESSION['admin-name']; ?></strong> <br><span>Hospital Information System</span></h2>
            <h3>This system was created to help hospitals manage their internal affairs and assist hospital staff</h3>
            <a href="#schedule" class="main-btn">Manage my work</a>
            <div class="social-icons">
                <a href="#"><i class="fab fa-linkedin"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-youtube"></i></a>
            </div>
        </div>
    </section>

    <!-- the map -->
    <div class="map">
        <h2 class="map_text" id="map">Hospital Map</h2>
        <img class="map_img" src="CSS/images/hospital_map2.png" alt="Not Found" width="1300">
    </div>

    <!-- patient search background -->
    <div class="patient-background">

    <!-- search bar -->
        <div id="search-bar">
            <form class="search-bar">
                <label for="search">Patient search:</label>
                <input type="text" placeholder="Search by Room or ID">
                <button type="submit">Search</button>
            </form>
        </div>

    <!-- patient information table -->
        <section class="patient-information">
            <h2>Patient Information</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Room</th>
                        <th>Age</th>
                        <th>Diseases</th>
                        <th>Medications</th>
                        <th>Lap result</th>
                        <th>More Information</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Ahmed Ali</td>
                        <td>101</td>
                        <td>45</td>
                        <td>Diabetes-blood pressure</td>
                        <td>Aspirin</td>
                        <td><a href="lab-results.html">Click here</a></td>
                        <td><a href="patient-information.html">Click here</a></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Mohamed Abdallah</td>
                        <td>102</td>
                        <td>30</td>
                        <td>Diabetes-stomach ulcer</td>
                        <td>Insulin</td>
                        <td><a href="lab-results.html">Click here</a></td>
                        <td><a href="patient-information.html">Click here</a></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Sara Ayman</td>
                        <td>103</td>
                        <td>50</td>
                        <td>virus C-blood cancer</td>
                        <td>Chemotherapy</td>
                        <td><a href="lab-results.html">Click here</a></td>
                        <td><a href="patient-information.html">Click here</a></td>
                    </tr>
                </tbody>
            </table>
        </section>
    </div>

    <!-- Add medications -->
    <section class="add-medication-doses">
        <h2>Add Medication Doses</h2>
        <form>
            <fieldset>
                <legend>Patient Information</legend>
                <label for="id">ID:</label>
                <input type="text" id="id" name="id">
            </fieldset>

            <fieldset>
                <legend>Medication Information</legend>
                <label for="medication-name">Medication Name:</label>
                <input type="text" id="medication-name" name="medication-name" ><br>

                <label for="dosage">Dosage:</label>
                <input type="text" id="dosage" name="dosage" ><br>

                <label for="frequency">Frequency:</label>
                <input type="text" id="frequency" name="frequency" ><br>

                <label for="duration">Duration:</label>
                <input type="text" id="duration" name="duration" ><br>

                <label class="notes" for="note">Add Notes:</label>
                <input type="text" id="note" name="note" ><br>
            </fieldset>

            <button type="submit">Add Medication Dose</button>
        </form>
    </section>

    <!-- Add bills -->
    <section class="add-bills">
        <h2>Add Bills</h2>
        <form>
            <fieldset>
                <legend>Patient Information</legend>
                <label for="id">ID:</label>
                <input type="text" id="id" name="id">
            </fieldset>

            <fieldset>
                <legend>Bills Information</legend>
                <label for="bill-amount">Bill Amount:</label>
                <input type="text" id="bill-amount" name="bill-amount" required><br>

                <label for="bill-description">Bill Description:</label>
                <input type="text" id="bill-description" name="bill-description" required><br>

                <label for="bill-date">Bill Date:</label>
                <input type="date" id="bill-date" name="bill-date" required><br>
            </fieldset>

            <button type="submit">Add Medication Dose</button>
        </form>
    </section>

    <!-- The set schedule -->
    <section class="schedule" id="schedule">
        <div class="content">
            <section class="schedule-management">
                <h2>Manage Doctor's Schedule</h2>
                <form>
                    <fieldset>
                        <legend>Set Your Availability</legend>
                        <label for="start-date">Start Date:</label>
                        <input type="date" id="start-date" name="start-date" required><br>
    
                        <label for="end-date">End Date:</label>
                        <input type="date" id="end-date" name="end-date" required><br>
    
                        <label for="start-time">Start Time:</label>
                        <input type="time" id="start-time" name="start-time" required><br>
    
                        <label for="end-time">End Time:</label>
                        <input type="time" id="end-time" name="end-time" required><br>
                    </fieldset>
    
                    <button type="submit">Set Availability</button>
                </form>
                <hr>
    <!-- the table schedule -->
                <h3>Your Schedule</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>May 10, 2023</td>
                            <td>10:00am</td>
                            <td>11:00am</td>
                            <td>
                                <button>Edit</button>
                                <button>Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td>May 11, 2023</td>
                            <td>2:00pm</td>
                            <td>3:00pm</td>
                            <td>
                                <button>Edit</button>
                                <button>Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td>May 12, 2023</td>
                            <td>9:00am</td>
                            <td>10:00am</td>
                            <td>
                                <button>Edit</button>
                                <button>Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </section>
            
        </div>
    </section>

    <!-- The Contact -->
    <section class="cards contact" id="contact">
        <h2 class="title">Contact the Administration</h2>
        <div class="content">
            <div class="card">
                <div class="icon">
                    <i class="fas fa-phone"></i>
                </div>
                <div class="info">
                    <h3>Phone</h3>
                    <p>0122222222</p>
                </div>
            </div>
            <div class="card">
                <div class="icon">
                    <i class="fas fa-envelope"></i>
                </div>
                <div class="info">
                    <h3>Email</h3>
                    <p>HIS@gmail.com</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <p class="footer-title">Copyrights @ <span>HIS</span></p>
        <div class="social-icons">
            <a href="#"><i class="fab fa-linkedin"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-youtube"></i></a>
        </div>
    </footer>

</body>
</html>