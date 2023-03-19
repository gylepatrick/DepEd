<?php
session_start();

include('db.php');

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM tree WHERE id = $id";

    $sql2 = "DELETE FROM inv_bank WHERE tree_id = $id";


    if ($conn->query($sql) === TRUE && $conn->query($sql2)) {
        $_SESSION['success'] = "Tree removed";
        header('Location: ../welcome.php');
    } else {
        $_SESSION['error'] = "Error Removing Tree";
        header('Location: ../welcome.php');
    }
}

$conn->close();