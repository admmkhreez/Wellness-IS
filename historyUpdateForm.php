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
    date_default_timezone_set("Asia/Kuala_Lumpur");
    
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
        <title>Update Medical History</title>
        <link rel="stylesheet" href="wellness.css">
        <link rel="stylesheet" href="bootstrap.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            function confirm_reset() {
                return confirm("Are you sure you want to reset all input?");
            }
        </script>
    </head>
    <body>
        <nav class="navbar sticky-top navbar-expand-sm bg-dark navbar-dark">
        <span class="nav-item" style="padding-left: 10px;color: white;"><?php echo $_SESSION["name"];?></span>
            <div class="container-sm">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="homepage.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="viewPatient.php">Patients List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="viewRecords.php">Records</a>
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
                <form class="d-flex" method="post" style="margin-left: 400px;">
                    <input type="search" class="form-control me-2" placeholder="Search" aria-label="Search" name="mrn">
                    <button class="btn btn-outline-success" formaction="selectRecord.php">Search</button>
                </form>
            </div>
            <a class="btn btn-danger" href="logout.php" style="color: white; font-weight: 700; margin-right: 30px">Logout</a>
        </nav>
        <br>
        <h1 style='color: white;'>Past Medical History</h1>
        <br>
        <div class="container">
            <form method="post" style="text-align: center;">
                    <label for="mrn">Enter Patient's MRN</label><br>
                    <input type="text" id="mrn" name="mrn" maxlength="10" required autofocus>
                    <button formaction="selectRecord.php" class="btn btn-primary">Search</button>
            </form>
            <br>
            <div class="text-center">
                    <h5>MRN: <?php echo $mrn;?></h5>
                    <form method="post" style="text-align: center;" class="btn-group">
                        <button formaction="selectRecord.php" class="btn btn-primary">View Record</button>
                        <button formaction="activeDetails.php" class="btn btn-primary">Latest Details</button>
                        <button formaction="editProfile.php" class="btn btn-primary">Edit Profile</button>
                        <button formaction="historyUpdateForm.php" class="btn btn-primary active">Edit Medical History</button>  
                        <input type="hidden" name="mrn" value="<?php echo $mrn;?>">
                        <div class="btn-group" role="group">
                            <button id="btnGroupDrop" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                Insert
                            </button>
                            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="btnGroupDrop">
                                <li>
                                <?php
                                    if($_SESSION["type"] == "admin" or $_SESSION["type"] == "doctor"){
                                ?>
                                    <button class="dropdown-item" formaction="recordForm.php">Record</button>
                                <?php
                                    }
                                ?>
                                </li>
                                <li>
                                    <button class="dropdown-item" formaction="physicalExam.php">Physical Examinantion</button>
                                </li>
                                <li>
                                    <button class="dropdown-item" formaction="historyForm.php">Medical History</button>
                                </li>
                            </ul>
                        </div>
                    </form>
                </div>
        <?php
        if ($data->num_rows>0)
        {
            while($row=$data->fetch_assoc()){
        ?> 
            </form>
            <hr>
            <form action="updateHistory.php" method="post">
            <h2>Medical History</h2>
            <hr>
                <div class="row">
                    <div class="col">
                        <fieldset>
                            <legend>Smoker/Non Smoker:</legend>
                            <div>
                                <input type="radio" class="form-check-input" id="yes" name="smoker" value="Smoker" required <?php if ($row['smoker'] == "Smoker") echo "checked"; ?> >
                                <label class="inline-radio" for="yes">Smoker</label>
                                <input type="radio" class="form-check-input" id="no" name="smoker" value="Non-Smoker" <?php if ($row['smoker']== "Non-Smoker") echo "checked"; ?>>
                                <label class="inline-radio" for="no">Non Smoker</label>
                            </div>
                        </fieldset>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <fieldset>
                        <legend>Diabetes:</legend>
                        <div>
                            <input type="radio" class="form-check-input" id="yes" name="diabetes" value="Yes" required <?php if ($row['diabetes'] == "Yes") echo "checked"; ?>>
                            <label class="inline-radio" for="yes">Yes</label>
                            <input type="radio" class="form-check-input" id="no" name="diabetes" value="No" <?php if ($row['diabetes']== "No") echo "checked"; ?>>
                            <label class="inline-radio" for="no">No</label>
                            <input type="radio" class="form-check-input" id="unknown" name="diabetes" value="Unknown" <?php if ($row['diabetes'] == "Unknown") echo "checked"; ?>>
                            <label class="inline-radio" for="unknown">Unknown</label>
                        </div>
                        </fieldset>
                    </div>                        
                    <div class="col">
                        <fieldset>
                        <legend>Heart Disease:</legend>
                        <div>
                            <input type="radio" class="form-check-input" id="yes" name="heart_disease" value="Yes" required <?php if ($row['heart_disease'] == "Yes") echo "checked"; ?>>
                            <label class="inline-radio" for="yes">Yes</label>
                            <input type="radio" class="form-check-input" id="no" name="heart_disease" value="No" <?php if ($row['heart_disease'] == "No") echo "checked"; ?>>
                            <label class="inline-radio" for="no">No</label>
                            <input type="radio" class="form-check-input" id="unknown" name="heart_disease" value="Unknown" <?php if ($row['heart_disease'] == "Unknown") echo "checked"; ?>>
                            <label class="inline-radio" for="unknown">Unknown</label>
                        </div>
                        </fieldset>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <fieldset>
                        <legend>Hypertension:</legend>
                        <div>
                            <input type="radio" class="form-check-input" id="yes" name="hypertension" value="Yes" required <?php if ($row['hypertension'] == "Yes") echo "checked"; ?>>
                            <label class="inline-radio" for="yes">Yes</label>
                            <input type="radio" class="form-check-input" id="no" name="hypertension" value="No" <?php if ($row['hypertension'] == "No") echo "checked"; ?>>
                            <label class="inline-radio" for="no">No</label>
                            <input type="radio" class="form-check-input" id="unknown" name="hypertension" value="Unknown" <?php if ($row['hypertension'] == "Unknown") echo "checked"; ?>>
                            <label class="inline-radio" for="unknown">Unknown</label>
                        </div>
                        </fieldset>
                    </div>
                    <div class="col">
                        <fieldset>
                        <legend>Stroke:</legend>
                        <div>
                            <input type="radio" class="form-check-input" id="yes" name="stroke" value="Yes" required <?php if ($row['stroke'] == "Yes") echo "checked"; ?>>
                            <label class="inline-radio" for="yes">Yes</label>
                            <input type="radio" class="form-check-input" id="no" name="stroke" value="No" <?php if ($row['stroke'] == "No") echo "checked"; ?>>
                            <label class="inline-radio" for="no">No</label>
                            <input type="radio" class="form-check-input" id="unknown" name="stroke" value="Unknown" <?php if ($row['stroke']== "Unknown") echo "checked"; ?>>
                            <label class="inline-radio" for="unknown">Unknown</label>
                        </div>
                        </fieldset>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <fieldset>
                        <legend>Asthma:</legend>
                        <div>
                            <input type="radio" class="form-check-input" id="yes" name="asthma" value="Yes" required <?php if ($row['asthma'] == "Yes") echo "checked"; ?> >
                            <label class="inline-radio" for="yes">Yes</label>
                            <input type="radio" class="form-check-input" id="no" name="asthma" value="No" <?php if ($row['asthma'] == "No") echo "checked"; ?>>
                            <label class="inline-radio" for="no">No</label>
                            <input type="radio" class="form-check-input" id="unknown" name="asthma" value="Unknown" <?php if ($row['asthma'] == "Unknown") echo "checked"; ?>>
                            <label class="inline-radio" for="unknown">Unknown</label>
                        </div>
                        </fieldset>
                    </div>                        
                    <div class="col">
                        <fieldset>
                        <legend>Tuberculosis:</legend>
                        <div>
                            <input type="radio" class="form-check-input" id="yes" name="tuberculosis" value="Yes" required <?php if ($row['tuberculosis'] == "Yes") echo "checked"; ?>>
                            <label class="inline-radio" for="yes">Yes</label>
                            <input type="radio" class="form-check-input" id="no" name="tuberculosis" value="No" <?php if ($row['tuberculosis']  == "No") echo "checked"; ?>>
                            <label class="inline-radio" for="no">No</label>
                            <input type="radio" class="form-check-input" id="unknown" name="tuberculosis" value="Unknown" <?php if ($row['tuberculosis']  == "Unknown") echo "checked"; ?>>
                            <label class="inline-radio" for="unknown">Unknown</label>
                        </div>
                        </fieldset>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <fieldset>
                        <legend>Skin Disesase:</legend>
                        <div>
                            <input type="radio" class="form-check-input" id="yes" name="skin_disease" value="Yes" required <?php if ($row['skin_disease'] == "Yes") echo "checked"; ?>>
                            <label class="inline-radio" for="yes">Yes</label>
                            <input type="radio" class="form-check-input" id="no" name="skin_disease" value="No" <?php if ($row['skin_disease'] == "No") echo "checked"; ?>>
                            <label class="inline-radio" for="no">No</label>
                            <input type="radio" class="form-check-input" id="unknown" name="skin_disease" value="Unknown" <?php if ($row['skin_disease'] == "Unknown") echo "checked"; ?>>
                            <label class="inline-radio" for="unknown">Unknown</label>
                        </div>
                        </fieldset>
                    </div>
                    <div class="col">
                        <fieldset>
                        <legend>Kidney Problem:</legend>
                        <div>
                            <input type="radio" class="form-check-input" id="yes" name="kidneyp" value="Yes" required <?php if ($row['kidneyp']  == "Yes") echo "checked"; ?>>
                            <label class="inline-radio" for="yes">Yes</label>
                            <input type="radio" class="form-check-input" id="no" name="kidneyp" value="No" <?php if ($row['kidneyp'] == "No") echo "checked"; ?>>
                            <label class="inline-radio" for="no">No</label>
                            <input type="radio" class="form-check-input" id="unknown" name="kidneyp" value="Unknown" <?php if ($row['kidneyp'] == "Unknown") echo "checked"; ?>>
                            <label class="inline-radio" for="unknown">Unknown</label>
                        </div>
                        </fieldset>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <fieldset>
                        <legend>Fits/Psychiatric:</legend>
                        <div>
                            <input type="radio" class="form-check-input" id="yes" name="fits_psychiatric" value="Yes" required <?php if ($row['fits_psychiatric'] == "Yes") echo "checked"; ?>>
                            <label class="inline-radio" for="yes">Yes</label>
                            <input type="radio" class="form-check-input" id="no" name="fits_psychiatric" value="No" <?php if ($row['fits_psychiatric']== "No") echo "checked"; ?>>
                            <label class="inline-radio" for="no">No</label>
                            <input type="radio" class="form-check-input" id="unknown" name="fits_psychiatric" value="Unknown" <?php if ($row['fits_psychiatric'] == "Unknown") echo "checked"; ?>>
                            <label class="inline-radio" for="unknown">Unknown</label>
                        </div>
                        </fieldset>
                    </div>
                    <div class="col">
                        <fieldset>
                        <legend>Cancer:</legend>
                        <div>
                            <input type="radio" class="form-check-input" id="yes" name="cancer" value="Yes" required <?php if ($row['cancer'] == "Yes") echo "checked"; ?>>
                            <label class="inline-radio" for="yes">Yes</label>
                            <input type="radio" class="form-check-input" id="no" name="cancer" value="No" <?php if ($row['cancer'] == "No") echo "checked"; ?>>
                            <label class="inline-radio" for="no">No</label>
                            <input type="radio" class="form-check-input" id="unknown" name="cancer" value="Unknown" <?php if ($row['cancer'] == "Unknown") echo "checked"; ?>>
                            <label class="inline-radio" for="unknown">Unknown</label>
                        </div>
                        </fieldset>
                    </div>
                </div>
                <h2>Family History</h2>
                <hr>
                <div>
                    <label class="inline" for="father_history">Father: </label>
                    <input type="text" id="father_history" name="father_history" maxlength="30" value=" <?php echo $row['father_history'];?>" required>
                </div>
                <div>
                    <label class="inline" for="mother_history">Mother: </label>
                    <input type="text" id="mother_history" name="mother_history" maxlength="30" value=" <?php echo $row['mother_history'];?>" required>
                </div>
                <div>
                    <label class="inline" for="siblings_history">Siblings: </label>
                    <input type="text" id="siblings_history" name="siblings_history" maxlength="30" value=" <?php echo $row['siblings_history'];?>" required>
                </div>
                <div>
                    <label class="inline" for="habits">Habits: </label>
                    <input type="text" id="habits" name="habits" maxlength="30" value=" <?php echo $row['habits'];?>" required>
                </div>
                <div>
                    <label class="inline" for="allergy">Allergy: </label>
                    <input type="text" id="allergy" name="allergy" maxlength="30" value=" <?php echo $row['allergy'];?>" required>
                </div>
                <div>
                    <label class="inline" for="others">Others: </label>
                    <input type="text" id="others" name="others" maxlength="30" value=" <?php echo $row['others'];?>" required>
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
        echo "<script type='text/javascript'>";
        echo "alert('Session does not exist. Please login again');";
        echo "window.location.href = 'log-in.html';";
        echo "</script>";
    }
    ?>
</html>