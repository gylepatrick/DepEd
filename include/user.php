<?php

    include 'config.php';
    $msg = "";

    if (isset($_POST['submit'])) {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $status = mysqli_real_escape_string($conn, $_POST['status']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm-password']);
    
        // check if there is already an administrator
        $result = mysqli_query($conn, "SELECT * FROM users WHERE status='administrator'");
        if (mysqli_num_rows($result) > 0 && $status === 'administrator') {
            $msg = "<div class='alert alert-danger'>An administrator user already exists.</div>";
        } else {
            // if no admin account it will save
            if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE email='{$email}'")) > 0) {
                $msg = "<div class='alert alert-danger'>The email address already exists.</div>";
            } else {
                if ($password === $confirm_password) {
                    $sql = "INSERT INTO users (name, email, status, password) VALUES ('{$name}', '{$email}', '{$status}', '{$password}')";
                    $result = mysqli_query($conn, $sql);
    
                    if ($result) {
                        $msg = "<div class='alert alert-success'>Register successful.</div>";
                    } else {
                        $msg = "<div class='alert alert-danger'>Failed to register. Please try again.</div>";
                    }
                } else {
                    $msg = "<div class='alert alert-danger'>Password and Confirm Password do not match.</div>";
                }
            }
        }
    }
?>