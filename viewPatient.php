<!DOCTYPE html>
<html>
    <head>
        <title>Patient's Record</title>
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
        <h1>KPJ Klang Wellness Information System</h1>
        <div class="container">
        <?php
            if ($data->num_rows > 0)
            {
                while ($row = $data->fetch_assoc())
                {
        ?>
            <h3>Details </h3>
            <div class="reference">
                <p>MRN: <?php echo $row['mrn'];?></p>
                <p>Name: <?php echo $row['name'];?></p>
                <p>I/C No/Passport: <?php echo $row['ic_passport'];?></p>
                <p>Date of Birth: <?php echo $row['date_of_birth'];?></p>
                <p>Home Address: <?php echo $row['address'];?></p>
                <p>E-mail Address: <?php echo $row['email'];?></p>
                <p>Telephone: <?php echo $row['telephone'];?></p>
                <p>Sex: <?php echo $row['sex'];?></p>
                <p>Occupation: <?php echo $row['occupation'];?></p>
                <p>Race: <?php echo $row['race'];?></p>
                <p>Religion: <?php echo $row['religion'];?></p>
                <p>Marital Status: <?php echo $row['marital_status'];?></p>
                <p>Next of Kin: <?php echo $row['next_of_kin'];?></p>
                <p>Relationship: <?php echo $row['relationship'];?></p>
                <p>Telephone No.: <?php echo $row['telephone_nok'];?></p>
                <p>Package Selected: <?php echo $row['package'];?></p>
            </div>
            <p>Registered On: <?php echo $row['registeredOn'];?></p>
            <p>Last Profile Update On: <?php echo $row['lastUpdateOn'];?></p>
            <h3>Past Medical History</h3>
            <div class="reference">
                <p>Smoker/Non Smoker: <?php echo $row['smoker'];?></p>
                <p>Asthma: <?php echo $row['asthma'];?></p>
                <p>Diabetes: <?php echo $row['diabetes'];?></p>
                <p>Heart Disease: <?php echo $row['heart_disease'];?></p>
                <p>Hypertension: <?php echo $row['hypertension'];?></p>
                <p>Stroke: <?php echo $row['stroke'];?></p>
                <p>Cacner: <?php echo $row['cancer'];?></p>
                <p>Tuberculosis: <?php echo $row['tuberculosis'];?></p>
                <p>Skin Disease: <?php echo $row['skin'];?></p>
                <p>Kidney Problem: <?php echo $row['kidneyp'];?></p>
                <p>Fits / Psychiatric: <?php echo $row['fits_psychiatric'];?></p>
            </div>
            <h3>Family History</h3>
            <div class="reference">
                <p>Father: <?php echo $row['father_history'];?></p>
                <p>Mother: <?php echo $row['mother_history'];?></p>
                <p>Siblings: <?php echo $row['siblings_history'];?></p>
                <p>Habits: <?php echo $row['habits'];?></p>
                <p>Allergy: <?php echo $row['allergy'];?></p>
                <p>Others: <?php echo $row['others'];?></p>
                <p>Medication: <?php echo $row['medication'];?></p>
            </div>
            <p>Last Updated On: <?php echo $row['lastUpdateMH'];?></p>
            <h3>Physical Examination</h3>
            <div class="reference">
                <p>General Appearance: <?php echo $row['appearance'];?></p>
                <p>Weight: <?php echo $row['weight'];?></p>
                <p>Height: <?php echo $row['height'];?></p>
                <p>BMI: <?php echo $row['bmi'];?></p>
                <p>Blood Pressure: <?php echo $row['systolic'];?>/<?php echo $row['diastolic'];?></p>
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
            <div class="reference">
                <p>Sound: <?php echo $row['sound'];?></p>
                <p>Murmur: <?php echo $row['murmur'];?></p>
            </div>    
            <h3>Respiratory System</h3>
            <div class="reference">
                <p>Air Entry: <?php echo $row['airentry'];?></p>
                <p>Chest Expansion: <?php echo $row['chestexp'];?></p>
                <p>Breath Sound: <?php echo $row['breathsound'];?></p>
            </div>
            <h3>Gastrointestinal System</h3>
            <div class="reference">
                <p>Liver: <?php echo $row['liver'];?></p>
                <p>Spleen: <?php echo $row['spleen'];?></p>
                <p>Kidney: <?php echo $row['kidney'];?></p>
            </div>
            <h3>Central Nervous System</h3>
            <div class="reference">
                <p>Mental Function: <?php echo $row['mentalfunct'];?></p>
                <p>Coordination: <?php echo $row['coordination'];?></p>
                <p>Gait: <?php echo $row['gait'];?></p>
            </div>
            <h3>Genitourinary System</h3>
            <div class="reference">
                <p>Genitalia: <?php echo $row['genitalia'];?></p>
                <p>Rectal Examination: <?php echo $row['rectal'];?></p>
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
                <div class="reference">
                    <p>Breast: <?php echo $row['breast'];?></p>
                    <p>Last Menstrual Period: <?php echo $row['lmp'];?></p>
                    <p>Gynaecology History: <?php echo $row['gynaecology'];?></p>
                    <p>Last Pap Smear: <?php echo $row['lastps'];?></p>
                </div>
                <?php
                    }
                ?>
                <h3>Investigation</h3>
                <div class="reference">
                    <p>Chest X-Ray: <?php echo $row['cxr'];?></p>
                    <p>Electrocardiogram: <?php echo $row['ecg'];?></p>
                    <p>Mammogram: <?php echo $row['mammogram'];?></p>
                    <p>Ultrasound Breast: <?php echo $row['us_breast'];?></p>
                    <p>Ultrasound Abdomen Pelvis: <?php echo $row['us_abdopel'];?></p>
                    <p>Stress Test: <?php echo $row['stresstest'];?></p>
                    <p>Pure Tone Audiometry: <?php echo $row['pta'];?></p>
                    <p>Lung Function Test: <?php echo $row['lft'];?></p>
                    <p>Urine: <?php echo $row['urine'];?></p>
                    <p>Blood: <?php echo $row['blood'];?></p>
                </div>
                <p>Impression: <?php echo $row['impression'];?></p>
                <p>Recommendation: <?php echo $row['recommendation'];?></p>
                <p>Last Update On: <?php echo $row['lastUpdate'];?></p>
                <br><br>
                <form method="post">
                <div class="btn-group">
                    <input type="hidden" name="mrn" value="<?php echo $mrn;?>">
                    <input type="hidden" name="sex" value="<?php echo $row['sex'];?>">
                    <input type="hidden" name="package" value="<?php echo $row['package'];?>">
                    <button formaction="editProfile.php" class="btn btn-primary">Edit Patient's Details</button>
                    <button formaction="recordUpdateForm.php" class="btn btn-primary">Update Patient's Record</button>
                    <button formaction="historyForm.php" class="btn btn-primary">Update Medical History</button>
                    
                </div>    
                </form>
                
        <?php
                }
            }
            else{
                echo "Patient does not exist in system.";
            }
        ?>
        </div>
    </body>