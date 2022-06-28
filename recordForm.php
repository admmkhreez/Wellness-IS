<!DOCTYPE html>
<html>
    <?php
        session_start();
        if(isset($_SESSION["type"])) {
    ?>
    <head>
        <title>User Registration</title>
        <link rel="stylesheet" href="test.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>
    
    <body>
        <?php
            $mrn = $_POST["mrn"];
            $servername = "localhost";
            $username = "root";
            $password = "";
            $db = "wellness_is";

            $conn = new mysqli($servername, $username, $password, $db);

            if ($conn->connect_error)
            {
                die("Connection failed: " . $conn->connect_error);
            }

            $check = "SELECT a.sex, a.package, b.status FROM patient a, record b WHERE a.mrn = '".$mrn."' AND b.mrn = '".$mrn."'";
            $data = $conn->query($check);
            if ($data->num_rows>0)
            {
                while($row=$data->fetch_assoc())
                {
                    if ($row['status'] == 0)
                    {
        ?>
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            <div class="container-fluid">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="homepage.php">Home</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="viewRecord.php">View Latest Patients</a>
                    </li>
                    <?php
                        if($_SESSION["type"] == "Doctor" || $_SESSION["type"] == "admin"){
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="selectRecord.php">Fill form</a>
                    </li>
                    <?php
                        }
                    ?>
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
        <h1>Patient Medical Report</h1>
        <div class="container">
            <p>MRN: <?php echo $mrn;?></p>
        <form action="insertRecord.php" method="post">
            <label for="appearance">General Appearance: </label>
            <input type="text" id="appearance" name="appearance" required><br>
            <label for="weight">Weight: </label>
            <input type="number" id="weight" step=".1" name="weight" required>kg<br>
            <label for="height">Height: </label>
            <input type="number" id="height" step=".1" name="height" required>cm<br>
            <label for="systolic">Systolic: </label>
            <input type="number" id="systolic" step="1" name="systolic" required><br>
            <label for="diastolic">Diastolic: </label>
            <input type="number" id="diastolic" step="1" name="diastolic" required><br>
            <label for="pulse">Pulse: </label>
            <input type="number" id="pulse" step="1" name="pulse" required><br>
            <h3>Eyes</h3>
            Visual Acuity (Aided)<br>
            <label for="va_aidedl">Left: </label>
            <input type="text" id="va_aidedl" name="va_aidedl" required>
            <label for="va_aidedr">Right: </label>
            <input type="text" id="va_aidedr" name="va_aidedr" required>
            <br>Visual Acuity (Unaided)<br>
            <label for="va_unaidedl">Left: </label>
            <input type="text" id="va_unaidedl" name="va_unaidedl" required>
            <label for="va_unaidedr">Right: </label>
            <input type="text" id="va_unaidedr" name="va_unaidedr" required>
            <br>Colour<br>
            <label for="colour_l">Left: </label>
            <input type="text" id="colour_l" name="colour_l" required>
            <label for="colour_r">Right: </label>
            <input type="text" id="colour_r" name="colour_r" required>
            <br>Fundoscopy<br>
            <label for="fundoscopy_l">Left: </label>
            <input type="text" id="fundoscopy_l" name="fundoscopy_l" required>
            <label for="fundoscopy_r">Right: </label>
            <input type="text" id="fundoscopy_r"name="fundoscopy_r" required>   
            <br><br>
            <label for="nose">Nose: </label>
            <input type="text" id="nose" name="nose" required><br>
            <label for="throat">Throat: </label>
            <input type="text" id="throat" name="throat" required><br>
            <label for="neck">Neck: </label>
            <input type="text" id="neck" name="neck" required><br>
            <label for="skin">Skin: </label>
            <input type="text" id="skin" name="skin" required><br>
            <h3>Ears</h3>
            External Canal<br>
            <label for="excanal_l">Left: </label>
            <input type="text" id="excanal_l" name="excanal_l" required>
            <label for="excanal_r">Right: </label>
            <input type="text" id="excanal_r" name="excanal_r" required>
            <br>Ear Drum<br>
            <label for="eardrum_l">Left: </label>
            <input type="text" id="eardrum_l" name="eardrum_l" required>
            <label for="eardrum_r">Right: </label>
            <input type="text" id="eardrum_r" name="eardrum_r" required>
            <br>Discharged<br>
            <label for="discharged_l">Left: </label>
            <input type="text" id="discharged_l" name="discharged_l" required>
            <label for="discharged_r">Right: </label>
            <input type="text" id="discharged_r" name="discharged_r" required>
            <h3>Cardiovascular System</h3>
            <label for="sound">Sound: </label>
            <input type="text" id="sound" name="sound" required><br>
            <label for="murmur">Murmur: </label>
            <input type="text" id="murmur" name="murmur" required><br>
            <h3>Respiratory System</h3>
            Air Entry<br>
            <input type="radio" id="normal" name="airentry" value="Normal" required>
            <label for="normal">Normal</label>
            <input type="radio" id="abnormal" name="airentry" value="Abnormal">
            <label for="abnormal">Abnormal</label>
            <br>Chest Expansion<br>
            <input type="radio" id="normal" name="chestexp" value="Normal" required>
            <label for="normal">Normal</label>
            <input type="radio" id="abnormal" name="chestexp" value="Abnormal">
            <label for="abnormal">Abnormal</label>
            <br>Breath Sound<br>
            <input type="radio" id="normal" name="breathsound" value="Normal" required>
            <label for="normal">Normal</label>
            <input type="radio" id="abnormal" name="breathsound" value="Abnormal">
            <label for="abnormal">Abnormal</label>
            <h3>Gastrointestinal System</h3>
            Liver<br>
            <input type="radio" id="palpable" name="liver" value="Palpable" required>
            <label for="palpable">Palpable</label>
            <input type="radio" id="notpalpable" name="liver" value="Not Palpable">
            <label for="notpalpable">Not Palpable</label>
            <br>Spleen<br>
            <input type="radio" id="palpable" name="spleen" value="Palpable" required>
            <label for="palpable">Palpable</label>
            <input type="radio" id="notpalpable" name="spleen" value="Not Palpable">
            <label for="notpalpable">Not Palpable</label>
            <br>Kidney<br>
            <input type="radio" id="palpable" name="kidney" value="Palpable" required>
            <label for="palpable">Palpable</label>
            <input type="radio" id="notpalpable" name="kidney" value="Not Palpable">
            <label for="notpalpable">Not Palpable</label>
            <h3>Central Nervous System</h3>
            Mental Function<br>
            <input type="radio" id="normal" name="mentalfunct" value="Normal" required>
            <label for="normal">Normal</label>
            <input type="radio" id="abnormal" name="mentalfunct" value="Abnormal">
            <label for="abnormal">Abnormal</label>
            <br>Coordination<br>
            <input type="radio" id="normal" name="coordination" value="Normal" required>
            <label for="normal">Normal</label>
            <input type="radio" id="abnormal" name="coordination" value="Abnormal">
            <label for="abnormal">Abnormal</label>
            <br>Gait<br>
            <input type="radio" id="normal" name="gait" value="Normal" required>
            <label for="normal">Normal</label>
            <input type="radio" id="abnormal" name="gait" value="Abnormal">
            <label for="abnormal">Abnormal</label>
            <h3>Genitourinary System</h3>
            Genitalia<br>
            <input type="radio" id="normal" name="genitalia" value="Normal" required>
            <label for="normal">Normal</label>
            <input type="radio" id="abnormal" name="genitalia" value="Abnormal">
            <label for="abnormal">Abnormal</label>
            <input type="radio" id="unknown" name="genitalia" value="Unknown">
            <label for="unknown">Unknown</label>
            <br>Rectal Examination<br>
            <input type="radio" id="normal" name="rectal" value="Normal" required>
            <label for="normal">Normal</label>
            <input type="radio" id="abnormal" name="rectal" value="Abnormal">
            <label for="abnormal">Abnormal</label>
            <input type="radio" id="unknown" name="rectal" value="Unknown">
            <label for="unknown">Unknown</label>
            <h3>Musculoskeletal System</h3>
            <h4>Lower Limb</h4>
            Power<br>
            <label for="lpow_l">Left: </label>
            <input type="text" id="lpow_l" name="lpow_l" required>
            <label for="lpow_r">Right: </label>
            <input type="text" id="lpow_r" name="lpow_r" required>
            <br>Reflex<br>
            <label for="lref_l">Left: </label>
            <input type="text" id="lref_l" name="lref_l" required>
            <label for="lref_r">Right: </label>
            <input type="text" id="lref_r" name="lref_r" required>
            <br>Sensantion<br>
            <label for="lsen_l">Left: </label>
            <input type="text" id="lsen_l" name="lsen_l" required>
            <label for="lsen_r">Right: </label>
            <input type="text" id="lsen_r" name="lsen_r" required>
            <h4>Upper Limb</h4>
            Power<br>
            <label for="upow_l">Left: </label>
            <input type="text" id="upow_l" name="upow_l" required>
            <label for="upow_r">Right: </label>
            <input type="text" id="upow_r" name="upow_r" required>
            <br>Reflex<br>
            <label for="uref_l">Left: </label>
            <input type="text" id="uref_l" name="uref_l" required>
            <label for="uref_r">Right: </label>
            <input type="text" id="uref_r" name="uref_r" required>
            <br>Sensantion<br>
            <label for="usen_l">Left: </label>
            <input type="text" id="usen_l" name="usen_l" required>
            <label for="usen_r">Right: </label>
            <input type="text" id="usen_r" name="usen_r" required>
            <?php
                if ($row['sex'] == 'Female' ){
            ?>
            <h3>For Female Patient</h3>
            <label for="breast">Breast: </label>
            <input type="text" id="breast" name="breast" required><br>
            <label for="lmp">Last Menstrual Period: </label>
            <input type="text" id="lmp" name="lmp" required><br>
            <label for="gynaecology">Gynaecology History: </label>
            <input type="text" id="gynaecology" name="gynaecology" required><br>
            <label for="lastps">Last Pap Smear: </label>
            <input type="text" id="lastps" name="lastps" required><br>
            <?php
                }
            ?>
            <h3>Investigation</h3>
            <label for="cxr">Chest X-Ray: </label>
            <input type="text" id="cxr" name="cxr" required><br>
            <label for="ecg">Electrocardiogram: </label>
            <input type="text" id="ecg" name="ecg" required><br>
            <?php
                if ($row['package'] == "Custom"){
            ?>
            <label for="mmg">Mammogram: </label>
            <input type="text" id="mmg" name="mammogram" required><br>
            <label for="us_breast">Ultrasound Breast: </label>
            <input type="text" id="us_breast" name="us_breast" required><br>
            <?php
                }
                if ($row['package'] == "Comprehensive" || $row['package'] == "Premium" || $row['package'] == "Custom"){
            ?>
            <label for="us_abdopel">Ultrasound Abdomen Pelvis: </label>
            <input type="text" id="us_abdopel" name="us_abdopel" required><br>
            <?php
                }
                if ($row['package'] == "Premium" || $row['package'] == "Custom"){
            ?>
            <label for="stress">Stress Test: </label>
            <input type="text" id="stress" name="stresstest" required><br>
            <?php
                }
                if ($row['package'] == "Custom"){
            ?>
            <label for="pta">Pure Tone Audiometry: </label>
            <input type="text" id="pta" name="pta" required><br>
            <label for="lft">Lung Function Test: </label>
            <input type="text" id="lft" name="lft" required><br>
            <?php
                }
            ?>
            <label for="urine">Urine: </label>
            <input type="text" id="urine" name="urine" required><br>
            <label for="blood">Blood: </label>
            <input type="text" id="blood" name="blood" required><br>
            <label for="impression">Impression: </label><br>
            <textarea id="impression" name="impression" rows="5" cols="100" required></textarea><br>
            <label for="recommendation">Recommendation: </label><br>
            <textarea id="recommendation" name="recommendation" rows="5" cols="100" required></textarea><br>
            <br>
            <input type="submit" class="btn btn-primary" value="Submit Record">
            <input type="hidden" name="mrn" value="<?php echo $mrn;?>">
            <input type="hidden" name="sex" value="<?php echo $row['sex'];?>">
            <input type="hidden" name="package" value="<?php echo $row['package'];?>">
        </form>
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
                    echo "<div class='container'><p>Record already exist, click <a href='selectPatient.php'>here</a> to update</p>";
                }
            }
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
</html>