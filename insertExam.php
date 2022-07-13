<!DOCTYPE html>
<html>
    <?php
        session_start();
        if(isset($_SESSION["username"])) {
    ?>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>KPJ Klang Wellness IS</title>
        <link rel="stylesheet" href="wellness.css">
        <link rel="stylesheet" href="bootstrap.css">
    </head>
    <body>
    <?php
        $mrn = $_POST["mrn"];
        $appearance = $_POST["appearance"];
        $weight = $_POST["weight"];
        $height = $_POST["height"];
        $systolic = $_POST["systolic"];
        $diastolic = $_POST["diastolic"];
        $pulse = $_POST["pulse"];
        $va_aidedl = $_POST["va_aidedl"];
        $va_aidedr = $_POST["va_aidedr"];
        $va_unaidedl = $_POST["va_unaidedl"];
        $va_unaidedr = $_POST["va_unaidedr"];
        $colour_l = $_POST["colour_l"];
        $colour_r = $_POST["colour_r"];
        $fundoscopy_l = $_POST["fundoscopy_l"];
        $fundoscopy_r = $_POST["fundoscopy_r"];
        $heightm = $height/100;
        $temp = $weight/($heightm*$heightm);
        $bmi = number_format((float)$temp, 2, '.', '');

        $servername = "localhost";
        $username = "root";
        $password = "";
        $db = "wellness_is";
        date_default_timezone_set("Asia/Kuala_Lumpur");
        $date = date("Y-m-d H:i:s");
        $conn = new mysqli($servername, $username, $password, $db);    
            
        if ($conn->connect_error)
        {
            die("Connection failed: " . $conn->connect_error);
        }
    ?>
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
                        <a class="nav-link" href="viewUser.php">View User</a>
                    </li>
                    <?php
                        }
                    ?>
                </ul>
                    <a class="nav-link btn btn-danger" href="logout.php" style="color: white; font-weight: 700;">Logout</a>
            </div>
        </nav>
        <br>
        <h1>Physical Examinantion</h1>
        <br>
        <div class="container">
            <dl class="row">
                <dt class="col-sm-3">General Appearance: </dt>
                <dd class="col-sm-9"><?php echo $appearance;?></dd>
                <dt class="col-sm-3">Weight: </dt>
                <dd class="col-sm-9"><?php echo $weight;?></dd>
                <dt class="col-sm-3">Height: </dt>
                <dd class="col-sm-9"><?php echo $height;?></dd>
                <dt class="col-sm-3">BMI: </dt>
                <dd class="col-sm-9"><?php echo $bmi;?></dd>
                <dt class="col-sm-3">Blood Pressure: </dt>
                <dd class="col-sm-9"><?php echo $systolic;?>/<?php echo $diastolic;?></dd>
            </dl>
        
            <h3>Eyes</h3>
            <table style="table-layout: fixed; width:100%;" class="table table-bordered">
                <thead class="table-dark" style="text-align:center;">
                    <tr>
                        <th></th>
                        <th>Left</th>
                        <th>Right</th>
                    </tr>
                </thead>
                <tbody>
                <tr>
                    <th>Visual Acuity(Aided)</th>
                    <td><?php echo $va_aidedl;?></td>
                    <td><?php echo $va_aidedr;?></td>
                </tr>
                <tr>
                    <th>Visual Acuity(Unaided)</th>
                    <td><?php echo $va_unaidedl;?></td>
                    <td><?php echo $va_unaidedr;?></td>
                </tr>
                <tr>
                    <th>Colour</th>
                    <td><?php echo $colour_l;?></td>
                    <td><?php echo $colour_r;?></td>
                </tr>
                <tr>
                    <th>Fundoscopy</th>
                    <td><?php echo $fundoscopy_l;?></td>
                    <td><?php echo $fundoscopy_r;?></td>
                </tr>
                </tbody>
            </table>
    <?php
        $insert = "UPDATE patient SET appearance = '".$appearance."', weight = '".$weight."', height = '".$height."', bmi = '".$bmi."', systolic = '".$systolic."', 
        diastolic = '".$diastolic."', pulse = '".$pulse."', va_aidedl = '".$va_aidedl."', va_aidedr = '".$va_aidedr."', va_unaidedl = '".$va_unaidedl."', va_unaidedr = '".$va_unaidedr."', 
        colour_r = '".$colour_r."', colour_l = '".$colour_l."', fundoscopy_r = '".$fundoscopy_r."', fundoscopy_l = '".$fundoscopy_l."' WHERE mrn = '".$mrn."'";
        
        if ($conn->query($insert) === TRUE)
            {
    ?>
                <p class='success'>Successfully Inserted medical report</p>
                <form method="post">
                    <button class="btn btn-primary" formaction="selectRecord.php">View</button>
                    <input type="hidden" name="mrn" value="<?php echo $mrn;?>">
                </form>
    <?php
            }
            else
            {
                echo "Error: " . $insert . "<br>" . $conn->error;
            }
            $conn->close();
    ?>
        </div>
    </body>
    <?php 
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
