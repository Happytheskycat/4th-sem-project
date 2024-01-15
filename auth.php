<?php      

    include('connect.php');  
    $username = $_POST['username'];  
    $useremail = $_POST['useremail'];  
    $password = $_POST['password'];  
    
    // file1.php

    session_start();

        //to prevent from mysqli injection  
        $username = stripcslashes($username);  
        $useremail = stripcslashes($useremail); 
        $password = stripcslashes($password);  
        $username = mysqli_real_escape_string($conn, $username); 
        $useremail = mysqli_real_escape_string($conn, $useremail);  
        $password = mysqli_real_escape_string($conn, $password);
        
        $_SESSION['username'] = $username;
        $_SESSION['useremail'] = $useremail;
        $_SESSION['password'] = $password;
      
        $sql = "select *from users where uemail = '$useremail' and upass = '$password'";  
        $result = mysqli_query($conn, $sql);  
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
        $count = mysqli_num_rows($result);  

          
        if($count == 1){  
           // echo "<h1><center> Login successful </center></h1>";
            header("Location: profile.php");  
        }  
        else{  
            echo "<h1> Login failed. Invalid username or password.</h1>";  
        }     
?>