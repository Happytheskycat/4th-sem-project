<?php
    // Establish database connection
    include('connect.php'); 

    session_start();
    session_destroy();
    
    // Close the database connection
    mysqli_close($conn);
    header("location: index.php");
?>