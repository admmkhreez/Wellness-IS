<!DOCTYPE html>
<html>
    <?php
    session_start();
    if(isset($_SESSION["username"])) {

    $id = $_POST["id"];

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
    else{
        $select = "SELECT * from user WHERE ID = '".$id."'";
        $data = $conn->query($select);
    }
    ?>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>KPJ Klang Wellness IS</title>
        <link rel="stylesheet" href="test.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script>
            function confirm_reset() {
                return confirm("Are you sure you want to reset all input?");
            }
        </script>
    </head>
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
        <h1>Past Medical History</h1>
        <br>
        <div class="container">
    <?php
    if ($data->num_rows>0)
    {
        while($row=$data->fetch_assoc()){
    ?>
        <form action="updateUser.php" method="post">
        <dl class="row">
            <dt class="col-sm-3">Username: </dt>
            <dd class="col-sm-9"><input type="text" name="username" value="<?php echo $row["username"];?>"></dd>
            <dt class="col-sm-3">Name: </dt>
            <dd class="col-sm-9"><input type="text" name="name" value="<?php echo $row["name"];?>"></dd>
            <dt class="col-sm-3">Position: </dt>
            <dd class="col-sm-9"><input type="text" name="position" value="<?php echo $row["position"];?>"></dd>
            <dt class="col-sm-3">User Type: </dt>
            <dd class="col-sm-9"><input type="text" name="type" value="<?php echo $row["type"];?>"></dd>
            <dt class="col-sm-3">Password: </dt>
            <dd class="col-sm-9"><input type="text" name="pw" value="<?php echo $row["password"];?>"></dd>
            </dl>
        </dl>
        <div style="text-align: center;">
            <input type="reset" class="btn btn-danger" value="Reset" onclick="return confirm_reset();">
            <input type="submit" class="btn btn-primary" value="Update Info">
            <input type="hidden" name="id" value="<?php echo $id;?>">
        </div>
        </form>
        <?php
            }
        }
        else{
            echo "User does not exist in system.";
        }
        ?>
        </div>
    </body>
    <?php
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
</html>