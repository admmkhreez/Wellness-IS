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
        $mrn1 = $_POST["mrn1"];
        $mrn = $_POST["mrn"];
        $name = $_POST["name"];
        $icpp = $_POST["icpp"];
        $dob = $_POST["dob"];
        $address = $_POST["address"];
        $email = $_POST["email"];
        $tel = $_POST["tel"];
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
        <span class="nav-item" style="padding-left: 10px;color: white;"><?php echo $_SESSION["name"];?></span>
            <div class="container-sm">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="homepage.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="viewPatient.php">Patients List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="viewRecords.php">Records</a>
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
                <form class="d-flex" method="post" style="margin-left: 400px;">
                    <input type="search" class="form-control me-2" placeholder="Search" aria-label="Search" name="mrn">
                    <button class="btn btn-outline-success" formaction="selectRecord.php">Search</button>
                </form>
            </div>
            <a class="btn btn-danger" href="logout.php" style="color: white; font-weight: 700; margin-right: 30px">Logout</a>
        </nav>
        <br>
        <h1 style='color: white;'>Update Patient's Details</h1>
        <br>
        <div class="container">
                <dl class="row">
                    <dt class="col-sm-3">MRN: </dt>
                    <dd class="col-sm-9"><?php echo $mrn;?></dd>
                    <dt class="col-sm-3">Name: </dt>
                    <dd class="col-sm-9"><?php echo $name;?></dd>
                    <dt class="col-sm-3">IC No/Passport: </dt>
                    <dd class="col-sm-9"><?php echo $icpp;?></dd>
                    <dt class="col-sm-3">Date of Birth: </dt>
                    <dd class="col-sm-9"><?php echo $dob;?></dd>
                    <dt class="col-sm-3">Home Address: </dt>
                    <dd class="col-sm-9"><?php echo $address;?></dd>
                    <dt class="col-sm-3">Email: </dt>
                    <dd class="col-sm-9"><?php echo $email;?></dd>
                    <dt class="col-sm-3">Telephone: </dt>
                    <dd class="col-sm-9"><?php echo $tel;?></dd>
                    <dt class="col-sm-3">Sex: </dt>
                    <dd class="col-sm-9"><?php echo $sex;?></dd>
                    <dt class="col-sm-3">Occupation: </dt>
                    <dd class="col-sm-9"><?php echo $occupation;?></dd>
                    <dt class="col-sm-3">Race: </dt>
                    <dd class="col-sm-9"><?php echo $race;?></dd>
                    <dt class="col-sm-3">Religion: </dt>
                    <dd class="col-sm-9"><?php echo $religion;?></dd>
                    <dt class="col-sm-3">Marital Status: </dt>
                    <dd class="col-sm-9"><?php echo $mstatus;?></dd>
                    <dt class="col-sm-3">Next of Kin: </dt>
                    <dd class="col-sm-9"><?php echo $nok;?></dd>
                    <dt class="col-sm-3">Relationship: </dt>
                    <dd class="col-sm-9"><?php echo $rs;?></dd>
                    <dt class="col-sm-3">Telephone: </dt>
                    <dd class="col-sm-9"><?php echo $tel_nok;?></dd>
                    <dt class="col-sm-3">Package: </dt>
                    <dd class="col-sm-9"><?php echo $package;?></dd>
                    <?php
                        if($package == "Custom"){
                    ?>
                    <dt class="col-sm-3">Additional Test: </dt>
                    <dd class="col-sm-9"><?php echo nl2br($addons);?></dd>
                    <?php
                        }
                    ?>
                </dl>    
    <?php
        if($package == "Custom"){
            $insert = "UPDATE patient SET mrn = '".$mrn."', name = '".$name."', ic_passport = '".$icpp."', date_of_birth = '".$dob."', address = '".$address."', email = '".$email."', telephone = '".$tel."',
            sex = '".$sex."', occupation = '".$occupation."', race = '".$race."', religion = '".$religion."', marital_status = '".$mstatus."', next_of_kin = '".$nok."', relationship = '".$rs."',
            telephone_nok = '".$tel_nok."', package = '".$package."', lastUpdateOn = '".$date."', addons = '".$addons."', pic = '".$pic."' WHERE mrn = '".$mrn1."'";
        }
        else{
            $insert = "UPDATE patient SET mrn = '".$mrn."', name = '".$name."', ic_passport = '".$icpp."', date_of_birth = '".$dob."', address = '".$address."', email = '".$email."', telephone = '".$tel."',
            sex = '".$sex."', occupation = '".$occupation."', race = '".$race."', religion = '".$religion."', marital_status = '".$mstatus."', next_of_kin = '".$nok."', relationship = '".$rs."',
            telephone_nok = '".$tel_nok."', package = '".$package."', lastUpdateOn = '".$date."', addons = NULL, pic = '".$pic."' WHERE mrn = '".$mrn1."'";
        }
        

        if ($conn->query($insert) === TRUE)
        {
            echo "<div class='success'>Successfully registered patient</div>";
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
    <br><button class="btn btn-primary" onclick="window.location.href='homepage.php'">Back to Home Page</button><br><br>
    <form method="post">
        <input type="hidden" value="<?php echo $mrn;?>" name="mrn">
        <button formaction="selectRecord.php" class="btn btn-primary">View</button>
    </form>
    </div>
    </body>
</html>