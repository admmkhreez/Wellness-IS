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
        else{
            $select = "SELECT * from record a, patient b WHERE a.mrn = '".$mrn."' AND b.mrn = '".$mrn."'";
            $data = $conn->query($select);
        }
    ?>
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
        <h1>Patient Medical Report</h1>
        <br>
        <div class="container">
        <form method="post" style="text-align: center;">
                <label class="inline" for="mrn">Enter Patient's MRN</label><br>
                <input type="text" id="mrn" name="mrn" maxlength="10" required autofocus><br>
                <button formaction="recordUpdateForm.php" class="btn btn-primary">Search</button>
    <?php
        if ($data->num_rows>0)
        {
            while($row=$data->fetch_assoc()){
    ?>
        
                <input type="hidden" name="sex" value="<?php echo $row["sex"];?>">
                <input type="hidden" name="package" value="<?php echo $row["package"];?>">
                
        </form>
        <br>
        <form method="post" style="text-align:center;">
            <div class="btn-group" style="width:100%;">
                <input type="hidden" name="mrn" value="<?php echo $mrn;?>">
                <input type="hidden" name="sex" value="<?php echo $row["sex"];?>">
                <input type="hidden" name="package" value="<?php echo $row["package"];?>">
                <button formaction="viewPatient.php" class="btn btn-primary">View Patient's Details</button>
                <button formaction="editProfile.php" class="btn btn-primary">Edit Patient's Details</button>
                <?php
                    if($_SESSION["type"] == "Doctor" || $_SESSION["type"] == "admin"){
                ?>
                <button formaction="recordUpdateForm.php" class="btn btn-primary active">Update Patient's Record</button>
                <?php
                    }
                ?>
                <button formaction="historyUpdateForm.php" class="btn btn-primary">Update Medical History</button>       
            </div>    
        </form>
        <br>
        <dl class="row h5">
            <dt class="col-sm-3">Name: </dt>
            <dd class="col-sm-9"><?php echo $row["name"];?></dd>
            <dt class="col-sm-3">MRN: </dt>
            <dd class="col-sm-9"><?php echo $mrn;?></dd>
            <dt class="col-sm-3">Done by: </dt>
            <dd class="col-sm-9"><?php echo $row["doneBy"];?></dd>
        </dl>  
        <form action="updateRecord.php" method="post">
            <label class="inline" for="appearance">General Appearance: </label>
            <input type="text" id="appearance" name="appearance" value="<?php echo $row["appearance"];?>"><br>
            <label class="inline" for="weight">Weight: </label>
            <input type="number" id="weight" step=".1" name="weight" value="<?php echo $row["weight"];?>">kg<br>
            <label class="inline" for="height">Height: </label>
            <input type="number" id="height" step=".1" name="height" value="<?php echo $row["height"];?>">cm<br>
            <label class="inline" for="systolic">Systolic: </label>
            <input type="number" id="systolic" step="1" name="systolic" value="<?php echo $row["systolic"];?>"><br>
            <label class="inline" for="diastolic">Diastolic: </label>
            <input type="number" id="diastolic" step="1" name="diastolic" value="<?php echo $row["diastolic"];?>"><br>
            <label class="inline" for="pulse">Pulse: </label>
            <input type="number" id="pulse" step="1" name="pulse" value="<?php echo $row["pulse"];?>"><br>
        <div class="lrcol">
            <h3>Eyes</h3>
            Visual Acuity (Aided)<br>
            <label class="inline" for="va_aidedl">Left: </label>
            <input type="text" id="va_aidedl" name="va_aidedl" value="<?php echo $row["va_aidedl"];?>">
            <label class="inline" for="va_aidedr">Right: </label>
            <input type="text" id="va_aidedr" name="va_aidedr" value="<?php echo $row["va_aidedr"];?>">
            <br>Visual Acuity (Unaided)<br>
            <label class="inline" for="va_unaidedl">Left: </label>
            <input type="text" id="va_unaidedl" name="va_unaidedl" value="<?php echo $row["va_unaidedl"];?>">
            <label class="inline" for="va_unaidedr">Right: </label>
            <input type="text" id="va_unaidedr" name="va_unaidedr" value="<?php echo $row["va_unaidedr"];?>">
            <br>Colour<br>
            <label class="inline" for="colour_l">Left: </label>
            <input type="text" id="colour_l" name="colour_l" value="<?php echo $row["colour_l"];?>">
            <label class="inline" for="colour_r">Right: </label>
            <input type="text" id="colour_r" name="colour_r" value="<?php echo $row["colour_r"];?>">
            <br>Fundoscopy<br>
            <label class="inline" for="fundoscopy_l">Left: </label>
            <input type="text" id="fundoscopy_l" name="fundoscopy_l" value="<?php echo $row["fundoscopy_l"];?>">
            <label class="inline" for="fundoscopy_r">Right: </label>
            <input type="text" id="fundoscopy_r"name="fundoscopy_r" value="<?php echo $row["fundoscopy_r"];?>">   
            <br><br>
        </div>
            <label class="inline" for="nose">Nose: </label>
            <input type="text" id="nose" name="nose" value="<?php echo $row["nose"];?>"><br>
            <label class="inline" for="throat">Throat: </label>
            <input type="text" id="throat" name="throat" value="<?php echo $row["throat"];?>"><br>
            <label class="inline" for="neck">Neck: </label>
            <input type="text" id="neck" name="neck" value="<?php echo $row["neck"];?>"><br>
            <label class="inline" for="skin">Skin: </label>
            <input type="text" id="skin" name="skin" value="<?php echo $row["skin"];?>"><br>
        <div class="lrcol">
            <h3>Ears</h3>
            External Canal<br>
            <label class="inline" for="excanal_l">Left: </label>
            <input type="text" id="excanal_l" name="excanal_l" value="<?php echo $row["excanal_l"];?>">
            <label class="inline" for="excanal_r">Right: </label>
            <input type="text" id="excanal_r" name="excanal_r" value="<?php echo $row["excanal_r"];?>">
            <br>Ear Drum<br>
            <label class="inline" for="eardrum_l">Left: </label>
            <input type="text" id="eardrum_l" name="eardrum_l" value="<?php echo $row["eardrum_l"];?>">
            <label class="inline" for="eardrum_r">Right: </label>
            <input type="text" id="eardrum_r" name="eardrum_r" value="<?php echo $row["eardrum_r"];?>">
            <br>Discharged<br>
            <label class="inline" for="discharged_l">Left: </label>
            <input type="text" id="discharged_l" name="discharged_l" value="<?php echo $row["discharged_l"];?>">
            <label class="inline" for="discharged_r">Right: </label>
            <input type="text" id="discharged_r" name="discharged_r" value="<?php echo $row["discharged_r"];?>">
        </div>
            <h3>Cardiovascular System</h3>
            <label class="inline" for="sound">Sound: </label>
            <input type="text" id="sound" name="sound" value="<?php echo $row["sound"];?>"><br>
            <label class="inline" for="murmur">Murmur: </label>
            <input type="text" id="murmur" name="murmur" value="<?php echo $row["murmur"];?>"><br>
            <h3>Respiratory System</h3>
            Air Entry<br>
            <input type="radio" class="form-check-input" id="normal" name="airentry" value="Normal" <?php if ($row['airentry'] == "Normal") echo "checked"; ?>>
            <label class="inline-radio" for="normal">Normal</label>
            <input type="radio" class="form-check-input" id="abnormal" name="airentry" value="Abnormal"<?php if ($row['airentry']== "Abnormal") echo "checked"; ?>>
            <label class="inline-radio" for="abnormal">Abnormal</label>
            <br>Chest Expansion<br>
            <input type="radio" class="form-check-input" id="normal" name="chestexp" value="Normal" <?php if ($row['chestexp'] == "Normal") echo "checked"; ?>>
            <label class="inline-radio" for="normal">Normal</label>
            <input type="radio" class="form-check-input" id="abnormal" name="chestexp" value="Abnormal"<?php if ($row['chestexp']== "Abnormal") echo "checked"; ?>>
            <label class="inline-radio" for="abnormal">Abnormal</label>
            <br>Breath Sound<br>
            <input type="radio" class="form-check-input" id="normal" name="breathsound" value="Normal" <?php if ($row['breathsound'] == "Normal") echo "checked"; ?>>
            <label class="inline-radio" for="normal">Normal</label>
            <input type="radio" class="form-check-input" id="abnormal" name="breathsound" value="Abnormal"<?php if ($row['breathsound']== "Abnormal") echo "checked"; ?>>
            <label class="inline-radio" for="abnormal">Abnormal</label>
            <h3>Gastrointestinal System</h3>
            Liver<br>
            <input type="radio" class="form-check-input" id="palpable" name="liver" value="Palpable" <?php if ($row['liver'] == "Palpable") echo "checked"; ?>>
            <label class="inline-radio" for="palpable">Palpable</label>
            <input type="radio" class="form-check-input" id="notpalpable" name="liver" value="Not Palpable" <?php if ($row['liver'] == "Not Palpable") echo "checked"; ?>>
            <label class="inline-radio" for="notpalpable">Not Palpable</label>
            <br>Spleen<br>
            <input type="radio" class="form-check-input" id="palpable" name="spleen" value="Palpable" <?php if ($row['spleen'] == "Palpable") echo "checked"; ?>>
            <label class="inline-radio" for="palpable">Palpable</label>
            <input type="radio" class="form-check-input" id="notpalpable" name="spleen" value="Not Palpable" <?php if ($row['spleen'] == "Not Palpable") echo "checked"; ?>>
            <label class="inline-radio" for="notpalpable">Not Palpable</label>
            <br>Kidney<br>
            <input type="radio" class="form-check-input" id="palpable" name="kidney" value="Palpable" <?php if ($row['kidney'] == "Palpable") echo "checked"; ?>>
            <label class="inline-radio" for="palpable">Palpable</label>
            <input type="radio" class="form-check-input" id="notpalpable" name="kidney" value="Not Palpable" <?php if ($row['kidney'] == "Not Palpable") echo "checked"; ?>>
            <label class="inline-radio" for="notpalpable">Not Palpable</label>
            <h3>Central Nervous System</h3>
            Mental Function<br>
            <input type="radio" class="form-check-input" id="normal" name="mentalfunct" value="Normal" <?php if ($row['mentalfunct'] == "Normal") echo "checked"; ?>>
            <label class="inline-radio" for="normal">Normal</label>
            <input type="radio" class="form-check-input" id="abnormal" name="mentalfunct" value="Abnormal"<?php if ($row['mentalfunct']== "Abnormal") echo "checked"; ?>>
            <label class="inline-radio" for="abnormal">Abnormal</label>
            <br>Coordination<br>
            <input type="radio" class="form-check-input" id="normal" name="coordination" value="Normal" <?php if ($row['coordination'] == "Normal") echo "checked"; ?>>
            <label class="inline-radio" for="normal">Normal</label>
            <input type="radio" class="form-check-input" id="abnormal" name="coordination" value="Abnormal"<?php if ($row['coordination']== "Abnormal") echo "checked"; ?>>
            <label class="inline-radio" for="abnormal">Abnormal</label>
            <br>Gait<br>
            <input type="radio" class="form-check-input" id="normal" name="gait" value="Normal" <?php if ($row['gait'] == "Normal") echo "checked"; ?>>
            <label class="inline-radio" for="normal">Normal</label>
            <input type="radio" class="form-check-input" id="abnormal" name="gait" value="Abnormal"<?php if ($row['gait']== "Abnormal") echo "checked"; ?>>
            <label class="inline-radio" for="abnormal">Abnormal</label>
            <h3>Genitourinary System</h3>
            Genitalia<br>
            <input type="radio" class="form-check-input" id="normal" name="genitalia" value="Normal" <?php if ($row['genitalia'] == "Normal") echo "checked"; ?>>
            <label class="inline-radio" for="normal">Normal</label>
            <input type="radio" class="form-check-input" id="abnormal" name="genitalia" value="Abnormal"<?php if ($row['genitalia']== "Abnormal") echo "checked"; ?>>
            <label class="inline-radio" for="abnormal">Abnormal</label>
            <input type="radio" class="form-check-input" id="unknown" name="genitalia" value="Unknown"<?php if ($row['genitalia']== "Abnormal") echo "checked"; ?>>
            <label class="inline-radio" for="unknown">Unknown</label>
            <br>Rectal Examination<br>
            <input type="radio" class="form-check-input" id="normal" name="rectal" value="Normal" <?php if ($row['rectal'] == "Normal") echo "checked"; ?>>
            <label class="inline-radio" for="normal">Normal</label>
            <input type="radio" class="form-check-input" id="abnormal" name="rectal" value="Abnormal"<?php if ($row['rectal']== "Abnormal") echo "checked"; ?>>
            <label class="inline-radio" for="abnormal">Abnormal</label>
            <input type="radio" class="form-check-input" id="unknown" name="rectal" value="Unknown"<?php if ($row['genitalia']== "Abnormal") echo "checked"; ?>>
            <label class="inline-radio" for="unknown">Unknown</label>
        <div class="lrcol">
            <h3>Musculoskeletal System</h3>
            <h4>Lower Limb</h4>
            Power<br>
            <label class="inline" for="lpow_l">Left: </label>
            <input type="text" id="lpow_l" name="lpow_l" value="<?php echo $row["lpow_l"];?>">
            <label class="inline" for="lpow_r">Right: </label>
            <input type="text" id="lpow_r" name="lpow_r" value="<?php echo $row["lpow_r"];?>">
            <br>Reflex<br>
            <label class="inline" for="lref_l">Left: </label>
            <input type="text" id="lref_l" name="lref_l" value="<?php echo $row["lref_l"];?>">
            <label class="inline" for="lref_r">Right: </label>
            <input type="text" id="lref_r" name="lref_r" value="<?php echo $row["lref_r"];?>">
            <br>Sensantion<br>
            <label class="inline" for="lsen_l">Left: </label>
            <input type="text" id="lsen_l" name="lsen_l" value="<?php echo $row["lsen_l"];?>">
            <label class="inline" for="lsen_r">Right: </label>
            <input type="text" id="lsen_r" name="lsen_r" value="<?php echo $row["lsen_r"];?>">
            <h4>Upper Limb</h4>
            Power<br>
            <label class="inline" for="upow_l">Left: </label>
            <input type="text" id="upow_l" name="upow_l" value="<?php echo $row["upow_l"];?>">
            <label class="inline" for="upow_r">Right: </label>
            <input type="text" id="upow_r" name="upow_r" value="<?php echo $row["upow_r"];?>">
            <br>Reflex<br>
            <label class="inline" for="uref_l">Left: </label>
            <input type="text" id="uref_l" name="uref_l" value="<?php echo $row["uref_l"];?>">
            <label class="inline" for="uref_r">Right: </label>
            <input type="text" id="uref_r" name="uref_r" value="<?php echo $row["uref_r"];?>">
            <br>Sensantion<br>
            <label class="inline" for="usen_l">Left: </label>
            <input type="text" id="usen_l" name="usen_l" value="<?php echo $row["usen_l"];?>">
            <label class="inline" for="usen_r">Right: </label>
            <input type="text" id="usen_r" name="usen_r" value="<?php echo $row["usen_r"];?>">
        </div>
            <?php
                if ($row["sex"] == 'Female' ){
            ?>
            <h3>For Female Patient</h3>
            <label class="inline" for="breast">Breast: </label>
            <input type="text" id="breast" name="breast" value="<?php echo $row["breast"];?>"><br>
            <label class="inline" for="lmp">Last Menstrual Period: </label>
            <input type="text" id="lmp" name="lmp" value="<?php echo $row["lmp"];?>"><br>
            <label class="inline" for="gynaecology">Gynaecology History: </label>
            <input type="text" id="gynaecology" name="gynaecology" value="<?php echo $row["gynaecology"];?>"><br>
            <label class="inline" for="lastps">Last Pap Smear: </label>
            <input type="text" id="lastps" name="lastps" value="<?php echo $row["lastps"];?>"><br>
            <?php
                }
            ?>
            <h3>Investigation</h3>
            <label class="inline" for="cxr">Chest X-Ray: </label>
            <input type="text" id="cxr" name="cxr" value="<?php echo $row["cxr"];?>"><br>
            <label class="inline" for="ecg">Electrocardiogram: </label>
            <input type="text" id="ecg" name="ecg" value="<?php echo $row["ecg"];?>"><br>
            <?php
                if ($row["package"] == "Custom"){
            ?>
            <label class="inline" for="mmg">Mammogram: </label>
            <input type="text" id="mmg" name="mammogram" value="<?php echo $row["mammogram"];?>"><br>
            <label class="inline" for="us_breast">Ultrasound Breast: </label>
            <input type="text" id="us_breast" name="us_breast" value="<?php echo $row["us_breast"];?>"><br>
            <?php
                }
                if ($row["package"] == "Comprehensive" || $row["package"] == "Premium" || $row["package"] == "Custom"){
            ?>
            <label class="inline" for="us_abdopel">Ultrasound Abdomen Pelvis: </label>
            <input type="text" id="us_abdopel" name="us_abdopel" value="<?php echo $row["us_abdopel"];?>"><br>
            <?php
                }
                if ($row["package"] == "Premium" || $row["package"] == "Custom"){
            ?>
            <label class="inline" for="stress">Stress Test: </label>
            <input type="text" id="stress" name="stresstest" value="<?php echo $row["stresstest"];?>"><br>
            <?php
                }
                if ($row["package"] == "Custom"){
            ?>
            <label class="inline" for="pta">Pure Tone Audiometry: </label>
            <input type="text" id="pta" name="pta" value="<?php echo $row["pta"];?>"><br>
            <label class="inline" for="lft">Lung Function Test: </label>
            <input type="text" id="lft" name="lft" value="<?php echo $row["lft"];?>"><br>
            <?php
                }
            ?>
            <label class="inline" for="urine">Urine: </label>
            <input type="text" id="urine" name="urine" value="<?php echo $row["urine"];?>"><br>
            <label class="inline" for="blood">Blood: </label>
            <input type="text" id="blood" name="blood" value="<?php echo $row["blood"];?>"><br>
            <label class="inline" for="impression">Impression: </label>
            <textarea id="impression" name="impression" rows="5" cols="100"><?php echo $row["impression"];?></textarea><br>
            <label class="inline" for="recommendation">Recommendation: </label>
            <textarea id="recommendation" name="recommendation" rows="5" cols="100"><?php echo $row["recommendation"];?></textarea><br>
            <br>
            <input type="submit" class="btn btn-primary" value="Submit Record">
            <input type="hidden" name="mrn" value="<?php echo $mrn;?>">
            <input type="hidden" name="sex" value="<?php echo $row["sex"];?>">
            <input type="hidden" name="package" value="<?php echo $row["package"];?>">
        </form>
        <br>
    <?php
            }
        }
        else{   
            echo "</form>Patient does not exist in system.";
        }
    ?>
    </div>
    </body>
    <?php
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
</html>