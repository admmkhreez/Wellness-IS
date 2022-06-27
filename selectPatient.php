<!DOCTYPE html>
<html>
    <?php
        session_start();
        if(isset($_SESSION["username"])) {
    ?>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="test.css">
    </head>
    <body>
        <div class="button">
            <a href="homepage.php"><img src="home.png" height="40px" width="40px"></a>
        </div>
        <h1>Medical Report</h1>
        <form action="editProfile.php" method="post">
            Enter Patient's MRN <input type="text" name="mrn" maxlength="10" required autofocus><br><br>
            <input type="submit" value="Update Patient's Details">
            <button formaction="viewPatient.php">View Details</button>
            <button formaction="historyForm.php">Update Medical History</button>
            <button formaction="recordUpdateForm.php">Update Medical Report</button>
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