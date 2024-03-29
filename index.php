<?php
session_start();

if (isset($_SESSION['username'])) {
    // The 'username' key exists in the $_SESSION array
    $username = $_SESSION['username'];
    $useremail = $_SESSION['useremail'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>   
            Front page 
        </title>  
        <style>
            

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
    margin: 20px;
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
        <!-- <link rel="stylesheet" href="index.css"> -->
</head> 
        <Body>
                <div> 
                    <nav>
                        <?php
                        // Check if the user is logged in 

                        if (isset($username) && $username != '') {

                            echo '<a href="profile.php" id="user">' . $username . '</a>';
                            // echo '<script>';
                            // echo 'var username = "' . $username . '";';
                            // echo 'var userElement = document.getElementById("user");';
                            // echo 'userElement.innerHTML = username;';
                            // echo '</script>';

                            // echo '<button type="button"><a href="profile.php">Profile</a></button>';
                            echo '<a href="logout.php">Sign out</a>';
                        } else {
                            echo '<a href="login.html">Sign in</a>';
                            echo '<a href="register.html">Register</a>';
                        }
                        ?>

                        <a href="#">About</a>
                        <a href="#">Contact</a>
                    </nav>
                </div> 

              
             


            <div class="center" id="productContainer">
                
          

            </div>

            <script>
                document.addEventListener("DOMContentLoaded", function () {
                    // Fetch product data from the server
                    fetch('getProducts.php')
                        .then(response => {
                            console.log(response); // Log the raw response
                            if (response.ok) {
                                return response.json();
                            } else {
                                throw new Error('Network response was not ok.');
                            }
                        })
                        .then(products => {
                            // 'products' should be an array containing product objects
                            console.log(products);

                            // Generate product cards dynamically
                            const productContainer = document.getElementById('productContainer');

                            products.forEach(product => {
                                const card = document.createElement('div');
                                card.classList.add('cards');

                                const title = document.createElement('h2');
                                title.textContent = product.pname;

                                const price = document.createElement('h3');
                                price.textContent = '$'+product.price;

                                const description = document.createElement('p');
                                description.textContent = "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Possimus quos, quam quis suscipit.";
                                
                                const buyButton = document.createElement('button');
                                buyButton.classList.add('buyButton');
                                buyButton.id = product.pname;
                                buyButton.setAttribute('data-key', 'pid');
                                buyButton.setAttribute('data-value', product.pid);
                                buyButton.textContent = `Buy ${product.pname}`;

                                card.appendChild(title);
                                card.appendChild(description);
                                card.appendChild(price);
                                card.appendChild(buyButton);
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
                                        // document.getElementById(data.message).value = "Added to cart";
                                        console.log('Operation was successful:', data.message);
                                    }else if (data.status === 'successs') {
                                        // Handle success
                                        // document.getElementById(data.message).value = "Cart Updated";
                                        console.log('Operation was successful:', data.message);
                                    }
                                    else {
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
            
</body>
</html>

