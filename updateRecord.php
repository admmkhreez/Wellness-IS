<!DOCTYPE htmL>
<html>
    <?php
        session_start();
        if(isset($_SESSION["type"])) {
    ?>
    <head>
        <title>Welness Information System</title>
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
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </nav>
        
        <h1>Patient Medical History</h1>
        <div class="container">
            <h3>Physical Examination</h3>
            <div class="reference">
                <p>MRN: <?php echo $mrn;?></p>
                <p>General Appearance: <?php echo $appearance;?></p>
                <p>Weight: <?php echo $weight;?></p>
                <p>Height: <?php echo $height;?></p>
                <p>BMI: <?php echo $bmi;?></p>
                <p>Blood Pressure: <?php echo $systolic;?>/<?php echo $diastolic;?></p>
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
            <div class="reference">
                <p>Sound: <?php echo $sound;?></p>
                <p>Murmur: <?php echo $murmur;?></p>
            </div>    
            <h3>Respiratory System</h3>
            <div class="reference">
                <p>Air Entry: <?php echo $airentry;?></p>
                <p>Chest Expansion: <?php echo $chestexp;?></p>
                <p>Breath Sound: <?php echo $breathsound;?></p>
            </div>
            <h3>Gastrointestinal System</h3>
            <div class="reference">
                <p>Liver: <?php echo $liver;?></p>
                <p>Spleen: <?php echo $spleen;?></p>
                <p>Kidney: <?php echo $kidney;?></p>
            </div>
            <h3>Central Nervous System</h3>
            <div class="reference">
                <p>Mental Function: <?php echo $mentalfunct;?></p>
                <p>Coordination: <?php echo $coordination;?></p>
                <p>Gait: <?php echo $gait;?></p>
            </div>
            <h3>Genitourinary System</h3>
            <div class="reference">
                <p>Genitalia: <?php echo $genitalia;?></p>
                <p>Rectal Examination: <?php echo $rectal;?></p>
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
                    <div class="reference">
                        <p>Breast: <?php echo $breast;?></p>
                        <p>Last Menstrual Period: <?php echo $lmp;?></p>
                        <p>Gynaecology History: <?php echo $gynaecology;?></p>
                        <p>Last Pap Smear: <?php echo $lastps;?></p>
                    </div>
                    <?php
                        }
                    ?>
                    <h3>Investigation</h3>
                    <div class="reference">
                        <p>Chest X-Ray: <?php echo $cxr;?></p>
                        <p>Electrocardiogram: <?php echo $ecg;?></p>
                    <?php
                        if ($package == "Custom"){
                    ?>
                        <p>Mammogram: <?php echo $mammogram;?></p>
                        <p>Ultrasound Breast: <?php echo $us_breast;?></p>
                    <?php
                        }
                        if($package == "Premium" || $package == "Comprehensive" || $package == "Custom"){
                    ?>
                        <p>Ultrasound Abdomen Pelvis: <?php echo $us_abdopel;?></p>
                    <?php
                        }
                        if($package == "Premium" || $package == "Custom"){
                    ?>
                        <p>Stress Test: <?php echo $stresstest;?></p>
                    <?php
                        }
                        if ($package == "Custom"){
                    ?>
                    <p>Pure Tone Audiometry: <?php echo $pta;?></p>
                    <p>Lung Function Test: <?php echo $lft;?></p>
                    <?php
                        }
                    ?>
                    <p>Urine: <?php echo $urine;?></p>
                    <p>Blood: <?php echo $blood;?></p>
                </div>
                <p>Impression: <?php echo $impression;?></p>
                <p>Recommendation: <?php echo $recommendation;?></p>
        
        <?php
        if($sex == "Female"){
            if($sex == "Female"){
                if ($package == "Custom"){
                    $insert = "UPDATE record SET appearance = '".$appearance."', weight = '".$weight."', height = '".$height."', bmi = '".$bmi."', systolic = '".$systolic."', diastolic = '".$diastolic."', 
                    pulse = '".$pulse."', va_aidedr = '".$va_aidedr."', va_aidedl = '".$va_aidedl."', va_unaidedr = '".$va_unaidedr."', va_unaidedl = '".$va_unaidedl."', colour_r = '".$colour_r."', colour_l = '".$colour_l."', 
                    fundoscopy_r = '".$fundoscopy_r."', fundoscopy_l = '".$fundoscopy_l."', nose = '".$nose."', throat = '".$throat."', neck = '".$neck."', skin = '".$skin."', excanal_r = '".$excanal_r."',
                    excanal_l = '".$excanal_l."', eardrum_r = '".$eardrum_r."', eardrum_l = '".$eardrum_l."', discharged_r = '".$discharged_r."', discharged_l = '".$discharged_l."', sound = '".$sound."', murmur = '".$murmur."',
                    airentry = '".$airentry."', chestexp = '".$chestexp."', breathsound = '".$breathsound."', liver = '".$liver."', spleen = '".$spleen."', kidney = '".$kidney."', mentalfunct = '".$mentalfunct."',
                    coordination = '".$coordination."', gait = '".$gait."', genitalia = '".$genitalia."', rectal = '".$rectal."', lpow_r = '".$lpow_r."', lpow_l = '".$lpow_l."', lref_r = '".$lref_r."', lref_l = '".$lref_l."',
                    lsen_r = '".$lsen_r."', lsen_l = '".$lsen_l."', upow_r = '".$upow_r."', upow_l = '".$upow_l."', uref_r = '".$uref_r."', uref_l = '".$uref_l."', usen_r = '".$usen_r."', usen_l = '".$usen_l."',
                    breast = '".$breast."', lmp = '".$lmp."', gynaecology = '".$gynaecology."', lastps = '".$lastps."', cxr = '".$cxr."', ecg = '".$ecg."', mammogram = '".$mammogram."', us_breast = '".$us_breast."', 
                    us_abdopel = '".$us_abdopel."', stresstest = '".$stresstest."', pta = '".$pta."', lft = '".$lft."', urine = '".$urine."', blood = '".$blood."', impression = '".$impression."', recommendation = '".$recommendation."', lastUpdate = '".$date."', status='1'";
                }
                elseif ($package == "Premium"){
                    $insert = "UPDATE record SET appearance = '".$appearance."', weight = '".$weight."', height = '".$height."', bmi = '".$bmi."', systolic = '".$systolic."', diastolic = '".$diastolic."', 
                    pulse = '".$pulse."', va_aidedr = '".$va_aidedr."', va_aidedl = '".$va_aidedl."', va_unaidedr = '".$va_unaidedr."', va_unaidedl = '".$va_unaidedl."', colour_r = '".$colour_r."', colour_l = '".$colour_l."', 
                    fundoscopy_r = '".$fundoscopy_r."', fundoscopy_l = '".$fundoscopy_l."', nose = '".$nose."', throat = '".$throat."', neck = '".$neck."', skin = '".$skin."', excanal_r = '".$excanal_r."',
                    excanal_l = '".$excanal_l."', eardrum_r = '".$eardrum_r."', eardrum_l = '".$eardrum_l."', discharged_r = '".$discharged_r."', discharged_l = '".$discharged_l."', sound = '".$sound."', murmur = '".$murmur."',
                    airentry = '".$airentry."', chestexp = '".$chestexp."', breathsound = '".$breathsound."', liver = '".$liver."', spleen = '".$spleen."', kidney = '".$kidney."', mentalfunct = '".$mentalfunct."',
                    coordination = '".$coordination."', gait = '".$gait."', genitalia = '".$genitalia."', rectal = '".$rectal."', lpow_r = '".$lpow_r."', lpow_l = '".$lpow_l."', lref_r = '".$lref_r."', lref_l = '".$lref_l."',
                    lsen_r = '".$lsen_r."', lsen_l = '".$lsen_l."', upow_r = '".$upow_r."', upow_l = '".$upow_l."', uref_r = '".$uref_r."', uref_l = '".$uref_l."', usen_r = '".$usen_r."', usen_l = '".$usen_l."',
                    breast = '".$breast."', lmp = '".$lmp."', gynaecology = '".$gynaecology."', lastps = '".$lastps."', cxr = '".$cxr."', ecg = '".$ecg."', mammogram = NULL, us_breast = NULL, 
                    us_abdopel = '".$us_abdopel."', stresstest = '".$stresstest."', pta = NULL, lft = NULL, urine = '".$urine."', blood = '".$blood."', impression = '".$impression."', recommendation = '".$recommendation."', lastUpdate = '".$date."', status='1'";
                }
                elseif ($package == "Comprehensive"){
                    $insert = "UPDATE record SET appearance = '".$appearance."', weight = '".$weight."', height = '".$height."', bmi = '".$bmi."', systolic = '".$systolic."', diastolic = '".$diastolic."', 
                    pulse = '".$pulse."', va_aidedr = '".$va_aidedr."', va_aidedl = '".$va_aidedl."', va_unaidedr = '".$va_unaidedr."', va_unaidedl = '".$va_unaidedl."', colour_r = '".$colour_r."', colour_l = '".$colour_l."', 
                    fundoscopy_r = '".$fundoscopy_r."', fundoscopy_l = '".$fundoscopy_l."', nose = '".$nose."', throat = '".$throat."', neck = '".$neck."', skin = '".$skin."', excanal_r = '".$excanal_r."',
                    excanal_l = '".$excanal_l."', eardrum_r = '".$eardrum_r."', eardrum_l = '".$eardrum_l."', discharged_r = '".$discharged_r."', discharged_l = '".$discharged_l."', sound = '".$sound."', murmur = '".$murmur."',
                    airentry = '".$airentry."', chestexp = '".$chestexp."', breathsound = '".$breathsound."', liver = '".$liver."', spleen = '".$spleen."', kidney = '".$kidney."', mentalfunct = '".$mentalfunct."',
                    coordination = '".$coordination."', gait = '".$gait."', genitalia = '".$genitalia."', rectal = '".$rectal."', lpow_r = '".$lpow_r."', lpow_l = '".$lpow_l."', lref_r = '".$lref_r."', lref_l = '".$lref_l."',
                    lsen_r = '".$lsen_r."', lsen_l = '".$lsen_l."', upow_r = '".$upow_r."', upow_l = '".$upow_l."', uref_r = '".$uref_r."', uref_l = '".$uref_l."', usen_r = '".$usen_r."', usen_l = '".$usen_l."',
                    breast = '".$breast."', lmp = '".$lmp."', gynaecology = '".$gynaecology."', lastps = '".$lastps."', cxr = '".$cxr."', ecg = '".$ecg."', mammogram = NULL, us_breast = NULL, 
                    us_abdopel = '".$us_abdopel."', stresstest = NULL, pta = NULL, lft = NULL, urine = '".$urine."', blood = '".$blood."', impression = '".$impression."', recommendation = '".$recommendation."', lastUpdate = '".$date."', status='1'";
                }
                else{
                    $insert = "UPDATE record SET appearance = '".$appearance."', weight = '".$weight."', height = '".$height."', bmi = '".$bmi."', systolic = '".$systolic."', diastolic = '".$diastolic."', 
                    pulse = '".$pulse."', va_aidedr = '".$va_aidedr."', va_aidedl = '".$va_aidedl."', va_unaidedr = '".$va_unaidedr."', va_unaidedl = '".$va_unaidedl."', colour_r = '".$colour_r."', colour_l = '".$colour_l."', 
                    fundoscopy_r = '".$fundoscopy_r."', fundoscopy_l = '".$fundoscopy_l."', nose = '".$nose."', throat = '".$throat."', neck = '".$neck."', skin = '".$skin."', excanal_r = '".$excanal_r."',
                    excanal_l = '".$excanal_l."', eardrum_r = '".$eardrum_r."', eardrum_l = '".$eardrum_l."', discharged_r = '".$discharged_r."', discharged_l = '".$discharged_l."', sound = '".$sound."', murmur = '".$murmur."',
                    airentry = '".$airentry."', chestexp = '".$chestexp."', breathsound = '".$breathsound."', liver = '".$liver."', spleen = '".$spleen."', kidney = '".$kidney."', mentalfunct = '".$mentalfunct."',
                    coordination = '".$coordination."', gait = '".$gait."', genitalia = '".$genitalia."', rectal = '".$rectal."', lpow_r = '".$lpow_r."', lpow_l = '".$lpow_l."', lref_r = '".$lref_r."', lref_l = '".$lref_l."',
                    lsen_r = '".$lsen_r."', lsen_l = '".$lsen_l."', upow_r = '".$upow_r."', upow_l = '".$upow_l."', uref_r = '".$uref_r."', uref_l = '".$uref_l."', usen_r = '".$usen_r."', usen_l = '".$usen_l."',
                    breast = '".$breast."', lmp = '".$lmp."', gynaecology = '".$gynaecology."', lastps = '".$lastps."', cxr = '".$cxr."', ecg = '".$ecg."', mammogram = NULL, us_breast = NULL, 
                    us_abdopel = NULL, stresstest = NULL, pta = NULL, lft = NULL, urine = '".$urine."', blood = '".$blood."', impression = '".$impression."', recommendation = '".$recommendation."', lastUpdate = '".$date."', status='1'";
                }
            }
            else{
                if ($package == "Custom"){
                    $insert = "UPDATE record SET appearance = '".$appearance."', weight = '".$weight."', height = '".$height."', bmi = '".$bmi."', systolic = '".$systolic."', diastolic = '".$diastolic."', 
                    pulse = '".$pulse."', va_aidedr = '".$va_aidedr."', va_aidedl = '".$va_aidedl."', va_unaidedr = '".$va_unaidedr."', va_unaidedl = '".$va_unaidedl."', colour_r = '".$colour_r."', colour_l = '".$colour_l."', 
                    fundoscopy_r = '".$fundoscopy_r."', fundoscopy_l = '".$fundoscopy_l."', nose = '".$nose."', throat = '".$throat."', neck = '".$neck."', skin = '".$skin."', excanal_r = '".$excanal_r."',
                    excanal_l = '".$excanal_l."', eardrum_r = '".$eardrum_r."', eardrum_l = '".$eardrum_l."', discharged_r = '".$discharged_r."', discharged_l = '".$discharged_l."', sound = '".$sound."', murmur = '".$murmur."',
                    airentry = '".$airentry."', chestexp = '".$chestexp."', breathsound = '".$breathsound."', liver = '".$liver."', spleen = '".$spleen."', kidney = '".$kidney."', mentalfunct = '".$mentalfunct."',
                    coordination = '".$coordination."', gait = '".$gait."', genitalia = '".$genitalia."', rectal = '".$rectal."', lpow_r = '".$lpow_r."', lpow_l = '".$lpow_l."', lref_r = '".$lref_r."', lref_l = '".$lref_l."',
                    lsen_r = '".$lsen_r."', lsen_l = '".$lsen_l."', upow_r = '".$upow_r."', upow_l = '".$upow_l."', uref_r = '".$uref_r."', uref_l = '".$uref_l."', usen_r = '".$usen_r."', usen_l = '".$usen_l."',
                    breast = NULL, lmp = NULL, gynaecology = NULL, lastps = NULL, cxr = '".$cxr."', ecg = '".$ecg."', mammogram = NULL, us_breast = NULL, 
                    us_abdopel = '".$us_abdopel."', stresstest = '".$stresstest."', pta = NULL, lft = NULL, urine = '".$urine."', blood = '".$blood."', impression = '".$impression."', recommendation = '".$recommendation."', lastUpdate = '".$date."', status='1'";
                }
                elseif ($package == "Premium"){
                    $insert = "UPDATE record SET appearance = '".$appearance."', weight = '".$weight."', height = '".$height."', bmi = '".$bmi."', systolic = '".$systolic."', diastolic = '".$diastolic."', 
                    pulse = '".$pulse."', va_aidedr = '".$va_aidedr."', va_aidedl = '".$va_aidedl."', va_unaidedr = '".$va_unaidedr."', va_unaidedl = '".$va_unaidedl."', colour_r = '".$colour_r."', colour_l = '".$colour_l."', 
                    fundoscopy_r = '".$fundoscopy_r."', fundoscopy_l = '".$fundoscopy_l."', nose = '".$nose."', throat = '".$throat."', neck = '".$neck."', skin = '".$skin."', excanal_r = '".$excanal_r."',
                    excanal_l = '".$excanal_l."', eardrum_r = '".$eardrum_r."', eardrum_l = '".$eardrum_l."', discharged_r = '".$discharged_r."', discharged_l = '".$discharged_l."', sound = '".$sound."', murmur = '".$murmur."',
                    airentry = '".$airentry."', chestexp = '".$chestexp."', breathsound = '".$breathsound."', liver = '".$liver."', spleen = '".$spleen."', kidney = '".$kidney."', mentalfunct = '".$mentalfunct."',
                    coordination = '".$coordination."', gait = '".$gait."', genitalia = '".$genitalia."', rectal = '".$rectal."', lpow_r = '".$lpow_r."', lpow_l = '".$lpow_l."', lref_r = '".$lref_r."', lref_l = '".$lref_l."',
                    lsen_r = '".$lsen_r."', lsen_l = '".$lsen_l."', upow_r = '".$upow_r."', upow_l = '".$upow_l."', uref_r = '".$uref_r."', uref_l = '".$uref_l."', usen_r = '".$usen_r."', usen_l = '".$usen_l."',
                    breast = NULL, lmp = NULL, gynaecology = NULL, lastps = NULL, cxr = '".$cxr."', ecg = '".$ecg."', mammogram = NULL, us_breast = NULL, 
                    us_abdopel = '".$us_abdopel."', stresstest = '".$stresstest."', pta = NULL, lft = NULL, urine = '".$urine."', blood = '".$blood."', impression = '".$impression."', recommendation = '".$recommendation."', lastUpdate = '".$date."', status='1'";
                }
                elseif ($package == "Comprehensive"){
                    $insert = "UPDATE record SET appearance = '".$appearance."', weight = '".$weight."', height = '".$height."', bmi = '".$bmi."', systolic = '".$systolic."', diastolic = '".$diastolic."', 
                    pulse = '".$pulse."', va_aidedr = '".$va_aidedr."', va_aidedl = '".$va_aidedl."', va_unaidedr = '".$va_unaidedr."', va_unaidedl = '".$va_unaidedl."', colour_r = '".$colour_r."', colour_l = '".$colour_l."', 
                    fundoscopy_r = '".$fundoscopy_r."', fundoscopy_l = '".$fundoscopy_l."', nose = '".$nose."', throat = '".$throat."', neck = '".$neck."', skin = '".$skin."', excanal_r = '".$excanal_r."',
                    excanal_l = '".$excanal_l."', eardrum_r = '".$eardrum_r."', eardrum_l = '".$eardrum_l."', discharged_r = '".$discharged_r."', discharged_l = '".$discharged_l."', sound = '".$sound."', murmur = '".$murmur."',
                    airentry = '".$airentry."', chestexp = '".$chestexp."', breathsound = '".$breathsound."', liver = '".$liver."', spleen = '".$spleen."', kidney = '".$kidney."', mentalfunct = '".$mentalfunct."',
                    coordination = '".$coordination."', gait = '".$gait."', genitalia = '".$genitalia."', rectal = '".$rectal."', lpow_r = '".$lpow_r."', lpow_l = '".$lpow_l."', lref_r = '".$lref_r."', lref_l = '".$lref_l."',
                    lsen_r = '".$lsen_r."', lsen_l = '".$lsen_l."', upow_r = '".$upow_r."', upow_l = '".$upow_l."', uref_r = '".$uref_r."', uref_l = '".$uref_l."', usen_r = '".$usen_r."', usen_l = '".$usen_l."',
                    breast = NULL, lmp = NULL, gynaecology = NULL, lastps = NULL, cxr = '".$cxr."', ecg = '".$ecg."', mammogram = NULL, us_breast = NULL, 
                    us_abdopel = '".$us_abdopel."', stresstest = NULL, pta = NULL, lft = NULL, urine = '".$urine."', blood = '".$blood."', impression = '".$impression."', recommendation = '".$recommendation."', lastUpdate = '".$date."', status='1'";
                }
                else{
                    $insert = "UPDATE record SET appearance = '".$appearance."', weight = '".$weight."', height = '".$height."', bmi = '".$bmi."', systolic = '".$systolic."', diastolic = '".$diastolic."', 
                    pulse = '".$pulse."', va_aidedr = '".$va_aidedr."', va_aidedl = '".$va_aidedl."', va_unaidedr = '".$va_unaidedr."', va_unaidedl = '".$va_unaidedl."', colour_r = '".$colour_r."', colour_l = '".$colour_l."', 
                    fundoscopy_r = '".$fundoscopy_r."', fundoscopy_l = '".$fundoscopy_l."', nose = '".$nose."', throat = '".$throat."', neck = '".$neck."', skin = '".$skin."', excanal_r = '".$excanal_r."',
                    excanal_l = '".$excanal_l."', eardrum_r = '".$eardrum_r."', eardrum_l = '".$eardrum_l."', discharged_r = '".$discharged_r."', discharged_l = '".$discharged_l."', sound = '".$sound."', murmur = '".$murmur."',
                    airentry = '".$airentry."', chestexp = '".$chestexp."', breathsound = '".$breathsound."', liver = '".$liver."', spleen = '".$spleen."', kidney = '".$kidney."', mentalfunct = '".$mentalfunct."',
                    coordination = '".$coordination."', gait = '".$gait."', genitalia = '".$genitalia."', rectal = '".$rectal."', lpow_r = '".$lpow_r."', lpow_l = '".$lpow_l."', lref_r = '".$lref_r."', lref_l = '".$lref_l."',
                    lsen_r = '".$lsen_r."', lsen_l = '".$lsen_l."', upow_r = '".$upow_r."', upow_l = '".$upow_l."', uref_r = '".$uref_r."', uref_l = '".$uref_l."', usen_r = '".$usen_r."', usen_l = '".$usen_l."',
                    breast = NULL, lmp = NULL, gynaecology = NULL, lastps = NULL, cxr = '".$cxr."', ecg = '".$ecg."', mammogram = NULL, us_breast = NULL, 
                    us_abdopel = NULL, stresstest = NULL, pta = NULL, lft = NULL, urine = '".$urine."', blood = '".$blood."', impression = '".$impression."', recommendation = '".$recommendation."', lastUpdate = '".$date."', status='1'";
                }
        }
            if ($conn->query($insert) === TRUE)
            {
                echo "<p class='success'>Successfully updated medical report";
            }
            else
            {
                echo "Error: " . $insert . "<br>" . $conn->error;
            }
            $conn->close();
        }
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