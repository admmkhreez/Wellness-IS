<!DOCTYPE html>
<html>
    <?php
        session_start();
        if(isset($_SESSION["username"])) {
    ?>
    <head>
        <title>KPJ Klang Wellness IS</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="wellness.css">
        <link rel="stylesheet" href="bootstrap.css">
    </head>
    <?php
        $mrn = $_POST["mrn"];
        $smoker = $_POST["smoker"];
        $asthma = $_POST["asthma"];
        $diabetes = $_POST["diabetes"];
        $heart = $_POST["heart_disease"];
        $hypertension = $_POST["hypertension"];
        $stroke = $_POST["stroke"];
        $cancer = $_POST["cancer"];
        $tb = $_POST["tuberculosis"];
        $skin = $_POST["skin_disease"];
        $kidneyp = $_POST["kidneyp"];
        $fits = $_POST["fits_psychiatric"];
        $father = $_POST["father_history"];
        $mother = $_POST["mother_history"];
        $siblings = $_POST["siblings_history"];
        $habits = $_POST["habits"];
        $allergy = $_POST["allergy"];
        $others = $_POST["others"];
        $medication = $_POST["medication"];
    ?>
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
                        <a class="nav-link" href="selectPatient.php">Search</a>
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
            </div>
            <a class="btn btn-danger" href="logout.php" style="color: white; font-weight: 700; margin-right: 30px">Logout</a>
        </nav>
        <br>
        <h1 style='color: white;'>Medical History</h1>
        <br>
        <div class="container">
        <h3>Past Medical History</h3>
            <div>
            <dl class="row">
                <dt class="col-sm-3">Smoker/Non Smoker: </dt>
                <dd class="col-sm-9"><?php echo $smoker;?></dd>
                <dt class="col-sm-3">Asthma: </dt>
                <dd class="col-sm-9"><?php echo $asthma;?></dd>
                <dt class="col-sm-3">Diabetes: </dt>
                <dd class="col-sm-9"><?php echo $diabetes;?></dd>
                <dt class="col-sm-3">Heart Disease: </dt>
                <dd class="col-sm-9"><?php echo $heart;?></dd>
                <dt class="col-sm-3">Hypertension: </dt>
                <dd class="col-sm-9"><?php echo $hypertension;?></dd>
                <dt class="col-sm-3">Stroke: </dt>
                <dd class="col-sm-9"><?php echo $stroke;?></dd>
                <dt class="col-sm-3">Cancer: </dt>
                <dd class="col-sm-9"><?php echo $cancer;?></dd>
                <dt class="col-sm-3">Tuberculosis: </dt>
                <dd class="col-sm-9"><?php echo $tb;?></dd>
                <dt class="col-sm-3">Skin Disease: </dt>
                <dd class="col-sm-9"><?php echo $skin;?></dd>
                <dt class="col-sm-3">Kidney Problem: </dt>
                <dd class="col-sm-9"><?php echo $kidneyp;?></dd>
                <dt class="col-sm-3">Fits/Psychiatric: </dt>
                <dd class="col-sm-9"><?php echo $fits;?></dd>
            </dl>
            </div>
            <h3>Family History</h3>
            <div>
            <dl class="row">
                <dt class="col-sm-3">Father: </dt>
                <dd class="col-sm-9"><?php echo $father;?></dd>
                <dt class="col-sm-3">Mother: </dt>
                <dd class="col-sm-9"><?php echo $mother;?></dd>
                <dt class="col-sm-3">Siblings: </dt>
                <dd class="col-sm-9"><?php echo $siblings;?></dd>
                <dt class="col-sm-3">Habits: </dt>
                <dd class="col-sm-9"><?php echo $habits;?></dd>
                <dt class="col-sm-3">Allergy: </dt>
                <dd class="col-sm-9"><?php echo $allergy;?></dd>
                <dt class="col-sm-3">Others: </dt>
                <dd class="col-sm-9"><?php echo $others;?></dd>
                <dt class="col-sm-3">Medication: </dt>
                <dd class="col-sm-9"><?php echo $medication;?></dd>
            </dl>
            </div>
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
        
        $insert = "UPDATE patient SET smoker = '".$smoker."', asthma = '".$asthma."', diabetes = '".$diabetes."', heart_disease = '".$heart."', hypertension = '".$hypertension."', stroke = '".$stroke."', cancer = '".$cancer."', tuberculosis = '".$tb."', skin_disease = '".$skin."', kidneyp = '".$kidneyp."', fits_psychiatric = '".$fits."',
        father_history = '".$father."', mother_history = '".$mother."', siblings_history = '".$siblings."', habits = '".$habits."', allergy = '".$allergy."', others = '".$others."', medication = '".$medication."', lastUpdateMH = '".$date."' WHERE mrn = '".$mrn."'";
        if ($conn->query($insert) === TRUE)
        {
            echo "<p class='success'>Successfully updated medical history";
        }
        else
        {
            echo "Error: " . $insert . "<br>" . $conn->error;
        }
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
        <br><br><button class="btn btn-primary" onclick="window.location.href='homepage.php'">Back to Home Page</button>
        <form method="post">
            <input type="hidden" value="<?php echo $mrn;?>" name="mrn">
            <button formaction="selectRecord.php" class="btn btn-primary">View</button>
        </form>
        </div>
    </body>
</html>