
<html>
    <?php
        session_start();
        if(isset($_SESSION["username"])) {
    ?>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>KPJ Klang Wellness IS</title>
        <link rel="stylesheet" href="wellness.css">
        <link rel="stylesheet" href="bootstrap.css">
    </head>
    <body>
        <?php
            $mrn = $_POST["mrn"];
            $servername = "localhost";
            $username = "root";
            $password = "";
            $db = "wellness_is";
            date_default_timezone_set("Asia/Kuala_Lumpur");

            $conn = new mysqli($servername, $username, $password, $db);

            if ($conn->connect_error)
            {
                die("Connection failed: " . $conn->connect_error);
            }

            $delete = "DELETE FROM patient WHERE mrn = '".$mrn."'";
            $data = $conn->query($delete);

            if ($data === TRUE) 
            {
                echo "<script type='text/javascript'>";
                echo "alert('Record successfully deleted, redirecting to home page.');";
                echo "window.location.href = 'homepage.php';";
                echo "</script>";
            }
            else
            {
                echo "Error : " . $conn->error;
            }
            }
            else
            {
                echo "<script type='text/javascript'>";
                echo "alert('Session does not exist. Please login again');";
                echo "window.location.href = 'log-in.html';";
                echo "</script>";
            }   
            ?>
    </body>
</html>