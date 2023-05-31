<?php 
include 'connect2.php';
session_start();

if (isset($_POST['delete'])) {

    $all_id = $_POST['stud_delete_id'];
    $extract_id = implode(',' , $all_id);
    // echo $extract_id;
    $query = "DELETE FROM clinic_schedule WHERE Sch_ID IN($extract_id)";
    $query_run = mysqli_query($conn, $query);

    if($query_run){
        $_SESSION['status'] = "Deleted Successfully";
        header("location: page-of-nurse.php");
    }else{
        $_SESSION['status'] = "Not Deleted Successfully";
        header("location: page-of-nurse.php");
    }
}








?>