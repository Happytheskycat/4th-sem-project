<?php      

    include('connect.php');  
    $username = $_POST['useremail'];  
    $password = $_POST['password'];  
    
    // file1.php

    session_start();

        //to prevent from mysqli injection  
        $username = stripcslashes($username);  
        $password = stripcslashes($password);  
        $username = mysqli_real_escape_string($conn, $username);  
        $password = mysqli_real_escape_string($conn, $password);
        
        $_SESSION['useremail'] = $username;
        $_SESSION['password'] = $password;
      
        $sql = "select *from users where uemail = '$username' and upass = '$password'";  
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