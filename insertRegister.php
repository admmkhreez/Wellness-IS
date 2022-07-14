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
        $mrn = $_POST["mrn"];
        $name = $_POST["name"];
        $icpp = $_POST["icpp"];
        $dob = $_POST["dob"];
        $address = $_POST["address"];
        $email = $_POST["email"];
        $tel = $_POST["telephone"];
        $sex = $_POST["sex"];
        $occupation = $_POST["occupation"];
        $race = $_POST["race"];
        $religion = $_POST["religion"];
        $mstatus = $_POST["marital_status"];
        $nok = $_POST["next_of_kin"];
        $rs = $_POST["relationship"];
        $tel_nok = $_POST["telephone_nok"];
        $package = $_POST["package"];
        if($package == "Custom"){
            $addons = $_POST["addons"];
        }
        $pic = $_SESSION["name"];

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
                        <a class="nav-link" href="selectPatient.php">Search</a>
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
        <h1 style='color: white;'>Patient Registration Details</h1>
        <br>
        <?php
        $check = "SELECT mrn FROM patient WHERE mrn = '".$mrn."'";
        $data = $conn->query($check);
        if ($data->num_rows>0)
        {
            while($row=$data->fetch_assoc())
            {
                if ($mrn == $row['mrn'])
                {
                    echo "<div class='container'><p>Record with MRN $mrn already exist<br><br>";
                    echo "  <form method='post'>
                                <input type='hidden' value='$mrn' name='mrn'>
                                <button formaction='selectRecord.php' class='btn btn-primary'>View Here</button>
                            </form>";
                    echo "</div>";
                    die;
                }       
            }       
        }
            if($package == "Custom"){
                $insert1 = "INSERT INTO patient (mrn, name, ic_passport, date_of_birth, address, email, telephone, sex, occupation, race, religion, marital_status, next_of_kin, relationship, telephone_nok, registeredOn, package, addons, pic) 
                VALUES ('".$mrn."', '".$name."', '".$icpp."', '".$dob."', '".$address."', '".$email."', '".$tel."', '".$sex."', '".$occupation."', '".$race."', '".$religion."', '".$mstatus."', '".$nok."', '".$rs."', '".$tel_nok."', '".$date."', '".$package."', '".$addons."', '".$pic."')";
            }
            else{
                $insert1 = "INSERT INTO patient (mrn, name, ic_passport, date_of_birth, address, email, telephone, sex, occupation, race, religion, marital_status, next_of_kin, relationship, telephone_nok, registeredOn, package, addons, pic) 
                VALUES ('".$mrn."', '".$name."', '".$icpp."', '".$dob."', '".$address."', '".$email."', '".$tel."', '".$sex."', '".$occupation."', '".$race."', '".$religion."', '".$mstatus."', '".$nok."', '".$rs."', '".$tel_nok."', '".$date."', '".$package."', NULL, '".$pic."')";
            }
           

            if ($conn->query($insert1)=== TRUE)
            {
            ?>
                <br><div class='container'><span class='success'>Successfully registered patient</span><br><br>
                <button class='btn btn-primary' onclick="window.location.href='homepage.php'">Back to Home Page</button><br><br>
                <form method="post">
                    <input type="hidden" value="<?php echo $mrn;?>" name="mrn">
                    <button formaction="selectRecord.php" class="btn btn-primary">View</button>
                </form>
            <?php
            }
            else
            {
                echo "Error : " . $conn->error;
            }
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
        </div>    
    </body>
    
</html>