<?php

$conn = mysqli_connect("localhost", "root", "", "DepEd");

if (!$conn) {
    echo "Connection Failed";
}