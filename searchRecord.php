<!DOCTYPE html>
<html>
    <?php
        session_start();
        if(isset($_SESSION["type"])) {
    ?>
    <head>
        <title>Patient's Record</title>
        <link rel="stylesheet" href="test.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>
        <?php
            $kw = $_POST["keyword"];
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
                            <a class="nav-link active" href="homepage.php">Home</a>
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
                    </ul>
                    <a class="nav-link" href="logout.php">Logout</a>
                </div>
            </nav>
            <br>
            <h1>Patient's Record</h1>
            <br>
            <form method="post" style="text-align: center;">
                <input type="text" placeholder="Search" name="keyword" value="<?php echo $kw;?>">
                <button formaction="searchRecord.php" class="btn btn-primary">Search</button>
            </form>
            <br>
        <?php    
            $display = "SELECT a.mrn, name, ic_passport, address, email, lastUpdateMH, b.lastUpdate, registeredOn, package FROM patient a INNER JOIN record b
            ON a.mrn = b.mrn WHERE a.mrn LIKE '%$kw%' OR a.name LIKE '%$kw%' OR a.ic_passport LIKE '%$kw%' OR a.email LIKE '%$kw%'";
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
                echo "No session exist or session has expired. Please log in again.<br>";
                echo "<a href=log-in.html> Login </a>";
            }
            ?>
        </body>
</html>