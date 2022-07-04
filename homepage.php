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
        <nav class="navbar sticky-top navbar-expand-sm bg-dark navbar-dark">
            <div class="container-sm">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="homepage.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="viewRecord.php">Patient's Record</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="selectRecord.php">Fill form</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="selectPatient.php">Search Patient</a>
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
                <a class="nav-link" href="logout.php">Logout</a>
            </div>
        </nav>
        <br>
        <h1>KPJ Klang Wellness Information System</h1>
        <br><br>
        <h2  style="color: white; text-align:center;">Register Patient</h2>
        <br>
        <form action="insertRegister.php" method="post">
            <div class="container">
                <h5>Patient's Information</h5>
                <hr>
                <label class="inline" for="mrn">MRN: </label>
                <input type="text" id="mrn" maxlength="10" placeholder="MRN" name="mrn" required><br>
                <label class="inline" for="name">Name: </label>
                <input type="text" id="name" maxlength="70" placeholder="Name" name="name" required><br>
                <label class="inline" for="icpp">I/C No or Passport: </label>
                <input type="text" id="icpp"maxlength="12" placeholder="IC / Passport" name="icpp" required><br>
                <label class="inline" for="dob">Date of Birth: </label>
                <input type="date" id="dob" name="dob" required><br>
                <label class="inline" for="address">Home Address:</label>
                <textarea type="text" id="address" maxlength="100" name="address" rows="4" cols="50" required></textarea><br>
                <label class="inline" for="email">E-mail Address: </label>
                <input type="email" id="email" maxlength="320" placeholder="Email" name="email"><br>
                <label class="inline" for="telephone">Telephone: </label>
                <input type="tel" id="telephone" name="telephone" placeholder="Telephone" maxlength="15"><br>
                <fieldset>
                <legend>Sex:</legend>
                    <input type="radio" class="form-check-input" id="male" name="sex" value="Male"required>
                    <label class="inline-radio" for="male">Male</label>
                    <input type="radio" class="form-check-input" id="female" name="sex" value="Female"required>
                    <label class="inline-radio" for="female">Female</label>
                </fieldset><br>
                <label class="inline" for="occupation">Occupation: </label>
                <input type="text" id="occupation" name="occupation" placeholder="Occupation" maxlength="30"><br>
                <label class="inline" for="race">Race: </label>
                <input type="text" id="race" name="race" placeholder="Race" maxlength="20"><br>
                <label class="inline" for="religion">Religion: </label>
                <input type="text" id="religion" name="religion" placeholder="Religion" maxlength="20"><br>
                <label class="inline" for="marital_status">Marital Status: </label>
                <select id="marital_status" name="marital_status">
                    <option value="">--Please Select--</option>
                    <option value="Married">Married</option>
                    <option value="Widowed">Widowed</option>
                    <option value="Seperated">Seperated</option>
                    <option value="Divorced">Divorced</option>
                    <option value="Single">Single</option>
                </select>
                
                
                <p>Next Of Kin</p>
                <label class="inline" for="next_of_kin">Name: </label>
                <input type="text" id="next_of_kin" maxlength="70" placeholder="Next of kin Name" name="next_of_kin" required><br>
                <label class="inline" for="relationship">Relationship: </label>
                <input type="text" id="relationship" name="relationship" placeholder="Relationship" maxlength="20"><br>
                <label class="inline" for="telephone_nok">Telephone: </label>
                <input type="tel" id="telephone_nok" name="telephone_nok" placeholder="Telephone" maxlength="15"><br>
                
                <label class="inline" for="package">Package</label>
                <select id="package" name="package" required>
                    <option value = "" selected disabled hidden>--Please Select--</option>
                    <option value = "Essential">Essential(No Add-Ons)</option>
                    <option value = "Comprehensive">Comprehensive(No Add-Ons)</option>
                    <option value = "Premium">Premium(No Add-Ons)</option>
                    <option value = "Custom">Custom</option>
                </select>
                <br>
                <label class="inline" for="addons">Additional Test: </label>
                <textarea type="text" id="addons" placeholder="*MENTION THE PACKAGE CHOSEN IF CUSTOM" maxlength="100" name="addons" rows="4" cols="50"></textarea><br>
                <br><br>
                <div style="text-align: center;">
                    <input type="reset" class="btn btn-danger" value="Reset">
                    <input type="submit" class="btn btn-primary" value="Register">
                </div>
            </div>
        </form>
        <br><br>
    </body>
    <?php
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