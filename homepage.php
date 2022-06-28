<!DOCTYPE html>
<html>
    <?php
        session_start();
        if(isset($_SESSION["username"])) {
    ?>
    <head>
        <meta charset="UTF-8">
        <title>Wellness Information System</title>
        <link rel="stylesheet" href="test.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>
    <body>
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            <div class="container-fluid">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="homepage.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="viewRecord.php">View Latest Patients</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="selectRecord.php">Fill form</a>
                    </li>
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
        <h1>KPJ Klang Wellness Information System</h1>
        <br><br>
        <h2 style="color:white; text-align:center;">Register Patient</h2>
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
                    <option value = "Essential">Essential(No Add-Ons)</option>
                    <option value = "Comprehensive">Comprehensive(No Add-Ons)</option>
                    <option value = "Premium">Premium(No Add-Ons)</option>
                    <option value = "Custom">Custom</option>
                </select><br><br>
                <div style="text-align: center;">
                    <input type="reset" class="btn btn-danger" value="Reset">
                    <input type="submit" class="btn btn-primary" value="Register">
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