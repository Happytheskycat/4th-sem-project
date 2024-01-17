<?php      

    include('connect.php');  
    $username = $_POST['username'];  
    $useremail = $_POST['useremail'];  
    $password = $_POST['password'];  
    $pid = $_POST['pid']; 
    $qty = $_POST['qty']; 
    
    // file0.php


        //to prevent from mysqli injection  
        $username = stripcslashes($username);  
        $useremail = stripcslashes($useremail); 
        $password = stripcslashes($password);  
        $pid = stripcslashes($pid); 
        $qty = stripcslashes($qty); 
        $username = mysqli_real_escape_string($conn, $username); 
        $useremail = mysqli_real_escape_string($conn, $useremail);  
        $password = mysqli_real_escape_string($conn, $password);
        $pid = mysqli_real_escape_string($conn, $pid);
        $qty = mysqli_real_escape_string($conn, $qty);


      
        $sql = "INSERT INTO users (uname,uemail, upass, pid,qty) VALUES ($username,$useremail,$password,$pid,$qty)";
        $result = mysqli_query($conn, $sql);    

          
        if($result == true){  
            sleep(5);
           // echo "<h1><center> Registration successful </center></h1>";
            header("Location: profile.php");  
        }  
        else{  
            echo "<h1> Write failed.</h1>";  
            header("Location: index.php");  
        }     
?>