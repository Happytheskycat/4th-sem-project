<?php
header('Content-Type: application/json; charset=utf-8');
// Establish database connection
include('connect.php');

// file2.php

session_start();
// $username = $_SESSION['username'];
$useremail = $_SESSION['useremail'];

$sql1 = "SELECT * FROM users WHERE uemail = '$useremail'";
$result1 = mysqli_query($conn, $sql1);

if (!$result1) {
    die("Query failed: " . mysqli_error($conn));
}

// $row1 = mysqli_fetch_array($result1);

if ($result1) {
    if (mysqli_num_rows($result1) > 0) {
        $profile = mysqli_fetch_assoc($result1);
        echo json_encode($profile);
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'No products found.'));
    }
} else {
    die("Query failed: " . mysqli_error($conn));
}
// Now you can use $row1 to access the values from the cart table.
?>
