<!DOCTYPE html>
<html>
    <?php
        session_start();
        if(isset($_SESSION["username"])) {
    ?>
    <head>
        <meta charset="UTF-8">
        <title>Wellness Information System</title>
        <link rel="stylesheet" href="test.css">
    </head>
    <body>    
        <h1>KPJ Klang Wellness Information System</h1>
        <a href="register.php">Patient Registration</a><br>
        <a href="viewRecord.php">View Patient's List</a><br>
        <a href="selectRecord.php">Insert Medical Report</a><br>
        <a href="selectPatient.php">Select Patient</a><br>
        <br><br>
        <a href="logout.php">Logout</a>
    </body>
    <?php
        }
        else
        {
        echo "No session exists or session has expired. Please log in again.<br>";
        echo "<a href=log-in.html> Login </a>";
        }
    ?>
</html>