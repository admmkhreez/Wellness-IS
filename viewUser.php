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
                            <a class="nav-link" href="selectPatient.php">Search Patient</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="viewReport.php">View Patient's Report</a>
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
            <table style="" class="table table-bordered">
                <thead class="table-dark" style="text-align:center;">
                    <tr>
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
                        <th rowspan="2" style="text-align: right;">
                            Actions
                        </th>
                    </tr>
                </thead>
            <?php
            if ($data->num_rows > 0)
            {
                while($row = $data->fetch_assoc())
                {
            ?> 
                <tbody style="background-color:#e3f0ff;">
                    <tr>
                        <td><?php echo $row['username'];?></td>
                        <td><?php echo $row['name'];?></td>
                        <td><?php echo $row['type'];?></td>
                        <td><?php echo $row['password'];?></td>
                        <td style="text-align: right;">
                            <button formaction="editUser.php" class="btn btn-primary">Edit</button>
                            <button formaction="deleteUser.php" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?');">Delete</button>
                        </td>
                        <input type="hidden" name="id" value="<?php echo $row["ID"];?>">
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
        </form>
        <a class="btn btn-primary" href="addUser.php" style="width: 100px;">Add User</a>
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