<!DOCTYPE html>
<html>
    <?php
        session_start();
        if(isset($_SESSION["username"])) {
    ?>
    <head>
        <title>KPJ Klang Wellness IS</title>
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
        </style>
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
                        <a class="nav-link btn btn-danger" href="logout.php" style="color: white; font-weight: 700;">Logout</a>
                </div>
            </nav>
            <br>
            <h1  id="top">Patient's Report</h1>
            <br>
            <div class="container">
                <form method="post" style="text-align: center;">
                        <label for="mrn">Enter Patient's MRN</label><br>
                        <input type="text" id="mrn" name="mrn" maxlength="10" required autofocus><br>
                        <button formaction="viewPatient.php" class="btn btn-primary">Search</button>
                </form>
                <br>
                <?php
                    if ($data->num_rows > 0)
                    {
                        while ($row = $data->fetch_assoc())
                        {
                            $temp = $row["lastUpdate"];
                            $lastUpdate = date("d-m-Y", strtotime($temp));
                ?>
                    <form method="post" style="text-align:center;">
                        <div class="btn-group" style="width:100%;">
                            <input type="hidden" name="mrn" value="<?php echo $mrn;?>">
                            <input type="hidden" name="sex" value="<?php echo $row['sex'];?>">
                            <input type="hidden" name="package" value="<?php echo $row['package'];?>">
                            <button formaction="viewPatient.php" class="btn btn-primary active">View Patient's Report</button>
                            <button formaction="editProfile.php" class="btn btn-primary">Edit Patient's Details</button>
                            <?php
                                if($_SESSION["type"] == "doctor" || $_SESSION["type"] == "admin"){
                            ?>
                            <button formaction="recordUpdateForm.php" class="btn btn-primary">Update Patient's Record</button>
                            <?php
                                }
                            ?>
                            <button formaction="historyUpdateForm.php" class="btn btn-primary">Update Medical History</button>
                        </div>    
                    </form>
                    <br>
                    <hr>
                    <div class="btn-group text-center position-sticky">
                        <a href="#medical_history" class="btn btn-primary">Medical History</a>
                        <a href="#doctors_form" class="btn btn-primary">doctor's Report</a>
                        <button class="btn btn-primary" onclick="print()">Print</button>
                    </div>
                    <br><hr>
                    <div>
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
                            <dt class="col-sm-3">Last Edited On: </dt>
                            <dd class="col-sm-9"><?php echo $row['lastUpdateOn'];?></dd>
                        </dl>    
                    </div>
                    <hr>
                    <div>
                        <a id="medical_history"><h3>Past Medical History</h3></a>
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
                    <hr>
                    <div>
                        <a id="doctors_form"><h3>Physical Examination</h3></a>   
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
                            <dt class="col-sm-3">Nose: </dt>
                            <dd class="col-sm-9"><?php echo $row['nose'];?></dd>
                            <dt class="col-sm-3">Throat: </dt>
                            <dd class="col-sm-9"><?php echo $row['throat'];?></dd>
                            <dt class="col-sm-3">Neck: </dt>
                            <dd class="col-sm-9"><?php echo $row['neck'];?></dd>
                            <dt class="col-sm-3">Skin: </dt>
                            <dd class="col-sm-9"><?php echo $row['skin'];?></dd>
                        </dl>
                    </div>
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
                    <h3>Cardiovascular System</h3>
                    <div>
                        <dl class="row">
                            <dt class="col-sm-3">Sound: </dt>
                            <dd class="col-sm-9"><?php echo $row['sound'];?></dd>
                            <dt class="col-sm-3">Murmur: </dt>
                            <dd class="col-sm-9"><?php echo $row['murmur'];?></dd>
                        </dl>
                    </div>    
                    <h3>Respiratory System</h3>
                    <div>
                        <dl class="row">
                            <dt class="col-sm-3">Air Entry: </dt>
                            <dd class="col-sm-9"><?php echo $row['airentry'];?></dd>
                            <dt class="col-sm-3">Chest Expansion: </dt>
                            <dd class="col-sm-9"><?php echo $row['chestexp'];?></dd>
                            <dt class="col-sm-3">Breath Sound: </dt>
                            <dd class="col-sm-9"><?php echo $row['breathsound'];?></dd>
                        </dl>
                    </div>
                    <h3>Gastrointestinal System</h3>
                    <div>
                        <dl class="row">
                            <dt class="col-sm-3">Liver: </dt>
                            <dd class="col-sm-9"><?php echo $row['liver'];?></dd>
                            <dt class="col-sm-3">Spleen: </dt>
                            <dd class="col-sm-9"><?php echo $row['spleen'];?></dd>
                            <dt class="col-sm-3">Kidney: </dt>
                            <dd class="col-sm-9"><?php echo $row['kidney'];?></dd>
                        </dl>
                    </div>
                    <h3>Central Nervous System</h3>
                    <div>
                        <dl class="row">
                            <dt class="col-sm-3">Mental Function: </dt>
                            <dd class="col-sm-9"><?php echo $row['mentalfunct'];?></dd>
                            <dt class="col-sm-3">Coordination: </dt>
                            <dd class="col-sm-9"><?php echo $row['coordination'];?></dd>
                            <dt class="col-sm-3">Gait: </dt>
                            <dd class="col-sm-9"><?php echo $row['gait'];?></dd>
                        </dl>
                    </div>
                    <h3>Genitourinary System</h3>
                    <div>
                        <dl class="row">
                            <dt class="col-sm-3">Genitalia: </dt>
                            <dd class="col-sm-9"><?php echo $row['genitalia'];?></dd>
                            <dt class="col-sm-3">Rectal Examination: </dt>
                            <dd class="col-sm-9"><?php echo $row['rectal'];?></dd>
                        </dl>
                    </div>
                    <h3>Musculoskeletal System</h3>
                    <table style="table-layout: fixed; width:100%;" class="table table-bordered">
                            <thead class="table-dark" style="text-align:center;">
                            <tr>
                                <th>Lower Limb</th>
                                <th>Left</th>
                                <th>Right</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>Power</th>
                                <td><?php echo $row['lpow_l'];?></td>
                                <td><?php echo $row['lpow_r'];?></td>
                            </tr>
                            <tr>
                                <th>Reflex</th>
                                <td><?php echo $row['lref_l'];?></td>
                                <td><?php echo $row['lref_r'];?></td>
                            </tr>
                            <tr>
                                <th>Sensation</th>
                                <td><?php echo $row['lsen_l'];?></td>
                                <td><?php echo $row['lsen_r'];?></td>
                            </tr>
                        </tbody>
                        </table><br>
                        <table style="table-layout: fixed; width:100%;" class="table table-bordered">
                            <thead class="table-dark" style="text-align:center;">
                                <tr>
                                    <th>Upper Limb</th>
                                    <th>Left</th>
                                    <th>Right</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>Power</th>
                                    <td><?php echo $row['upow_l'];?></td>
                                    <td><?php echo $row['upow_r'];?></td>
                                </tr>
                                <tr>
                                    <th>Reflex</th>
                                    <td><?php echo $row['uref_l'];?></td>
                                    <td><?php echo $row['uref_r'];?></td>
                                </tr>
                                <tr>
                                    <th>Sensation</th>
                                    <td><?php echo $row['usen_l'];?></td>
                                    <td><?php echo $row['usen_r'];?></td>
                                </tr>
                            </tbody>
                        </table>
                        <?php
                            if($row['sex'] == "Female"){
                        ?>
                        <h3>For Female</h3>
                        <div>
                            <dl class="row">
                                <dt class="col-sm-3">Breast: </dt>
                                <dd class="col-sm-9"><?php echo $row['breast'];?></dd>
                                <dt class="col-sm-3">Last Menstrual Period: </dt>
                                <dd class="col-sm-9"><?php echo $row['lmp'];?></dd>
                                <dt class="col-sm-3">Gynaecology History: </dt>
                                <dd class="col-sm-9"><?php echo $row['gynaecology'];?></dd>
                                <dt class="col-sm-3">Last Pap Smear: </dt>
                                <dd class="col-sm-9"><?php echo $row['lastps'];?></dd>
                            </dl>
                        </div>
                        <?php
                            }
                        ?>
                        <h3>Investigation</h3>
                        <div>
                            <dl class="row">
                                <dt class="col-sm-3">Chest X-Ray: </dt>
                                <dd class="col-sm-9"><?php echo $row['cxr'];?></dd>
                                <dt class="col-sm-3">Electrocardiogram: </dt>
                                <dd class="col-sm-9"><?php echo $row['ecg'];?></dd>
                                <?php
                                    if($row['package'] == "Custom"){
                                ?>
                                <dt class="col-sm-3">Mammogram: </dt>
                                <dd class="col-sm-9"><?php echo $row['mammogram'];?></dd>
                                <dt class="col-sm-3">Ultrasound Breast: </dt>
                                <dd class="col-sm-9"><?php echo $row['us_breast'];?></dd>
                                <dt class="col-sm-3">Pure Tone Audiometry: </dt>
                                <dd class="col-sm-9"><?php echo $row['pta'];?></dd>
                                <dt class="col-sm-3">Lung Function Test: </dt>
                                <dd class="col-sm-9"><?php echo $row['lft'];?></dd>
                                <?php
                                    }
                                    if($row['package'] == "Premium" || $row['package'] == "Comprehensive" || $row['package'] == "Custom"){
                                ?>
                                <dt class="col-sm-3">Ultrasound Abdomen Pelvis: </dt>
                                <dd class="col-sm-9"><?php echo $row['us_abdopel'];?></dd>
                                <?php
                                    }
                                    if($row['package'] == "Custom" || $row['package'] == "Premium"){
                                ?>
                                <dt class="col-sm-3">Stress Test: </dt>
                                <dd class="col-sm-9"><?php echo $row['stresstest'];?></dd>
                                <?php
                                    }
                                ?>
                                <dt class="col-sm-3">Urine: </dt>
                                <dd class="col-sm-9"><?php echo $row['urine'];?></dd>
                                <dt class="col-sm-3">Blood: </dt>
                                <dd class="col-sm-9"><?php echo $row['blood'];?></dd>
                                <dt class="col-sm-3">Impression: </dt>
                                <dd class="col-sm-9"><?php echo nl2br($row['impression']);?></dd>
                                <dt class="col-sm-3">Recommendation: </dt>
                                <dd class="col-sm-9"><?php echo nl2br($row['recommendation']);?></dd>
                                <dt class="col-sm-3">Last Updated On: </dt>
                                <dd class="col-sm-9"><?php echo $row['lastUpdate'];?></dd>
                            </dl>
                        </div></a>
                        <br><br>
                        <a href="#top" class="top">Back to Top</a>
                        <script>
                            print(){
                                window.print();
                            }
                        </script>
            </div>
        </div>
            <div id="printable">
                    <img src="logo.png" width="200px" height="54px" class="rounded mx-auto d-block"><br>
                    <h4 class="text-center">Health Screening Services</h4><br>
                    <h5>Personal Information</h5>
                    <div>
                        <label for="mrn" class="inline">MRN</label>
                        : <span id="mrn"><?php echo $row["mrn"];?></span><br>
                        <label for="name" class="inline">Name</label>
                        : <span id="name"><?php echo $row["name"];?></span><br>
                        <label for="icpp" class="inline">IC No/Passport</label>
                        : <span id="icpp"><?php echo $row["ic_passport"];?></span><br>
                        <label for="dob" class="inline">Date of Birth</label>
                        : <span id="dob"><?php echo $row["date_of_birth"];?></span><br>
                        <div class="textfield">
                            <label for="address" class="inline">Home Address</label>
                            : <span id="address" style="display: inline-block;"> <?php echo nl2br($row["address"]);?></span><br>
                        </div>
                        <label for="email" class="inline">Email</label>
                        : <span id="email"><?php echo $row["email"];?></span><br>
                        <label for="tel" class="inline">Telephone</label>
                        : <span id="tel"><?php echo $row["telephone"];?></span><br>
                        <label for="sex" class="inline">Sex</label>
                        : <span id="sex"><?php echo $row["sex"];?></span><br>
                        <label for="occupation" class="inline">Occupation</label>
                        : <span id="occupation"><?php echo $row["occupation"];?></span><br>
                        <label for="race" class="inline">Race</label>
                        : <span id="race"><?php echo $row["race"];?></span><br>
                        <label for="religion" class="inline">Religion</label>
                        : <span id="religion"><?php echo $row["religion"];?></span><br>
                        <label for="mstatus" class="inline">Marital Status</label>
                        : <span id="mstatus"><?php echo $row["marital_status"];?></span><br>
                        <label for="package" class="inline">Package</label>
                        : <span id="package"><?php echo $row["package"];?></span><br>
                        <div class="textfield">
                            <label for="addons" class="inline">Additional Test</label>
                            : <span id="addons" style="display: inline-block"><?php echo nl2br($row["addons"]);?></span><br><br>
                        </div>
                    </div>
                    <h5>Next of Kin</h5>
                    <div>
                        <label for="nok" class="inline">Next of Kin</label>
                        : <span id="nok"><?php echo $row["next_of_kin"];?></span><br>
                        <label for="rs" class="inline">Relationship</label>
                        : <span id="rs"><?php echo $row["relationship"];?></span><br>
                        <label for="telnok" class="inline">Telephone</label>
                        : <span id="telnok"><?php echo $row["telephone_nok"];?></span><br><br>
                        <div style="break-after:page;"></div>
                        <h5>Past Medical History</h5>
                        <span id="smoker"><?php echo $row["smoker"];?></span><br>
                        <label for="asthma" class="inline">Asthma</label>
                        : <span id="asthma"><?php echo $row["asthma"];?></span><br>
                        <label for="diabetes" class="inline">Diabetes</label>
                        : <span id="diabetes"><?php echo $row["diabetes"];?></span><br>
                        <label for="heart" class="inline">Heart Disease</label>
                        : <span id="heart"><?php echo $row["heart_disease"];?></span><br>
                        <label for="hyper" class="inline">Hypertension</label>
                        : <span id="hyper"><?php echo $row["hypertension"];?></span><br>
                        <label for="stroke" class="inline">Stroke</label>
                        : <span id="stroke"><?php echo $row["stroke"];?></span><br>
                        <label for="cancer" class="inline">Cancer</label>
                        : <span id="cancer"><?php echo $row["cancer"];?></span><br>
                        <label for="tb" class="inline">Tuberculosis</label>
                        : <span id="tb"><?php echo $row["tuberculosis"];?></span><br>
                        <label for="skind" class="inline">Skin Disease</label>
                        : <span id="skind"><?php echo $row["skin_disease"];?></span><br>
                        <label for="kidneyp" class="inline">Kidney Problem</label>
                        : <span id="kidneyp"><?php echo $row["kidneyp"];?></span><br>
                        <label for="fits" class="inline">Fits/Psychiatric</label>
                        : <span id="fits"><?php echo $row["fits_psychiatric"];?></span><br><br>
                        <h5>Family History</h5>
                        <label for="father" class="inline">Father</label>
                        : <span id="father"><?php echo $row["father_history"];?></span><br>
                        <label for="mother" class="inline">Mother</label>
                        : <span id="mother"><?php echo $row["mother_history"];?></span><br>
                        <label for="siblings" class="inline">Siblings</label>
                        : <span id="siblings"><?php echo $row["siblings_history"];?></span><br>
                        <label for="habits" class="inline">Habits</label>
                        : <span id="habits"><?php echo $row["habits"];?></span><br>
                        <label for="allergy" class="inline">Allergy</label>
                        : <span id="allergy"><?php echo $row["allergy"];?></span><br>
                        <label for="others" class="inline">Others</label>
                        : <span id="others"><?php echo $row["others"];?></span><br>
                        <label for="medication" class="inline">Medication</label>
                        : <span id="medication"><?php echo $row["medication"];?></span><br><br>
                        <h5>Physical Examination</h5>
                        <label for="appearance" class="inline">General Appearance</label>
                        : <span id="appearance"><?php echo $row["appearance"];?></span><br>
                        <label for="weight" class="inline">Weight</label>
                        : <span id="weight"><?php echo $row["weight"];?></span><br>
                        <label for="height" class="inline">Height</label>
                        : <span id="height"><?php echo $row["height"];?></span><br>
                        <label for="bmi" class="inline">BMI</label>
                        : <span id="bmi"><?php echo $row["bmi"];?></span><br>
                        <label for="bloodp" class="inline">Blood Pressure</label>
                        : <span id="bloodp"><?php echo $row["systolic"];?>/<?php echo $row["diastolic"];?></span><br>
                        <label for="nose" class="inline">Nose</label>
                        : <span id="nose"><?php echo $row["nose"];?></span><br>
                        <label for="throat" class="inline">Throat</label>
                        : <span id="throat"><?php echo $row["throat"];?></span><br>
                        <label for="neck" class="inline">Neck</label>
                        : <span id="neck"><?php echo $row["neck"];?></span><br>
                        <label for="skin" class="inline">Skin</label>
                        : <span id="skin"><?php echo $row["skin"];?></span><br><br>
                    </div>
                    <div style="break-after:page;"></div>
                    <h5>Eyes</h5>
                    <div>
                        <table>
                                <thead>
                                    <th></th>
                                    <th>Left</th>
                                    <th>Right</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>Visual Acuity(Aided):</th>
                                        <td><?php echo $row["va_aidedl"];?></td>
                                        <td><?php echo $row["va_aidedr"];?></td>
                                    </tr>
                                    <tr>
                                        <th>Visual Acuity(Unaided):</th>
                                        <td><?php echo $row["va_unaidedl"];?></td>
                                        <td><?php echo $row["va_unaidedr"];?></td>
                                    </tr>
                                    <tr>
                                        <th>Colour:</th>
                                        <td><?php echo $row["colour_l"];?></td>
                                        <td><?php echo $row["colour_r"];?></td>
                                    </tr>
                                    <tr>
                                        <th>Fundoscopy:</th>
                                        <td><?php echo $row["fundoscopy_l"];?></td>
                                        <td><?php echo $row["fundoscopy_r"];?></td>
                                    </tr>
                                </tbody>
                        </table><br>
                    </div>
                    <h5>Cardiovascular System</h5>
                    <div>
                        <label for="sound" class="inline">Sound</label>
                        : <span id="sound"><?php echo $row["sound"];?></span><br>
                        <label for="murmur" class="inline">Murmur</label>
                        : <span id="murmur"><?php echo $row["murmur"];?></span><br><br>
                    </div>
                    <div>
                        <h5>Respiratory System</h5>
                        <label for="airentry" class="inline">Air Entry</label>
                        : <span id="airentry"><?php echo $row["airentry"];?></span><br>
                        <label for="chestexp" class="inline">Chest Expansion</label>
                        : <span id="chestexp"><?php echo $row["chestexp"];?></span><br>
                        <label for="bs" class="inline">Breath Sound</label>
                        : <span id="bs"><?php echo $row["breathsound"];?></span><br><br>
                    </div>
                    <div>
                        <h5>Gastrointestinal System</h5>
                        <label for="liver" class="inline">Liver</label>
                        : <span id="liver"><?php echo $row["liver"];?></span><br>
                        <label for="spleen" class="inline">Spleen</label>
                        : <span id="spleen"><?php echo $row["spleen"];?></span><br>
                        <label for="kidney" class="inline">Kidney</label>
                        : <span id="kidney"><?php echo $row["kidney"];?></span><br><br>
                    </div>
                    <div>
                        <h5>Central Nervous System</h5>
                        <label for="mf" class="inline">Mental Function</label>
                        : <span id="mf"><?php echo $row["mentalfunct"];?></span><br>
                        <label for="coordination" class="inline">Coordination</label>
                        : <span id="coordination"><?php echo $row["coordination"];?></span><br>
                        <label for="gait" class="inline">Gait</label>
                        : <span id="gait"><?php echo $row["gait"];?></span><br><br>
                        <h5>Genitourinary System</h5>
                        <label for="genitalia" class="inline">Genitalia</label>
                        : <span id="genitalia"><?php echo $row["genitalia"];?></span><br>
                        <label for="rectal" class="inline">Rectal Examination</label>
                        : <span id="rectal"><?php echo $row["rectal"];?></span><br><br>
                    </div>
                    <div>
                        <?php
                            if($row['sex'] == "Female"){
                        ?>
                        <h5>For Female</h5>
                        <label for="breast" class="inline">Breast</label>
                        : <span id="breast"><?php echo $row["breast"];?></span><br>
                        <label for="lmp" class="inline">Last Menstrual Period</label>
                        : <span id="lmp"><?php echo $row["lmp"];?></span><br>
                        <label for="gynaecology" class="inline">Gynaecology</label>
                        : <span id="gynaecology"><?php echo $row["gynaecology"];?></span><br>
                        <label for="lastps" class="inline">Last Pap Smear</label>
                        : <span id="lastps"><?php echo $row["lastps"];?></span><br><br> 
                        <?php
                            }
                        ?>
                    </div>
                    <div style="break-after:page;"></div>
                    <h5>Musculoskeletal System</h5>
                    <div>
                        <table>
                                <thead>
                                    <th>Lower Limb</th>
                                    <th>Left</th>
                                    <th>Right</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>Power:</th>
                                        <td><?php echo $row["lpow_l"];?></td>
                                        <td><?php echo $row["lpow_r"];?></td>
                                    </tr>
                                    <tr>
                                        <th>Reflex:</th>
                                        <td><?php echo $row["lref_l"];?></td>
                                        <td><?php echo $row["lref_r"];?></td>
                                    </tr>
                                    <tr>
                                        <th>Sensation</th>
                                        <td><?php echo $row["lsen_l"];?></td>
                                        <td><?php echo $row["lsen_r"];?></td>
                                    </tr>
                                </tbody>
                        </table>
                        <br>
                        <table>
                                <thead>
                                    <th>Upper Limb</th>
                                    <th>Left</th>
                                    <th>Right</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>Power:</th>
                                        <td><?php echo $row["upow_l"];?></td>
                                        <td><?php echo $row["upow_r"];?></td>
                                    </tr>
                                    <tr>
                                        <th>Reflex:</th>
                                        <td><?php echo $row["uref_l"];?></td>
                                        <td><?php echo $row["uref_r"];?></td>
                                    </tr>
                                    <tr>
                                        <th>Sensation</th>
                                        <td><?php echo $row["usen_l"];?></td>
                                        <td><?php echo $row["usen_r"];?></td>
                                    </tr>
                                </tbody>
                        </table><br>
                    </div>
                    <h5>Investigation</h5>
                    <div>
                        <label for="cxr" class="inline">Chest X-Ray</label>
                        : <span id="cxr"><?php echo $row["cxr"];?></span><br>
                        <label for="ecg" class="inline">Electrocardiogram</label>
                        : <span id="ecg"><?php echo $row["ecg"];?></span><br>
                        <?php
                            if($row['package'] == "Custom"){
                        ?>
                        <label for="mammogram" class="inline">Mammogram</label>
                        : <span id="mammogram"><?php echo $row["mammogram"];?></span><br>
                        <label for="us_breast" class="inline">Ultrasound Breast</label>
                        : <span id="us_breast"><?php echo $row["us_breast"];?></span><br>
                        <label for="pta" class="inline">Pure Tone Audiometry</label>
                        : <span id="pta"><?php echo $row["pta"];?></span><br>
                        <label for="lft" class="inline">Lung Function Test</label>
                        : <span id="lft"><?php echo $row["lft"];?></span><br>
                        <?php
                            }
                            if($row['package'] == "Premium" || $row['package'] == "Comprehensive" || $row['package'] == "Custom"){
                        ?>
                        <label for="us_abdopel" class="inline">Ultrasound Abdomen Pelvis</label>
                        : <span id="us_abdopel"><?php echo $row["us_abdopel"];?></span><br>
                        <?php
                            }
                            if($row['package'] == "Custom" || $row['package'] == "Premium"){
                        ?>
                        <label for="stresstest" class="inline">Stress Test</label>
                        : <span id="stresstest"><?php echo $row["stresstest"];?></span><br>
                        <?php
                            }
                        ?>
                        <label for="urine" class="inline">Urine</label>
                        : <span id="urine"><?php echo $row["urine"];?></span><br>
                        <label for="blood" class="inline">Blood</label>
                        : <span id="blood"><?php echo $row["blood"];?></span><br>
                        <div class="textfield">
                        <label for="impression" class="inline">Impression: </label><br>
                        <span id="impression" style="display: inline-block;"><?php echo nl2br($row["impression"]);?></span><br>
                        </div>
                        <div class="textfield">
                        <label for="recommendation" class="inline">Recommendation: </label><br>
                        <span id="recommendation" style="display: inline-block;"><?php echo nl2br($row["recommendation"]);?></span>
                        </div>
                    </div>
                    <div>
                        <footer class="page-footer font-small pt-4" style="position: absolute; bottom: 0; right: 0;">
                            <div class="container-fluid text-md-left">
                                <div class="row">
                                    <div class="col-md-6 mt-md-0 mt-3">
                                        <h6 class="font-weight-bold"><?php echo $row["doneBy"];?></h6>
                                        <p style="line-height: 100%;"><?php echo nl2br($row["position"]);?></p>
                                    </div>
                                </div>
                            </div>
                        </footer>
                    </div>
                    <div class="date">
                        <p>Date: <?php echo $lastUpdate;?></p>
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