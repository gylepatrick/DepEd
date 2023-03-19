<?php
session_start();

include('db.php');

if(isset($_POST['submit'])) {
    $district = $_POST['district'];

    $sql = "INSERT INTO district(name) VALUES('".$district."')";
    $res = mysqli_query($conn, $sql);

    if (!$res) {
        $_SESSION['error'] = "Error Inserting New District";
        header('Location: ../school.php');
    } else {
        $_SESSION['success'] = "New District Added";
        header('Location: ../school.php');
    }
}