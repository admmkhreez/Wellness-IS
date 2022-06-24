<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Patient Registration</title>
        <link rel="stylesheet" href="test.css">
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

            if($data->num_rows > 0){
                while($row = $data->fetch_assoc()){
        ?>
        <div class="button">
            <a href="homepage.html"><img src="home.png" height="40px" width="40px"></a>
        </div>
            <h1>Health Screening Services</h1>
            <form action="updateDetails.php" method="post">
            <div class="container">
                <p>Patient's Information</p>
                <label for="mrn">MRN: </label>
                <input type="text" id="mrn" maxlength="10" name="mrn" value="<?php echo $row["mrn"]?>" required><br>
                <label for="name">Name: </label>
                <input type="text" id="name" maxlength="70" name="name" value="<?php echo $row["name"]?>" required><br>
                <label for="icpp">I/C No / Passport: </label>
                <input type="text" id="icpp"maxlength="12" name="icpp" value="<?php echo $row["ic_passport"]?>" required><br>
                <label for="dob">Date of Birth: </label>
                <input type="date" id="dob" name="dob" value="<?php echo $row["date_of_birth"]?>" required><br>
                <label for="address">Home Address:</label><br>
                <textarea type="text" id="address" maxlength="100" name="address" rows="4" cols="50" required><?php echo $row["address"]?></textarea><br>
                <label for="email">E-mail Address: </label>
                <input type="email" id="email" maxlength="320" name="email" value="<?php echo $row["email"]?>"><br>
                Sex:
                <input type="radio" id="male" name="sex" value="Male" <?php if ($row['sex'] == "Male") echo "checked"?> required>
                <label for="male">Male</label>
                <input type="radio" id="female" name="sex" value="Female" <?php if ($row['sex'] == "Female") echo "checked"?> required>
                <label for="female">Female</label><br>
                <label for="occupation">Occupation: </label>
                <input type="text" id="occupation" name="occupation" maxlength="30" value="<?php echo $row["occupation"]?>"><br>
                <label for="race">Race: </label>
                <input type="text" id="race" name="race" maxlength="20" value="<?php echo $row["race"]?>"><br>
                <label for="religion">Religion: </label>
                <input type="text" id="religion" name="religion" maxlength="20" value="<?php echo $row["religion"]?>"><br>
                <label for="marital_status">Marital Status: </label>
                <select id="marital_status" name="marital_status">
                    <option value="" selected disabled hidden>--Please Select--</option>
                    <option value="Married" <?php if ($row['marital_status'] == "Married") echo "selected"?>>Married</option>
                    <option value="Widowed" <?php if ($row['marital_status'] == "Widowed") echo "selected"?>>Widowed</option>
                    <option value="Seperated" <?php if ($row['marital_status'] == "Seperated") echo "selected"?>>Seperated</option>
                    <option value="Divorced" <?php if ($row['marital_status'] == "Divorced") echo "selected"?>>Divorced</option>
                    <option value="Single" <?php if ($row['marital_status'] == "Single") echo "selected"?>>Single</option>
                </select>
                
                
                <p>Next Of Kin</p>
                <label for="next_of_kin">Name: </label>
                <input type="text" id="next_of_kin" maxlength="70" name="next_of_kin" value="<?php echo $row["next_of_kin"]?>" required><br>
                <label for="relationship">Relationship: </label>
                <input type="text" id="relationship" name="relationship" maxlength="20" value="<?php echo $row["relationship"]?>"><br>
                <label for="telephone_nok">Telephone: </label>
                <input type="tel" id="telephone_nok" name="telephone_nok" maxlength="15" value="<?php echo $row["telephone_nok"]?>"><br>
                
                <label for="package">Package</label>
                <select id="package" name="package" required>
                    <option value = "" selected disabled hidden>--Please Select--</option>
                    <option value = "Essential" <?php if ($row['package'] == "Essential") echo "selected"?>>Essential</option>
                    <option value = "Comprehensive" <?php if ($row['package'] == "Comprehensive") echo "selected"?>>Comprehensive</option>
                    <option value = "Premium" <?php if ($row['package'] == "Premium") echo "selected"?>>Premium</option>
                    <option value = "Custom" <?php if ($row['package'] == "Custom") echo "selected"?>>Custom</option>
                </select><br><br>
                <input type="submit" value="Register"><br>
                <input type="reset" value="Reset">
            </div>
        </form>
        <?php
                }

            }
        
        ?>
    </body>
</html>