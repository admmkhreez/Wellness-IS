<!DOCTYPE html>
<html>
    <?php
    session_start();
    if(isset($_SESSION["username"])) {

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
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>KPJ Klang Wellness IS</title>
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
        <h1>Past Medical History</h1>
        <br>
        <div class="container">
        <form method="post" style="text-align: center;">
                <label class="inline" for="mrn">Enter Patient's MRN</label><br>
                <input type="text" id="mrn" name="mrn" maxlength="10" required autofocus><br>
                <button formaction="historyUpdateForm.php" class="btn btn-primary">Search</button>
        </form>
        <br>
    <?php
    if ($data->num_rows>0)
    {
        while($row=$data->fetch_assoc()){
    ?>
        
        <form method="post" style="text-align:center;">
            <div class="btn-group" style="width:100%;">
                <input type="hidden" name="mrn" value="<?php echo $mrn;?>">
                <input type="hidden" name="sex" value="<?php echo $row['sex'];?>">
                <input type="hidden" name="package" value="<?php echo $row['package'];?>">
                <button formaction="viewPatient.php" class="btn btn-primary">View Patient's Details</button>
                <button formaction="editProfile.php" class="btn btn-primary">Edit Patient's Details</button>
                <?php
                    if($_SESSION["type"] == "Doctor" || $_SESSION["type"] == "admin"){
                ?>
                <button formaction="recordUpdateForm.php" class="btn btn-primary">Update Patient's Record</button>
                <?php
                    }
                ?>
                <button formaction="historyUpdateForm.php" class="btn btn-primary active">Update Medical History</button>
                        
            </div>    
        </form>
        <br>
        <form action="updateHistory.php" method="post">
        <dl class="row h5">
            <dt class="col-sm-3">Name: </dt>
            <dd class="col-sm-9"><?php echo $row["name"];?></dd>
            <dt class="col-sm-3">MRN: </dt>
            <dd class="col-sm-9"><?php echo $mrn;?></dd>
        </dl>
            <h5>Medical History</h5>
            <fieldset>
            <legend>Smoker/Non Smoker:</legend>
            <div>
                <input type="radio" class="form-check-input" id="yes" name="smoker" value="Yes" <?php if ($row['smoker'] == "Yes") echo "checked"; ?> required>
                <label class="inline-radio" for="yes">Smoker</label>
                <input type="radio" class="form-check-input" id="no" name="smoker" value="No"<?php if ($row['smoker']== "No") echo "checked"; ?>>
                <label class="inline-radio" for="no">Non Smoker</label>
            </div>
            </fieldset>
            <fieldset>
            <legend>Asthma:</legend>
            <div>
            <input type="radio" class="form-check-input" id="yes" name="asthma" value="Yes"<?php if ($row['asthma'] == "Yes") echo "checked"; ?> required>
            <label class="inline-radio" for="yes">Yes</label>
                <input type="radio" class="form-check-input" id="no" name="asthma" value="No"<?php if ($row['asthma'] == "No") echo "checked"; ?>>
                <label class="inline-radio" for="no">No</label>
                <input type="radio" class="form-check-input" id="unknown" name="asthma" value="Unknown"<?php if ($row['asthma'] == "Unknown") echo "checked"; ?>>
                <label class="inline-radio" for="unknown">Unknown</label>
            </div>
            </fieldset>
            <fieldset>
            <legend>Diabetes:</legend>
            <div>
                <input type="radio" class="form-check-input" id="yes" name="diabetes" value="Yes"<?php if ($row['diabetes'] == "Yes") echo "checked"; ?>required>
                <label class="inline-radio" for="yes">Yes</label>
                <input type="radio" class="form-check-input" id="no" name="diabetes" value="No"<?php if ($row['diabetes']== "No") echo "checked"; ?>>
                <label class="inline-radio" for="no">No</label>
                <input type="radio" class="form-check-input" id="unknown" name="diabetes" value="Unknown"<?php if ($row['diabetes'] == "Unknown") echo "checked"; ?>>
                <label class="inline-radio" for="unknown">Unknown</label>
            </div>
            </fieldset>
            <fieldset>
            <legend>Heart Disease:</legend>
            <div>
                <input type="radio" class="form-check-input" id="yes" name="heart_disease" value="Yes"<?php if ($row['heart_disease'] == "Yes") echo "checked"; ?>required>
                <label class="inline-radio" for="yes">Yes</label>
                <input type="radio" class="form-check-input" id="no" name="heart_disease" value="No"<?php if ($row['heart_disease'] == "No") echo "checked"; ?>>
                <label class="inline-radio" for="no">No</label>
                <input type="radio" class="form-check-input" id="unknown" name="heart_disease" value="Unknown"<?php if ($row['heart_disease'] == "Unknown") echo "checked"; ?>>
                <label class="inline-radio" for="unknown">Unknown</label>
            </div>
            </fieldset>
            <fieldset>
            <legend>Hypertension:</legend>
            <div>
                <input type="radio" class="form-check-input" id="yes" name="hypertension" value="Yes"<?php if ($row['hypertension'] == "Yes") echo "checked"; ?>required>
                <label class="inline-radio" for="yes">Yes</label>
                <input type="radio" class="form-check-input" id="no" name="hypertension" value="No"<?php if ($row['hypertension'] == "No") echo "checked"; ?>>
                <label class="inline-radio" for="no">No</label>
                <input type="radio" class="form-check-input" id="unknown" name="hypertension" value="Unknown"<?php if ($row['hypertension'] == "Unknown") echo "checked"; ?>>
                <label class="inline-radio" for="unknown">Unknown</label>
            </div>
            </fieldset>
            <fieldset>
            <legend>Stroke:</legend>
            <div>
                <input type="radio" class="form-check-input" id="yes" name="stroke" value="Yes"<?php if ($row['stroke'] == "Yes") echo "checked"; ?>required>
                <label class="inline-radio" for="yes">Yes</label>
                <input type="radio" class="form-check-input" id="no" name="stroke" value="No"<?php if ($row['stroke'] == "No") echo "checked"; ?>>
                <label class="inline-radio" for="no">No</label>
                <input type="radio" class="form-check-input" id="unknown" name="stroke" value="Unknown"<?php if ($row['stroke']== "Unknown") echo "checked"; ?>>
                <label class="inline-radio" for="unknown">Unknown</label>
            </div>
            </fieldset>
            <fieldset>
            <legend>Cancer:</legend>
            <div>
                <input type="radio" class="form-check-input" id="yes" name="cancer" value="Yes"<?php if ($row['cancer'] == "Yes") echo "checked"; ?>required>
                <label class="inline-radio" for="yes">Yes</label>
                <input type="radio" class="form-check-input" id="no" name="cancer" value="No"<?php if ($row['cancer'] == "No") echo "checked"; ?>>
                <label class="inline-radio" for="no">No</label>
                <input type="radio" class="form-check-input" id="unknown" name="cancer" value="Unknown"<?php if ($row['cancer'] == "Unknown") echo "checked"; ?>>
                <label class="inline-radio" for="unknown">Unknown</label>
            </div>
            </fieldset>
            <fieldset>
            <legend>Tuberculosis:</legend>
            <div>
                <input type="radio" class="form-check-input" id="yes" name="tuberculosis" value="Yes"<?php if ($row['tuberculosis'] == "Yes") echo "checked"; ?>required>
                <label class="inline-radio" for="yes">Yes</label>
                <input type="radio" class="form-check-input" id="no" name="tuberculosis" value="No"<?php if ($row['tuberculosis']  == "No") echo "checked"; ?>>
                <label class="inline-radio" for="no">No</label>
                <input type="radio" class="form-check-input" id="unknown" name="tuberculosis" value="Unknown"<?php if ($row['tuberculosis']  == "Unknown") echo "checked"; ?>>
                <label class="inline-radio" for="unknown">Unknown</label>
            </div>
            </fieldset>
            <fieldset>
            <legend>Skin Disesase:</legend>
            <div>
                <input type="radio" class="form-check-input" id="yes" name="skin_disease" value="Yes"<?php if ($row['skin_disease'] == "Yes") echo "checked"; ?>required>
                <label class="inline-radio" for="yes">Yes</label>
                <input type="radio" class="form-check-input" id="no" name="skin_disease" value="No"<?php if ($row['skin_disease'] == "No") echo "checked"; ?>>
                <label class="inline-radio" for="no">No</label>
                <input type="radio" class="form-check-input" id="unknown" name="skin_disease" value="Unknown"<?php if ($row['skin_disease'] == "Unknown") echo "checked"; ?>>
                <label class="inline-radio" for="unknown">Unknown</label>
            </div>
            </fieldset>
            <fieldset>
            <legend>Kidney Problem:</legend>
            <div>
                <input type="radio" class="form-check-input" id="yes" name="kidneyp" value="Yes"<?php if ($row['kidneyp']  == "Yes") echo "checked"; ?>required>
                <label class="inline-radio" for="yes">Yes</label>
                <input type="radio" class="form-check-input" id="no" name="kidneyp" value="No"<?php if ($row['kidneyp'] == "No") echo "checked"; ?>>
                <label class="inline-radio" for="no">No</label>
                <input type="radio" class="form-check-input" id="unknown" name="kidneyp" value="Unknown"<?php if ($row['kidneyp'] == "Unknown") echo "checked"; ?>>
                <label class="inline-radio" for="unknown">Unknown</label>
            </div>
            </fieldset>
            <fieldset>
            <legend>Fits/Psychiatric:</legend>
            <div>
                <input type="radio" class="form-check-input" id="yes" name="fits_psychiatric" value="Yes"<?php if ($row['fits_psychiatric'] == "Yes") echo "checked"; ?>required>
                <label class="inline-radio" for="yes">Yes</label>
                <input type="radio" class="form-check-input" id="no" name="fits_psychiatric" value="No"<?php if ($row['fits_psychiatric']== "No") echo "checked"; ?>>
                <label class="inline-radio" for="no">No</label>
                <input type="radio" class="form-check-input" id="unknown" name="fits_psychiatric" value="Unknown"<?php if ($row['fits_psychiatric'] == "Unknown") echo "checked"; ?>>
                <label class="inline-radio" for="unknown">Unknown</label>
            </div>
            </fieldset>
            <p>Family History</p>
            <div>
                <label class="inline" for="father_history">Father: </label>
                <input type="text" id="father_history" name="father_history" maxlength="30" value="<?php echo $row['father_history'];?>" required>
            </div>
            <div>
                <label class="inline" for="mother_history">Mother: </label>
                <input type="text" id="mother_history" name="mother_history" maxlength="30" value="<?php echo $row['mother_history'];?>" required>
            </div>
            <div>
                <label class="inline" for="siblings_history">Siblings: </label>
                <input type="text" id="siblings_history" name="siblings_history" maxlength="30" value="<?php echo $row['siblings_history'];?>" required>
            </div>
            <div>
                <label class="inline" for="habits">Habits: </label>
                <input type="text" id="habits" name="habits" maxlength="30" value="<?php echo $row['habits'];?>" required>
            </div>
            <div>
                <label class="inline" for="allergy">Allergy: </label>
                <input type="text" id="allergy" name="allergy" maxlength="30" value="<?php echo $row['allergy'];?>" required>
            </div>
            <div>
                <label class="inline" for="others">Others: </label>
                <input type="text" id="others" name="others" maxlength="30" value="<?php echo $row['others'];?>" required>
            </div>
            <div>
                <label class="inline" for="medication">Medication: </label>
                <textarea id="medication" name="medication" rows="5" cols="100" required><?php echo $row['medication'];?></textarea>
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