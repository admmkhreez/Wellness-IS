<!DOCTYPE html>
<html>
    <?php
        session_start();
        if(isset($_SESSION["username"])) {
    ?>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            .unstyled-button {
                border: none;
                padding: 0;
                background: none;
                text-decoration: underline;
                color: blue;
            }
        </style>
        <title>KPJ Klang Wellness IS</title>
        <link rel="stylesheet" href="wellness.css">
        <link rel="stylesheet" href="bootstrap.css">
    </head>
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
        <h1 style='color: white;'>Physical Examinantion</h1>
        <br>
        <?php
            $mrn = $_POST["mrn"];
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
            $check = "SELECT mrn FROM patient WHERE mrn = '".$mrn."'";
            $data = $conn->query($check);
            if ($data->num_rows>0)
            {
                while($row=$data->fetch_assoc())
                {
        ?>
        <div class="container">
            <form method="post" action="selectRecord.php" style="margin-bottom: 20px;">
                <input type="submit" value="Back" class="btn btn-danger" style="position: relative;">
                <input type="hidden" value="<?php echo $mrn;?>" name="mrn">
            </form>
            <p>MRN: <?php echo $mrn;?></p>
            <form action="insertExam.php" method="post">
                <label class="inline" for="appearance">General Appearance: </label>
                <input type="text" id="appearance" name="appearance" required><br>
                <label class="inline" for="weight">Weight: </label>
                <input type="number" id="weight" step=".1" name="weight" required>kg<br>
                <label class="inline" for="height">Height: </label>
                <input type="number" id="height" step=".1" name="height" required>cm<br>
                <label class="inline" for="systolic">Systolic: </label>
                <input type="number" id="systolic" step="1" name="systolic" required><br>
                <label class="inline" for="diastolic">Diastolic: </label>
                <input type="number" id="diastolic" step="1" name="diastolic" required><br>
                <label class="inline" for="pulse">Pulse: </label>
                <input type="number" id="pulse" step="1" name="pulse" required><br>
                <div class="lrcol">
                    <h3>Eyes</h3>
                    Visual Acuity (Aided)<br>
                    <label class="inline" for="va_aidedl">Left: </label>
                    <input type="text" id="va_aidedl" name="va_aidedl" required>
                    <label class="inline" for="va_aidedr">Right: </label>
                    <input type="text" id="va_aidedr" name="va_aidedr" required>
                    <br>Visual Acuity (Unaided)<br>
                    <label class="inline" for="va_unaidedl">Left: </label>
                    <input type="text" id="va_unaidedl" name="va_unaidedl" required>
                    <label class="inline" for="va_unaidedr">Right: </label>
                    <input type="text" id="va_unaidedr" name="va_unaidedr" required>
                    <br>Colour<br>
                    <label class="inline" for="colour_l">Left: </label>
                    <input type="text" id="colour_l" name="colour_l" required>
                    <label class="inline" for="colour_r">Right: </label>
                    <input type="text" id="colour_r" name="colour_r" required>
                    <br>Fundoscopy<br>
                    <label class="inline" for="fundoscopy_l">Left: </label>
                    <input type="text" id="fundoscopy_l" name="fundoscopy_l" required>
                    <label class="inline" for="fundoscopy_r">Right: </label>
                    <input type="text" id="fundoscopy_r"name="fundoscopy_r" required>  
                </div> 
                <input type="submit" value="Submit" class="btn btn-primary">
                <input type="hidden" value="<?php echo $mrn;?>" name="mrn">
            </form>
        <?php
                }
            }
            else{
        ?>
            <div class="container">
                <form method="post">
                    <p>
                        Patient does not exist, register <button formaction="homepage.php" class="unstyled-button">here</button>
                    </p>
                        <input type="hidden" name="mrn" value="<?php echo $mrn;?>">
                        <input type="hidden" name="check" value="">
                </form>
            </div>
        <?php
            }
        }
        else
        {
            echo "<script type='text/javascript'>";
            echo "alert('Session does not exist. Please login again');";
            echo "window.location.href = 'log-in.html';";
            echo "</script>";
        }
        ?>
        </div>
    </body>        
</html>