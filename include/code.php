<?php
    session_start();
    if (!isset($_SESSION['SESSION_EMAIL'])) {
        header("Location: index.php");
        die();
    }

    include 'config.php';

if(isset($_POST['save_multiple_data']))
{
    $schoolname = $_POST['schoolname'];
    $land_area = $_POST['lans_area'];
    $location = $_POST['location'];
    $trees = $_POST['trees'];
    $type = $_POST['type'];
    $status = $_POST['status'];
    $LON = $_POST['LON'];
    $LAT = $_POST['LAT'];

    foreach($schoolname as $index => $schoolnames)
    {
        $s_name = $names;
        $s_phone = $phone[$index];
        // $s_otherfiled = $empid[$index];

        $query = "INSERT INTO demo (name,phone) VALUES ('$s_name','$s_phone')";
        $query_run = mysqli_query($con, $query);
    }

    if($query_run)
    {
        $_SESSION['status'] = "Multiple Data Inserted Successfully";
        header("Location: insert-multiple-data.php");
        exit(0);
    }
    else
    {
        $_SESSION['status'] = "Data Not Inserted";
        header("Location: insert-multiple-data.php");
        exit(0);
    }
}
?>