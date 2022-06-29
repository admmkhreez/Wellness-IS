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
        $select = "SELECT name from patient WHERE mrn = '".$mrn."'";
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
        <h1>Past Medical History</h1>
        <?php
        if ($data->num_rows>0)
        {
            while($row=$data->fetch_assoc()){
        ?>
        <div class="container">
        <br>
        <form action="insertHistory.php" method="post">
        <p>Patient's Name: <?php echo $row["name"];?></p>
        <p>Patient's MRN: <?php echo $mrn;?></p>
            <p>Medical History</p>
            <fieldset>
            <legend>Smoker/Non Smoker:</legend>
            <div>
                <input type="radio" id="yes" name="smoker" value="Yes" required>
                <label for="yes">Smoker</label>
                <input type="radio" id="no" name="smoker" value="No">
                <label for="no">Non Smoker</label>
            </div>
            </fieldset>
            <fieldset>
            <legend>Asthma:</legend>
            <div>
            <input type="radio" id="yes" name="asthma" value="Yes" required>
            <label for="yes">Yes</label>
                <input type="radio" id="no" name="asthma" value="No">>
                <label for="no">No</label>
                <input type="radio" id="unknown" name="asthma" value="Unknown">
                <label for="unknown">Unknown</label>
            </div>
            </fieldset>
            <fieldset>
            <legend>Diabetes:</legend>
            <div>
                <input type="radio" id="yes" name="diabetes" value="Yes" required>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="diabetes" value="No">
                <label for="no">No</label>
                <input type="radio" id="unknown" name="diabetes" value="Unknown">
                <label for="unknown">Unknown</label>
            </div>
            </fieldset>
            <fieldset>
            <legend>Heart Disease:</legend>
            <div>
                <input type="radio" id="yes" name="heart_disease" value="Yes" required>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="heart_disease" value="No">
                <label for="no">No</label>
                <input type="radio" id="unknown" name="heart_disease" value="Unknown">
                <label for="unknown">Unknown</label>
            </div>
            </fieldset>
            <fieldset>
            <legend>Hypertension:</legend>
            <div>
                <input type="radio" id="yes" name="hypertension" value="Yes" required>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="hypertension" value="No">
                <label for="no">No</label>
                <input type="radio" id="unknown" name="hypertension" value="Unknown">
                <label for="unknown">Unknown</label>
            </div>
            </fieldset>
            <fieldset>
            <legend>Stroke:</legend>
            <div>
                <input type="radio" id="yes" name="stroke" value="Yes" required>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="stroke" value="No">
                <label for="no">No</label>
                <input type="radio" id="unknown" name="stroke" value="Unknown">
                <label for="unknown">Unknown</label>
            </div>
            </fieldset>
            <fieldset>
            <legend>Cancer:</legend>
            <div>
                <input type="radio" id="yes" name="cancer" value="Yes" required>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="cancer" value="No">
                <label for="no">No</label>
                <input type="radio" id="unknown" name="cancer" value="Unknown">
                <label for="unknown">Unknown</label>
            </div>
            </fieldset>
            <fieldset>
            <legend>Tuberculosis:</legend>
            <div>
                <input type="radio" id="yes" name="tuberculosis" value="Yes" required>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="tuberculosis" value="No">
                <label for="no">No</label>
                <input type="radio" id="unknown" name="tuberculosis" value="Unknown">
                <label for="unknown">Unknown</label>
            </div>
            </fieldset>
            <fieldset>
            <legend>Skin Disesase:</legend>
            <div>
                <input type="radio" id="yes" name="skin_disease" value="Yes" required>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="skin_disease" value="No">
                <label for="no">No</label>
                <input type="radio" id="unknown" name="skin_disease" value="Unknown">
                <label for="unknown">Unknown</label>
            </div>
            </fieldset>
            <fieldset>
            <legend>Kidney Problem:</legend>
            <div>
                <input type="radio" id="yes" name="kidneyp" value="Yes" required>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="kidneyp" value="No">
                <label for="no">No</label>
                <input type="radio" id="unknown" name="kidneyp" value="Unknown">
                <label for="unknown">Unknown</label>
            </div>
            </fieldset>
            <fieldset>
            <legend>Fits/Psychiatric:</legend>
            <div>
                <input type="radio" id="yes" name="fits_psychiatric" value="Yes" required>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="fits_psychiatric" value="No">
                <label for="no">No</label>
                <input type="radio" id="unknown" name="fits_psychiatric" value="Unknown">
                <label for="unknown">Unknown</label>
            </div>
            </fieldset>
            <p>Family History</p>
            <div>
                <label for="father_history">Father: </label>
                <input type="text" id="father_history" name="father_history" maxlength="30" required>
            </div>
            <div>
                <label for="mother_history">Mother: </label>
                <input type="text" id="mother_history" name="mother_history" maxlength="30" required>
            </div>
            <div>
                <label for="siblings_history">Siblings: </label>
                <input type="text" id="siblings_history" name="siblings_history" maxlength="30" required>
            </div>
            <div>
                <label for="habits">Habits: </label>
                <input type="text" id="habits" name="habits" maxlength="30" required>
            </div>
            <div>
                <label for="allergy">Allergy: </label>
                <input type="text" id="allergy" name="allergy" maxlength="30" required>
            </div>
            <div>
                <label for="others">Others: </label>
                <input type="text" id="others" name="others" maxlength="30" required>
            </div>
            <div>
                <label for="medication">Medication: </label><br>
                <input type="text" id="medication" name="medication" maxlength="50" required>
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