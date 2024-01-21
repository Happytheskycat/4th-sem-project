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

            body {
              font-family: 'Rubik', sans-serif;
              margin: 0;
              padding: 0;
              background-color: lightgoldenrodyellow;
          }
          
          header {
              background-color: #333;
              color: #fff;
              padding: 10px;
              text-align: center;
          }
          
          nav {
              background-color: rgb(240,255,240);
              color: #fff;
              padding: 10px;
              text-align: center;
              display: flex;
              position: sticky;
              padding: 20px 10px;
              font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
          }
          
          section {
              padding: 20px;
          }
          
          article {
              margin-bottom: 20px;
              border: 1px solid #ddd;
              background-color: #fff;
              padding: 15px;
              border-radius: 5px;
          }
          
          footer {
              background-color: #333;
              color: #fff;
              padding: 10px;
              text-align: center;
          }
          
          .center{
              /* margin-left: 10px; */
              /* border: 1px solid black; */
              padding: 15px;
              display: flex;
              flex-wrap: wrap;
              overflow: hidden;
              /* height: 150vh; */
              /* flex-basis: 50%; */
              /* width: 100%; */
              justify-content: space-around;
              align-items: center;
              background: linear-gradient(rgba(0, 0, 0, 0.3),rgba(255, 255, 255, 0.5));
          }
          
          .cards{
              border: 1px solid black;
              border-radius: 10px;
              margin: 10px;
              display: flex;
              flex-direction: column;
              background: linear-gradient(rgba(255, 255, 255, 0.5),rgba(0, 0, 0, 0.3));
              /* display: grid;
              grid-template-columns: 1fr 1fr; */
              /* gap: 5px; */
              height: 280px;
              width: 250px;
              align-items: center;
              /* justify-content: space-between; */
          }
          
          Button{
              border: 1px solid rgb(255, 196, 0);
              padding: 10px;
              margin: 7px;
              border-radius: 20px;
              width:120px;
          }
          h2{
              margin: 10px
          }
          
          a{
              color: green;
              margin-left: 15px;
              padding: 5px 20px;
              border-radius: 19px;
              text-decoration: none;
              border: 1px solid rgb(255, 196, 0);
          }
          
          a:hover{
              color: #fff;
          }
          
          
          
          ul{
              display: flex;
              list-style-type: none;
          }
          
          img{
              height:48vh;
              border-radius: 15px;
          }
          
          p{
              margin: 5px;
          }
          
          .author{
              /* padding-right: 5px; */
              display: grid;
              grid-template-columns: 1fr 1fr 1fr;
              gap: 2px;
              overflow: hidden;
              border: 1px solid black;
              border-radius: 50px;
              width: 360px;
              justify-content: center;
              align-items: center;
              text-align: center;
          }
          
          .author :hover{
              width: 140px;
              transition: 0.2s;
          }
          
          .hidden{
              overflow: hidden;
          }
          .contact{
              display: grid;
              grid-template-columns: 1fr 1.5fr;
              justify-content: center;
              align-items: center;
          }
          .zoom{
              width: 110px;
              height: 200px;
              gap: 5px;
          }
          .zoom :hover{
              width: 150px;
          }
          *{
              margin: 0%;
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

                                const pid = document.createElement('p');
                                pid.textContent = product.pid;

                                const qty = document.createElement('p');
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

                                const delButton = document.createElement('button');
                                delButton.classList.add('buyButton');
                                delButton.setAttribute('data-key', 'delete');
                                delButton.setAttribute('data-value', product.pid);
                                delButton.textContent = `Remove`;

                                card.appendChild(title);
                                card.appendChild(pid);
                                card.appendChild(qty);
                                card.appendChild(buyButton);
                                card.appendChild(subButton);
                                card.appendChild(delButton);
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

