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
		<td>Product Name</td>
        <td>Product piece</td>
        <td>Action</td>
	  </tr>
			<?php
			// $i=0;
			while($row = mysqli_fetch_array($result)) {
			?>
	  <tr>
      <td> <input type="email" value="<?php echo $row["uemail"]; ?>"> </td>
		<td> <input type="text" value="<?php echo $row["upass"]; ?>"> </td>
        <td> <input type="text" value=" Kineko saman " readonly> </td>
		<td> <input type="number" value="<?php echo $row["pid"]; ?>"></td>
		
		<td >
            <input type="submit" value="Confirm">
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



































<?php

include('connect.php');

// file3.php



if(count($_POST)>0) {
mysqli_query($conn,"UPDATE users set userid='" . $_POST['userid'] . "', first_name='" . $_POST['first_name'] . "', last_name='" . $_POST['last_name'] . "', city_name='" . $_POST['city_name'] . "' ,email='" . $_POST['email'] . "' WHERE userid='" . $_POST['userid'] . "'");
$message = "Record Modified Successfully";
}
$result = mysqli_query($conn,"SELECT * FROM employee WHERE userid='" . $_GET['userid'] . "'");
$row= mysqli_fetch_array($result);
?>
<html>
<head>
<title>Update Employee Data</title>
</head>



<body>
<form name="frmUser" method="post" action="">
<div><?php if(isset($message)) { echo $message; } ?>
</div>
<div style="padding-bottom:5px;">
<a href="retrieve.php">Employee List</a>
</div>
Username: <br>
<input type="hidden" name="userid" class="txtField" value="<?php echo $row['userid']; ?>">
<input type="text" name="userid"  value="<?php echo $row['userid']; ?>">
<br>
First Name: <br>
<input type="text" name="first_name" class="txtField" value="<?php echo $row['first_name']; ?>">
<br>
Last Name :<br>
<input type="text" name="last_name" class="txtField" value="<?php echo $row['last_name']; ?>">
<br>
City:<br>
<input type="text" name="city_name" class="txtField" value="<?php echo $row['city_name']; ?>">
<br>
Email:<br>
<input type="text" name="email" class="txtField" value="<?php echo $row['email']; ?>">
<br>
<input type="submit" name="submit" value="Submit" class="buttom">

</form>

</body>
</html>