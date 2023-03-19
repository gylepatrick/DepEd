<?php 
    session_start();
    include 'db.php';


    $id = $_POST['id'];
    $user_id = $_POST['user_id'];
    $school = $_POST['school'];
    $tree = $_POST['tree'];
    $tree_type = $_POST['tree_type'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $location = $_POST['location'];
    $tree_status = $_POST['tree_status'];
    $month = date('M-Y');

    for ($i=0; $i < count($id); $i++) { 
        $sql = "UPDATE tree SET tree_status = '$tree_status[$i]' WHERE id = '$id[$i]'";

        $sql2 = "INSERT INTO `inv_bank`(`user_id`, `school`, `tree_id`, `tree`, `tree_type`, `tree_status`, `location`, `latitude`, `longitude`, `month`) 
                    VALUES ('$user_id[$i]', '$school[$i]', '$id[$i]','$tree[$i]', '$tree_type[$i]','$tree_status[$i]','$location[$i]','$latitude[$i]','$longitude[$i]', '$month')";


        if (mysqli_query($conn, $sql) && mysqli_query($conn, $sql2)) {
            $_SESSION['success'] = "Status updated!";
            header('Location: ../welcome.php');
        } else {
            $_SESSION['success'] = "Status update failed!";
            header('Location: ../welcome.php');
        }
    }

    exit();
?>