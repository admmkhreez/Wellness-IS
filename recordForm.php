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
    
    <body>
        <nav class="navbar sticky-top navbar-expand-sm bg-dark navbar-dark">
            <div class="container-sm">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="homepage.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="viewRecord.php">View Patients</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="selectRecord.php">Fill form</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="selectPatient.php">Search Patient</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="viewReport.php">View Report</a>
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
        <h1>Patient Medical Report</h1>
        <br>
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

            $check = "SELECT a.name, a.sex, a.package, b.status FROM patient a, record b WHERE a.mrn = '".$mrn."' AND b.mrn = '".$mrn."'";
            $data = $conn->query($check);
            if ($data->num_rows>0)
            {
                while($row=$data->fetch_assoc())
                {
                    if ($row['status'] == 0)
                    {
        ?>
        <div class="container">
        <dl class="row h5">
            <dt class="col-sm-3">Name: </dt>
            <dd class="col-sm-9"><?php echo $row["name"];?></dd>
            <dt class="col-sm-3">MRN: </dt>
            <dd class="col-sm-9"><?php echo $mrn;?></dd>
        </dl>
        <form action="insertRecord.php" method="post">
            <label class="inline" for="appearance">General Appearance: </label>
            <input type="text" id="appearance" name="appearance" required><br>
            <label class="inline" for="weight">Weight: </label>
            <input type="number" id="weight" step=".1" name="weight" required>kg<br>
            <label class="inline" for="height">Height: </label>
            <input type="number" id="height" step=".1" name="height" required>cm<br>
            <label class="inline" for="systolic">Systolic: </label>
            <input type="number" id="systolic" step="1" name="systolic" required><br>
            <label class="inline" for="diastolic">Diastolic: </label>
            <input type="number" id="diastolic" step="1" name="diastolic" required><br>
            <label class="inline" for="pulse">Pulse: </label>
            <input type="number" id="pulse" step="1" name="pulse" required><br>
        <div class="lrcol">
            <h3>Eyes</h3>
            Visual Acuity (Aided)<br>
            <label class="inline" for="va_aidedl">Left: </label>
            <input type="text" id="va_aidedl" name="va_aidedl" required>
            <label class="inline" for="va_aidedr">Right: </label>
            <input type="text" id="va_aidedr" name="va_aidedr" required>
            <br>Visual Acuity (Unaided)<br>
            <label class="inline" for="va_unaidedl">Left: </label>
            <input type="text" id="va_unaidedl" name="va_unaidedl" required>
            <label class="inline" for="va_unaidedr">Right: </label>
            <input type="text" id="va_unaidedr" name="va_unaidedr" required>
            <br>Colour<br>
            <label class="inline" for="colour_l">Left: </label>
            <input type="text" id="colour_l" name="colour_l" required>
            <label class="inline" for="colour_r">Right: </label>
            <input type="text" id="colour_r" name="colour_r" required>
            <br>Fundoscopy<br>
            <label class="inline" for="fundoscopy_l">Left: </label>
            <input type="text" id="fundoscopy_l" name="fundoscopy_l" required>
            <label class="inline" for="fundoscopy_r">Right: </label>
            <input type="text" id="fundoscopy_r"name="fundoscopy_r" required>  
        </div> 
            <br><br>
            <label class="inline" for="nose">Nose: </label>
            <input type="text" id="nose" name="nose" required><br>
            <label class="inline" for="throat">Throat: </label>
            <input type="text" id="throat" name="throat" required><br>
            <label class="inline" for="neck">Neck: </label>
            <input type="text" id="neck" name="neck" required><br>
            <label class="inline" for="skin">Skin: </label>
            <input type="text" id="skin" name="skin" required><br>
        <div class="lrcol">
            <h3>Ears</h3>
            External Canal<br>
            <label class="inline" for="excanal_l">Left: </label>
            <input type="text" id="excanal_l" name="excanal_l" required>
            <label class="inline" for="excanal_r">Right: </label>
            <input type="text" id="excanal_r" name="excanal_r" required>
            <br>Ear Drum<br>
            <label class="inline" for="eardrum_l">Left: </label>
            <input type="text" id="eardrum_l" name="eardrum_l" required>
            <label class="inline" for="eardrum_r">Right: </label>
            <input type="text" id="eardrum_r" name="eardrum_r" required>
            <br>Discharged<br>
            <label class="inline" for="discharged_l">Left: </label>
            <input type="text" id="discharged_l" name="discharged_l" required>
            <label class="inline" for="discharged_r">Right: </label>
            <input type="text" id="discharged_r" name="discharged_r" required>
        </div>
            <h3>Cardiovascular System</h3>
            <label class="inline" for="sound">Sound: </label>
            <input type="text" id="sound" name="sound" required><br>
            <label class="inline" for="murmur">Murmur: </label>
            <input type="text" id="murmur" name="murmur" required><br>
            <h3>Respiratory System</h3>
            Air Entry<br>
            <input type="radio" class="form-check-input" id="normal" name="airentry" value="Normal" required>
            <label class="inline-radio" for="normal">Normal</label>
            <input type="radio" class="form-check-input" id="abnormal" name="airentry" value="Abnormal">
            <label class="inline-radio" for="abnormal">Abnormal</label>
            <br>Chest Expansion<br>
            <input type="radio" class="form-check-input" id="normal" name="chestexp" value="Normal" required>
            <label class="inline-radio" for="normal">Normal</label>
            <input type="radio" class="form-check-input" id="abnormal" name="chestexp" value="Abnormal">
            <label class="inline-radio" for="abnormal">Abnormal</label>
            <br>Breath Sound<br>
            <input type="radio" class="form-check-input" id="normal" name="breathsound" value="Normal" required>
            <label class="inline-radio" for="normal">Normal</label>
            <input type="radio" class="form-check-input" id="abnormal" name="breathsound" value="Abnormal">
            <label class="inline-radio" for="abnormal">Abnormal</label>
            <h3>Gastrointestinal System</h3>
            Liver<br>
            <input type="radio" class="form-check-input" id="palpable" name="liver" value="Palpable" required>
            <label class="inline-radio" for="palpable">Palpable</label>
            <input type="radio" class="form-check-input" id="notpalpable" name="liver" value="Not Palpable">
            <label class="inline-radio" for="notpalpable">Not Palpable</label>
            <br>Spleen<br>
            <input type="radio" class="form-check-input" id="palpable" name="spleen" value="Palpable" required>
            <label class="inline-radio" for="palpable">Palpable</label>
            <input type="radio" class="form-check-input" id="notpalpable" name="spleen" value="Not Palpable">
            <label class="inline-radio" for="notpalpable">Not Palpable</label>
            <br>Kidney<br>
            <input type="radio" class="form-check-input" id="palpable" name="kidney" value="Palpable" required>
            <label class="inline-radio" for="palpable">Palpable</label>
            <input type="radio" class="form-check-input" id="notpalpable" name="kidney" value="Not Palpable">
            <label class="inline-radio" for="notpalpable">Not Palpable</label>
            <h3>Central Nervous System</h3>
            Mental Function<br>
            <input type="radio" class="form-check-input" id="normal" name="mentalfunct" value="Normal" required>
            <label class="inline-radio" for="normal">Normal</label>
            <input type="radio" class="form-check-input" id="abnormal" name="mentalfunct" value="Abnormal">
            <label class="inline-radio" for="abnormal">Abnormal</label>
            <br>Coordination<br>
            <input type="radio" class="form-check-input" id="normal" name="coordination" value="Normal" required>
            <label class="inline-radio" for="normal">Normal</label>
            <input type="radio" class="form-check-input" id="abnormal" name="coordination" value="Abnormal">
            <label class="inline-radio" for="abnormal">Abnormal</label>
            <br>Gait<br>
            <input type="radio" class="form-check-input" id="normal" name="gait" value="Normal" required>
            <label class="inline-radio" for="normal">Normal</label>
            <input type="radio" class="form-check-input" id="abnormal" name="gait" value="Abnormal">
            <label class="inline-radio" for="abnormal">Abnormal</label>
            <h3>Genitourinary System</h3>
            Genitalia<br>
            <input type="radio" class="form-check-input" id="normal" name="genitalia" value="Normal" required>
            <label class="inline-radio" for="normal">Normal</label>
            <input type="radio" class="form-check-input" id="abnormal" name="genitalia" value="Abnormal">
            <label class="inline-radio" for="abnormal">Abnormal</label>
            <input type="radio" class="form-check-input" id="unknown" name="genitalia" value="Unknown">
            <label class="inline-radio" for="unknown">Unknown</label>
            <br>Rectal Examination<br>
            <input type="radio" class="form-check-input" id="normal" name="rectal" value="Normal" required>
            <label class="inline-radio" for="normal">Normal</label>
            <input type="radio" class="form-check-input" id="abnormal" name="rectal" value="Abnormal">
            <label class="inline-radio" for="abnormal">Abnormal</label>
            <input type="radio" class="form-check-input" id="unknown" name="rectal" value="Unknown">
            <label class="inline-radio" for="unknown">Unknown</label>
        <div class="lrcol">
            <h3>Musculoskeletal System</h3>
            <h4>Lower Limb</h4>
            Power<br>
            <label class="inline" for="lpow_l">Left: </label>
            <input type="text" id="lpow_l" name="lpow_l" required>
            <label class="inline" for="lpow_r">Right: </label>
            <input type="text" id="lpow_r" name="lpow_r" required>
            <br>Reflex<br>
            <label class="inline" for="lref_l">Left: </label>
            <input type="text" id="lref_l" name="lref_l" required>
            <label class="inline" for="lref_r">Right: </label>
            <input type="text" id="lref_r" name="lref_r" required>
            <br>Sensantion<br>
            <label class="inline" for="lsen_l">Left: </label>
            <input type="text" id="lsen_l" name="lsen_l" required>
            <label class="inline" for="lsen_r">Right: </label>
            <input type="text" id="lsen_r" name="lsen_r" required>
            <h4>Upper Limb</h4>
            Power<br>
            <label class="inline" for="upow_l">Left: </label>
            <input type="text" id="upow_l" name="upow_l" required>
            <label class="inline" for="upow_r">Right: </label>
            <input type="text" id="upow_r" name="upow_r" required>
            <br>Reflex<br>
            <label class="inline" for="uref_l">Left: </label>
            <input type="text" id="uref_l" name="uref_l" required>
            <label class="inline" for="uref_r">Right: </label>
            <input type="text" id="uref_r" name="uref_r" required>
            <br>Sensantion<br>
            <label class="inline" for="usen_l">Left: </label>
            <input type="text" id="usen_l" name="usen_l" required>
            <label class="inline" for="usen_r">Right: </label>
            <input type="text" id="usen_r" name="usen_r" required>
        </div>
            <?php
                if ($row['sex'] == 'Female' ){
            ?>
            <h3>For Female Patient</h3>
            <label class="inline" for="breast">Breast: </label>
            <input type="text" id="breast" name="breast" required><br>
            <label class="inline" for="lmp">Last Menstrual Period: </label>
            <input type="text" id="lmp" name="lmp" required><br>
            <label class="inline" for="gynaecology">Gynaecology History: </label>
            <input type="text" id="gynaecology" name="gynaecology" required><br>
            <label class="inline" for="lastps">Last Pap Smear: </label>
            <input type="text" id="lastps" name="lastps" required><br>
            <?php
                }
            ?>
            <h3>Investigation</h3>
            <label class="inline" for="cxr">Chest X-Ray: </label>
            <input type="text" id="cxr" name="cxr" required><br>
            <label class="inline" for="ecg">Electrocardiogram: </label>
            <input type="text" id="ecg" name="ecg" required><br>
            <?php
                if ($row['package'] == "Custom"){
            ?>
            <label class="inline" for="mmg">Mammogram: </label>
            <input type="text" id="mmg" name="mammogram" required><br>
            <label class="inline" for="us_breast">Ultrasound Breast: </label>
            <input type="text" id="us_breast" name="us_breast" required><br>
            <?php
                }
                if ($row['package'] == "Comprehensive" || $row['package'] == "Premium" || $row['package'] == "Custom"){
            ?>
            <label class="inline" for="us_abdopel">Ultrasound Abdomen Pelvis: </label>
            <input type="text" id="us_abdopel" name="us_abdopel" required><br>
            <?php
                }
                if ($row['package'] == "Premium" || $row['package'] == "Custom"){
            ?>
            <label class="inline" for="stress">Stress Test: </label>
            <input type="text" id="stress" name="stresstest" required><br>
            <?php
                }
                if ($row['package'] == "Custom"){
            ?>
            <label class="inline" for="pta">Pure Tone Audiometry: </label>
            <input type="text" id="pta" name="pta" required><br>
            <label class="inline" for="lft">Lung Function Test: </label>
            <input type="text" id="lft" name="lft" required><br>
            <?php
                }
            ?>
            <label class="inline" for="urine">Urine: </label>
            <input type="text" id="urine" name="urine" required><br>
            <label class="inline" for="blood">Blood: </label>
            <input type="text" id="blood" name="blood" required><br>
            <label class="inline" for="impression">Impression: </label>
            <textarea id="impression" name="impression" rows="5" cols="100" required></textarea><br>
            <label class="inline" for="recommendation">Recommendation: </label>
            <textarea id="recommendation" name="recommendation" rows="5" cols="100" required></textarea><br>
            <br>
            <input type="submit" class="btn btn-primary" value="Submit Record">
            <input type="hidden" name="mrn" value="<?php echo $mrn;?>">
            <input type="hidden" name="sex" value="<?php echo $row['sex'];?>">
            <input type="hidden" name="package" value="<?php echo $row['package'];?>">
            <input type="hidden" name="name" value="<?php echo $row["name"];?>">
        </form>
        <?php
                    }
                else{
                    echo "<div class='container'><p>Record already exist, click <a href='selectPatient.php'>here</a> to update</p>";
                }
            }
        }
        else{
                    echo "<div class='container'><p>User does not exist, click <a href='homepage.php'>here</a> to Register</p>";
                }
        }
        else
        {
            echo "<script type='text/javascript'>";
            echo "alert('Session does not exist. Please login again');";
            echo "window.location.href = 'log-in.html';";
            echo "</script>";
        }
        $conn->close();
        ?>
        </div>
    </body>
</html>