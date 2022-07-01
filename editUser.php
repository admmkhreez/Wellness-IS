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
        echo "No session exist or session has expired. Please log in again.<br>";
        echo "<a href=log-in.html> Login </a>";
    }
    ?>
</html>