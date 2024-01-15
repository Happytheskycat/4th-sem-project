<?php
include('connect.php'); 

// file2.php

session_start();
$username = $_SESSION['useremail'];
$password = $_SESSION['password'];


$sql="SELECT * FROM users where uemail = '$username' and upass = '$password'";
$result = mysqli_query($conn,$sql);

// $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
// $count = mysqli_num_rows($result); 

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
    <div>
       <h1> <center> Welcome <?php echo $username; ?> </center> </h1>
    </div>
        
    <?php
if (mysqli_num_rows($result) > 0) {
?>
<table border="1" >
	  <tr>
	    <td>Email</td>
		<td>Password</td>
		<td>Product</td>
        <td>Action</td>
	  </tr>
			<?php
			// $i=0;
			while($row = mysqli_fetch_array($result)) {
			?>
	  <tr>
	    <td><?php echo $row["uemail"]; ?></td>
		<td><?php echo $row["upass"]; ?></td>
		<td><?php echo $row["pid"]; ?></td>
		
		<td >
            <p><a href="update.php"> Update </a></p>
            <p><a href="delete.php"> Delete </a></p>
        </td>
      </tr>
			<?php
			// $i++;
			}
			?>
</table>
 <?php
}
else
{
    echo "No result found";
}
?>
    
    <p><a href="index.html" style="text-decoration: none; font-size:25px" >Go back</a></p>

</body>
</html>

