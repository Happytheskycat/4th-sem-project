<?php      

    include('connect.php'); 
    
    session_start();

        // // Retrieve the data sent from JavaScript
        // $data = json_decode(file_get_contents("php://input"), true);

        // // Process the data (you can perform database operations or any other task here)
        // // For demonstration, echoing the received data
        // echo json_encode(['message' => 'Data received successfully', 'data' => $data]);
        

    if (isset($_SESSION['username'])) {
        // The 'username' key exists in the $_SESSION array
        $username = $_SESSION['username'];
        $useremail = $_SESSION['useremail'];
        $password = $_SESSION['password'];
        $pid = $_SESSION['pid'];
        $qty = $_SESSION['qty'];
    
        $sql="SELECT * FROM users where uemail = '$useremail' and upass = '$password'";
        $result = mysqli_query($conn,$sql);
    
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
        $count = mysqli_num_rows($result); 
        } else {
            $count = 0; 
            $username = '';
            $useremail = '';
            $password = '';
            $pid = '';
            $qty = '';
    }
    
    // file0.php


        //to prevent from mysqli injection  
        // $username = stripcslashes($username);  
        $useremail = stripcslashes($useremail); 
        // $password = stripcslashes($password);  
        $pid = stripcslashes($pid); 
        $qty = stripcslashes($qty); 
        // $username = mysqli_real_escape_string($conn, $username); 
        $useremail = mysqli_real_escape_string($conn, $useremail);  
        // $password = mysqli_real_escape_string($conn, $password);
        $pid = mysqli_real_escape_string($conn, $pid);
        $qty = mysqli_real_escape_string($conn, $qty);

      
        $sql = "INSERT INTO cart (uemail, pid,qty) VALUES ($useremail,$pid,$qty)";
        $result = mysqli_query($conn, $sql);   

          
        if($result == true){  
            sleep(5);
            echo "<h1><center> Added to cart </center></h1>";
            header("Location: profile.php");  
        }  
        else{  
            echo "<h1> Write failed.</h1>";  
            header("Location: index.php");  
        }     
?>