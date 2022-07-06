<html>
    <?php
        session_start();
        if(isset($_SESSION["username"])) {
    ?>
    <head>
        <title>KPJ Klang Wellness IS</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="test.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
            <div class="container-sm">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="homepage.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="viewRecord.php">Patient's Record</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="selectRecord.php">Fill form</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="selectPatient.php">Search Patient</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="viewReport.php">Chronological Summary</a>
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
                <a class="nav-link" href="logout.php" style="color: white; font-weight: 700;">Logout</a>
            </div>
        </nav>
        <br>
        <h1>User Registration Details</h1>
        <br>
        <div class="container">
                <dl class="row">
                    <dt class="col-sm-3">Username: </dt>
                    <dd class="col-sm-9"><?php echo $us;?></dd>
                    <dt class="col-sm-3">Name: </dt>
                    <dd class="col-sm-9"><?php echo $name;?></dd>
                    <dt class="col-sm-3">Position: </dt>
                    <dd class="col-sm-9"><?php echo $pos;?></dd>
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

        