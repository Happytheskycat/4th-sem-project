<div>
    <nav>
        <?php
        // Check if the user is logged in 
        $isLoggedIn = /*  logic to check if the user is logged in */;

        if ($isLoggedIn) {
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
                    var username = '<?php echo "$username"?>';
                    var userElement = document.getElementById("user");
                        if (username !== '' && username !== null) {
                            userElement.innerHTML = username; 
                        }
                </script>