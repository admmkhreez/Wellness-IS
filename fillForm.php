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
        <link rel="stylesheet" href="wellness.css">
        <link rel="stylesheet" href="bootstrap.css">
    </head>
    <body style="text-align: center;">
        <nav class="navbar sticky-top navbar-expand-sm bg-dark navbar-dark">
            <div class="container-sm">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="homepage.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="viewPatient.php">View Patient List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="fillForm.php">Fill Record</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="selectPatient.php">Search Patient</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="viewReport.php">View Patient's Report</a>
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
                    <a class="nav-link btn btn-danger" href="logout.php" style="color: white; font-weight: 700;">Logout</a>
            </div>
        </nav>
        <br>
        <h1>Fill Record</h1>
        <br>
        <div class="container">
            <form action="recordForm.php" method="post">
            <label for="mrn">Enter Patient's MRN</label><br>
            <input type="text" id="mrn" name="mrn" maxlength="10" required autofocus><br>
        <?php
            if($_SESSION["type"] == "admin" or $_SESSION["type"] == "doctor"){
        ?>
            <input class="btn btn-primary" type="submit" value="Insert Record">
        <?php
            }
        ?>
            <button formaction="historyForm.php" class="btn btn-primary">Insert Medical History</button>
            </form>
        </div>
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