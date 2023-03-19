<?php
session_start();

include('db.php');

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $sql = "DELETE FROM district WHERE id = $id";
    $sql2 = "DELETE FROM school WHERE district_id = $name";

    if ( $conn->query($sql) === TRUE && $conn->query($sql) === TRUE) {
        $_SESSION['success'] = "District removed";
        header('Location: ../school.php');
    } else {
        $_SESSION['error'] = "Error Removing District";
        header('Location: ../school.php');
    }
}

$conn->close();