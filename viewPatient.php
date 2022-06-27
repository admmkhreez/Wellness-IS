<!DOCTYPE html>
<html>
    <head>
        <title>Patient's Record</title>
        <link rel="stylesheet" href="test.css">
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
        <div class="button">
            <a href="homepage.php"><img src="home.png" height="40px" width="40px"></a>
        </div>
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
            <h3>Physical Examination</h3>
            <div class="reference">
                <p>General Appearance: <?php echo $row['appearance'];?></p>
                <p>Weight: <?php echo $row['weight'];?></p>
                <p>Height: <?php echo $row['height'];?></p>
                <p>BMI: <?php echo $row['bmi'];?></p>
                <p>Blood Pressure: <?php echo $row['systolic'];?>/<?php echo $row['diastolic'];?></p>
            </div>
            <h3>Eyes</h3>
                <table style="table-layout: fixed; width:100%;">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Left</th>
                            <th>Right</th>
                        </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th class="darkhead">Visual Acuity(Aided)</th>
                        <td><?php echo $row['va_aidedl'];?></td>
                        <td><?php echo $row['va_aidedr'];?></td>
                    </tr>
                    <tr>
                        <th class="darkhead">Visual Acuity(Unaided)</th>
                        <td><?php echo $row['va_unaidedl'];?></td>
                        <td><?php echo $row['va_unaidedr'];?></td>
                    </tr>
                    <tr>
                        <th class="darkhead">Colour</th>
                        <td><?php echo $row['colour_l'];?></td>
                        <td><?php echo $row['colour_r'];?></td>
                    </tr>
                    <tr>
                        <th class="darkhead">Fundoscopy</th>
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
            <table style="table-layout: fixed; width:100%;">
                <thead>
                    <tr>
                        <th>Lower Limb</th>
                        <th>Left</th>
                        <th>Right</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th class="darkhead">Power</th>
                        <td><?php echo $row['lpow_l'];?></td>
                        <td><?php echo $row['lpow_r'];?></td>
                    </tr>
                    <tr>
                        <th class="darkhead">Reflex</th>
                        <td><?php echo $row['lref_l'];?></td>
                        <td><?php echo $row['lref_r'];?></td>
                    </tr>
                    <tr>
                        <th class="darkhead">Sensation</th>
                        <td><?php echo $row['lsen_l'];?></td>
                        <td><?php echo $row['lsen_r'];?></td>
                    </tr>
                </tbody>
                </table><br>
                <table style="table-layout: fixed; width:100%;">
                    <thead>
                        <tr>
                            <th>Upper Limb</th>
                            <th>Left</th>
                            <th>Right</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th class="darkhead">Power</th>
                            <td><?php echo $row['upow_l'];?></td>
                            <td><?php echo $row['upow_r'];?></td>
                        </tr>
                        <tr>
                            <th class="darkhead">Reflex</th>
                            <td><?php echo $row['uref_l'];?></td>
                            <td><?php echo $row['uref_r'];?></td>
                        </tr>
                        <tr>
                            <th class="darkhead">Sensation</th>
                            <td><?php echo $row['usen_l'];?></td>
                            <td><?php echo $row['usen_r'];?></td>
                        </tr>
                    </tbody>
                </table>
                <h3>For Female</h3>
                <div class="reference">
                    <p>Breast: <?php echo $row['breast'];?></p>
                    <p>Last Menstrual Period: <?php echo $row['lmp'];?></p>
                    <p>Gynaecology History: <?php echo $row['gynaecology'];?></p>
                    <p>Last Pap Smear: <?php echo $row['lastps'];?></p>
                </div>
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
        <?php
                }
            }
            else{
                echo "Patient does not exist in system.";
            }
        ?>
        </div>
    </body>