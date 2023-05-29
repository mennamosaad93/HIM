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
    <title>Hospital Information System</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="CSS/patient-information.css">
    <!-- header -->
</head>
<!-- main -->
<body>
    <div class="content">
        <nav>
            <img src="CSS/images/logo2 black.png" width="50px" height="50px">
            <a class="logo"  href="#">HIS</a>
            <ul>
                <li><a href="Doctor.html">Home</a></li>
                <li><a href="#">Print</a></li>
                <li><a href="#">Report</a></li>
                <li><a href="#">Contact</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
        <!-- patient information -->
    <div class="internal">
        <div class="text">
            <main>
                <section class="patient-info">
                    <h2>Patient <?php echo $_SESSION['patient-name']; ?> Information</h2>
                    <table>
                        <tbody>
                            <tr>
                                <th>Name:</th>
                                <td><?php echo $_SESSION['patient-name']; ?></td>
                            </tr>
                            <tr>
                                <th>Gender:</th>
                                <td><?php echo $_SESSION['patient-gender']; ?></td>
                            </tr>
                            <tr>
                                <th>Age:</th>
                                <td><?php echo $_SESSION['patient-age']; ?></td>
                            </tr>
                            <tr>
                                <th>Address:</th>
                                <td><?php echo $_SESSION['patient-address']; ?></td>
                            </tr>
                            <tr>
                                <th>Phone:</th>
                                <td><?php echo $_SESSION['patient-phone']; ?></td>
                            </tr>
                            <tr>
                                <th>Email:</th>
                                <td><?php echo $_SESSION['patient-email']; ?></td>
                            </tr>
                            <tr>
                                <th>Bills Payable:</th>
                                <td><?php echo $_SESSION['patient-Bill']; ?></td>
                            </tr>
                            <tr>
                                <th>Medical Case:</th>
                                <td><?php echo $_SESSION['patient-case']; ?></td>
                            </tr>
                           

                        </tbody>
                    </table>
                </section>
            </main>
        </div>
        
    </div>
    </div>

</body>
</html>