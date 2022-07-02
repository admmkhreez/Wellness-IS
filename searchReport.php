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
            $start = $_POST["startDate"];
            $end = $_POST["endDate"];
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
            <nav class="navbar sticky-top navbar-expand-sm bg-dark navbar-dark">
                <div class="container-sm">
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
                        <li class="nav-item">
                            <a class="nav-link active" href="viewReport.php">View Report</a>
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
                    <a class="nav-link" href="logout.php">Logout</a>
                </div>
            </nav>
            <br>
            <h1>Patient's Record</h1>
            <br>
            <form method="post" style="text-align: center; color: white;">
                Between <input type="date" name="startDate" value="<?php echo $start;?>"> And
                <input type="date" name="endDate" value="<?php echo $end;?>">
                <button formaction="searchReport.php" class="btn btn-primary">Search</button>
            </form>
            <br>
        <?php    
            $display = "SELECT a.mrn, name, ic_passport, address, email, lastUpdateMH, b.lastUpdate, registeredOn, package FROM patient a INNER JOIN record b
            ON a.mrn = b.mrn WHERE b.lastUpdate BETWEEN '".$start."' AND '".$end."'";
            $data = $conn->query($display);
        ?>
                <table style="width: 100%;" height="100%" class="table table-bordered">
                    <thead class="table-dark" style="text-align:center;">
                        <tr>
                            <th rowspan="2">
                                MRN
                            </th>
                            <th rowspan="2">
                                Name
                            </th>
                            <th rowspan="2">
                                I/C No/Passport
                            </th>
                            <th rowspan="2">
                                Address
                            </th>
                            <th rowspan="2">
                                Email
                            </th>
                            <th colspan="4">
                                Last Updated On
                            </th>
                            <th rowspan="2">
                                Registered On
                            </th>
                            <th rowspan="2">
                                Package
                            </th>
                        </tr>
                        <tr>
                            <th colspan="2">Medical History</th>
                            <th colspan="2">Report Form</th>
                        </tr>
                    </thead>
                    <tbody style="background-color:white;"
                <?php
                if ($data->num_rows > 0)
                {
                    while($row = $data->fetch_assoc())
                    {
                ?> 
                    >
                        <tr>
                            <td><?php echo $row['mrn'];?></td>
                            <td><?php echo $row['name'];?></td>
                            <td><?php echo $row['ic_passport'];?></td>
                            <td><?php echo $row['address'];?></td>
                            <td><?php echo $row['email'];?></td>
                            <td colspan="2"><?php echo $row['lastUpdateMH'];?></td>
                            <td colspan="2"><?php echo $row['lastUpdate'];?></td>
                            <td><?php echo $row['registeredOn'];?></td>
                            <td><?php echo $row['package'];?></td>
                        </tr>
                        <?php
                            }
                        }
                        else
                        {
                            echo "<tr><td colspan = '12' style='text-align: center;'>No Patient Found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
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