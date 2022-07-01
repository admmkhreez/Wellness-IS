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
        <?php
            $mrn = $_POST['mrn'];
            $servername = "localhost";
            $username = "root";
            $password = "";
            $db = "wellness_is";

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
                        <a class="nav-link active" href="selectPatient.php">Search Patient</a>
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
        <h1>KPJ Klang Wellness Information System</h1>
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
        ?>
            <form method="post" style="text-align:center;">
                <div class="btn-group" style="width:100%;">
                    <input type="hidden" name="mrn" value="<?php echo $mrn;?>">
                    <input type="hidden" name="sex" value="<?php echo $row['sex'];?>">
                    <input type="hidden" name="package" value="<?php echo $row['package'];?>">
                    <button formaction="viewPatient.php" class="btn btn-primary active">View Patient's Details</button>
                    <button formaction="editProfile.php" class="btn btn-primary">Edit Patient's Details</button>
                    <?php
                        if($_SESSION["type"] == "Doctor" || $_SESSION["type"] == "admin"){
                    ?>
                    <button formaction="recordUpdateForm.php" class="btn btn-primary">Update Patient's Record</button>
                    <?php
                        }
                    ?>
                    <button formaction="historyUpdateForm.php" class="btn btn-primary">Update Medical History</button>
                    
                </div>    
            </form>
            <br>
            <h3>Details </h3>
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
                    <dd class="col-sm-9"><?php echo $row['address'];?></dd>
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
                    <dd class="col-sm-9"><?php echo $row['addons'];?></dd>
                    <dt class="col-sm-3">Registered On: </dt>
                    <dd class="col-sm-9"><?php echo $row['registeredOn'];?></dd>
                    <dt class="col-sm-3">Last Edited On: </dt>
                    <dd class="col-sm-9"><?php echo $row['lastUpdateOn'];?></dd>
                </dl>    
            </div>
            <h3>Past Medical History</h3>
            <div>
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
            </div>
            <h3>Family History</h3>
            <div>
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
            
            <h3>Physical Examination</h3>
            <div>
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
                <h3>For Female Patient</h3>
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
                    <dt class="col-sm-3">Pure Tone Audiometry: </dt>
                    <dd class="col-sm-9"><?php echo $row['pta'];?></dd>
                    <dt class="col-sm-3">Lung Function Test: </dt>
                    <dd class="col-sm-9"><?php echo $row['lft'];?></dd>
                    <dt class="col-sm-3">Urine: </dt>
                    <dd class="col-sm-9"><?php echo $row['urine'];?></dd>
                    <dt class="col-sm-3">Blood: </dt>
                    <dd class="col-sm-9"><?php echo $row['blood'];?></dd>
                    <dt class="col-sm-3">Impression: </dt>
                    <dd class="col-sm-9"><?php echo $row['impression'];?></dd>
                    <dt class="col-sm-3">Recommendation: </dt>
                    <dd class="col-sm-9"><?php echo $row['recommendation'];?></dd>
                    <dt class="col-sm-3">Last Updated On: </dt>
                    <dd class="col-sm-9"><?php echo $row['lastUpdate'];?></dd>
                </dl>
                </div>
                <br><br>
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
                echo "No session exist or session has expired. Please log in again.<br>";
                echo "<a href=log-in.html> Login </a>";
            }
        ?>
        </div>
    </body>