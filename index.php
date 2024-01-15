<?php
include('connect.php'); 

// file2.php

session_start();
$username = $_SESSION['username'];
$useremail = $_SESSION['useremail'];
$password = $_SESSION['password'];
$pid = $_SESSION['pid'];
$ppiece = $_SESSION['ppiece'];


$sql="SELECT * FROM users where uemail = '$useremail' and upass = '$password'";
$result = mysqli_query($conn,$sql);

$row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
$count = mysqli_num_rows($result); 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     
        <Title>   
            Front page 
        </Title>  

        <script src="index.js"></script>
         
        <link rel="stylesheet" href="index.css">
       
</head> 
        <Body>
            <script>
                <?php if ($count==1){ ?>
                    var username = "<?php echo $username ?>";
                    var useremail = "<?php echo $useremail ?>";
                <?php } ?>
            </script>
            <div> 
                <header>  
                <nav>  
                <ul>  
                <li>  
                        <button type="button" id="collapsible" class="collapsible">User</button>
                        <div id="content" class="content">
                            <ul>
                                <li> 
                                    <a href="login.html"> Sign in </a>  
                                </li>  
                                <li> 
                                    <a href="register.html"> Register </a>  
                                </li>  
                            </ul>
                        </div> 
                </li>  
                <li>  
                <a href="#"> About </a>  
                </li>  
                <li>  
                <a href="#"> Contact </a>  
                </li>  
                
                
                </ul>  
                </nav>  
                </header> 
            </div>  


            <script>   
                     if(username=='' || username==null){
                        
                     }
                     else{
                         document.getElementById("collapsible").innerHTML = username; 
                         document.getElementById("content").value = '  <a href="logout.php"> Sign out </a>   '; 
                     }


                        var coll = document.getElementsByClassName("collapsible");
                        var i;

                        for (i = 0; i < coll.length; i++) {
                        coll[i].addEventListener("click", function() {
                            this.classList.toggle("active");
                            var content = this.nextElementSibling;
                            if (content.style.display === "block") {
                            content.style.display = "none";
                            } else {
                            content.style.display = "block";
                            }
                        });
                        } 
                     </script>



            <div class="center">
                <div>
                    <h1>Product</h1>
                </div>

                <div>
                    <div>
                        <h2>product</h2>
                    </div>
                    <div>
                        <h2>product</h2>
                        <button id="product1" name="bag001" class="product" onclick=buy(id)>Buy</button>
                    </div>
                </div>
            </div>

            <script>
                function buy(id){
                <?php 
                    $_SESSION['pid']=id;
                    $_SESSION['ppiece']=1;
                    header("Location: update.php");
                ?>
                }
            </script>
</body>
</html>