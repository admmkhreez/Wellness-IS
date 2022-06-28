<!DOCTYPE html>
<html>
    <?php
    session_start();
    if(isset($_SESSION["type"])) {

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
        $select = "SELECT * from patient WHERE mrn = '".$mrn."'";
        $data = $conn->query($select);
    }
    ?>
    <head>
        <meta charset="UTF-8">
        <title>Patient Medical History</title>
        <link rel="stylesheet" href="test.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script>
            function confirm_reset() {
                return confirm("Are you sure you want to reset all input?");
            }
        </script>
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
        <h1>Past Medical History</h1>
        <div class="container">
    <?php
    if ($data->num_rows>0)
    {
        while($row=$data->fetch_assoc()){
    ?>
    
        <form action="updateHistory.php" method="post">
        <p>Patient's Name: <?php echo $row["name"];?></p>
        <p>Patient's MRN: <?php echo $mrn;?></p>
            <p>Medical History</p>
            <fieldset>
            <legend>Smoker/Non Smoker:</legend>
            <div>
                <input type="radio" id="yes" name="smoker" value="Yes" <?php if ($row['smoker'] == "Yes") echo "checked"; ?> required>
                <label for="yes">Smoker</label>
                <input type="radio" id="no" name="smoker" value="No"<?php if ($row['smoker']== "No") echo "checked"; ?>>
                <label for="no">Non Smoker</label>
            </div>
            </fieldset>
            <fieldset>
            <legend>Asthma:</legend>
            <div>
            <input type="radio" id="yes" name="asthma" value="Yes"<?php if ($row['asthma'] == "Yes") echo "checked"; ?> required>
            <label for="yes">Yes</label>
                <input type="radio" id="no" name="asthma" value="No"<?php if ($row['asthma'] == "No") echo "checked"; ?>>
                <label for="no">No</label>
                <input type="radio" id="unknown" name="asthma" value="Unknown"<?php if ($row['asthma'] == "Unknown") echo "checked"; ?>>
                <label for="unknown">Unknown</label>
            </div>
            </fieldset>
            <fieldset>
            <legend>Diabetes:</legend>
            <div>
                <input type="radio" id="yes" name="diabetes" value="Yes"<?php if ($row['diabetes'] == "Yes") echo "checked"; ?>required>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="diabetes" value="No"<?php if ($row['diabetes']== "No") echo "checked"; ?>>
                <label for="no">No</label>
                <input type="radio" id="unknown" name="diabetes" value="Unknown"<?php if ($row['diabetes'] == "Unknown") echo "checked"; ?>>
                <label for="unknown">Unknown</label>
            </div>
            </fieldset>
            <fieldset>
            <legend>Heart Disease:</legend>
            <div>
                <input type="radio" id="yes" name="heart_disease" value="Yes"<?php if ($row['heart_disease'] == "Yes") echo "checked"; ?>required>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="heart_disease" value="No"<?php if ($row['heart_disease'] == "No") echo "checked"; ?>>
                <label for="no">No</label>
                <input type="radio" id="unknown" name="heart_disease" value="Unknown"<?php if ($row['heart_disease'] == "Unknown") echo "checked"; ?>>
                <label for="unknown">Unknown</label>
            </div>
            </fieldset>
            <fieldset>
            <legend>Hypertension:</legend>
            <div>
                <input type="radio" id="yes" name="hypertension" value="Yes"<?php if ($row['hypertension'] == "Yes") echo "checked"; ?>required>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="hypertension" value="No"<?php if ($row['hypertension'] == "No") echo "checked"; ?>>
                <label for="no">No</label>
                <input type="radio" id="unknown" name="hypertension" value="Unknown"<?php if ($row['hypertension'] == "Unknown") echo "checked"; ?>>
                <label for="unknown">Unknown</label>
            </div>
            </fieldset>
            <fieldset>
            <legend>Stroke:</legend>
            <div>
                <input type="radio" id="yes" name="stroke" value="Yes"<?php if ($row['stroke'] == "Yes") echo "checked"; ?>required>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="stroke" value="No"<?php if ($row['stroke'] == "No") echo "checked"; ?>>
                <label for="no">No</label>
                <input type="radio" id="unknown" name="stroke" value="Unknown"<?php if ($row['stroke']== "Unknown") echo "checked"; ?>>
                <label for="unknown">Unknown</label>
            </div>
            </fieldset>
            <fieldset>
            <legend>Cancer:</legend>
            <div>
                <input type="radio" id="yes" name="cancer" value="Yes"<?php if ($row['cancer'] == "Yes") echo "checked"; ?>required>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="cancer" value="No"<?php if ($row['cancer'] == "No") echo "checked"; ?>>
                <label for="no">No</label>
                <input type="radio" id="unknown" name="cancer" value="Unknown"<?php if ($row['cancer'] == "Unknown") echo "checked"; ?>>
                <label for="unknown">Unknown</label>
            </div>
            </fieldset>
            <fieldset>
            <legend>Tuberculosis:</legend>
            <div>
                <input type="radio" id="yes" name="tuberculosis" value="Yes"<?php if ($row['tuberculosis'] == "Yes") echo "checked"; ?>required>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="tuberculosis" value="No"<?php if ($row['tuberculosis']  == "No") echo "checked"; ?>>
                <label for="no">No</label>
                <input type="radio" id="unknown" name="tuberculosis" value="Unknown"<?php if ($row['tuberculosis']  == "Unknown") echo "checked"; ?>>
                <label for="unknown">Unknown</label>
            </div>
            </fieldset>
            <fieldset>
            <legend>Skin Disesase:</legend>
            <div>
                <input type="radio" id="yes" name="skin_disease" value="Yes"<?php if ($row['skin_disease'] == "Yes") echo "checked"; ?>required>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="skin_disease" value="No"<?php if ($row['skin_disease'] == "No") echo "checked"; ?>>
                <label for="no">No</label>
                <input type="radio" id="unknown" name="skin_disease" value="Unknown"<?php if ($row['skin_disease'] == "Unknown") echo "checked"; ?>>
                <label for="unknown">Unknown</label>
            </div>
            </fieldset>
            <fieldset>
            <legend>Kidney Problem:</legend>
            <div>
                <input type="radio" id="yes" name="kidneyp" value="Yes"<?php if ($row['kidneyp']  == "Yes") echo "checked"; ?>required>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="kidneyp" value="No"<?php if ($row['kidneyp'] == "No") echo "checked"; ?>>
                <label for="no">No</label>
                <input type="radio" id="unknown" name="kidneyp" value="Unknown"<?php if ($row['kidneyp'] == "Unknown") echo "checked"; ?>>
                <label for="unknown">Unknown</label>
            </div>
            </fieldset>
            <fieldset>
            <legend>Fits/Psychiatric:</legend>
            <div>
                <input type="radio" id="yes" name="fits_psychiatric" value="Yes"<?php if ($row['fits_psychiatric'] == "Yes") echo "checked"; ?>required>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="fits_psychiatric" value="No"<?php if ($row['fits_psychiatric']== "No") echo "checked"; ?>>
                <label for="no">No</label>
                <input type="radio" id="unknown" name="fits_psychiatric" value="Unknown"<?php if ($row['fits_psychiatric'] == "Unknown") echo "checked"; ?>>
                <label for="unknown">Unknown</label>
            </div>
            </fieldset>
            <p>Family History</p>
            <div>
                <label for="father_history">Father: </label>
                <input type="text" id="father_history" name="father_history" maxlength="30" value="<?php echo $row['father_history'];?>" required>
            </div>
            <div>
                <label for="mother_history">Mother: </label>
                <input type="text" id="mother_history" name="mother_history" maxlength="30" value="<?php echo $row['mother_history'];?>" required>
            </div>
            <div>
                <label for="siblings_history">Siblings: </label>
                <input type="text" id="siblings_history" name="siblings_history" maxlength="30" value="<?php echo $row['siblings_history'];?>" required>
            </div>
            <div>
                <label for="habits">Habits: </label>
                <input type="text" id="habits" name="habits" maxlength="30" value="<?php echo $row['habits'];?>" required>
            </div>
            <div>
                <label for="allergy">Allergy: </label>
                <input type="text" id="allergy" name="allergy" maxlength="30" value="<?php echo $row['allergy'];?>" required>
            </div>
            <div>
                <label for="others">Others: </label>
                <input type="text" id="others" name="others" maxlength="30" value="<?php echo $row['others'];?>" required>
            </div>
            <div>
                <label for="medication">Medication: </label><br>
                <input type="text" id="medication" name="medication" maxlength="50" value="<?php echo $row['medication'];?>" required>
            </div>
            <div style="text-align: center;">
                <input type="reset" class="btn btn-danger" value="Reset" onclick="return confirm_reset();">
                <input type="submit" class="btn btn-primary" value="Update Info">
                <input type="hidden" name="mrn" value="<?php echo $mrn; ?>">
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
    <?php
    $conn->close();
    }
    else
    {
        echo "No session exist or session has expired. Please log in again.<br>";
        echo "<a href=log-in.html> Login </a>";
    }
    ?>
</html>