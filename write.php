<?php      

    include('connect.php');  
    $username = $_POST['username'];  
    $useremail = $_POST['useremail'];  
    $password = $_POST['password'];  
    $pid = $_POST['pid']; 
    $ppiece = $_POST['ppiece']; 
    
    // file0.php


        //to prevent from mysqli injection  
        $username = stripcslashes($username);  
        $useremail = stripcslashes($useremail); 
        $password = stripcslashes($password);  
        $pid = stripcslashes($pid); 
        $ppiece = stripcslashes($ppiece); 
        $username = mysqli_real_escape_string($conn, $username); 
        $useremail = mysqli_real_escape_string($conn, $useremail);  
        $password = mysqli_real_escape_string($conn, $password);
        $pid = mysqli_real_escape_string($conn, $pid);
        $ppiece = mysqli_real_escape_string($conn, $ppiece);


      
        $sql = "INSERT INTO users (uname,uemail, upass, pid,ppiece) VALUES ($username,$useremail,$password,$pid,$ppiece)";
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