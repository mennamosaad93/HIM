<!DOCTYPE html>
<html>
<head>
    <link rel="Website Icon" href="css/images/logo2.png" type="png" >
	<meta charset="utf-8">
	<title>Qr Generator</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
	<h1 class="page-header text-center">Get patient Qr code</h1>
	<div class="row">
		<div class="col-sm-3 col-sm-offset-3">
			<form method="POST">
				<div class="form-group">
					<label for="">PID</label>
					<input type="text" class="form-control" name="PID">
				</div>
				<button type="submit" class="btn btn-primary" name="generate">Generate QRCode</button>
			</form>
		</div>
		<div class="col-sm-3">
			<?php
            include "connect2.php";
            session_start();
				if(isset($_POST['generate'])){

					$code = $_POST['PID'];
                    $Result = mysqli_query($conn, "SELECT patient.* , payment_details.BillAmount FROM patient INNER JOIN payment_details  on patient.PID=payment_details.p_id WHERE PID='$code'");
                if (mysqli_num_rows($Result) > 0) {
                    while ($row = mysqli_fetch_assoc($Result)) {
					// echo 
                    // "<a href='patient-information.php'>"."<?php
                    //     $_SESSION['patient-case'] = $row['case'];
                    //     $_SESSION['patient-name'] = $row['firstname'];
                    //     $_SESSION['patient-gender'] = $row['gender'];
                    //     $_SESSION['patient-age'] = $row['age'];
                    //     $_SESSION['patient-address'] = $row['address'];
                    //     $_SESSION['patient-phone'] = $row['phone'];
                    //     $_SESSION['patient-email'] = $row['email'];
                        // $_SESSION['patient-Bill'] = $row['BillAmount']; <img src='https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=$code&choe=UTF-8'></a>";
		// 		 }
        //     }
        // } 
		// 	?>
		</div>
	</div>
</div>

<a href='patient-information.php'><?php
                        $_SESSION['patient-case'] = $row['case'];
                        $_SESSION['patient-name'] = $row['firstname'];
                        $_SESSION['patient-gender'] = $row['gender'];
                        $_SESSION['patient-age'] = $row['age'];
                        $_SESSION['patient-address'] = $row['address'];
                        $_SESSION['patient-phone'] = $row['phone'];
                        $_SESSION['patient-email'] = $row['email'];
                        $_SESSION['patient-Bill'] = $row['BillAmount']; ?><img src='https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=<?php echo "http://localhost/him/him/patient-information.php"?>&choe=UTF-8'></a>
				<?php
                    }}else {
                        echo "ID doesn't exist";
                    }
                }
                    ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>