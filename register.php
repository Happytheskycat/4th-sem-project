<?php      

    include('connect.php');  

        if ((isset($_POST['username']))&&(isset($_POST['useremail']))&&(isset($_POST['password']))) { 
            // The 'username' , 'useremail' and 'password' keys exist in the $_POST array

            $username=$_POST['username'];
            $useremail=$_POST['useremail'];
            $password=$_POST['password'];

            // file0.php

            //to prevent from mysqli injection  
            $username = stripcslashes($username);  
            $useremail = stripcslashes($useremail); 
            $password = stripcslashes($password);  
            $username = mysqli_real_escape_string($conn, $username); 
            $useremail = mysqli_real_escape_string($conn, $useremail);  
            $password = mysqli_real_escape_string($conn, $password);


        
            $sql = "INSERT INTO users (uname, uemail, upass) VALUES ('$username','$useremail','$password')";
            $result = mysqli_query($conn, $sql);    

            if($result == true){  
                sleep(5);
               // echo "<h1><center> Registration successful </center></h1>";
                header("Location: index.php");  
            } 
        }
        else{  
            echo "<h1> Registration failed.</h1>";  
        } 
          
        
           
?>