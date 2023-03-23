<?php 
include('db.php');

session_start();

$user_id = $_POST['user_id'];
$school_name = $_POST['school_name'];
$district_name = $_POST['district_name'];
$tree = $_POST['tree'];
$tree_type = $_POST['tree_type'];
$tree_status = $_POST['tree_status'];
$longitude = $_POST['longitude'];
$latitude = $_POST['latitude'];
$location = $_POST['location'];
$brgy = $_POST['brgy'];


for ($i=0; $i < count($tree); $i++) { 
    $query = "INSERT INTO tree(user_id, school_name, district_name, tree, tree_type, tree_status, latitude, longitude, location, brgy) 
    VALUES('" . $user_id . "', '" . $school_name . "', '" . $district_name . "', '" . $tree[$i] . "', '" . $tree_type[$i] . "', '" . $tree_status[$i] . "', '" . $latitude[$i] . "', '" . $longitude[$i] . "', '" . $location . "', '" . $brgy . "')";


    $result = mysqli_query($conn, $query);

}

if($result) {
    $_SESSION['success'] = "Form Submitted!";
    header('Location: ../treeform.php');
} else  {
    $_SESSION['error'] = "Error saving. Please try again!";
}


mysqli_close($conn);