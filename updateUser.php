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

        $servername = "localhost";
        $username = "root";
        $password = "";
        $db = "wellness_is";
        $date = date("Y-m-d H:i:s");
        $conn = new mysqli($servername, $username, $password, $db);

        if ($conn->connect_error)
        {
            die("Connection failed: " . $conn->connect_error);
        }
    ?>
    <body>
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            <div class="container-fluid">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="homepage.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="viewRecord.php">View Patients</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="selectRecord.php">Fill form</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="selectPatient.php">Search Patient</a>
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
                <a class="nav-link" href="logout.php">Logout</a>
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
                    <dt class="col-sm-3">User Type: </dt>
                    <dd class="col-sm-9"><?php echo $type;?></dd>
                    <dt class="col-sm-3">Password: </dt>
                    <dd class="col-sm-9"><?php echo $pw;?></dd>
                </dl>    
    <?php
        $insert = "UPDATE user SET username = '".$us."', name = '".$name."', type = '".$type."', password = '".$pw."' WHERE ID = '".$id."'";

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
            echo "No session exist or session has expired. Please log in again.<br>";
            echo "<a href=log-in.html> Login </a>";
        }
    ?>
    <br><button class="btn btn-primary" onclick="window.location.href='homepage.php'">Back to Home Page</button>
    </div>
    </body>
</html>

        