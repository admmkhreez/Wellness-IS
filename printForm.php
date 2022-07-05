<!DOCTYPE html>
<html>
    <?php
        session_start();
        if(isset($_SESSION["username"])) {
    ?>
    <head>
        <title>Health Screening Report Card</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="test.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <?php
            $mrn = $_POST['mrn'];
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

            $display = "SELECT * FROM patient a, record b WHERE a.mrn = '".$mrn."' AND b.mrn = '".$mrn."'";
            $data = $conn->query($display);
        ?>
    </head>
    <body>
        <div id="non-printable">
            <nav class="navbar sticky-top navbar-expand-sm bg-dark navbar-dark">
                <div class="container-sm">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="homepage.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="viewRecord.php">Patient's Record</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="selectRecord.php">Fill form</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="selectPatient.php">Search Patient</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="viewReport.php">Chronological Summary</a>
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
            <h1  id="top">KPJ Klang Wellness Information System</h1>
            <br>
        </div>
        <?php
            if ($data->num_rows > 0)
            {
                while ($row = $data->fetch_assoc())
                {
        ?>
        <div class="container">
            <div id="non-printable">
                <form method="post" style="text-align:center;">
                    <div class="btn-group" style="width:100%;">
                        <input type="hidden" name="mrn" value="<?php echo $mrn;?>">
                        <input type="hidden" name="sex" value="<?php echo $row['sex'];?>">
                        <input type="hidden" name="package" value="<?php echo $row['package'];?>">
                        <button formaction="viewPatient.php" class="btn btn-primary">View Patient's Details</button>
                        <button formaction="editProfile.php" class="btn btn-primary">Edit Patient's Details</button>
                        <?php
                            if($_SESSION["type"] == "Doctor" || $_SESSION["type"] == "admin"){
                        ?>
                        <button formaction="recordUpdateForm.php" class="btn btn-primary">Update Patient's Record</button>
                        <?php
                            }
                        ?>
                        <button formaction="historyUpdateForm.php" class="btn btn-primary">Update Medical History</button>
                        <button formaction="printForm.php" class="btn btn-primary active">Printable Form</button>
                    </div>    
                </form>
            </div>
        </div>
            <div id="printable">
                    <img src="logo.png" width="200px" height="54px" class="rounded mx-auto d-block"><br>
                    <h4 class="text-center">Health Screening Services</h4><br>
                    <h5>Personal Information</h5>
                    <label for="mrn" class="inline">MRN</label>
                    <span id="mrn">: <?php echo $row["mrn"];?></span><br>
                    <label for="name" class="inline">Name</label>
                    <span id="name">: <?php echo $row["name"];?></span><br>
                    <label for="icpp" class="inline">IC No/Passport</label>
                    <span id="icpp">: <?php echo $row["ic_passport"];?></span><br>
                    <label for="dob" class="inline">Date of Birth</label>
                    <span id="dob">: <?php echo $row["date_of_birth"];?></span><br>
                    <label for="address" class="inline">Home Address</label>
                    <span id="address">: <?php echo $row["address"];?></span><br>
                    <label for="email" class="inline">Email</label>
                    <span id="email">: <?php echo $row["email"];?></span><br>
                    <label for="tel" class="inline">Telephone</label>
                    <span id="tel">: <?php echo $row["telephone"];?></span><br>
                    <label for="sex" class="inline">Sex</label>
                    <span id="sex">: <?php echo $row["sex"];?></span><br>
                    <label for="occupation" class="inline">Occupation</label>
                    <span id="occupation">: <?php echo $row["occupation"];?></span><br>
                    <label for="race" class="inline">Race</label>
                    <span id="race">: <?php echo $row["race"];?></span><br>
                    <label for="religion" class="inline">Religion</label>
                    <span id="religion">: <?php echo $row["religion"];?></span><br>
                    <label for="mstatus" class="inline">Marital Status</label>
                    <span id="mstatus">: <?php echo $row["marital_status"];?></span><br>
                    <label for="package" class="inline">Package</label>
                    <span id="package">: <?php echo $row["package"];?></span><br>
                    <label for="addons" class="inline">Additional Test</label>
                    <span id="addons">: <?php echo nl2br($row["addons"]);?></span><br><br>
                    <h5>Next of Kin</h5>
                    <label for="nok" class="inline">Next of Kin</label>
                    <span id="nok">: <?php echo $row["next_of_kin"];?></span><br>
                    <label for="rs" class="inline">Relationship</label>
                    <span id="rs">: <?php echo $row["relationship"];?></span><br>
                    <label for="telnok" class="inline">Telephone</label>
                    <span id="telnok">: <?php echo $row["telephone_nok"];?></span><br><br>
                    <div style="break-after:page;"></div>
                    <h5>Past Medical History</h5>
                    <label for="smoker" class="inline">Smoker/Non Smoker</label>
                    <span id="smoker">: <?php echo $row["smoker"];?></span><br>
                    <label for="asthma" class="inline">Asthma</label>
                    <span id="asthma">: <?php echo $row["asthma"];?></span><br>
                    <label for="diabetes" class="inline">Diabetes</label>
                    <span id="diabetes">: <?php echo $row["diabetes"];?></span><br>
                    <label for="heart" class="inline">Heart Disease</label>
                    <span id="heart">: <?php echo $row["heart_disease"];?></span><br>
                    <label for="hyper" class="inline">Hypertension</label>
                    <span id="hyper">: <?php echo $row["hypertension"];?></span><br>
                    <label for="stroke" class="inline">Stroke</label>
                    <span id="stroke">: <?php echo $row["stroke"];?></span><br>
                    <label for="cancer" class="inline">Cancer</label>
                    <span id="cancer">: <?php echo $row["cancer"];?></span><br>
                    <label for="tb" class="inline">Tuberculosis</label>
                    <span id="tb">: <?php echo $row["tuberculosis"];?></span><br>
                    <label for="skind" class="inline">Skin Disease</label>
                    <span id="skind">: <?php echo $row["skin_disease"];?></span><br>
                    <label for="kidneyp" class="inline">Kidney Problem</label>
                    <span id="kidneyp">: <?php echo $row["kidneyp"];?></span><br>
                    <label for="fits" class="inline">Fits/Psychiatric</label>
                    <span id="fits">: <?php echo $row["fits_psychiatric"];?></span><br><br>
                    <h5>Family History</h5>
                    <label for="father" class="inline">Father</label>
                    <span id="father">: <?php echo $row["father_history"];?></span><br>
                    <label for="mother" class="inline">Mother</label>
                    <span id="mother">: <?php echo $row["mother_history"];?></span><br>
                    <label for="siblings" class="inline">Siblings</label>
                    <span id="siblings">: <?php echo $row["siblings_history"];?></span><br>
                    <label for="habits" class="inline">Habits</label>
                    <span id="habits">: <?php echo $row["habits"];?></span><br>
                    <label for="allergy" class="inline">Allergy</label>
                    <span id="allergy">: <?php echo $row["allergy"];?></span><br>
                    <label for="medication" class="inline">Medication</label>
                    <span id="medication">: <?php echo $row["medication"];?></span><br>
            </div>
        <?php 
                }
            }
            else{
                echo "<div class='fail text-center'>Patient does not exist in system.</div>";
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