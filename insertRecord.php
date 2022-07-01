<!DOCTYPE htmL>
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
        ?>
    </head>
    
    <body>
        <?php
            $package = $_POST["package"];
            $sex = $_POST["sex"];  
            $mrn = $_POST["mrn"];
            $appearance = $_POST["appearance"];
            $weight = $_POST["weight"];
            $height = $_POST["height"];
            $systolic = $_POST["systolic"];
            $diastolic = $_POST["diastolic"];
            $pulse = $_POST["pulse"];
            $va_aidedl = $_POST["va_aidedl"];
            $va_aidedr = $_POST["va_aidedr"];
            $va_unaidedl = $_POST["va_unaidedl"];
            $va_unaidedr = $_POST["va_unaidedr"];
            $colour_l = $_POST["colour_l"];
            $colour_r = $_POST["colour_r"];
            $fundoscopy_l = $_POST["fundoscopy_l"];
            $fundoscopy_r = $_POST["fundoscopy_r"];
            $nose = $_POST["nose"];
            $throat = $_POST["throat"];
            $neck = $_POST["neck"];
            $skin = $_POST["skin"];
            $excanal_l = $_POST["excanal_l"];
            $excanal_r = $_POST["excanal_r"];
            $eardrum_l = $_POST["eardrum_l"];
            $eardrum_r = $_POST["eardrum_r"];
            $discharged_l = $_POST["discharged_l"];
            $discharged_r = $_POST["discharged_r"];
            $sound = $_POST["sound"];
            $murmur = $_POST["murmur"];
            $airentry = $_POST["airentry"];
            $chestexp = $_POST["chestexp"];
            $breathsound = $_POST["breathsound"];
            $liver = $_POST["liver"];
            $spleen = $_POST["spleen"];
            $kidney = $_POST["kidney"];
            $mentalfunct = $_POST["mentalfunct"];
            $coordination = $_POST["coordination"];
            $gait = $_POST["gait"];
            $genitalia = $_POST["genitalia"];
            $rectal = $_POST["rectal"];
            $lpow_l = $_POST["lpow_l"];
            $lpow_r = $_POST["lpow_r"];
            $lref_l = $_POST["lref_l"];
            $lref_r = $_POST["lref_r"];
            $lsen_l = $_POST["lsen_l"];
            $lsen_r = $_POST["lsen_r"];
            $upow_l = $_POST["upow_l"];
            $upow_r = $_POST["upow_r"];
            $uref_l = $_POST["uref_l"];
            $uref_r = $_POST["uref_r"];
            $usen_l = $_POST["usen_l"];
            $usen_r = $_POST["usen_r"];
            if($sex == "Female"){
                $breast = $_POST["breast"];
                $lmp = $_POST["lmp"];
                $gynaecology = $_POST["gynaecology"];
                $lastps = $_POST["lastps"];
            }
            $cxr = $_POST["cxr"];
            $ecg = $_POST["ecg"];
            if ($package == "Custom"){
                $mammogram = $_POST["mammogram"];
                $us_breast = $_POST["us_breast"];
            }
            if ($package == "Comprehensive" || $package == "Premium" || $package == "Custom"){
                $us_abdopel = $_POST["us_abdopel"];
            }
            if ($package == "Premium" || $package == "Custom"){
                $stresstest = $_POST["stresstest"];
            }
            if ($package == "Custom"){
                $pta = $_POST["pta"];
                $lft = $_POST["lft"];
            }
            $urine = $_POST["urine"];
            $blood = $_POST["blood"];
            $impression = $_POST["impression"];
            $recommendation = $_POST["recommendation"];
            $doneBy = $_SESSION["name"];

            $heightm = $height/100;
            $temp = $weight/($heightm*$heightm);
            $bmi = number_format((float)$temp, 2, '.', '');
            ?>
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
                            <a class="nav-link" href="selectPatient.php">Search Patient</a>
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
            <h1>Patient Medical History</h1>
            <br>
            <div class="container">
            <h3>Physical Examination</h3>
            <dl class="row h5">
                <dt class="col-sm-3">Name: </dt>
                <dd class="col-sm-9"><?php echo $name;?></dd>
                <dt class="col-sm-3">MRN: </dt>
                <dd class="col-sm-9"><?php echo $mrn;?></dd>
                <dt class="col-sm-3">Done by: </dt>
                <dd class="col-sm-9"><?php echo $_SESSION["name"];?></dd>
            </dl>
            <div>
            <dl class="row">
                <dt class="col-sm-3">General Appearance: </dt>
                <dd class="col-sm-9"><?php echo $appearance;?></dd>
                <dt class="col-sm-3">Weight: </dt>
                <dd class="col-sm-9"><?php echo $weight;?></dd>
                <dt class="col-sm-3">Height: </dt>
                <dd class="col-sm-9"><?php echo $height;?></dd>
                <dt class="col-sm-3">BMI: </dt>
                <dd class="col-sm-9"><?php echo $bmi;?></dd>
                <dt class="col-sm-3">Blood Pressure: </dt>
                <dd class="col-sm-9"><?php echo $systolic;?>/<?php echo $diastolic;?></dd>
                <dt class="col-sm-3">Nose: </dt>
                <dd class="col-sm-9"><?php echo $nose;?></dd>
                <dt class="col-sm-3">Throat: </dt>
                <dd class="col-sm-9"><?php echo $throat;?></dd>
                <dt class="col-sm-3">Neck: </dt>
                <dd class="col-sm-9"><?php echo $neck;?></dd>
                <dt class="col-sm-3">Skin: </dt>
                <dd class="col-sm-9"><?php echo $skin;?></dd>
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
                        <td><?php echo $va_aidedl;?></td>
                        <td><?php echo $va_aidedr;?></td>
                    </tr>
                    <tr>
                        <th>Visual Acuity(Unaided)</th>
                        <td><?php echo $va_unaidedl;?></td>
                        <td><?php echo $va_unaidedr;?></td>
                    </tr>
                    <tr>
                        <th>Colour</th>
                        <td><?php echo $colour_l;?></td>
                        <td><?php echo $colour_r;?></td>
                    </tr>
                    <tr>
                        <th>Fundoscopy</th>
                        <td><?php echo $fundoscopy_l;?></td>
                        <td><?php echo $fundoscopy_r;?></td>
                    </tr>
                    </tbody>
                </table>
            <h3>Cardiovascular System</h3>
            <div>
            <dl class="row">
                <dt class="col-sm-3">Sound: </dt>
                <dd class="col-sm-9"><?php echo $sound;?></dd>
                <dt class="col-sm-3">Murmur: </dt>
                <dd class="col-sm-9"><?php echo $murmur;?></dd>
            </dl>
            </div>    
            <h3>Respiratory System</h3>
            <div>
            <dl class="row">
                <dt class="col-sm-3">Air Entry: </dt>
                <dd class="col-sm-9"><?php echo $airentry;?></dd>
                <dt class="col-sm-3">Chest Expansion: </dt>
                <dd class="col-sm-9"><?php echo $chestexp;?></dd>
                <dt class="col-sm-3">Breath Sound: </dt>
                <dd class="col-sm-9"><?php echo $breathsound;?></dd>
            </dl>
            </div>
            <h3>Gastrointestinal System</h3>
            <div>
            <dl class="row">
                <dt class="col-sm-3">Liver: </dt>
                <dd class="col-sm-9"><?php echo $liver;?></dd>
                <dt class="col-sm-3">Spleen: </dt>
                <dd class="col-sm-9"><?php echo $spleen;?></dd>
                <dt class="col-sm-3">Kidney: </dt>
                <dd class="col-sm-9"><?php echo $kidney;?></dd>
            </dl>
            </div>
            <h3>Central Nervous System</h3>
            <div>
            <dl class="row">
                <dt class="col-sm-3">Mental Function: </dt>
                <dd class="col-sm-9"><?php echo $mentalfunct;?></dd>
                <dt class="col-sm-3">Coordination: </dt>
                <dd class="col-sm-9"><?php echo $coordination;?></dd>
                <dt class="col-sm-3">Gait: </dt>
                <dd class="col-sm-9"><?php echo $gait;?></dd>
            </dl>
            </div>
            <h3>Genitourinary System</h3>
            <div>
            <dl class="row">
                <dt class="col-sm-3">Genitalia: </dt>
                <dd class="col-sm-9"><?php echo $genitalia;?></dd>
                <dt class="col-sm-3">Rectal Examination: </dt>
                <dd class="col-sm-9"><?php echo $rectal;?></dd>
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
                        <td><?php echo $lpow_l;?></td>
                        <td><?php echo $lpow_r;?></td>
                    </tr>
                    <tr>
                        <th>Reflex</th>
                        <td><?php echo $lref_l;?></td>
                        <td><?php echo $lref_r;?></td>
                    </tr>
                    <tr>
                        <th>Sensation</th>
                        <td><?php echo $lsen_l;?></td>
                        <td><?php echo $lsen_r;?></td>
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
                            <td><?php echo $upow_l;?></td>
                            <td><?php echo $upow_r;?></td>
                        </tr>
                        <tr>
                            <th>Reflex</th>
                            <td><?php echo $uref_l;?></td>
                            <td><?php echo $uref_r;?></td>
                        </tr>
                        <tr>
                            <th>Sensation</th>
                            <td><?php echo $usen_l;?></td>
                            <td><?php echo $usen_r;?></td>
                        </tr>
                    </tbody>
                </table>
                <?php
                    if($sex == "Female"){
                ?>
                <h3>For Female Patient</h3>
                <div>
                <dl class="row">
                    <dt class="col-sm-3">Breast: </dt>
                    <dd class="col-sm-9"><?php echo $breast;?></dd>
                    <dt class="col-sm-3">Last Menstrual Period: </dt>
                    <dd class="col-sm-9"><?php echo $lmp;?></dd>
                    <dt class="col-sm-3">Gynaecology History: </dt>
                    <dd class="col-sm-9"><?php echo $gynaecology;?></dd>
                    <dt class="col-sm-3">Last Pap Smear: </dt>
                    <dd class="col-sm-9"><?php echo $lastps;?></dd>
                </dl>
                </div>
                <?php
                    }
                ?>
                <h3>Investigation</h3>
                <div>
                <dl class="row">
                    <dt class="col-sm-3">Chest X-Ray: </dt>
                    <dd class="col-sm-9"><?php echo $cxr;?></dd>
                    <dt class="col-sm-3">Electrocardiogram: </dt>
                    <dd class="col-sm-9"><?php echo $ecg;?></dd>
                    <?php
                        if($package == "Custom"){
                    ?>
                    <dt class="col-sm-3">Mammogram: </dt>
                    <dd class="col-sm-9"><?php echo $mammogram;?></dd>
                    <dt class="col-sm-3">Ultrasound Breast: </dt>
                    <dd class="col-sm-9"><?php echo $us_breast;?></dd>
                    <?php
                        }
                        if($package == "Premium" || $package == "Comprehensive" || $package == "Custom"){
                    ?>
                    <dt class="col-sm-3">Ultrasound Abdomen Pelvis: </dt>
                    <dd class="col-sm-9"><?php echo $us_abdopel;?></dd>
                    <?php
                        }
                        if($package == "Custom" || $package == "Premium"){
                    ?>
                    <dt class="col-sm-3">Stress Test: </dt>
                    <dd class="col-sm-9"><?php echo $stresstest;?></dd>
                    <?php
                        }
                    ?>
                    <dt class="col-sm-3">Pure Tone Audiometry: </dt>
                    <dd class="col-sm-9"><?php echo $pta;?></dd>
                    <dt class="col-sm-3">Lung Function Test: </dt>
                    <dd class="col-sm-9"><?php echo $lft;?></dd>
                    <dt class="col-sm-3">Urine: </dt>
                    <dd class="col-sm-9"><?php echo $urine;?></dd>
                    <dt class="col-sm-3">Blood: </dt>
                    <dd class="col-sm-9"><?php echo $blood;?></dd>
                    <dt class="col-sm-3">Impression: </dt>
                    <dd class="col-sm-9"><?php echo $impression;?></dd>
                    <dt class="col-sm-3">Recommendation: </dt>
                    <dd class="col-sm-9"><?php echo $recommendation;?></dd>
                </dl>
                </div>
            
            <?php
                if($sex == "Female"){
                    if ($package == "Custom"){
                        $insert = "INSERT INTO record (mrn) VALUES ('".$mrn."') ON DUPLICATE KEY UPDATE appearance = '".$appearance."', weight = '".$weight."', height = '".$height."', bmi = '".$bmi."', systolic = '".$systolic."', diastolic = '".$diastolic."', 
                        pulse = '".$pulse."', va_aidedr = '".$va_aidedr."', va_aidedl = '".$va_aidedl."', va_unaidedr = '".$va_unaidedr."', va_unaidedl = '".$va_unaidedl."', colour_r = '".$colour_r."', colour_l = '".$colour_l."', 
                        fundoscopy_r = '".$fundoscopy_r."', fundoscopy_l = '".$fundoscopy_l."', nose = '".$nose."', throat = '".$throat."', neck = '".$neck."', skin = '".$skin."', excanal_r = '".$excanal_r."',
                        excanal_l = '".$excanal_l."', eardrum_r = '".$eardrum_r."', eardrum_l = '".$eardrum_l."', discharged_r = '".$discharged_r."', discharged_l = '".$discharged_l."', sound = '".$sound."', murmur = '".$murmur."',
                        airentry = '".$airentry."', chestexp = '".$chestexp."', breathsound = '".$breathsound."', liver = '".$liver."', spleen = '".$spleen."', kidney = '".$kidney."', mentalfunct = '".$mentalfunct."',
                        coordination = '".$coordination."', gait = '".$gait."', genitalia = '".$genitalia."', rectal = '".$rectal."', lpow_r = '".$lpow_r."', lpow_l = '".$lpow_l."', lref_r = '".$lref_r."', lref_l = '".$lref_l."',
                        lsen_r = '".$lsen_r."', lsen_l = '".$lsen_l."', upow_r = '".$upow_r."', upow_l = '".$upow_l."', uref_r = '".$uref_r."', uref_l = '".$uref_l."', usen_r = '".$usen_r."', usen_l = '".$usen_l."',
                        breast = '".$breast."', lmp = '".$lmp."', gynaecology = '".$gynaecology."', lastps = '".$lastps."', cxr = '".$cxr."', ecg = '".$ecg."', mammogram = '".$mammogram."', us_breast = '".$us_breast."', 
                        us_abdopel = '".$us_abdopel."', stresstest = '".$stresstest."', pta = '".$pta."', lft = '".$lft."', urine = '".$urine."', blood = '".$blood."', impression = '".$impression."', recommendation = '".$recommendation."', lastUpdate = '".$date."', status='1', doneBy='".$doneBy."'";
                    }
                    elseif ($package == "Premium"){
                        $insert = "INSERT INTO record (mrn) VALUES ('".$mrn."') ON DUPLICATE KEY UPDATE appearance = '".$appearance."', weight = '".$weight."', height = '".$height."', bmi = '".$bmi."', systolic = '".$systolic."', diastolic = '".$diastolic."', 
                        pulse = '".$pulse."', va_aidedr = '".$va_aidedr."', va_aidedl = '".$va_aidedl."', va_unaidedr = '".$va_unaidedr."', va_unaidedl = '".$va_unaidedl."', colour_r = '".$colour_r."', colour_l = '".$colour_l."', 
                        fundoscopy_r = '".$fundoscopy_r."', fundoscopy_l = '".$fundoscopy_l."', nose = '".$nose."', throat = '".$throat."', neck = '".$neck."', skin = '".$skin."', excanal_r = '".$excanal_r."',
                        excanal_l = '".$excanal_l."', eardrum_r = '".$eardrum_r."', eardrum_l = '".$eardrum_l."', discharged_r = '".$discharged_r."', discharged_l = '".$discharged_l."', sound = '".$sound."', murmur = '".$murmur."',
                        airentry = '".$airentry."', chestexp = '".$chestexp."', breathsound = '".$breathsound."', liver = '".$liver."', spleen = '".$spleen."', kidney = '".$kidney."', mentalfunct = '".$mentalfunct."',
                        coordination = '".$coordination."', gait = '".$gait."', genitalia = '".$genitalia."', rectal = '".$rectal."', lpow_r = '".$lpow_r."', lpow_l = '".$lpow_l."', lref_r = '".$lref_r."', lref_l = '".$lref_l."',
                        lsen_r = '".$lsen_r."', lsen_l = '".$lsen_l."', upow_r = '".$upow_r."', upow_l = '".$upow_l."', uref_r = '".$uref_r."', uref_l = '".$uref_l."', usen_r = '".$usen_r."', usen_l = '".$usen_l."',
                        breast = '".$breast."', lmp = '".$lmp."', gynaecology = '".$gynaecology."', lastps = '".$lastps."', cxr = '".$cxr."', ecg = '".$ecg."', mammogram = NULL, us_breast = NULL, 
                        us_abdopel = '".$us_abdopel."', stresstest = '".$stresstest."', pta = NULL, lft = NULL, urine = '".$urine."', blood = '".$blood."', impression = '".$impression."', recommendation = '".$recommendation."', lastUpdate = '".$date."', status='1', doneBy='".$doneBy."'";
                    }
                    elseif ($package == "Comprehensive"){
                        $insert = "INSERT INTO record (mrn) VALUES ('".$mrn."') ON DUPLICATE KEY UPDATE appearance = '".$appearance."', weight = '".$weight."', height = '".$height."', bmi = '".$bmi."', systolic = '".$systolic."', diastolic = '".$diastolic."', 
                        pulse = '".$pulse."', va_aidedr = '".$va_aidedr."', va_aidedl = '".$va_aidedl."', va_unaidedr = '".$va_unaidedr."', va_unaidedl = '".$va_unaidedl."', colour_r = '".$colour_r."', colour_l = '".$colour_l."', 
                        fundoscopy_r = '".$fundoscopy_r."', fundoscopy_l = '".$fundoscopy_l."', nose = '".$nose."', throat = '".$throat."', neck = '".$neck."', skin = '".$skin."', excanal_r = '".$excanal_r."',
                        excanal_l = '".$excanal_l."', eardrum_r = '".$eardrum_r."', eardrum_l = '".$eardrum_l."', discharged_r = '".$discharged_r."', discharged_l = '".$discharged_l."', sound = '".$sound."', murmur = '".$murmur."',
                        airentry = '".$airentry."', chestexp = '".$chestexp."', breathsound = '".$breathsound."', liver = '".$liver."', spleen = '".$spleen."', kidney = '".$kidney."', mentalfunct = '".$mentalfunct."',
                        coordination = '".$coordination."', gait = '".$gait."', genitalia = '".$genitalia."', rectal = '".$rectal."', lpow_r = '".$lpow_r."', lpow_l = '".$lpow_l."', lref_r = '".$lref_r."', lref_l = '".$lref_l."',
                        lsen_r = '".$lsen_r."', lsen_l = '".$lsen_l."', upow_r = '".$upow_r."', upow_l = '".$upow_l."', uref_r = '".$uref_r."', uref_l = '".$uref_l."', usen_r = '".$usen_r."', usen_l = '".$usen_l."',
                        breast = '".$breast."', lmp = '".$lmp."', gynaecology = '".$gynaecology."', lastps = '".$lastps."', cxr = '".$cxr."', ecg = '".$ecg."', mammogram = NULL, us_breast = NULL, 
                        us_abdopel = '".$us_abdopel."', stresstest = NULL, pta = NULL, lft = NULL, urine = '".$urine."', blood = '".$blood."', impression = '".$impression."', recommendation = '".$recommendation."', lastUpdate = '".$date."', status='1', doneBy='".$doneBy."'";
                    }
                    else{
                        $insert = "INSERT INTO record (mrn) VALUES ('".$mrn."') ON DUPLICATE KEY UPDATE appearance = '".$appearance."', weight = '".$weight."', height = '".$height."', bmi = '".$bmi."', systolic = '".$systolic."', diastolic = '".$diastolic."', 
                        pulse = '".$pulse."', va_aidedr = '".$va_aidedr."', va_aidedl = '".$va_aidedl."', va_unaidedr = '".$va_unaidedr."', va_unaidedl = '".$va_unaidedl."', colour_r = '".$colour_r."', colour_l = '".$colour_l."', 
                        fundoscopy_r = '".$fundoscopy_r."', fundoscopy_l = '".$fundoscopy_l."', nose = '".$nose."', throat = '".$throat."', neck = '".$neck."', skin = '".$skin."', excanal_r = '".$excanal_r."',
                        excanal_l = '".$excanal_l."', eardrum_r = '".$eardrum_r."', eardrum_l = '".$eardrum_l."', discharged_r = '".$discharged_r."', discharged_l = '".$discharged_l."', sound = '".$sound."', murmur = '".$murmur."',
                        airentry = '".$airentry."', chestexp = '".$chestexp."', breathsound = '".$breathsound."', liver = '".$liver."', spleen = '".$spleen."', kidney = '".$kidney."', mentalfunct = '".$mentalfunct."',
                        coordination = '".$coordination."', gait = '".$gait."', genitalia = '".$genitalia."', rectal = '".$rectal."', lpow_r = '".$lpow_r."', lpow_l = '".$lpow_l."', lref_r = '".$lref_r."', lref_l = '".$lref_l."',
                        lsen_r = '".$lsen_r."', lsen_l = '".$lsen_l."', upow_r = '".$upow_r."', upow_l = '".$upow_l."', uref_r = '".$uref_r."', uref_l = '".$uref_l."', usen_r = '".$usen_r."', usen_l = '".$usen_l."',
                        breast = '".$breast."', lmp = '".$lmp."', gynaecology = '".$gynaecology."', lastps = '".$lastps."', cxr = '".$cxr."', ecg = '".$ecg."', mammogram = NULL, us_breast = NULL, 
                        us_abdopel = NULL, stresstest = NULL, pta = NULL, lft = NULL, urine = '".$urine."', blood = '".$blood."', impression = '".$impression."', recommendation = '".$recommendation."', lastUpdate = '".$date."', status='1', doneBy='".$doneBy."'";
                    }
                }
                else{
                    if ($package == "Custom"){
                        $insert = "INSERT INTO record (mrn) VALUES ('".$mrn."') ON DUPLICATE KEY UPDATE appearance = '".$appearance."', weight = '".$weight."', height = '".$height."', bmi = '".$bmi."', systolic = '".$systolic."', diastolic = '".$diastolic."', 
                        pulse = '".$pulse."', va_aidedr = '".$va_aidedr."', va_aidedl = '".$va_aidedl."', va_unaidedr = '".$va_unaidedr."', va_unaidedl = '".$va_unaidedl."', colour_r = '".$colour_r."', colour_l = '".$colour_l."', 
                        fundoscopy_r = '".$fundoscopy_r."', fundoscopy_l = '".$fundoscopy_l."', nose = '".$nose."', throat = '".$throat."', neck = '".$neck."', skin = '".$skin."', excanal_r = '".$excanal_r."',
                        excanal_l = '".$excanal_l."', eardrum_r = '".$eardrum_r."', eardrum_l = '".$eardrum_l."', discharged_r = '".$discharged_r."', discharged_l = '".$discharged_l."', sound = '".$sound."', murmur = '".$murmur."',
                        airentry = '".$airentry."', chestexp = '".$chestexp."', breathsound = '".$breathsound."', liver = '".$liver."', spleen = '".$spleen."', kidney = '".$kidney."', mentalfunct = '".$mentalfunct."',
                        coordination = '".$coordination."', gait = '".$gait."', genitalia = '".$genitalia."', rectal = '".$rectal."', lpow_r = '".$lpow_r."', lpow_l = '".$lpow_l."', lref_r = '".$lref_r."', lref_l = '".$lref_l."',
                        lsen_r = '".$lsen_r."', lsen_l = '".$lsen_l."', upow_r = '".$upow_r."', upow_l = '".$upow_l."', uref_r = '".$uref_r."', uref_l = '".$uref_l."', usen_r = '".$usen_r."', usen_l = '".$usen_l."',
                        breast = NULL, lmp = NULL, gynaecology = NULL, lastps = NULL, cxr = '".$cxr."', ecg = '".$ecg."', mammogram = NULL, us_breast = NULL, 
                        us_abdopel = '".$us_abdopel."', stresstest = '".$stresstest."', pta = '".$pta."', lft = '".$lft."', urine = '".$urine."', blood = '".$blood."', impression = '".$impression."', recommendation = '".$recommendation."', lastUpdate = '".$date."', status='1', doneBy='".$doneBy."'";
                    }
                    elseif ($package == "Premium"){
                        $insert = "INSERT INTO record (mrn) VALUES ('".$mrn."') ON DUPLICATE KEY UPDATE appearance = '".$appearance."', weight = '".$weight."', height = '".$height."', bmi = '".$bmi."', systolic = '".$systolic."', diastolic = '".$diastolic."', 
                        pulse = '".$pulse."', va_aidedr = '".$va_aidedr."', va_aidedl = '".$va_aidedl."', va_unaidedr = '".$va_unaidedr."', va_unaidedl = '".$va_unaidedl."', colour_r = '".$colour_r."', colour_l = '".$colour_l."', 
                        fundoscopy_r = '".$fundoscopy_r."', fundoscopy_l = '".$fundoscopy_l."', nose = '".$nose."', throat = '".$throat."', neck = '".$neck."', skin = '".$skin."', excanal_r = '".$excanal_r."',
                        excanal_l = '".$excanal_l."', eardrum_r = '".$eardrum_r."', eardrum_l = '".$eardrum_l."', discharged_r = '".$discharged_r."', discharged_l = '".$discharged_l."', sound = '".$sound."', murmur = '".$murmur."',
                        airentry = '".$airentry."', chestexp = '".$chestexp."', breathsound = '".$breathsound."', liver = '".$liver."', spleen = '".$spleen."', kidney = '".$kidney."', mentalfunct = '".$mentalfunct."',
                        coordination = '".$coordination."', gait = '".$gait."', genitalia = '".$genitalia."', rectal = '".$rectal."', lpow_r = '".$lpow_r."', lpow_l = '".$lpow_l."', lref_r = '".$lref_r."', lref_l = '".$lref_l."',
                        lsen_r = '".$lsen_r."', lsen_l = '".$lsen_l."', upow_r = '".$upow_r."', upow_l = '".$upow_l."', uref_r = '".$uref_r."', uref_l = '".$uref_l."', usen_r = '".$usen_r."', usen_l = '".$usen_l."',
                        breast = NULL, lmp = NULL, gynaecology = NULL, lastps = NULL, cxr = '".$cxr."', ecg = '".$ecg."', mammogram = NULL, us_breast = NULL, 
                        us_abdopel = '".$us_abdopel."', stresstest = '".$stresstest."', pta = NULL, lft = NULL, urine = '".$urine."', blood = '".$blood."', impression = '".$impression."', recommendation = '".$recommendation."', lastUpdate = '".$date."', status='1', doneBy='".$doneBy."'";
                    }
                    elseif ($package == "Comprehensive"){
                        $insert = "INSERT INTO record (mrn) VALUES ('".$mrn."') ON DUPLICATE KEY UPDATE appearance = '".$appearance."', weight = '".$weight."', height = '".$height."', bmi = '".$bmi."', systolic = '".$systolic."', diastolic = '".$diastolic."', 
                        pulse = '".$pulse."', va_aidedr = '".$va_aidedr."', va_aidedl = '".$va_aidedl."', va_unaidedr = '".$va_unaidedr."', va_unaidedl = '".$va_unaidedl."', colour_r = '".$colour_r."', colour_l = '".$colour_l."', 
                        fundoscopy_r = '".$fundoscopy_r."', fundoscopy_l = '".$fundoscopy_l."', nose = '".$nose."', throat = '".$throat."', neck = '".$neck."', skin = '".$skin."', excanal_r = '".$excanal_r."',
                        excanal_l = '".$excanal_l."', eardrum_r = '".$eardrum_r."', eardrum_l = '".$eardrum_l."', discharged_r = '".$discharged_r."', discharged_l = '".$discharged_l."', sound = '".$sound."', murmur = '".$murmur."',
                        airentry = '".$airentry."', chestexp = '".$chestexp."', breathsound = '".$breathsound."', liver = '".$liver."', spleen = '".$spleen."', kidney = '".$kidney."', mentalfunct = '".$mentalfunct."',
                        coordination = '".$coordination."', gait = '".$gait."', genitalia = '".$genitalia."', rectal = '".$rectal."', lpow_r = '".$lpow_r."', lpow_l = '".$lpow_l."', lref_r = '".$lref_r."', lref_l = '".$lref_l."',
                        lsen_r = '".$lsen_r."', lsen_l = '".$lsen_l."', upow_r = '".$upow_r."', upow_l = '".$upow_l."', uref_r = '".$uref_r."', uref_l = '".$uref_l."', usen_r = '".$usen_r."', usen_l = '".$usen_l."',
                        breast = NULL, lmp = NULL, gynaecology = NULL, lastps = NULL, cxr = '".$cxr."', ecg = '".$ecg."', mammogram = NULL, us_breast = NULL, 
                        us_abdopel = '".$us_abdopel."', stresstest = NULL, pta = NULL, lft = NULL, urine = '".$urine."', blood = '".$blood."', impression = '".$impression."', recommendation = '".$recommendation."', lastUpdate = '".$date."', status='1', doneBy='".$doneBy."'";
                    }
                    else{
                        $insert = "INSERT INTO record (mrn) VALUES ('".$mrn."') ON DUPLICATE KEY UPDATE appearance = '".$appearance."', weight = '".$weight."', height = '".$height."', bmi = '".$bmi."', systolic = '".$systolic."', diastolic = '".$diastolic."', 
                        pulse = '".$pulse."', va_aidedr = '".$va_aidedr."', va_aidedl = '".$va_aidedl."', va_unaidedr = '".$va_unaidedr."', va_unaidedl = '".$va_unaidedl."', colour_r = '".$colour_r."', colour_l = '".$colour_l."', 
                        fundoscopy_r = '".$fundoscopy_r."', fundoscopy_l = '".$fundoscopy_l."', nose = '".$nose."', throat = '".$throat."', neck = '".$neck."', skin = '".$skin."', excanal_r = '".$excanal_r."',
                        excanal_l = '".$excanal_l."', eardrum_r = '".$eardrum_r."', eardrum_l = '".$eardrum_l."', discharged_r = '".$discharged_r."', discharged_l = '".$discharged_l."', sound = '".$sound."', murmur = '".$murmur."',
                        airentry = '".$airentry."', chestexp = '".$chestexp."', breathsound = '".$breathsound."', liver = '".$liver."', spleen = '".$spleen."', kidney = '".$kidney."', mentalfunct = '".$mentalfunct."',
                        coordination = '".$coordination."', gait = '".$gait."', genitalia = '".$genitalia."', rectal = '".$rectal."', lpow_r = '".$lpow_r."', lpow_l = '".$lpow_l."', lref_r = '".$lref_r."', lref_l = '".$lref_l."',
                        lsen_r = '".$lsen_r."', lsen_l = '".$lsen_l."', upow_r = '".$upow_r."', upow_l = '".$upow_l."', uref_r = '".$uref_r."', uref_l = '".$uref_l."', usen_r = '".$usen_r."', usen_l = '".$usen_l."',
                        breast = NULL, lmp = NULL, gynaecology = NULL, lastps = NULL, cxr = '".$cxr."', ecg = '".$ecg."', mammogram = NULL, us_breast = NULL, 
                        us_abdopel = NULL, stresstest = NULL, pta = NULL, lft = NULL, urine = '".$urine."', blood = '".$blood."', impression = '".$impression."', recommendation = '".$recommendation."', lastUpdate = '".$date."', status='1', doneBy='".$doneBy."'";
                    }
                }
                if ($conn->query($insert) === TRUE)
                {
                    echo "<p class='success'>Successfully Inserted medical report";
                }
                else
                {
                    echo "Error: " . $insert . "<br>" . $conn->error;
                }
                $conn->close();
                }
                else
                {
                    echo "No session exist or session has expired. Please log in again.<br>";
                    echo "<a href=log-in.html> Login </a>";
                }
            ?>
            <br><br><button class="btn btn-primary" onclick="window.location.href='homepage.php'">Back to Home Page</button>
            </div>
    </body>
</html>