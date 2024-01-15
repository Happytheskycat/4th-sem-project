<?php      

    include('connect.php');  
    $username = $_POST['useremail'];  
    $password = $_POST['password'];  
    
    // file0.php


        //to prevent from mysqli injection  
        $username = stripcslashes($username);  
        $password = stripcslashes($password);  
        $username = mysqli_real_escape_string($conn, $username);  
        $password = mysqli_real_escape_string($conn, $password);


      
        $sql = "INSERT INTO users (uemail, upass, pid) VALUES ($username,$password ,null )";
        $result = mysqli_query($conn, $sql);    

          
        if($result == true){  
            sleep(5);
           // echo "<h1><center> Registration successful </center></h1>";
            header("Location: index.html");  
        }  
        else{  
            echo "<h1> Registration failed.</h1>";  
        }     
?>