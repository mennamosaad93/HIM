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
    <link rel="stylesheet" href="css/page-of-accountant.css">
    <title>Hospital Information System</title>
</head>

<body>

    <!-- Header -->
    <header>
        <div class="logo_image"> <img src="css/images/logo2.png" alt="HIS Logo" width="80" height="80"> </div>
        <a href="#" class="logo">Hospital Information System</a>
        <nav class="navigation">
            <a href="#map">The Map</a>
            <a href="#Patient-Search">Patient Search</a>
            <a href="#Staff-Search">Staff Search</a>
            <a href="#contact">Contact</a>
            <a href="Policies.html">Policies</a>
            <a href="qr.php">QR Generator</a>
            <a href="logout.php">Logout</a>
        </nav>
    </header>

    <!-- the main -->
    <section class="main">
        <div>
            <h2>Hello, Accountant: <strong><?php echo $_SESSION['admin-name']; ?><br><span>Hospital Information
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

    <!-- patient background -->
    <div class="patient-background" id="Patient-Search">

        <!-- search bar -->
        <div id="patient-search-bar">
            <form class="patient-search-bar" method="post" action="page-of-accountant.php#Patient-Search">
                <label for="search">Patient search:</label>
                <input type="text" name="search" placeholder="Search by Room or ID">
                <button class="patient-button" type="submit" name="search1">Search</button>
            </form>
        </div>

        <!-- patient information -->
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
                        <td><?php print_r($row['firstname']); ?></td>
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
                <label for="acc_id">Acc. ID:</label>
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

    <!-- staff section background -->
    <div class="staff-background" id="Staff-Search">
        <!-- staff search bar -->
        <div id="staff-search-bar">
            <form method="post" action="page-of-accountant.php#staff-search-bar" class="staff-search-bar">
                <label for="search">Staff search:</label>
                <input type="text" name="Staff-S1" placeholder="Search by ID">
                <button type="submit" name="Staff-S">Search</button>
            </form>
        </div>
        <!-- staff information -->
        <section class="staff-information">
            <h2>Staff Information</h2>
            <?php
            if (isset($_POST['Staff-S'])) {


                $st = $_POST['Staff-S1'];
                $myquery = " SELECT * FROM employee  where PID like '$st'";
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
                        <th>Gender</th>
                        <th>The Department</th>
                        <th>Age</th>
                        <th>More Information</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php print_r($row['PID']);  ?></td>
                        <td><?php print_r($row['firstname']) . print_r($row['lastname']);  ?></td>
                        <td><?php print_r($row['gender']);  ?></td>
                        <td><?php print_r($row['department']);  ?></td>
                        <td><?php print_r($row['birthdate']);  ?></td>
                        <td><a href="staff-information.php">
                                <?php
                                        $_SESSION['employee-firstname'] = $row['firstname'];
                                        $_SESSION['employee-lastname'] = $row['lastname'];
                                        $_SESSION['employee-gender'] = $row['gender'];
                                        $_SESSION['employee-age'] = $row['birthdate'];
                                        $_SESSION['employee-address'] = $row['address'];
                                        $_SESSION['employee-phone'] = $row['phone'];
                                        $_SESSION['employee-email'] = $row['emaill'];
                                        $_SESSION['employee-Dep'] = $row['department'];
                                        $_SESSION['employee-salary'] = $row['salary'];
                                        $_SESSION['employee-Qualifications'] = $row['qualifications'];




                                        ?>
                                Click here</a></td>
                    </tr>
                </tbody>
            </table>
            <?php
                }
            }
            // else{
            //     echo "ID doesnt exist";
            // }


            ?>
        </section>
    </div>

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