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
        <link rel="stylesheet" href="index.css">
</head> 
        <Body>
                <script>
                    <?php if (isset($username) && $username != '') { ?>
                        var username = "<?php echo $username ?>";
                        var userElement = document.getElementById("user");
                        userElement.innerHTML = username; 
                    <?php } ?>
                </script>
            
                <div> 
                <nav>
                    <?php
                    // Check if the user is logged in 

                    if (isset($username) && $username != '') {
                        echo '<button type="button" id="user">' . $username . '</button>';
                        echo '<button type="button"><a href="profile.php">Profile</a></button>';
                        echo '<button type="button"><a href="logout.php">Sign out</a></button>';
                    } else {
                        echo '<button><a href="login.html">Sign in</a></button>';
                        echo '<button><a href="register.html">Register</a></button>';
                    }
                    ?>

                    <button type="button" id="about">About</button>
                    <button type="button" id="contact">Contact</button>
                </nav>
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

                    const buyButton = document.createElement('button');
                    buyButton.classList.add('buyButton');
                    buyButton.setAttribute('data-key', 'pid');
                    buyButton.setAttribute('data-value', product.pid);
                    buyButton.textContent = `Buy ${product.pname}`;

                    card.appendChild(title);
                    card.appendChild(buyButton);
                    productContainer.appendChild(card);
                });
            })
            .catch(error => {
                console.error('Error during fetch:', error);
            });
    });
</script>


            <div class="center" id="productContainer">
                
                    <!-- <div class="cards">
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
                    </div> -->

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

