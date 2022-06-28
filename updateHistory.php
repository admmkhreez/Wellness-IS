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
        
        <h1>Patient Medical History</h1>
        <div class="container">
            <h3>Past Medical History</h3>
            <div class="reference">
                <p>MRN: <?php echo $mrn;?></p>
                <p>Smoker/Non Smoker: <?php echo $smoker;?></p>
                <p>Asthma: <?php echo $asthma;?></p>
                <p>Diabetes: <?php echo $diabetes;?></p>
                <p>Heart Disease: <?php echo $heart;?></p>
                <p>Hypertension: <?php echo $hypertension;?></p>
                <p>Stroke: <?php echo $stroke;?></p>
                <p>Cacner: <?php echo $cancer;?></p>
                <p>Tuberculosis: <?php echo $tb;?></p>
                <p>Skin Disease: <?php echo $skin;?></p>
                <p>Kidney Problem: <?php echo $kidneyp;?></p>
                <p>Fits / Psychiatric: <?php echo $fits;?></p>
            </div>
            <h3>Family History</h3>
            <div class="reference">
                <p>Father: <?php echo $father;?></p>
                <p>Mother: <?php echo $mother;?></p>
                <p>Siblings: <?php echo $siblings;?></p>
                <p>Habits: <?php echo $habits;?></p>
                <p>Allergy: <?php echo $allergy;?></p>
                <p>Others: <?php echo $others;?></p>
                <p>Medication: <?php echo $medication;?></p>
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