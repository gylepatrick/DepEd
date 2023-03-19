<?php
session_start();

include('db.php');

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM users WHERE id = $id";


    if ($conn->query($sql) === TRUE) {
        $_SESSION['success'] = "User removed";
        header('Location: ../users.php');
    } else {
        $_SESSION['error'] = "Error Removing User";
        header('Location: ../users.php');
    }
}

$conn->close();