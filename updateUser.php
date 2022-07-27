<!DOCTYPE html>
<html>
    <?php
        session_start();
        if(isset($_SESSION["username"])) {
    ?>
    <head>
        <title>Update User</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="wellness.css">
        <link rel="stylesheet" href="bootstrap.css">
    </head>
    <?php
        
        $id = $_POST["id"];
        $us = $_POST["username"];
        $name = $_POST["name"];
        $type = $_POST["type"];
        $pw = $_POST["pw"];
        $pos = $_POST["position"];

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
    ?>
    <body>
        <nav class="navbar sticky-top navbar-expand-sm bg-dark navbar-dark">
        <span class="nav-item" style="padding-left: 10px;color: white;"><?php echo $_SESSION["name"];?></span>
            <div class="container-sm">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="homepage.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="viewPatient.php">Patients</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="viewRecords.php">Records</a>
                    </li>
                    <?php
                        if($_SESSION["type"] == "admin"){
                    ?>
                    <li class="nav-item">
                        <a class="nav-link active" href="viewUser.php">View User</a>
                    </li>
                    <?php
                        }
                    ?>
                </ul>
                <form class="d-flex" method="post" style="margin-left: 400px;">
                    <input type="search" class="form-control me-2" placeholder="Search" aria-label="Search" name="mrn">
                    <button class="btn btn-outline-success" formaction="selectRecord.php">Search</button>
                </form>
            </div>
            <a class="btn btn-danger" href="logout.php" style="color: white; font-weight: 700; margin-right: 30px">Logout</a>
        </nav>
        <br>
        <h1 style='color: white;'>Update User Details</h1>
        <br>
        <div class="container">
                <dl class="row">
                    <dt class="col-sm-3">Username: </dt>
                    <dd class="col-sm-9"><?php echo $us;?></dd>
                    <dt class="col-sm-3">Name: </dt>
                    <dd class="col-sm-9"><?php echo $name;?></dd>
                    <dt class="col-sm-3">Position: </dt>
                    <dd class="col-sm-9"><?php echo nl2br($pos);?></dd>
                    <dt class="col-sm-3">User Type: </dt>
                    <dd class="col-sm-9"><?php echo $type;?></dd>
                    <dt class="col-sm-3">Password: </dt>
                    <dd class="col-sm-9"><?php echo $pw;?></dd>
                </dl>    
    <?php
        $insert = "UPDATE user SET username = '".$us."', name = '".$name."', type = '".$type."', password = '".$pw."', position = '".$pos."' WHERE ID = '".$id."'";

        if ($conn->query($insert) === TRUE)
        {
            echo "<div class='success'>Successfully registered patient</div>";
        }
        else
        {
            echo "Error : " . $conn->error;
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
    <br><button class="btn btn-primary" onclick="window.location.href='homepage.php'">Back to Home Page</button>
    </div>
    </body>
</html>

        