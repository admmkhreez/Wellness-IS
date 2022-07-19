<!DOCTYPE html>
<html>
    <?php
        session_start();
        if(isset($_SESSION["username"])) {
    ?>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            .unstyled-button {
                border: none;
                padding: 0;
                background: none;
                text-decoration: underline;
                color: blue;
            }
        </style>
        <title>KPJ Klang Wellness IS</title>
        <link rel="stylesheet" href="wellness.css">
        <link rel="stylesheet" href="bootstrap.css">
    </head>
    <body>
        <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $db = "wellness_is";
            date_default_timezone_set("Asia/Kuala_Lumpur");
            $date = date("Y-m-d H:i:s");
            $conn = new mysqli($servername, $username, $password, $db);
    
            if ($conn->connect_error)
            {
                die("Connection failed: " . $conn->connect_error);
            }
        ?>
        <nav class="navbar sticky-top navbar-expand-sm bg-dark navbar-dark">
        <span class="nav-item" style="padding-left: 10px;color: white;"><?php echo $_SESSION["name"];?></span>
            <div class="container-sm">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="homepage.php">Home</a>
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
        <h1 style="color: white;">KPJ Klang Wellness Information System</h1>
        <h2  style="text-align:center; color: white;">Register Patient</h2>
        <br>
        <div class="container">
            <form action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="post" style="margin-left: 40px;">
                <label class="inline" for="mrn">MRN: </label>
                <input type="text" id="mrn" maxlength="10" placeholder="MRN" name="mrn" required autofocus>
                <input type="submit" name="check" class="btn btn-primary" value="Check"><br>
            </form>
        <?php
            if(isset($_POST["check"])){
                $mrn = $_POST["mrn"];
                $check = "SELECT mrn FROM patient WHERE mrn = '".$mrn."'";
                $data = $conn->query($check);
                if ($data->num_rows>0)
                {
                    while($row=$data->fetch_assoc())
                    {
        ?>
                    <br>
                    <form method="post">
                        <p>MRN <?php echo $mrn;?> is already registered view <button class="unstyled-button" formaction="selectRecord.php">here</button></p>
                        <input type="hidden" name="mrn" value="<?php echo $mrn?>">
                    </form>
        <?php
                    }
                }
                else
                {
        ?>
            
            <?php
                if(isset($mrn)){    
            ?>
                <form action="insertRegister.php" method="post">
                <h5>Patient's Information</h5>
                <hr>
                <label for="mrn" class="inline">MRN:</label>
                <span id="mrn"><?php echo $mrn;?></span>
                <br>
                <label class="inline" for="name">Name: </label>
                <input type="text" id="name" maxlength="70" placeholder="Name" name="name" required><br>
                <label class="inline" for="icpp">I/C No or Passport: </label>
                <input type="text" id="icpp"maxlength="12" placeholder="IC / Passport" name="icpp" required><br>
                <label class="inline" for="dob">Date of Birth: </label>
                <input type="date" id="dob" name="dob" required><br>
                <div class="textfield">
                    <label class="inline" for="address">Home Address:</label>
                    <textarea type="text" id="address" maxlength="100" placeholder="Address" name="address" rows="4" cols="50" required></textarea><br>
                </div>
                <label class="inline" for="email">E-mail Address: </label>
                <input type="email" id="email" maxlength="320" placeholder="Email" name="email"><br>
                <label class="inline" for="telephone">Telephone: </label>
                <input type="tel" id="telephone" name="telephone" placeholder="Telephone" maxlength="15"><br>
                <fieldset>
                <legend>Sex:</legend>
                    <input type="radio" class="form-check-input" id="male" name="sex" value="Male" required>
                    <label class="inline-radio" for="male">Male</label>
                    <input type="radio" class="form-check-input" id="female" name="sex" value="Female" required>
                    <label class="inline-radio" for="female">Female</label>
                </fieldset><br>
                <label class="inline" for="occupation">Occupation: </label>
                <input type="text" id="occupation" name="occupation" placeholder="Occupation" maxlength="30"><br>
                <label class="inline" for="race">Race: </label>
                <input type="text" id="race" name="race" placeholder="Race" maxlength="20" required><br>
                <label class="inline" for="religion">Religion: </label>
                <input type="text" id="religion" name="religion" placeholder="Religion" maxlength="20" required><br>
                <label class="inline" for="marital_status">Marital Status: </label>
                <select id="marital_status" name="marital_status" required>
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
                <div class="textfield" style="margin-top: 10px;">
                    <label class="inline" for="addons">Additional Test: </label>
                    <textarea type="text" id="addons" placeholder="*MENTION THE PACKAGE CHOSEN IF CUSTOM" maxlength="100" name="addons" rows="4" cols="50"></textarea><br>
                </div>
                <br><br>
                <div style="text-align: center;">
                    <input type="reset" class="btn btn-danger" value="Reset">
                    <input type="submit" class="btn btn-primary" value="Register">
                    <input type="hidden" value="<?php echo $mrn;?>" name="mrn">
                    
                </div>
                
            </form>
        <?php
                }
            }
        ?>
        
            <?php
                }
            ?>
        </div>
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