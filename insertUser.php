<!DOCTYPE html>
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
        $user_name = $_POST["username"];
        $pw = $_POST["password"];
        $name = $_POST["name"];
        $type = $_POST["type"];
        $position = $_POST["position"];

        $servername = "localhost";
        $username = "root";
        $password = "";
        $db = "wellness_is";
        date_default_timezone_set("Asia/Kuala_Lumpur");
        $date = date("Y-m-d H:i:s");

        $conn = new mysqli($servername, $username, $password, $db);

        if ($conn->connect_error)
        {
            die("Connection failed: " . $conn->connect_error);
        }
    ?>
        <nav class="navbar sticky-top navbar-expand-sm bg-dark navbar-dark">
            <div class="container-sm">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="homepage.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="viewPatient.php">View Patient List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="selectPatient.php">Search Patient</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="viewReport.php">View Patient's Report</a>
                    </li>
                    <?php
                        if($_SESSION["type"] == "admin"){
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="viewUser.php">View User</a>
                    </li>
                    <?php
                        }
                    ?>
                </ul>
                    <a class="nav-link btn btn-danger" href="logout.php" style="color: white; font-weight: 700;">Logout</a>
            </div>
        </nav>
        <br>
        <h1>Patient Medical History</h1>
        <br>
        <div class="container">
            <dl class="row">
                <dt class="col-sm-3">Username: </dt>
                <dd class="col-sm-9"><?php echo $user_name;?></dd>
                <dt class="col-sm-3">Password: </dt>
                <dd class="col-sm-9"><?php echo $pw;?></dd>
                <dt class="col-sm-3">Name: </dt>
                <dd class="col-sm-9"><?php echo $name;?></dd>
                <dt class="col-sm-3">Position: </dt>
                <dd class="col-sm-9"><?php echo nl2br($position);?></dd>
                <dt class="col-sm-3">User Type: </dt>
                <dd class="col-sm-9"><?php echo $type;?></dd>
            </dl>
        
            <?php
            $insert = "INSERT INTO user (username, password, name, position, type) VALUES ('".$user_name."', '".$pw."', '".$name."', '".$position."', '".$type."')";
            $data = $conn->query($insert);

            if($data === TRUE)
            {
            ?>
                <p class='success'>Successfully Inserted New User</p>
                <a class="btn btn-primary" href="viewUser.php">View</a>
            <?php
            }
            else
            {
                echo "Error: " . $insert . "<br>" . $conn->error;
            }
            $conn->close();
            }
            else
            {
                echo "<script type='text/javascript'>";
                echo "alert('Session does not exist. Please login again');";
                echo "window.location.href = 'log-in.html';";
                echo "</script>";
            }   
            ?>
        </div>
    </body>
</html>