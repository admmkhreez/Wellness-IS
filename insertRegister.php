<html>
    <head>
        <title>User Registration</title>
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
        $sex = $_POST["sex"];
        $occupation = $_POST["occupation"];
        $race = $_POST["race"];
        $religion = $_POST["religion"];
        $mstatus = $_POST["marital_status"];
        $nok = $_POST["next_of_kin"];
        $rs = $_POST["relationship"];
        $tel_nok = $_POST["telephone_nok"];
        $package = $_POST["package"];

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
            $check = "SELECT mrn FROM patient WHERE mrn = '".$mrn."'";
            $data = $conn->query($check);
            if ($data->num_rows>0)
            {
                while($row=$data->fetch_assoc())
                {
                    if ($data === FALSE)
                    {
    ?>
    <body>
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            <div class="container-fluid">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="homepage.php">Home</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="viewRecord.php">View Latest Patients</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="selectRecord.php">Fill form</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="selectPatient.php">Search Patient</a>
                    </li>
                    <li class="nav-item">
                            <a class="nav-link" href="selectHistory.php">Medical History</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </nav>
        <h1>User Registration Details</h1>
        <div class="reference">
        <p>MRN: <?php echo $mrn;?></p>
        <p>Name: <?php echo $name;?></p>
        <p>I/C No/Passport: <?php echo $icpp;?></p>
        <p>Date of Birth: <?php echo $dob;?></p>
        <p>Home Address: <?php echo $address;?></p>
        <p>E-mail Address: <?php echo $email;?></p>
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
    </body>
    <?php
                    }
                    else{
                        echo "<nav class='navbar navbar-expand-sm bg-dark navbar-dark'>
                        <div class='container-fluid'>
                            <ul class='navbar-nav'>
                                <li class='nav-item'>
                                    <a class='nav-link' href='homepage.php'>Home</a>
                                </li>
                                <li class='nav-item'>
                                <a class='nav-link' href='viewRecord.php'>View Latest Patients</a>
                                </li>
                                <li class='nav-item'>
                                    <a class='nav-link' href='selectRecord.php'>Fill form</a>
                                </li>
                                <li class='nav-item'>
                                    <a class='nav-link' href='selectPatient.php'>Search Patient</a>
                                </li>
                                <li class='nav-item'>
                                    <a class='nav-link' href='selectHistory.php'>Medical History</a>
                                </li>
                                <li class='nav-item'>
                                    <a class='nav-link' href='logout.php'>Logout</a>
                                </li>
                            </ul>
                        </div>
                        </nav>";
                        echo "<h1>KPJ Klang Wellness Information System</h1>";
                        echo "<div class='container'><p>Record already exist, click <a href='viewRecord.php'>here</a> to view</p>";
                        die;
                    }
                }       
            }
        
        $insert1 = "INSERT INTO patient (mrn, name, ic_passport, date_of_birth, address, email, sex, occupation, race, religion, marital_status, next_of_kin, relationship, telephone_nok, registeredOn, package) 
        VALUES ('".$mrn."', '".$name."', '".$icpp."', '".$dob."', '".$address."', '".$email."', '".$sex."', '".$occupation."', '".$race."', '".$religion."', '".$mstatus."', '".$nok."', '".$rs."', '".$tel_nok."', '".$date."', '".$package."')";
        $insert2 = "INSERT INTO record (mrn) VALUES ('".$mrn."')";

        if ($conn->query($insert1) && $conn->query($insert2 )=== TRUE)
        {
            echo "<div class='success'>Successfully registered patient</div>";
        }
        else
        {
            echo "Error : " . $conn->error;
        }
        $conn->close();
    ?>
    <br><button class="btn btn-primary" onclick="window.location.href='homepage.php'">Back to Home Page</button>
</html>