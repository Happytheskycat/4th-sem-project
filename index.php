<?php

// Establish database connection
include('connect.php'); 

// file2.php

session_start();

if (isset($_SESSION['username'])) {
    // The 'username' key exists in the $_SESSION array
    $username = $_SESSION['username'];
    $useremail = $_SESSION['useremail'];
    // $password = $_SESSION['password'];
    // $pid = $_SESSION['pid'];
    // $qty = $_SESSION['qty'];

    $sql="SELECT * FROM users where uemail = '$useremail' and upass = '$password'";
    $result = mysqli_query($conn,$sql);

    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
    $count = mysqli_num_rows($result); 
    // Close the database connection
    mysqli_close($conn);
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
                <div> 
                    <nav>
                        
                            
                                <button><a href="login.html"> Sign in </a></button> 
                                <button><a href="register.html"> Register </a></button> 
                            
                            <button type="button" id="user" >User</button>
                           
                                <button type="button" ><a href="profile.php"> Profile </a></button> 
                                <button type="button" ><a href="logout.php"> Sign out </a></button> 
                           
                            <button type="button" id="about" >About</button>
                            <button type="button" id="contact" >Contact</button>
                        
                    </nav>
                </div>  

                 <script>
                    var username = '<?php echo "$username"?>';
                    var userElement = document.getElementById("user");
                        if (username != '' || username != null) {
                            userElement.innerHTML = username; 
                        }
                </script>

            <div class="center" id="productContainer">
                
                    <div class="cards">
                        <h2>product</h2>
                        <button class="buyButton" data-key="pid" data-value="001">Buy Product 1</button>
                    </div>
                    <div class="cards">
                        <h2>product</h2>
                        <button class="buyButton" data-key="pid" data-value="002">Buy Product 2</button>
                    </div>
                    <div class="cards">
                        <h2>product</h2>
                        <button class="buyButton" data-key="pid" data-value="003">Buy Product 3</button>
                    </div>

            </div>


            <script>
                // Get all elements with class 'buyButton'
                var buttons = document.getElementsByClassName("buyButton");

                // Add click event listeners to each button
                for (var i = 0; i < buttons.length; i++) {
                    buttons[i].addEventListener("click", function() {
                        // Get the custom data attributes from the clicked button
                         var key = this.getAttribute("data-key");
                        var value = this.getAttribute("data-value");

                        // Create an object with the specific data
                         var dataToSend = { key: key, value: value };

                        // Perform an asynchronous request (AJAX) using fetch
                        fetch('cart.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify(dataToSend),
                            
                        })
                        .then(response => {
                            console.log(response); // Log the raw response
                            if (response.ok) {
                                return response.json();
                            } else {
                                throw new Error('Network response was not ok.');
                            }
                        })
                        .then(data => {
                            if (data !== null) {
                                 // Handle the response data from the PHP script
                            console.log('Response from PHP script:', data);
                            
                                    // Check if data is valid JSON
                                    if (typeof data === 'object') {
                                        // Check the status in the response
                                        if (data.status === 'success') {
                                            // Handle success
                                            console.log("Added to cart");
                                            console.log('Operation was successful.');
                                        } else {
                                            // Handle failure
                                            console.log("Not Added to cart");
                                            console.error('Operation failed:', data.message);
                                        }
                                    } else {
                                        throw new Error('Invalid JSON response from server.');
                                    }
                            } else {
                                throw new Error('Empty JSON response from server.');
                            }
                           

                        })
                        .catch(error => {
                            console.error('Error during fetch:', error);
                        });
                    });
                }

            </script>
            
</body>
</html>

