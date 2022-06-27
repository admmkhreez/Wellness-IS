<!DOCTYPE html>
<html>
    <?php
        session_start();
        if(isset($_SESSION["username"])) {
    ?>
    <head>
        <meta charset="UTF-8">
        <title>Patient Registration</title>
        <link rel="stylesheet" href="test.css">
    </head>
    <body>
        <div class="button">
            <a href="homepage.php"><img src="home.png" height="40px" width="40px"></a>
        </div>
            <h1>Health Screening Services</h1>
            <form action="insertRegister.php" method="post">
            <div class="container">
                <p>Patient's Information</p>
                <label for="mrn">MRN: </label><br>
                <input type="text" id="mrn" maxlength="10" placeholder="MRN" name="mrn" required><br>
                <label for="name">Name: </label><br>
                <input type="text" id="name" maxlength="70" placeholder="Name" name="name" required><br>
                <label for="icpp">I/C No or Passport: </label><br>
                <input type="text" id="icpp"maxlength="12" placeholder="IC / Passport" name="icpp" required><br>
                <label for="dob">Date of Birth: </label><br>
                <input type="date" id="dob" name="dob" required><br>
                <label for="address">Home Address:</label><br>
                <textarea type="text" id="address" maxlength="100" name="address" rows="4" cols="50" required></textarea><br>
                <label for="email">E-mail Address: </label><br>
                <input type="email" id="email" maxlength="320" placeholder="Email" name="email"><br>
                <fieldset>
                <legend>Sex:</legend>
                    <input type="radio" id="male" name="sex" value="Male"required>
                    <label for="male">Male</label>
                    <input type="radio" id="female" name="sex" value="Female"required>
                    <label for="female">Female</label><br>
                </fieldset>
                <label for="occupation">Occupation: </label><br>
                <input type="text" id="occupation" name="occupation" placeholder="Occupation" maxlength="30"><br>
                <label for="race">Race: </label><br>
                <input type="text" id="race" name="race" placeholder="Race" maxlength="20"><br>
                <label for="religion">Religion: </label><br>
                <input type="text" id="religion" name="religion" placeholder="Religion" maxlength="20"><br>
                <label for="marital_status">Marital Status: </label>
                <select id="marital_status" name="marital_status">
                    <option value="">--Please Select--</option>
                    <option value="Married">Married</option>
                    <option value="Widowed">Widowed</option>
                    <option value="Seperated">Seperated</option>
                    <option value="Divorced">Divorced</option>
                    <option value="Single">Single</option>
                </select>
                
                
                <p>Next Of Kin</p>
                <label for="next_of_kin">Name: </label><br>
                <input type="text" id="next_of_kin" maxlength="70" placeholder="Next of kin Name" name="next_of_kin" required><br>
                <label for="relationship">Relationship: </label><br>
                <input type="text" id="relationship" name="relationship" placeholder="Relationship" maxlength="20"><br>
                <label for="telephone_nok">Telephone: </label><br>
                <input type="tel" id="telephone_nok" name="telephone_nok" placeholder="Telephone" maxlength="15"><br>
                
                <label for="package">Package</label>
                <select id="package" name="package" required>
                    <option value = "" selected disabled hidden>--Please Select--</option>
                    <option value = "Essential">Essential</option>
                    <option value = "Comprehensive">Comprehensive</option>
                    <option value = "Premium">Premium</option>
                    <option value = "Custom">Custom</option>
                </select><br><br>
                <div style="text-align: center;">
                    <input type="reset" value="Reset">
                    <input type="submit" value="Register">
                </div>
            </div>
        
        </form>
    </body>
    <?php
        }
        else
        {
        echo "No session exists or session has expired. Please log in again.<br>";
        echo "<a href=log-in.html> Login </a>";
        }
    ?>
</html>