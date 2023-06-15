<?php
    include "connect2.php";
    session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset ="utf-8">
    <title> QR code</title>
    <link rel="stylesheet" href="css/qr-code">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;

        }
        body{
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            /* background: ; */

        }
        .wrapper{
            height: 260px;
            max-width: 410px;
            border-radius: 7px;
            padding: 16px 25px;
            transition: height 0.2s ease;

        }
        .wrapper.active{
            height: 530px;
        }
        header h1{
            font-size: 21px;
            font-weight: 500;
        }
        header p{
            margin-top: 5px;
            /* color: ; */
            font-size: 16px;
        }
        .wrapper .form{
            margin: 20px 0 25px ;
        }
        .form :where(input, button){
            width: 100%;
            height: 55px;
            border: none;
            border-radius: 5px;
        }
        .form input{
            font-size: 18px;
            padding: 0 17px;
            border: 1px solid ;
        }
        .form button{
            margin-top: 20px;
            font-size: 17px;
            /* background: ; */
        }
        .wrapper .qr-code{
            display: flex;
            opacity: 0;
            pointer-events: none;
            padding: 33px 0;
            border-radius: 5px;
            align-items: center;
            justify-content: center;
            border: 1px solid;
        }
        .wrapper.active .qr-code{
            opacity: 1;
            pointer-events: auto;
            transition: opacity 0.5s ease;

        }
    </style>
</head>
<body>
<div class="wrapper">
    <header>
        <h1> OR Code Generator</h1>
        <p> enter patient id </p>
    </header>
    
            <div class="form">
                <form  method="get">
                    <input type="text" name="Qrcode" placeholder="enter patient id">
                    <button type="submit" name="generate"> Generate qr code </button>
                </
            </div>
            <?php
            if (isset($_GET['generate'])) {
                $PID = $_GET["Qrcode"];
                $Result = mysqli_query($conn, "SELECT patient.* , payment_details.BillAmount FROM patient INNER JOIN payment_details  on patient.PID=payment_details.p_id WHERE PID='$PID'");
                if (mysqli_num_rows($Result) > 0) {
                    while ($row = mysqli_fetch_assoc($Result)) {
                        // Echo the patient's name, ID, and email
                        // echo $row["firstname"] . ", " . $row["PID"] . ", " . $row["email"] . "<br>";
                    // }}}
        ?>
        
                                
                               
            <div class="qr-code">
            <a href="patient-information.php"><?php
                    $_SESSION['patient-case'] = $row['case'];
                    $_SESSION['patient-name'] = $row['firstname'];
                    $_SESSION['patient-gender'] = $row['gender'];
                    $_SESSION['patient-age'] = $row['age'];
                    $_SESSION['patient-address'] = $row['address'];
                    $_SESSION['patient-phone'] = $row['phone'];
                    $_SESSION['patient-email'] = $row['email'];
                    $_SESSION['patient-Bill'] = $row['BillAmount'];
                                    ?>
                    <img src="qr-code.png" alt="qr-code">
            </a>  
                <?php 
                 }
                }
                }
                ?>           
            </div>
            
           
        </div>
        

    

<script>
    const wrapper = document.querySelector(".wrapper"),
        qrInput = wrapper.querySelector(".form input"),
        generateBtn = wrapper.querySelector(".form button"),
        qrImg = wrapper.querySelector(".qr-code img");
    generateBtn.addEventListener("click", () =>{
        let qrValue = qrInput.value;
        if (!qrValue) return;
        qrImg.src =`https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=${qrValue}`
        console.log(qrValue);
        wrapper.classList.add("active");
    } )
</script>
</body>
</html>