<!DOCTYPE html>
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
            $servername = "localhost";
            $username = "root";
            $password = "";
            $db = "wellness_is";

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
            <h1>Users</h1>
            <br>
        <?php    
            $display = "SELECT *  FROM user";
            $data = $conn->query($display);
        ?>
        <form method="post">
            <table style="width: 100%;" class="table table-bordered">
                <thead class="table-dark" style="text-align:center;">
                    <tr>
                        <th>

                        </th>
                        <th rowspan="2">
                            Username
                        </th>
                        <th rowspan="2">
                            Name
                        </th>
                        <th rowspan="2">
                            User Type
                        </th>
                        <th rowspan="2">
                            Password
                        </th>
                    </tr>
                </thead>
            <?php
            if ($data->num_rows > 0)
            {
                while($row = $data->fetch_assoc())
                {
            ?> 
                <tbody style="background-color:white;">
                    <tr>
                        <td class="text-center"><input type="radio" name="id" value="<?php echo $row["ID"];?>" required></td>
                        <td><?php echo $row['username'];?></td>
                        <td><?php echo $row['name'];?></td>
                        <td><?php echo $row['type'];?></td>
                        <td><?php echo $row['password'];?></td>
                    </tr>
                </tbody>
            <?php
                }
            }
            else
            {
                echo "<tr><td colspan = '5'>No User Found</td></tr>";
            }
            ?>
            </table>
            <div class="text-center">
                <button formaction="editUser.php" class="btn btn-primary">Next ></button>
            </div>
        </form>
        <?php
        $conn->close();
        }
        else
        {
            echo "No session exist or session has expired. Please log in again.<br>";
            echo "<a href=log-in.html> Login </a>";
        }
        ?>
    </body>
</html>