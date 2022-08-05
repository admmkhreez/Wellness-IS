<!DOCTYPE html>
<html>
    <?php
        session_start();
        if(isset($_SESSION["username"])) {
    ?>
    <head>
        <title>Patient's Report</title>
        <style type="text/css">
            @page {
              size: A4;
              margin: 40px; 
            }
            th{
                font-weight: 700;
            }
            table{
                border: none; 
                width: 80%; 
                table-layout: fixed;
            }
            span{
                margin-left: 5px;
            }
        </style> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="wellness.css">
        <link rel="stylesheet" href="bootstrap.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
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
        ?>
    </head>
        <body>
            <?php
   
            ?>
            <nav class="navbar sticky-top navbar-expand-sm bg-dark navbar-dark">
                <div class="container-sm">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="homepage.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="viewPatient.php">Patients</a>
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
                <h1  id="top" style="margin-top: 40px; color: white;">Patient's Report</h1>
                <br>
                <div class="container">
                    <form method="post" style="text-align: center;">
                        <label for="mrn">Enter Patient's MRN</label><br>
                        <input type="text" id="mrn" name="mrn" maxlength="10" required autofocus>
                        <button formaction="selectRecord.php" class="btn btn-primary">Search</button>
                    </form>
                    <div class="text-center">
                        <h5>MRN: <?php echo $mrn;?></h5>
                        <form method="post" style="text-align: center;" class="btn-group">
                            <button formaction="selectRecord.php" class="btn btn-primary">View Record</button>
                            <button formaction="activeDetails.php" class="btn btn-primary active">Latest Details</button>
                            <button formaction="editProfile.php" class="btn btn-primary">Edit Profile</button>
                            <button formaction="checkHistoryForm.php" class="btn btn-primary">Check Medical History</button>  
                            <input type="hidden" name="mrn" value="<?php echo $mrn;?>">
                            <div class="btn-group" role="group">
                                <button id="btnGroupDrop" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    Insert
                                </button>
                                <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="btnGroupDrop">
                                    <li>
                                    <?php
                                        if($_SESSION["type"] == "admin" or $_SESSION["type"] == "doctor"){
                                    ?>
                                            <button class="dropdown-item" formaction="recordForm.php">Record</button>
                                    <?php
                                        }
                                    ?>
                                    </li>
                                    <li>
                                        <button class="dropdown-item" formaction="physicalExam.php">Physical Examinantion</button>
                                    </li>
                                    <li>
                                        <button class="dropdown-item" formaction="historyForm.php">Medical History</button>
                                    </li>
                                </ul>
                            </div>
                        </form>
                    </div>
                    <hr>
                        <?php
                        $display = "SELECT * FROM patient WHERE mrn = '".$mrn."'";
                        $data = $conn->query($display);
                            if ($data->num_rows > 0)
                            {
                                while ($row = $data->fetch_assoc())
                                {
                        ?>
                            <div class="accordion" id="accordionDetails">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            Patient's Information
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionDetails">
                                        <div class="accordion-body">
                                            <dl class="row">
                                                <dt class="col-sm-3">MRN: </dt>
                                                <dd class="col-sm-9"><?php echo $row['mrn'];?></dd>
                                                <dt class="col-sm-3">Name: </dt>
                                                <dd class="col-sm-9"><?php echo $row['name'];?></dd>
                                                <dt class="col-sm-3">IC No/Passport: </dt>
                                                <dd class="col-sm-9"><?php echo $row['ic_passport'];?></dd>
                                                <dt class="col-sm-3">Date of Birth: </dt>
                                                <dd class="col-sm-9"><?php echo $row['date_of_birth'];?></dd>
                                                <dt class="col-sm-3">Home Address: </dt>
                                                <dd class="col-sm-9"><?php echo nl2br($row['address']);?></dd>
                                                <dt class="col-sm-3">Email: </dt>
                                                <dd class="col-sm-9"><?php echo $row['email'];?></dd>
                                                <dt class="col-sm-3">Telephone: </dt>
                                                <dd class="col-sm-9"><?php echo $row['telephone'];?></dd>
                                                <dt class="col-sm-3">Sex: </dt>
                                                <dd class="col-sm-9"><?php echo $row['sex'];?></dd>
                                                <dt class="col-sm-3">Occupation: </dt>
                                                <dd class="col-sm-9"><?php echo $row['occupation'];?></dd>
                                                <dt class="col-sm-3">Race: </dt>
                                                <dd class="col-sm-9"><?php echo $row['race'];?></dd>
                                                <dt class="col-sm-3">Religion: </dt>
                                                <dd class="col-sm-9"><?php echo $row['religion'];?></dd>
                                                <dt class="col-sm-3">Marital Status: </dt>
                                                <dd class="col-sm-9"><?php echo $row['marital_status'];?></dd>
                                                <dt class="col-sm-3">Next of Kin: </dt>
                                                <dd class="col-sm-9"><?php echo $row['next_of_kin'];?></dd>
                                                <dt class="col-sm-3">Relationship: </dt>
                                                <dd class="col-sm-9"><?php echo $row['relationship'];?></dd>
                                                <dt class="col-sm-3">Telephone: </dt>
                                                <dd class="col-sm-9"><?php echo $row['telephone_nok'];?></dd>
                                                <dt class="col-sm-3">Package: </dt>
                                                <dd class="col-sm-9"><?php echo $row['package'];?></dd>
                                                <dt class="col-sm-3">Additional Test: </dt>
                                                <dd class="col-sm-9"><?php echo nl2br($row['addons']);?></dd>
                                                <dt class="col-sm-3">Registered On: </dt>
                                                <dd class="col-sm-9"><?php echo $row['registeredOn'];?></dd>
                                                <dt class="col-sm-3">Last Edit By: </dt>
                                                <dd class="col-sm-9"><?php echo $row['pic'];?></dd>
                                                <dt class="col-sm-3">Last Edited On: </dt>
                                                <dd class="col-sm-9"><?php echo $row['lastUpdateOn'];?></dd>
                                            </dl>    
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingTwo">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            Medical History
                                        </button>
                                    </h2>
                                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionDetails">
                                        <div class="accordion-body">
                                            <dl class="row">
                                                <dt class="col-sm-3">Smoker/Non Smoker: </dt>
                                                <dd class="col-sm-9"><?php echo $row['smoker'];?></dd>
                                                <dt class="col-sm-3">Asthma: </dt>
                                                <dd class="col-sm-9"><?php echo $row['asthma'];?></dd>
                                                <dt class="col-sm-3">Diabetes: </dt>
                                                <dd class="col-sm-9"><?php echo $row['diabetes'];?></dd>
                                                <dt class="col-sm-3">Heart Disease: </dt>
                                                <dd class="col-sm-9"><?php echo $row['heart_disease'];?></dd>
                                                <dt class="col-sm-3">Hypertension: </dt>
                                                <dd class="col-sm-9"><?php echo $row['hypertension'];?></dd>
                                                <dt class="col-sm-3">Stroke: </dt>
                                                <dd class="col-sm-9"><?php echo $row['stroke'];?></dd>
                                                <dt class="col-sm-3">Cancer: </dt>
                                                <dd class="col-sm-9"><?php echo $row['cancer'];?></dd>
                                                <dt class="col-sm-3">Tuberculosis: </dt>
                                                <dd class="col-sm-9"><?php echo $row['tuberculosis'];?></dd>
                                                <dt class="col-sm-3">Skin Disease: </dt>
                                                <dd class="col-sm-9"><?php echo $row['skin_disease'];?></dd>
                                                <dt class="col-sm-3">Kidney Problem: </dt>
                                                <dd class="col-sm-9"><?php echo $row['kidneyp'];?></dd>
                                                <dt class="col-sm-3">Fits/Psychiatric: </dt>
                                                <dd class="col-sm-9"><?php echo $row['fits_psychiatric'];?></dd>
                                            </dl>
                                            <h3>Family History</h3>
                                            <dl class="row">
                                                <dt class="col-sm-3">Father: </dt>
                                                <dd class="col-sm-9"><?php echo $row['father_history'];?></dd>
                                                <dt class="col-sm-3">Mother: </dt>
                                                <dd class="col-sm-9"><?php echo $row['mother_history'];?></dd>
                                                <dt class="col-sm-3">Siblings: </dt>
                                                <dd class="col-sm-9"><?php echo $row['siblings_history'];?></dd>
                                                <dt class="col-sm-3">Habits: </dt>
                                                <dd class="col-sm-9"><?php echo $row['habits'];?></dd>
                                                <dt class="col-sm-3">Allergy: </dt>
                                                <dd class="col-sm-9"><?php echo $row['allergy'];?></dd>
                                                <dt class="col-sm-3">Others: </dt>
                                                <dd class="col-sm-9"><?php echo $row['others'];?></dd>
                                                <dt class="col-sm-3">Medication: </dt>
                                                <dd class="col-sm-9"><?php echo $row['medication'];?></dd>
                                                <dt class="col-sm-3">Last Updated On: </dt>
                                                <dd class="col-sm-9"><?php echo $row['lastUpdateMH'];?></dd>
                                            </dl>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingThree">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                            Physical Examination
                                        </button>
                                    </h2>
                                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionDetails">
                                        <div class="accordion-body">   
                                            <dl class="row">
                                                <dt class="col-sm-3">General Appearance: </dt>
                                                <dd class="col-sm-9"><?php echo $row['appearance'];?></dd>
                                                <dt class="col-sm-3">Weight: </dt>
                                                <dd class="col-sm-9"><?php echo $row['weight'];?></dd>
                                                <dt class="col-sm-3">Height: </dt>
                                                <dd class="col-sm-9"><?php echo $row['height'];?></dd>
                                                <dt class="col-sm-3">BMI: </dt>
                                                <dd class="col-sm-9"><?php echo $row['bmi'];?></dd>
                                                <dt class="col-sm-3">Blood Pressure: </dt>
                                                <dd class="col-sm-9"><?php echo $row['systolic'];?>/<?php echo $row['diastolic'];?></dd>
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
                                                    <td><?php echo $row['va_aidedl'];?></td>
                                                    <td><?php echo $row['va_aidedr'];?></td>
                                                </tr>
                                                <tr>
                                                    <th>Visual Acuity(Unaided)</th>
                                                    <td><?php echo $row['va_unaidedl'];?></td>
                                                    <td><?php echo $row['va_unaidedr'];?></td>
                                                </tr>
                                                <tr>
                                                    <th>Colour</th>
                                                    <td><?php echo $row['colour_l'];?></td>
                                                    <td><?php echo $row['colour_r'];?></td>
                                                </tr>
                                                <tr>
                                                    <th>Fundoscopy</th>
                                                    <td><?php echo $row['fundoscopy_l'];?></td>
                                                    <td><?php echo $row['fundoscopy_r'];?></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
        </body>