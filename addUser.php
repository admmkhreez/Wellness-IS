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
    <body>
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
        <h1>Patient Medical History</h1>
        <br>
        <div class="container">
            <form method="post" action="insertUser.php">
                <label for="username" class="inline">Username</label>
                <input type="text" id="username" placeholder="Username" name="username" maxlength="15" required><br>
                <label for="password" class="inline">Password</label>
                <input type="password" id="password" placeholder="Password" name="password" maxlength="30" required><br>
                <label for="name" class="inline">Name</label>
                <input type="text" id="name" placeholder="Name" name="name" maxlength="40" required><br>
                <label for="position" class="inline">Position</label>
                <textarea type="text" id="position" name="position" placeholder="Position" maxlength="200" required></textarea><br>
                <label for="type" class="inline">User Type</label>
                <input type="text" id="type" placeholder="User Type *all lowercase" name="type" maxlength="10" required><br>
                <input type="submit" value="Add" class="btn btn-primary">
            </form>
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