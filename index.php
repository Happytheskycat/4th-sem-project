<?php
include('connect.php'); 

// file2.php

session_start();

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
}




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
                
                    <div class="parent">
                        <div>
                        <button type="button" id="collapsible" class="collapsible">User</button>
                        </div>
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
                        <div>
                        <button type="button" id="collapsible" class="collapsible">About</button>
                        </div>
                        <div>
                        <button type="button" id="collapsible" class="collapsible">Contact</button>
                        </div> 
                 

             
                </div>
               
            </div>  


            <script>   
                    var username = '<?php echo "$username"?>';
                     if(username=='' || username==null){
                        
                     }
                     else{
                         document.getElementById("collapsible").innerHTML = username; 
                         document.getElementById("content").innerhtml = '  <a href="logout.php"> Sign out </a>   '; 
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
                <form action="order.php" method="post">
                    <div class="cards">
                        <h2>product</h2>
                        <input type="submit" name="product1" class="product" onsubmit="buy()"  value="buy">
                    </div>
                    <div class="cards">
                        <h2>product</h2>
                        <input type="submit" name="product1" class="product" onsubmit="buy()"  value="buy">
                    </div>
                    <div class="cards">
                        <h2>product</h2>
                        <input type="submit" name="product1" class="product" onsubmit="buy()"  value="buy">
                    </div>
                </form>
            </div>


            <script>
                function buy(){
                <?php 
                    $_SESSION['pid']=id;
                    $_SESSION['qty']=1;
                ?>
                }
            </script>
</body>
</html>