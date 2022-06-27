<html>
    <head>
        <title>User Registration</title>
        <link rel="stylesheet" href="test.css">
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
        <div class="button">
            <a href="homepage.php"><img src="home.png" height="40px" width="40px"></a>
        </div>
        
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
    ?>
        <br><br><a href="homepage.php">Back to Home Page</a>
        </div>
    </body>
</html>