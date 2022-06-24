<html>
    <head>
        <title>User Registration</title>
        <link rel="stylesheet" href="test.css">
    </head>
    <?php
        $mrn = $_POST["mrn"];
        $name = $_POST["name"];
        $icpp = $_POST["icpp"];
        $dob = $_POST["dob"];
        $address = $_POST["address"];
        $email = $_POST["email"];
        $sex = $_POST["sex"];
        $occupation = $_POST["occupation"];
        $race = $_POST["race"];
        $religion = $_POST["religion"];
        $mstatus = $_POST["marital_status"];
        $nok = $_POST["next_of_kin"];
        $rs = $_POST["relationship"];
        $tel_nok = $_POST["telephone_nok"];
        $package = $_POST["package"];

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
    ?>
    <body>
        <div class="button">
            <a href="homepage.html"><img src="home.png" height="40px" width="40px"></a>
        </div>
        <h1>User Registration Details</h1>
        <div class="reference">
        <p>MRN: <?php echo $mrn;?></p>
        <p>Name: <?php echo $name;?></p>
        <p>I/C No/Passport: <?php echo $icpp;?></p>
        <p>Date of Birth: <?php echo $dob;?></p>
        <p>Home Address: <?php echo $address;?></p>
        <p>E-mail Address: <?php echo $email;?></p>
        <p>Sex: <?php echo $sex;?></p>
        <p>Occupation: <?php echo $occupation;?></p>
        <p>Race: <?php echo $race;?></p>
        <p>Religion: <?php echo $religion;?></p>
        <p>Marital Status: <?php echo $mstatus;?></p>
        <p>Next of Kin: <?php echo $nok;?></p>
        <p>Relationship: <?php echo $rs;?></p>
        <p>Telephone No.: <?php echo $tel_nok;?></p>
        <p>Package Selected: <?php echo $package;?></p>
        </div>
    </body>
    <?php
        
        $insert = "UPDATE patient SET name = '".$name."', ic_passport = '".$icpp."', date_of_birth = '".$dob."', address = '".$address."', email = '".$email."', 
        sex = '".$sex."', occupation = '".$occupation."', race = '".$race."', religion = '".$religion."', marital_status = '".$mstatus."', next_of_kin = '".$nok."', relationship = '".$rs."',
        telephone_nok = '".$tel_nok."', package = '".$package."' WHERE mrn = '".$mrn."'";

        if ($conn->query($insert) === TRUE)
        {
            echo "<div class='success'>Successfully registered patient</div>";
        }
        else
        {
            echo "Error : " . $conn->error;
        }
        $conn->close();
    ?>
    <br><a href="homepage.html">Back to Home Page</a>
</html>