<?php
header('Content-Type: application/json; charset=utf-8');

include('connect.php');
session_start();

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$username = $_SESSION['username'];
$useremail = $_SESSION['useremail'];

$sql = "SELECT uemail, cart.pid, qty, pname, price FROM cart
        INNER JOIN store ON cart.pid=store.pid
        WHERE uemail=? OR uemail IS NULL";

$stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        die("Statement preparation failed: " . mysqli_error($conn));
    }
    mysqli_stmt_bind_param($stmt, "s", $useremail);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $products = mysqli_fetch_all($result, MYSQLI_ASSOC);
            echo json_encode($products);
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'No products found.'));
        }
    } else {
        die("Query failed: " . mysqli_error($conn));
    }



// Close the result set
mysqli_free_result($result);

// Close the prepared statement
mysqli_stmt_close($stmt);

// Close the database connection
mysqli_close($conn);

?>