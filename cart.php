
<?php
session_start();
include('connect.php');
header('Content-Type: application/json');
 // The 'username' key exists in the $_SESSION array
 $username = $_SESSION['username'];
 $useremail = $_SESSION['useremail'];
 $password = $_SESSION['password'];
 $qty = 1;
 //to prevent from mysqli injection  
            $useremail = stripcslashes($useremail); 
            // $password = stripcslashes($password);  
            $useremail = mysqli_real_escape_string($conn, $useremail);  
            // $password = mysqli_real_escape_string($conn, $password);

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve data from the POST request
    $postData = json_decode(file_get_contents("php://input"), true);

        // Check if data was successfully decoded
        if ($postData !== null) {
        try {    
            // Process the data as needed
            $key = $postData['key'];
            $value = $postData['value'];
            // Convert $value to an integer
            $value = (int)$value;

            // Perform actions based on $key and $value
       
        
                // data processing code here
                
                    $sql0="SELECT * FROM cart where uemail = ? and pid = ?";
                    $stmt0 = mysqli_prepare($conn, $sql0);

                    // Bind parameters
                    mysqli_stmt_bind_param($stmt0, "si", $useremail, $value);

                    // Execute the statement
                    mysqli_stmt_execute($stmt0);

                    $result0 =  mysqli_stmt_get_result($stmt0);

                    // Close the statement
                    mysqli_stmt_close($stmt0);
                    if(mysqli_num_rows($result0) > 0){

                        $qty1 = $qty + 1;
                        // Preparing SQL Statement
                        $sql1 = "UPDATE `cart` SET `uemail`=?, `pid`=?, `qty`=? WHERE `uemail` = ? AND `pid` = ?";
                        $stmt1 = mysqli_prepare($conn, $sql1);

                        // Bind parameters
                        mysqli_stmt_bind_param($stmt1, "siiis", $useremail, $value, $qty1, $useremail, $value);

                        // Execute the statement
                        $result1 = mysqli_stmt_execute($stmt1);
                     
                        // Close the statement
                        mysqli_stmt_close($stmt1);

                        if($result1 === true){  
                            // echo "<h1><center> Added to cart </center></h1>";
                            // header('Content-Type: application/json');
                            $response = array('status' => 'success', 'message' => 'CART UPDATED.');
                            // header("Location: profile.php");  
                        } 
                        else{  
                            // header('Content-Type: application/json');
                            $response = array('status' => 'success', 'message' => 'NOT ADDED TO CART.');
                            // Any output before this line will interfere with JSON parsing
                            echo json_encode($response);
                        }  

                    }



                    else{
                
                        // $row1 = mysqli_fetch_array($result, MYSQLI_ASSOC);  
                        // $count1 = mysqli_num_rows($result); 
                        
                            
                            $sql = "INSERT INTO cart (uemail, pid,qty) VALUES (?,?,?)";
                            $stmt = mysqli_prepare($conn, $sql);
                            mysqli_stmt_bind_param($stmt, "sii", $useremail, $value, $qty);
                            $result = mysqli_stmt_execute($stmt);
                            mysqli_stmt_close($stmt);  

                            if(($result === true)){  
                                // echo "<h1><center> Added to cart </center></h1>";
                                // header('Content-Type: application/json');
                                $response = array('status' => 'success', 'message' => 'ADDED TO CART.');
                                // header("Location: profile.php");  
                            }  
                            else{  
                                // header('Content-Type: application/json');
                                $response = array('status' => 'success', 'message' => 'NOT ADDED TO CART.');
                                // Any output before this line will interfere with JSON parsing
                                echo json_encode($response);
                            }  
   

                       
                    }
                } catch (Exception $e) {
                    // An error occurred, send an error response
                    $response = array('status' => 'error', 'message' => 'Exception.');
                    // $response = array('status' => 'error', 'message' =>  $e->getMessage());
                    echo json_encode($response);
                }
        }
   

} else {
    // Not a POST request
    $response = array('status' => 'error', 'message' => 'Invalid request method.');
    echo json_encode($response);
}
?>

