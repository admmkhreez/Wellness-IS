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

        $servername = "localhost";
        $username = "root";
        $password = "";
        $db = "wellness_is";
        $date = date("Y-m-d H:i:s");
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
        <h1>User Registration Details</h1>
        <br>
        <?php
        $check = "SELECT mrn FROM patient WHERE mrn = '".$mrn."'";
        $data = $conn->query($check);
        if ($data->num_rows>0)
        {
            while($row=$data->fetch_assoc())
            {
                if ($data === FALSE)
                {
        ?>
        <div class="container">
            <p>MRN: <?php echo $mrn;?></p>
            <p>Name: <?php echo $name;?></p>
            <p>I/C No/Passport: <?php echo $icpp;?></p>
            <p>Date of Birth: <?php echo $dob;?></p>
            <p>Home Address: <?php echo $address;?></p>
            <p>E-mail Address: <?php echo $email;?></p>
            <p>Telephone: <?php echo $tel;?></p>
            <p>Sex: <?php echo $sex;?></p>
            <p>Occupation: <?php echo $occupation;?></p>
            <p>Race: <?php echo $race;?></p>
            <p>Religion: <?php echo $religion;?></p>
            <p>Marital Status: <?php echo $mstatus;?></p>
            <p>Next of Kin: <?php echo $nok;?></p>
            <p>Relationship: <?php echo $rs;?></p>
            <p>Telephone No.: <?php echo $tel_nok;?></p>
            <p>Package Selected: <?php echo $package;?></p>
        </div>
    
    <?php
                    }
                    else{
                        echo "<div class='container'><p>Record already exist, click <a href='viewRecord.php'>here</a> to view</p>";
                        die;
                    }
                }       
            }
        if($package == "Custom"){
            $insert1 = "INSERT INTO patient (mrn, name, ic_passport, date_of_birth, address, email, telephone, sex, occupation, race, religion, marital_status, next_of_kin, relationship, telephone_nok, registeredOn, package, addons) 
            VALUES ('".$mrn."', '".$name."', '".$icpp."', '".$dob."', '".$address."', '".$email."', '".$tel."', '".$sex."', '".$occupation."', '".$race."', '".$religion."', '".$mstatus."', '".$nok."', '".$rs."', '".$tel_nok."', '".$date."', '".$package."', '".$addons."')";
        }
        else{
            $insert1 = "INSERT INTO patient (mrn, name, ic_passport, date_of_birth, address, email, telephone, sex, occupation, race, religion, marital_status, next_of_kin, relationship, telephone_nok, registeredOn, package, addons) 
            VALUES ('".$mrn."', '".$name."', '".$icpp."', '".$dob."', '".$address."', '".$email."', '".$tel."', '".$sex."', '".$occupation."', '".$race."', '".$religion."', '".$mstatus."', '".$nok."', '".$rs."', '".$tel_nok."', '".$date."', '".$package."', NULL)";
        }
        $insert2 = "INSERT INTO record (mrn) VALUES ('".$mrn."')";

        if ($conn->query($insert1) && $conn->query($insert2 )=== TRUE)
        {
            echo "<br><div class='container'><span class='success'>Successfully registered patient</span></div>";
        }
        else
        {
            echo "Error : " . $conn->error;
        }
        $conn->close();
        }
        else
        {
            echo "No session exist or session has expired. Please log in again.<br>";
            echo "<a href=log-in.html> Login </a>";
        }
    ?>
        <br><button class="btn btn-primary" onclick="window.location.href='homepage.php'">Back to Home Page</button>
    </body>
</html>