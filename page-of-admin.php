<?php
include 'connection.php';
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
    <link rel="stylesheet" href="CSS/page-of-admin.css">
    <title>Hospital Information System</title>
</head>

<body>
    <!-- Header -->
    <header>
        <div class="logo_image"> <img src="css/images/logo2.png" alt="HIS Logo" width="80" height="80"> </div>
        <a href="#" class="logo-name">Hospital Information System</a>
        <nav class="navigation">
            <a href="#map">The Map</a>
            <a href="#search-bar">Search Patient</a>
            <a href="#staff-search-bar">Search Staff</a>
            <a href="Policies.html">Policies</a>
            <a href="logout.php">Logout</a>
        </nav>
    </header>

    <!-- the main -->
    <section class="main">
        <div>
            <h2>Hello, Admin: <strong><?php echo $_SESSION['admin-name']; ?></strong>  <br><span>Hospital Information System</span></h2>
            <h3>This system was created to help hospitals manage their internal affairs and assist hospital staff</h3>
            <a href="#staff-search-bar" class="main-btn">Manage  my work</a>  <!--button-->
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

    <!-- patient section background -->
    <div class="patient-background">
    <!-- search bar -->
        <div id="search-bar">
            <form class="search-bar" action="page-of-admin.php#search-bar" method="post">
                <label for="search">Patient search:</label>
                <input type="text" name="search" placeholder="Search by Room or ID">
                <button type="submit" name="search1">Search</button>
            </form>
        </div>
    <!-- add patient button -->
        <a href="patient_registration.html" class="add-patient">Add new patient</a>
    <!-- patient information -->
        <section class="patient-information">
            <h2>Patient Information</h2>
            <?php

        
        
        if (isset($_POST['search1'])) {

    
                  $st= $_POST['search'] ;
                  $myquery=" SELECT * FROM registration JOIN accountant ON registration.PID=accountant.patient_id where PID like '%$st%'";
                //   $myquery2=" SELECT * FROM accountant where patient_id like '%$st%'";
                  $result= mysqli_query($con, $myquery);
                  while ($row=mysqli_fetch_array($result) ) { 
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
                        <td><?php print_r($row['firstname']) ." ". print_r($row['lastname']); ?></td>
                        <td>101</td>
                        <td><?php print_r($row['birthdate']); ?></td>
                        <td><?php print_r($row['BillAmount']); ?></td>
                        <td><a href="patient-information.html">Click here</a></td>
                    </tr>
            </table>
            <?php
    }
        
    }else{
        echo "ID doesnt exist";
    }
    

    ?>
        </section>
    </div>

    <?php
    if(isset($_POST['add'])){
        $PID = $_POST["PID"];
        $Result = mysqli_query($con, "SELECT * FROM registration WHERE PID='$PID'" );
        $row = mysqli_fetch_array($Result);
        if(mysqli_num_rows($Result) > 0 ){
            if($PID == $row['PID']){
                $PID = mysqli_real_escape_string($con,$_POST['PID']);
                $BillAmount = mysqli_real_escape_string($con,$_POST['BillAmount']);
                $BillDescription = mysqli_real_escape_string($con,$_POST['BillDescription']);
                $BillDate = mysqli_real_escape_string($con,$_POST['BillDate']);
                $Query = mysqli_query($con, "INSERT INTO accountant VALUES('','$BillAmount','$BillDescription','$BillDate','$PID')");
                echo 
                     "<script> alert('Bill Added Successfully'); </script>";
            }else{
                echo 
                "<script> alert('ID Doesnt Match'); </script>";
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

            <button type="submit" name="add">Add Medication Dose</button>
        </form>
    </section>

    <!-- staff section background -->
    <div class="staff-background">
    <!-- staff search bar -->
    <div id="staff-search-bar">
        <form method="post" action="page-of-admin.php#staff-search-bar" class="staff-search-bar">
            <label for="search">Staff search:</label>
            <input type="text" name="Staff-S1" placeholder="Search by ID">
            <button type="submit" name="Staff-S">Search</button>
        </form>
    </div>
<!-- add staff button -->
    <a href="staff_registration.html" class="staff-add-btn">Add new member</a>
<!-- staff information -->
    <section class="staff-information">
        <h2>Staff Information</h2>


        <?php
         if (isset($_POST['Staff-S'])) {

    
            $st= $_POST['Staff-S1'] ;
            $myquery=" SELECT * FROM staff  where PID like '%$st%'";
          //   $myquery2=" SELECT * FROM accountant where patient_id like '%$st%'";
            $result= mysqli_query($con, $myquery);
            while ($row=mysqli_fetch_array($result) ) { 
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
                    <td><a href="staff-information.html">Click here</a></td>
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