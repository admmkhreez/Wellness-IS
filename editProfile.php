<!DOCTYPE html>
<html>
    <?php
        session_start();
        if(isset($_SESSION["type"])) {
    ?>
    <head>
        <meta charset="UTF-8">
        <title>Patient Registration</title>
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

            $display = "SELECT * FROM patient WHERE mrn = '".$mrn."'";
            $data = $conn->query($display);
        ?>
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
            <br>
            <h1>Health Screening Services</h1>
            <div class="container">
        <?php
            if($data->num_rows > 0){
                while($row = $data->fetch_assoc()){
        ?>
        
            <form action="updateDetails.php" method="post">
            
                <p>Patient's Information</p>
                <div>
                    <label for="mrn">MRN: </label>
                    <input type="text" id="mrn" maxlength="10" name="mrn" value="<?php echo $row["mrn"]?>" required>
                </div>
                <div>
                    <label for="name">Name: </label>
                    <input type="text" id="name" maxlength="70" name="name" value="<?php echo $row["name"]?>" required>
                </div>
                <div>
                    <label for="icpp">I/C No / Passport: </label>
                    <input type="text" id="icpp"maxlength="12" name="icpp" value="<?php echo $row["ic_passport"]?>" required>
                </div>
                <div>
                    <label for="dob">Date of Birth: </label>
                    <input type="date" id="dob" name="dob" value="<?php echo $row["date_of_birth"]?>" required>
                </div>
                <div>
                    <label for="address">Home Address:</label><br>
                    <textarea type="text" id="address" maxlength="100" name="address" rows="4" cols="50" required><?php echo $row["address"]?></textarea>
                </div>
                <div>
                    <label for="email">E-mail Address: </label>
                    <input type="email" id="email" maxlength="320" name="email" value="<?php echo $row["email"]?>">
                </div>
                <div>
                    <label for="telephone">Telephone: </label>
                    <input type="tel" id="telephone" maxlength="15" name="tel" value="<?php echo $row["telephone"]?>">
                </div>
                <div>
                    <fieldset>
                        <legend>Sex: </legend>
                            <input type="radio" id="male" name="sex" value="Male" <?php if ($row['sex'] == "Male") echo "checked"?> required>
                            <label for="male">Male</label>
                            <input type="radio" id="female" name="sex" value="Female" <?php if ($row['sex'] == "Female") echo "checked"?> required>
                            <label for="female">Female</label>
                    </fieldset>
                </div>
                <div>
                    <label for="occupation">Occupation: </label>
                    <input type="text" id="occupation" name="occupation" maxlength="30" value="<?php echo $row["occupation"]?>">
                </div>
                <div>
                    <label for="race">Race: </label>
                    <input type="text" id="race" name="race" maxlength="20" value="<?php echo $row["race"]?>">
                </div>
                <div>
                <label for="religion">Religion: </label>
                <input type="text" id="religion" name="religion" maxlength="20" value="<?php echo $row["religion"]?>">
                </div>
                <div>
                    <label for="marital_status">Marital Status: </label>
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
                    <label for="next_of_kin">Name: </label>
                    <input type="text" id="next_of_kin" maxlength="70" name="next_of_kin" value="<?php echo $row["next_of_kin"]?>" required>
                </div>
                <div>
                    <label for="relationship">Relationship: </label>
                    <input type="text" id="relationship" name="relationship" maxlength="20" value="<?php echo $row["relationship"]?>">
                </div>
                <div>
                    <label for="telephone_nok">Telephone: </label>
                    <input type="tel" id="telephone_nok" name="telephone_nok" maxlength="15" value="<?php echo $row["telephone_nok"]?>">
                </div>
                <div>
                <label for="package">Package</label>
                    <select id="package" name="package" required>
                        <option value = "" selected disabled hidden>--Please Select--</option>
                        <option value = "Essential" <?php if ($row['package'] == "Essential") echo "selected"?>>Essential</option>
                        <option value = "Comprehensive" <?php if ($row['package'] == "Comprehensive") echo "selected"?>>Comprehensive</option>
                        <option value = "Premium" <?php if ($row['package'] == "Premium") echo "selected"?>>Premium</option>
                        <option value = "Custom" <?php if ($row['package'] == "Custom") echo "selected"?>>Custom</option>
                    </select><br><br>
                </div>
                <div style="text-align: center;">
                    <input type="reset" class="btn btn-danger" value="Reset">
                    <input type="submit" class="btn btn-primary" value="Submit">
                </div>
            
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
            echo "No session exist or session has expired. Please log in again.<br>";
            echo "<a href=log-in.html> Login </a>";
        }   
        ?>
        </div>
    </body>
</html>