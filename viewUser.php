<!DOCTYPE html>
<html>
    <?php
        session_start();
        if(isset($_SESSION["username"])) {
    ?>
    <head>
        <title>KPJ Klang Wellness IS</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="wellness.css">
        <link rel="stylesheet" href="bootstrap.css">
    </head>
        <?php
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
                            <a class="nav-link" href="viewPatient.php">View Patient List</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="fillForm.php">Fill form</a>
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
                        <a class="nav-link btn btn-danger" href="logout.php" style="color: white; font-weight: 700;">Logout</a>
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
                        <td class="text-center"><input type="radio" class="form-check-input" name="id" value="<?php echo $row["ID"];?>" required></td>
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
            echo "<script type='text/javascript'>";
            echo "alert('Session does not exist. Please login again');";
            echo "window.location.href = 'log-in.html';";
            echo "</script>";
        }
        ?>
    </body>
</html>