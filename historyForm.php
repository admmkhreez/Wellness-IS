<!DOCTYPE html>
<html>
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
        $select = "SELECT * from patient WHERE mrn = '".$mrn."'";
        $data = $conn->query($select);
    }
    if ($data->num_rows>0)
    {
        while($row=$data->fetch_assoc()){
    ?>
    <head>
        <meta charset="UTF-8">
        <title>Patient Medical History</title>
        <link rel="stylesheet" href="test.css">
    </head>
    <body>
        <div class="button">
            <a href="homepage.html"><img src="home.png" height="40px" width="40px"></a>
        </div>
        <h1>Past Medical History</h1>
        <form action="updateHistory.php" method="post">
        <div class="container">
        <p>Patient's Name: <?php echo $row["name"];?></p>
            <p>Medical History</p>
            Smoker/Non Smoker:
            <input type="radio" id="yes" name="smoker" value="Yes" <?php if ($row['smoker'] == "Yes") echo "checked"; ?> required>
            <label for="yes">Smoker</label>
            <input type="radio" id="no" name="smoker" value="No"<?php if ($row['smoker']== "No") echo "checked"; ?>>
            <label for="no">Non Smoker</label><br>
            Asthma:
            <input type="radio" id="yes" name="asthma" value="Yes"<?php if ($row['asthma'] == "Yes") echo "checked"; ?> required>
            <label for="yes">Yes</label>
            <input type="radio" id="no" name="asthma" value="No"<?php if ($row['asthma'] == "No") echo "checked"; ?>>
            <label for="no">No</label>
            <input type="radio" id="unknown" name="asthma" value="Unknown"<?php if ($row['asthma'] == "Unknown") echo "checked"; ?>>
            <label for="unknown">Unknown</label><br>
            Diabetes:
            <input type="radio" id="yes" name="diabetes" value="Yes"<?php if ($row['diabetes'] == "Yes") echo "checked"; ?>required>
            <label for="yes">Yes</label>
            <input type="radio" id="no" name="diabetes" value="No"<?php if ($row['diabetes']== "No") echo "checked"; ?>>
            <label for="no">No</label>
            <input type="radio" id="unknown" name="diabetes" value="Unknown"<?php if ($row['diabetes'] == "Unknown") echo "checked"; ?>>
            <label for="unknown">Unknown</label><br>
            Heart Disease:
            <input type="radio" id="yes" name="heart_disease" value="Yes"<?php if ($row['heart_disease'] == "Yes") echo "checked"; ?>required>
            <label for="yes">Yes</label>
            <input type="radio" id="no" name="heart_disease" value="No"<?php if ($row['heart_disease'] == "No") echo "checked"; ?>>
            <label for="no">No</label>
            <input type="radio" id="unknown" name="heart_disease" value="Unknown"<?php if ($row['heart_disease'] == "Unknown") echo "checked"; ?>>
            <label for="unknown">Unknown</label><br>
            Hypertension:
            <input type="radio" id="yes" name="hypertension" value="Yes"<?php if ($row['hypertension'] == "Yes") echo "checked"; ?>required>
            <label for="yes">Yes</label>
            <input type="radio" id="no" name="hypertension" value="No"<?php if ($row['hypertension'] == "No") echo "checked"; ?>>
            <label for="no">No</label>
            <input type="radio" id="unknown" name="hypertension" value="Unknown"<?php if ($row['hypertension'] == "Unknown") echo "checked"; ?>>
            <label for="unknown">Unknown</label><br>
            Stroke:
            <input type="radio" id="yes" name="stroke" value="Yes"<?php if ($row['stroke'] == "Yes") echo "checked"; ?>required>
            <label for="yes">Yes</label>
            <input type="radio" id="no" name="stroke" value="No"<?php if ($row['stroke'] == "No") echo "checked"; ?>>
            <label for="no">No</label>
            <input type="radio" id="unknown" name="stroke" value="Unknown"<?php if ($row['stroke']== "Unknown") echo "checked"; ?>>
            <label for="unknown">Unknown</label><br>
            Cancer:
            <input type="radio" id="yes" name="cancer" value="Yes"<?php if ($row['cancer'] == "Yes") echo "checked"; ?>required>
            <label for="yes">Yes</label>
            <input type="radio" id="no" name="cancer" value="No"<?php if ($row['cancer'] == "No") echo "checked"; ?>>
            <label for="no">No</label>
            <input type="radio" id="unknown" name="cancer" value="Unknown"<?php if ($row['cancer'] == "Unknown") echo "checked"; ?>>
            <label for="unknown">Unknown</label><br>
            Tuberculosis:
            <input type="radio" id="yes" name="tuberculosis" value="Yes"<?php if ($row['tuberculosis'] == "Yes") echo "checked"; ?>required>
            <label for="yes">Yes</label>
            <input type="radio" id="no" name="tuberculosis" value="No"<?php if ($row['tuberculosis']  == "No") echo "checked"; ?>>
            <label for="no">No</label>
            <input type="radio" id="unknown" name="tuberculosis" value="Unknown"<?php if ($row['tuberculosis']  == "Unknown") echo "checked"; ?>>
            <label for="unknown">Unknown</label><br>
            Skin Disesase:
            <input type="radio" id="yes" name="skin_disease" value="Yes"<?php if ($row['skin_disease'] == "Yes") echo "checked"; ?>required>
            <label for="yes">Yes</label>
            <input type="radio" id="no" name="skin_disease" value="No"<?php if ($row['skin_disease'] == "No") echo "checked"; ?>>
            <label for="no">No</label>
            <input type="radio" id="unknown" name="skin_disease" value="Unknown"<?php if ($row['skin_disease'] == "Unknown") echo "checked"; ?>>
            <label for="unknown">Unknown</label><br>
            Kidney Problem:
            <input type="radio" id="yes" name="kidneyp" value="Yes"<?php if ($row['kidneyp']  == "Yes") echo "checked"; ?>required>
            <label for="yes">Yes</label>
            <input type="radio" id="no" name="kidneyp" value="No"<?php if ($row['kidneyp'] == "No") echo "checked"; ?>>
            <label for="no">No</label>
            <input type="radio" id="unknown" name="kidneyp" value="Unknown"<?php if ($row['kidneyp'] == "Unknown") echo "checked"; ?>>
            <label for="unknown">Unknown</label><br>
            Fits/Psychiatric:
            <input type="radio" id="yes" name="fits_psychiatric" value="Yes"<?php if ($row['fits_psychiatric'] == "Yes") echo "checked"; ?>required>
            <label for="yes">Yes</label>
            <input type="radio" id="no" name="fits_psychiatric" value="No"<?php if ($row['fits_psychiatric']== "No") echo "checked"; ?>>
            <label for="no">No</label>
            <input type="radio" id="unknown" name="fits_psychiatric" value="Unknown"<?php if ($row['fits_psychiatric'] == "Unknown") echo "checked"; ?>>
            <label for="unknown">Unknown</label><br>

            <p>Family History</p>
            <label for="father_history">Father: </label>
            <input type="text" id="father_history" name="father_history" maxlength="30" value="<?php echo $row['father_history'];?>" required><br>
            <label for="mother_history">Mother: </label>
            <input type="text" id="mother_history" name="mother_history" maxlength="30" value="<?php echo $row['mother_history'];?>" required><br>
            <label for="siblings_history">Siblings: </label>
            <input type="text" id="siblings_history" name="siblings_history" maxlength="30" value="<?php echo $row['siblings_history'];?>" required><br>
            <label for="habits">Habits: </label>
            <input type="text" id="habits" name="habits" maxlength="30" value="<?php echo $row['habits'];?>" required><br>
            <label for="allergy">Allergy: </label>
            <input type="text" id="allergy" name="allergy" maxlength="30" value="<?php echo $row['allergy'];?>" required><br>
            <label for="others">Others: </label>
            <input type="text" id="others" name="others" maxlength="30" value="<?php echo $row['others'];?>" required><br>
            <p><label for="medication">Medication: </label></p>
            <input type="text" id="medication" name="medication" maxlength="50" value="<?php echo $row['medication'];?>" required><br><br>
            <input type="submit" value="Update Info">
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
    </body>
    <?php
    $conn->close()
    ?>
</html>