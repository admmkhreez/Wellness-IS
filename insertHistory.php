<html>
    <?php
        session_start();
        if(isset($_SESSION["type"])) {
    ?>
    <head>
        <title>User Registration</title>
        <link rel="stylesheet" href="test.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            <div class="container-fluid">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="homepage.php">Home</a>
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
                </ul>
                <a class="nav-link" href="logout.php">Logout</a>
            </div>
        </nav>
        <br>
        <h1>Medical History</h1>
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
            echo "No session exist or session has expired. Please log in again.<br>";
            echo "<a href=log-in.html> Login </a>";
        }
    ?>
        <br><br><button class="btn btn-primary" onclick="window.location.href='homepage.php'">Back to Home Page</button>
        </div>
    </body>
</html>