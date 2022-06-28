<?php
$username = $_POST['username']; 
$password = $_POST['password'];

//declare DB connection variables
$servername = "localhost"; //host name
$user = "root"; //database userid 
$pass = ""; //database pwd
$db = "wellness_is";// please write your DB name 

// Create connection
$conn = new mysqli($servername, $user, $pass, $db);

// Check connection
if ($conn->connect_error) { 
 //to check if DB connection IS NOT OK
 die("Connection failed: " . $conn->connect_error); 
}
else
{ 
//connection OK - get records for the selected User account

$queryCheck = "SELECT * FROM user WHERE username = '".$username."'";

$resultCheck = $conn->query($queryCheck); 

    if ($resultCheck->num_rows == 0) 
    { //if no record match
        echo "<p style='color:red;'>User does not exist</p>";
        echo "<br>Click <a href='log-in.html'> here </a> to LOGIN again.";
	}
	else
    {	// record matched, get the data
	    while($row = $resultCheck->fetch_assoc()) {
		
	        if( $row["password"] == $password ) 
            {
                session_start();
                $_SESSION["username"] = $username ;
                $_SESSION["type"] = $row["type"];
                $_SESSION["name"] = $row["name"];
                //redirect to page menu.php
                header("Location:homepage.php");
		    }
            else
            {
                echo "<p style='color:red;'>Wrong Password!!!</p>";
                echo "<br>Click <a href='log-in.html'> here </a> to login again.";
            }
	
        }
        $conn->close();
    }
}
?>
