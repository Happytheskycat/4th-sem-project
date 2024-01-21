<?php
// Establish database connection
include('connect.php'); 

// file2.php

session_start();
$username = $_SESSION['username'];
$useremail = $_SESSION['useremail'];
$password = $_SESSION['password'];


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
    <title>Document</title>

    <style>

    p{
        text-align: center;
    }
    table{
        text-align: center;
        margin:auto;
        width:50%
    }

    </style>

</head>
<body>
        
    <?php
if ($count == 1) {
?>              
                <div class="center" id="userProfile" >

                </div>
                <script>
                    const userProfile = document.getElementById('userProfile');
                     const card = document.createElement('div');
                                card.classList.add('cards');

                                const title = document.createElement('h2');
                                title.textContent =  '<?php echo $username; ?>';

                                const description = document.createElement('p');
                                description.textContent = 'Hi! Welcome to your profile page.';

                                const updateButton = document.createElement('button');
                                updateButton.classList.add('editProfile');
                                updateButton.setAttribute(onclick,"update.php");
                                // updateButton.setAttribute('data-value', product.pid);
                                updateButton.textContent = `Update Profile`;

                                card.appendChild(title);
                                card.appendChild(description);
                                card.appendChild(updateButton);
                                userProfile.appendChild(card);
                </script>
                                


            <br>

            <?php
            $sql1="SELECT * FROM cart where uemail = '$useremail'";
            $result1 = mysqli_query($conn,$sql);
            $row1 = mysqli_fetch_array($result);

            ?>


            <div class="center" id="productContainer">
                <!-- Generated content here -->
            </div>

           
            <script>
                document.addEventListener("DOMContentLoaded", function () {
                    // Fetch product data from the server
                    fetch('http://localhost/4th-sem-project/getCart.php')
                        .then(response => {
                            console.log(response); // Log the raw response
                            if (response.ok) {
                                return response.json();
                            } else {
                                throw new Error(`HTTP error! Status: ${response.status}`);
                            }
                            // return response.text(); // Retrieve the response as text
                        })
                        // .then(data => {
                            // console.log('raw JSON data',data); // Log the raw JSON data
                            
                            // Check if data is a string before attempting to trim
                            // const trimmedData = typeof data === 'string' ? data.trim() : '';

                            // console.log("Raw JSON data:", trimmedData); // Log the trimmed data

                            // Parse the JSON data
                            // const jsonData = trimmedData ? JSON.parse(trimmedData) : [];
                            // return jsonData;
                        // })
                        .then(products => {
                            // 'products' should be an array containing product objects            uemail  pid  qty pname
                            console.log(products);

                            // Generate product cards dynamically
                            const productContainer = document.getElementById('productContainer');

                            products.forEach(product => {
                                const card = document.createElement('div');
                                card.classList.add('cards');

                                const title = document.createElement('h2');
                                title.textContent = product.pname;

                                const pid = document.createElement('h3');
                                pid.textContent = product.pid;

                                const qty = document.createElement('h3');
                                qty.textContent = product.qty;

                                const buyButton = document.createElement('button');
                                buyButton.classList.add('buyButton');
                                buyButton.setAttribute('data-key', 'pid');
                                buyButton.setAttribute('data-value', product.pid);
                                buyButton.textContent = `+`;

                                const subButton = document.createElement('button');
                                subButton.classList.add('buyButton');
                                subButton.setAttribute('data-key', 'minus');
                                subButton.setAttribute('data-value', product.pid);
                                subButton.textContent = `-`;

                                card.appendChild(title);
                                card.appendChild(pid);
                                card.appendChild(qty);
                                card.appendChild(buyButton);
                                card.appendChild(subButton);
                                productContainer.appendChild(card);
                            });
                        })
                        .catch(error => {
                            console.error('Error during fetch:', error);
                        });
                        
                    console.log("Script executed"); 
                    
                    // Add a single click event listener to the parent container
                    document.getElementById('productContainer').addEventListener('click', function (event) {
                    // Check if the clicked element has the 'buyButton' class
                    if (event.target.classList.contains('buyButton')) {
                        // Get the custom data attributes from the clicked button
                        var key = event.target.getAttribute("data-key");
                        var value = event.target.getAttribute("data-value");
                        value = value;
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
                                        // console.log('Operation was successful.');
                                        console.log('Operation was successful:', data.message);
                                    } else {
                                        // Handle failure
                                        console.log("Not Added to cart");
                                        console.error('Operation failed:', data.message);
                                    }
                                } else {
                                    throw new Error('Invalid JSON response from the server.');
                                }
                            } else {
                                throw new Error('Empty JSON response from the server.');
                            }
                        })
                        .catch(error => {
                            console.error('Error during fetch:', error);
                        });
                    }
                        
                });
            });

    </script>












 <?php
}
else
{
    echo "No result found";
}
?>
    
    <p><a href="index.php" style="text-decoration: none; font-size:25px" >Go back</a></p>
    <p><a href="checkout.php" style="text-decoration: none; font-size:25px" >checkout</a></p>

</body>
</html>

