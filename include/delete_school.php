<?php
session_start();

include('db.php');

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM school WHERE id = $id";


    if ($conn->query($sql) === TRUE) {
        $_SESSION['success'] = "School removed";
        header('Location: ../school.php');
    } else {
        $_SESSION['error'] = "Error Removing School";
        header('Location: ../school.php');
    }
}

$conn->close();