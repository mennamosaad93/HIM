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
<link rel="Website Icon" href="css/images/logo2.png" type="png" >

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--this external file to the icon in page-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/page-of-nurse.css">
    <title>Hospital Information System</title>
</head>

<body>
    <!-- Header -->
    <header>
        <div class="logo_image"> <img src="css/images/logo2.png" alt="HIS Logo" width="80" height="80"> </div>
        <a href="#" class="logo">Hospital Information System</a>
        <nav class="navigation">
            <a href="#map">The Map</a>
            <a href="#search-bar">Search</a>
            <a href="#schedule">Your Schedule</a>
            <a href="#contact">Contact</a>
            <a href="Policies.html">Policies</a>
            <a href="logout.php">Logout</a>
        </nav>
    </header>

    <!-- the main -->
    <section class="main">
        <div>
            <h2>Hello, Nurse: <strong><?php echo $_SESSION['admin-name']; ?></strong> <br><span>Hospital Information
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
        <img class="map_img" src="CSS/Images/hospital_map2.png" alt="Not Found" width="1300">
    </div>

    <!-- patient search background -->
    <div class="patient-background">
        <!-- search bar -->
        <div id="search-bar">
            <form class="search-bar" action="page-of-nurse.php#search-bar" method="post">
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
        if(isset($_POST['ADD'])){
            $PID = $_POST["PID"];
            $Result = mysqli_query($conn, "SELECT * FROM patient WHERE PID='$PID'" );
            // $Result1 = mysqli_query($conn, "SELECT * FROM nurse  WHERE nurse_id='$nurse_id'");
            $row = mysqli_fetch_array($Result);
            if(mysqli_num_rows($Result) > 0 ){
                // $row1 = mysqli_fetch_array($Result1);
                // if(mysqli_num_rows($Result1) > 0){
                if($PID == $row['PID']){
                    $Notes = mysqli_real_escape_string($conn,$_POST['Notes']);
                    $Query = mysqli_query($conn, "INSERT INTO nursenotes VALUES('','$PID','$Notes')");
                    echo 
                         "<script> alert('Note Added Successfully'); </script>";
                }else{
                    echo 
                    "<script> alert('ID Doesnt Match'); </script>";
                  }
                }
            }
        
        // }
    ?>


    <!-- Add notes -->
    <section class="add-notes">
        <h2>Add notes to the patient</h2>
        <form method="post">
            <fieldset>
                <legend>Patient Information</legend>
                <label for="PID">ID:</label>
                <input type="text" id="PID" name="PID">
            </fieldset>

            <fieldset>
                <legend>Add Notes</legend>
                <label for="Notes">The Notes:</label>
                <input type="text" id="Notes" name="Notes" required><br>
            </fieldset>

            <button type="submit" name="ADD">Add notes</button>
        </form>
    </section>
    <?php 
    if(isset($_POST['SetTime'])){
        $PID = $_POST["PID"];
        $Result = mysqli_query($conn, "SELECT employee.PID, clinic_schedule.*  FROM employee INNER JOIN clinic_schedule ON employee.PID=clinic_schedule.nurseID WHERE PID='$PID'" );
        $row = mysqli_fetch_array($Result);
        if(mysqli_num_rows($Result) > 0 ){
            if($PID == $row['PID']){
                $PID = mysqli_real_escape_string($conn,$_POST['PID']);
                $StartDate = mysqli_real_escape_string($conn,$_POST['StartDate']);
                $EndDate = mysqli_real_escape_string($conn,$_POST['EndDate']);
                $StartTime = mysqli_real_escape_string($conn,$_POST['StartTime']);
                $EndTime = mysqli_real_escape_string($conn,$_POST['EndTime']);
                $Query = mysqli_query($conn, "INSERT INTO clinic_schedule VALUES('','$PID','$StartDate','$EndDate','$StartTime','$EndTime')");
                echo 
                     "<script> alert('SCH Added Successfully'); </script>";
            }
            }else{
                echo 
                "<script> alert('ID Doesnt Match'); </script>";
              }
        }
    
    
    ?>



    ?>
    <!-- The schedule -->
    <section class="schedule" id="schedule">
        <div class="content">
            <section class="schedule-management">
                <h2>Manage Nurse's Schedule</h2>
                <form method="post" action="page-of-nurse.php#schedule">
                    <fieldset>
                        <legend>Nurse Id:</legend>
                        <input type="text" id="PID" name="PID" required><br>


                        <legend>Set Your Availability</legend>
                        <label for="StartDate">Start Date:</label>
                        <input type="date" id="StartDate" name="StartDate" required><br>

                        <label for="EndDate">End Date:</label>
                        <input type="date" id="EndDate" name="EndDate" required><br>

                        <label for="StartTime">Start Time:</label>
                        <input type="time" id="StartTime" name="StartTime" required><br>

                        <label for="EndTime">End Time:</label>
                        <input type="time" id="EndTime" name="EndTime" required><br>
                    </fieldset>

                    <button type="submit" name="SetTime">Set Availability</button>
                </form>
                <hr>
                <!-- set nurse schedule -->
                <h3>Your Schedule</h3>
                <?php
                    if (isset($_SESSION['status'])){

                        echo "<h4>".$_SESSION['status']."</h4>";
                        unset($_SESSION['status']);

                    }


                ?>
                <form method="post" action="delete.php">
                    <table>
                        <thead>
                            <tr>
                                <th>
                                    <button type="submit" name="delete">Delete</button>
                                </th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                            </tr>
                        </thead>
                        <?php

                        $query2 = "SELECT * FROM clinic_schedule";
                        $data = mysqli_query($conn, $query2);
                        $results = mysqli_num_rows($data);
                        if ($results) {
                            // while ($row = mysqli_fetch_array($data)) {
                            //     $id=$row['Sch_ID'];
                            foreach ($data as $row) {




                        ?>

                        <tbody>
                            <tr>
                                <td>
                                    <input type="checkbox" name="stud_delete_id[]" value="<?= $row['Sch_ID']; ?>">
                                </td>
                                <td><?= $row['start_date']; ?></td>
                                <td><?= $row['end_date']; ?></td>
                                <td><?= $row['start_time']; ?></td>
                                <td><?= $row['end_time']; ?></td>
                            </tr>
                        </tbody>
                        <?php }
                        } ?>
                    </table>
                </form>
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