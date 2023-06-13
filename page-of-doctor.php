<?php
include 'connect2.php';
session_start();
if (!isset($_SESSION['admin-name'])) {
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
            <h2>Hello, Doctor: <strong><?php echo $_SESSION['admin-name']; ?></strong> <br><span>Hospital Information
                    System</span></h2>
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
            <form class="search-bar" action="page-of-doctor.php#search-bar" method="post">
                <label for="search">Patient search:</label>
                <input type="text" name="search" placeholder="Search by Room or ID">
                <button type="submit" name="search1">Search</button>
            </form>
        </div>

        <!-- patient information table -->
        <section class="patient-information">
            <h2>Patient Information</h2>
            <?php



            if (isset($_POST['search1'])) {


                $st = $_POST['search'];
                $myquery = "SELECT patient.* , payment_details.BillAmount FROM patient INNER JOIN payment_details  on patient.PID=payment_details.p_id WHERE PID like '$st'";
                //   " SELECT * FROM patient  where PID like '%$st%'";
                //   $myquery2=" SELECT * FROM accountant where patient_id like '%$st%'";
                $result = mysqli_query($conn, $myquery);
                while ($row = mysqli_fetch_array($result)) {
                    // code...


            ?>
            <table>

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Room</th>
                        <th>Birthdate</th>
                        <th>Patient bill</th>
                        <th>More Information</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php print_r($row['PID']);  ?></td>
                        <td><?php print_r($row['firstname']) . "" . print_r($row['lastname']); ?></td>
                        <td><?php print_r($row['room']); ?></td>
                        <td><?php print_r($row['birthdate']); ?></td>
                        <td><?php print_r($row['BillAmount']); ?></td>
                        <td><a href="patient-information.php">
                                <?php
                                        $_SESSION['patient-case'] = $row['case'];
                                        $_SESSION['patient-name'] = $row['firstname'];
                                        $_SESSION['patient-gender'] = $row['gender'];
                                        $_SESSION['patient-age'] = $row['age'];
                                        $_SESSION['patient-address'] = $row['address'];
                                        $_SESSION['patient-phone'] = $row['phone'];
                                        $_SESSION['patient-email'] = $row['email'];
                                        $_SESSION['patient-Bill'] = $row['BillAmount'];




                                        ?>
                                Click here</a></td>
                    </tr>
            </table>
            <?php
                }
            }


            ?>
        </section>
    </div>

    <?php
    if (isset($_POST['submit'])) {
        $PID = $_POST["PID"];
        $Result = mysqli_query($conn, "SELECT * FROM patient  WHERE PID='$PID'");
        $Result1 = mysqli_query($conn, "SELECT * FROM medicine");
        $row = mysqli_fetch_array($Result);
        if (mysqli_num_rows($Result) > 0) {
            $row1 = mysqli_fetch_array($Result1);
            if (mysqli_num_rows($Result1) > 0) {
                if ($PID == $row['PID']) {
                    $PIS = mysqli_real_escape_string($conn, $_POST['PID']);
                    $MedicationName = mysqli_real_escape_string($conn, $_POST['MedicationName']);
                    $Frequency = mysqli_real_escape_string($conn, $_POST['Frequency']);
                    $Duration = mysqli_real_escape_string($conn, $_POST['Duration']);
                    $dosage = mysqli_real_escape_string($conn, $_POST['dosage']);
                    $price = mysqli_real_escape_string($conn, $_POST['price']);
                    $Querys = mysqli_query($conn, "INSERT INTO medicine VALUES('','$MedicationName','$Frequency','$Duration','$dosage','$price','$PID')");
                    echo
                    "<script> alert('MED Added Successfully'); </script>";
                }
            }
        } else {
            echo
            "<script> alert('ID Doesnt Match'); </script>";
        }
    }
    ?>
    <!-- Add medications -->
    <section class="add-medication-doses">
        <h2>Add Medication Doses</h2>
        <form action="page-of-doctor.php" method="post">
            <fieldset>
                <legend>Patient Information</legend>
                <label for="PID">ID:</label>
                <input type="text" id="PID" name="PID">
            </fieldset>

            <fieldset>
                <legend>MedicationName</legend>
                <label for="MedicationName">MedicationName:</label>
                <input type="text" id="MedicationName" name="MedicationName" required><br>

                <label for="Frequency">Frequency:</label>
                <input type="text" id="Frequency" name="Frequency" required><br>

                <label for="Duration">Duration:</label>
                <input type="text" id="Duration" name="Duration" required><br>

                <label for="dosage">dosage:</label>
                <input type="text" id="dosage" name="dosage" required><br>

                <label for="price">price:</label>
                <input type="text" id="price" name="price" required><br>


            </fieldset>
            <button type="submit" name="submit" id="submit">Add Med</button>

        </form>
    </section>
    <?php
    if (isset($_POST['add'])) {
        $PID = $_POST["PID"];
        $acc_id = $_POST["acc_id"];
        $Result = mysqli_query($conn, "SELECT * FROM patient  WHERE PID='$PID'");
        $Result1 = mysqli_query($conn, "SELECT * FROM accountant  WHERE ID='$acc_id'");
        $row = mysqli_fetch_array($Result);
        if (mysqli_num_rows($Result) > 0) {
            $row1 = mysqli_fetch_array($Result1);
            if (mysqli_num_rows($Result1) > 0) {
                if ($PID == $row['PID']) {
                    $PID = mysqli_real_escape_string($conn, $_POST['PID']);
                    $acc_id = mysqli_real_escape_string($conn, $_POST['acc_id']);
                    $BillAmount = mysqli_real_escape_string($conn, $_POST['BillAmount']);
                    $BillDescription = mysqli_real_escape_string($conn, $_POST['BillDescription']);
                    $BillDate = mysqli_real_escape_string($conn, $_POST['BillDate']);
                    $Query = mysqli_query($conn, "INSERT INTO payment_details VALUES('','$BillAmount','$PID','$acc_id','$BillDescription','$BillDate')");
                    echo
                    "<script> alert('Bill Added Successfully'); </script>";
                } else {
                    echo
                    "<script> alert('ID Doesnt Match'); </script>";
                }
            }
        }
    }
    ?>
    <!-- Add bills -->
    <section class="add-bills">
        <h2>Add Bills</h2>
        <form method="post">
            <fieldset>
                <legend>Patient Information</legend>
                <label for="PID">ID:</label>
                <input type="text" id="PID" name="PID">
                <br>
                <label for="acc_id">acc_id:</label>
                <input type="text" id="acc_id" name="acc_id">
            </fieldset>

            <fieldset>
                <legend>Bills Information</legend>
                <label for="BillAmount">Bill Amount:</label>
                <input type="number" id="BillAmount" name="BillAmount" required><br>

                <label for="BillDescription">Bill Description:</label>
                <input type="text" id="BillDescription" name="BillDescription" required><br>

                <label for="BillDate">Bill Date:</label>
                <input type="date" id="BillDate" name="BillDate" required>
            </fieldset>

            <button type="submit" name="add">Add Bill</button>
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