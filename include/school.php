<?php
session_start();

include('db.php');

if(isset($_POST['submit'])) {
    $school_name = $_POST['school_name'];
    $district_id = $_POST['district_id'];

    $sql = "INSERT INTO school(name, district_id) VALUES('".$school_name."', '".$district_id."')";
    $res = mysqli_query($conn, $sql);

    if (!$res) {
        $_SESSION['error'] = "Error Inserting New School";
        header('Location: ../school.php');
    } else {
        $_SESSION['success'] = "New School Added";
        header('Location: ../school.php');
    }
}