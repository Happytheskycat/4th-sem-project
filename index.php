<?php
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

                    <header>
                        <h1>My Online Store</h1>
                    </header>

                    <nav>
                        <a href="#">Home</a> |
                        <a href="#">Products</a> |
                        <a href="#">Contact</a>
                    </nav>

                    <section>
                        <article>
                            <h2>Product 1</h2>
                            <p>Description of Product 1.</p>
                            <p>Price: $19.99</p>
                            <button>Add to Cart</button>
                        </article>

                        <article>
                            <h2>Product 2</h2>
                            <p>Description of Product 2.</p>
                            <p>Price: $29.99</p>
                            <button>Add to Cart</button>
                        </article>

                        <!-- Add more product articles as needed -->
                    </section>

                    <footer>
                        &copy; 2023 My Online Store
                    </footer>


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






<!-- 
            <script>
                document.getElementById("submitButton").addEventListener("click", function() {
                    // Fixed data to be sent
                    var dataToSend = { key1: "value1", key2: "value2" };

                    // Perform an asynchronous request (AJAX) using fetch
                    fetch('process.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify(dataToSend),
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Handle the response data from the PHP script
                        console.log('Response from PHP script:', data);
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
                });

            </script>
 -->







<!-- 
            <script>
                // Get all elements with class 'submitButton'
                var buttons = document.getElementsByClassName("submitButton");

                // Add click event listeners to each button
                for (var i = 0; i < buttons.length; i++) {
                    buttons[i].addEventListener("click", function() {
                        // Get the custom data attributes from the clicked button
                        var key = this.getAttribute("data-key");
                        var value = this.getAttribute("data-value");

                        // Create an object with the specific data
                        var dataToSend = { key: key, value: value };

                        // Perform an asynchronous request (AJAX) using fetch
                        fetch('process.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify(dataToSend),
                        })
                        .then(response => response.json())
                        .then(data => {
                            // Handle the response data from the PHP script
                            console.log('Response from PHP script:', data);
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                    });
                }

            </script>
         -->
</body>
</html>