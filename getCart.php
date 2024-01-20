<?php
header('Content-Type: application/json; charset=utf-8');
// Establish database connection
include('connect.php');

// Fetch product data from the database
$sql = "SELECT uemail, pid, qty FROM cart";
$result = mysqli_query($conn, $sql);

// Check if there are rows in the result
if (mysqli_num_rows($result) > 0) {
    $products = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // Convert product data to JSON format
    $productsJson = json_encode($products);

    // Output JSON response
    echo $productsJson;
} else {
    // No products found
    echo json_encode(array('status' => 'error', 'message' => 'No products found.'));
}

// Close the database connection
mysqli_close($conn);
?>
