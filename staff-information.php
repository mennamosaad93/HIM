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
    <link rel="stylesheet" type="text/css" href="css/staff-information.css">
    
</head>
<body>
    <div class="content">
        <nav>
            <img src="CSS/Images/logo2 black.png" width="50px" height="50px">
            <a class="logo"  href="#">HIS</a>
            <ul>
                <li><a href="login.php">Home</a></li>
                <li><a href="#">Print</a></li>
                <li><a href="#">Report</a></li>
                <li><a href="#">Contact</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    <div class="internal">
        <div class="text">
            <main>
                <section class="patient-info">
                    <h2>Staff <?php echo $_SESSION['employee-firstname'] . $_SESSION['employee-lastname'] ; ?> Information</h2>
                    <table>
                        <tbody>
                            <tr>
                                <th>Name:</th>
                                <td><?php echo $_SESSION['employee-firstname'] . $_SESSION['employee-lastname'] ; ?></td>
                            </tr>
                            <tr>
                                <th>Gender:</th>
                                <td><?php echo $_SESSION['employee-gender']; ?></td>
                            </tr>
                            <tr>
                                <th>Age:</th>
                                <td><?php echo $_SESSION['employee-age']; ?></td>
                            </tr>
                            <tr>
                                <th>Address:</th>
                                <td><?php echo $_SESSION['employee-address']; ?></td>
                            </tr>
                            <tr>
                                <th>Phone:</th>
                                <td><?php echo $_SESSION['employee-phone']; ?></td>
                            </tr>
                            <tr>
                                <th>Email:</th>
                                <td><?php echo $_SESSION['employee-email']; ?></td>
                            </tr>
                            <tr>
                                <th>Department:</th>
                                <td><?php echo $_SESSION['employee-Dep']; ?></td>
                            </tr>
                            <tr>
                                <th>Salary:</th>
                                <td><?php echo $_SESSION['employee-salary']; ?></td>
                            </tr>
                            <tr>
                                <th>Qualifications:</th>
                                <td>
                                <?php echo $_SESSION['employee-Qualifications']; ?>
                                </td>
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