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
        <form action="recordForm.php" method="post">
        Enter Patient's MRN <input type="text" name="mrn" maxlength="10" required autofocus>
        <input type="submit" value="Update This Patient">
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