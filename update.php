
<?php
include('connect.php'); 

// file2.php

session_start();
$username = $_SESSION['username'];
$useremail = $_SESSION['useremail'];
$password = $_SESSION['password'];


$sql="SELECT * FROM users where uemail = '$useremail' and upass = '$password'";
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
        <td>Name</td>
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
      <form id="form_id" method="post" name="f1" action="register.php" onsubmit = "return validate()">
        <td> <input type="text" id="username" name="username" value="<?php echo $row["uname"]; ?>"> </td>
        <td> <input type="email" id="useremail" name="useremail" value="<?php echo $row["uemail"]; ?>"> </td>
		<td> <input type="text" id="password" name="password" value="<?php echo $row["upass"]; ?>"> </td>
		<td> <input type="number" id="pid" value="<?php echo $row["pid"]; ?>" readonly></td>
        <td> <input type="number" id="ppiece" value=" <?php echo $row["pid"]; ?> "> </td>

		<td >
            <input type="submit" name="submit" value="Submit" class="buttom">
        </td>
        </form>
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




