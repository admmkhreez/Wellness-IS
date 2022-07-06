<!DOCTYPE html>
<html>
    <?php
        session_start();
        if(isset($_SESSION["username"])) {
    ?>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>KPJ Klang Wellness IS</title>
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
            date_default_timezone_set("Asia/Kuala_Lumpur");

            $conn = new mysqli($servername, $username, $password, $db);

            if ($conn->connect_error)
            {
                die("Connection failed: " . $conn->connect_error);
            }

            $display = "SELECT * FROM patient WHERE mrn = '".$mrn."'";
            $data = $conn->query($display);
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
                    <a class="nav-link" href="logout.php" style="color: white; font-weight: 700;">Logout</a>
                </div>
            </nav>
            <br>
            <h1>Patient's Details</h1>
            <br>
            <div class="container">
            <form method="post" style="text-align: center;">
                <label class="inline" for="mrn">Enter Patient's MRN</label><br>
                <input type="text" id="mrn" name="mrn" maxlength="10" required autofocus><br>
                <button formaction="editProfile.php" class="btn btn-primary">Search</button>
            </form>
            <br>
            <?php
                if($data->num_rows > 0){
                    while($row = $data->fetch_assoc()){
            ?>
            
            <form method="post" style="text-align:center;">
                <div class="btn-group" style="width:100%;">
                    <input type="hidden" name="mrn" value="<?php echo $mrn;?>">
                    <input type="hidden" name="sex" value="<?php echo $row['sex'];?>">
                    <input type="hidden" name="package" value="<?php echo $row['package'];?>">
                    <button formaction="viewPatient.php" class="btn btn-primary">View Patient's Report</button>
                    <button formaction="editProfile.php" class="btn btn-primary active">Edit Patient's Details</button>
                    <?php
                        if($_SESSION["type"] == "Doctor" || $_SESSION["type"] == "admin"){
                    ?>
                    <button formaction="recordUpdateForm.php" class="btn btn-primary">Update Patient's Record</button>
                    <?php
                        }
                    ?>
                    <button formaction="historyUpdateForm.php" class="btn btn-primary">Update Medical History</button>
                    
                </div>    
            </form>
            <br>
            <form action="updateDetails.php" method="post">
            
                <h5>Patient's Information</h5>
                <div>
                    <label class="inline" for="mrn">MRN: </label>
                    <input type="text" id="mrn" maxlength="10" name="mrn" value="<?php echo $row["mrn"]?>" required>
                </div>
                <div>
                    <label class="inline" for="name">Name: </label>
                    <input type="text" id="name" maxlength="70" name="name" value="<?php echo $row["name"]?>" required>
                </div>
                <div>
                    <label class="inline" for="icpp">I/C No / Passport: </label>
                    <input type="text" id="icpp"maxlength="12" name="icpp" value="<?php echo $row["ic_passport"]?>" required>
                </div>
                <div>
                    <label class="inline" for="dob">Date of Birth: </label>
                    <input type="date" id="dob" name="dob" value="<?php echo $row["date_of_birth"]?>" required>
                </div>
                <div>
                    <label class="inline" for="address">Home Address:</label><br>
                    <textarea type="text" id="address" maxlength="100" name="address" rows="4" cols="50" required><?php echo $row["address"]?></textarea>
                </div>
                <div>
                    <label class="inline" for="email">E-mail Address: </label>
                    <input type="email" id="email" maxlength="320" name="email" value="<?php echo $row["email"]?>">
                </div>
                <div>
                    <label class="inline" for="telephone">Telephone: </label>
                    <input type="tel" id="telephone" maxlength="15" name="tel" value="<?php echo $row["telephone"]?>">
                </div>
                <div>
                    <fieldset>
                        <legend>Sex: </legend>
                            <input type="radio" class="form-check-input" id="male" name="sex" value="Male" <?php if ($row['sex'] == "Male") echo "checked"?> required>
                            <label class="inline" for="male">Male</label>
                            <input type="radio" class="form-check-input" id="female" name="sex" value="Female" <?php if ($row['sex'] == "Female") echo "checked"?> required>
                            <label class="inline" for="female">Female</label>
                    </fieldset>
                </div>
                <br>
                <div>
                    <label class="inline" for="occupation">Occupation: </label>
                    <input type="text" id="occupation" name="occupation" maxlength="30" value="<?php echo $row["occupation"]?>">
                </div>
                <div>
                    <label class="inline" for="race">Race: </label>
                    <input type="text" id="race" name="race" maxlength="20" value="<?php echo $row["race"]?>">
                </div>
                <div>
                <label class="inline" for="religion">Religion: </label>
                <input type="text" id="religion" name="religion" maxlength="20" value="<?php echo $row["religion"]?>">
                </div>
                <div>
                    <label class="inline" for="marital_status">Marital Status: </label>
                    <select id="marital_status" name="marital_status">
                        <option value="" selected disabled hidden>--Please Select--</option>
                        <option value="Married" <?php if ($row['marital_status'] == "Married") echo "selected"?>>Married</option>
                        <option value="Widowed" <?php if ($row['marital_status'] == "Widowed") echo "selected"?>>Widowed</option>
                        <option value="Seperated" <?php if ($row['marital_status'] == "Seperated") echo "selected"?>>Seperated</option>
                        <option value="Divorced" <?php if ($row['marital_status'] == "Divorced") echo "selected"?>>Divorced</option>
                        <option value="Single" <?php if ($row['marital_status'] == "Single") echo "selected"?>>Single</option>
                    </select>
                </div>
                
                
                <p>Next Of Kin</p>
                <div>       
                    <label class="inline" for="next_of_kin">Name: </label>
                    <input type="text" id="next_of_kin" maxlength="70" name="next_of_kin" value="<?php echo $row["next_of_kin"]?>" required>
                </div>
                <div>
                    <label class="inline" for="relationship">Relationship: </label>
                    <input type="text" id="relationship" name="relationship" maxlength="20" value="<?php echo $row["relationship"]?>">
                </div>
                <div>
                    <label class="inline" for="telephone_nok">Telephone: </label>
                    <input type="tel" id="telephone_nok" name="telephone_nok" maxlength="15" value="<?php echo $row["telephone_nok"]?>">
                </div>
                <div>
                <label class="inline" for="package">Package</label>
                    <select id="package" name="package" required>
                        <option value = "" selected disabled hidden>--Please Select--</option>
                        <option value = "Essential" <?php if ($row['package'] == "Essential") echo "selected"?>>Essential(No Add-Ons)</option>
                        <option value = "Comprehensive" <?php if ($row['package'] == "Comprehensive") echo "selected"?>>Comprehensive(No Add-Ons)</option>
                        <option value = "Premium" <?php if ($row['package'] == "Premium") echo "selected"?>>Premium(No Add-Ons)</option>
                        <option value = "Custom" <?php if ($row['package'] == "Custom") echo "selected"?>>Custom</option>
                    </select>
                </div>
                <br>
                <div>
                    <label class="inline" for="addons">Additional Test: </label>
                    <textarea type="text" id="addons" maxlength="100" placeholder="*MENTION THE PACKAGE CHOSEN IF CUSTOM" name="addons" rows="4" cols="50"><?php echo $row["addons"]?></textarea>
                </div>
                <br><br>
                <div style="text-align: center;">
                    <input type="reset" class="btn btn-danger" value="Reset">
                    <input type="submit" class="btn btn-primary" value="Submit">
                </div>
                <br>
        </form>
        
        <?php
                }
            }
            else{
                echo "Patient does not exist in system.";
            }
        }
        else
        {
            echo "<script type='text/javascript'>";
            echo "alert('Session does not exist. Please login again');";
            echo "window.location.href = 'log-in.html';";
            echo "</script>";
        }   
        ?>
        </div>
    </body>
</html>