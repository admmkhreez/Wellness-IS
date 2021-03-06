<!DOCTYPE html>
<html>
    <?php
        session_start();
        if(isset($_SESSION["username"])) {
    ?>
    <head>
        <title>Reports</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="wellness.css">
        <link rel="stylesheet" href="bootstrap.css">
    </head>
        <?php
            $startDate = $_POST["startDate"];
            $endDate = $_POST["endDate"];
            $servername = "localhost";
            $username = "root";
            $password = "";
            $db = "wellness_is";
            date_default_timezone_set("Asia/Kuala_Lumpur");

            $conn = new mysqli($servername, $username, $password, $db);

            if ($conn->connect_error)
            {
                die("Connection failed: " . $conn->connect_error);
            }
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
                            <a class="nav-link active" href="viewRecords.php">Records</a>
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
            <h1 style='color: white; margin-bottom: 30px;'>Records</h1>
            <form method="post" style="text-align: center; color: white;">
                Between <input type="date" name="startDate" value="<?php echo $startDate;?>"> And
                <input type="date" name="endDate" value="<?php echo $endDate;?>">
                <button formaction="searchReport.php" class="btn btn-primary">Search</button>
            </form>
            <div class="text-center" style="color: white;">
                Click <a href="viewPatient.php">here</a> if you want to view patients list.
            </div>
                <br>
                <table style="width: 100%;" height="100%" class="table table-bordered">
                    <thead class="table-dark" style="text-align:center;">
                        <tr>
                            <th rowspan="2">
                                MRN
                            </th>
                            <th rowspan="2">
                                Name
                            </th>
                            <th rowspan="2">
                                I/C No/Passport
                            </th>
                            <th rowspan="2">
                                Address
                            </th>
                            <th rowspan="2">
                                Email
                            </th>
                            <th rowspan="2">
                                Telephone
                            </th>
                            <th colspan="4">
                                Last Updated On
                            </th>
                            <th rowspan="2">
                                Registered On
                            </th>
                            <th rowspan="2">
                                Package
                            </th>
                        </tr>
                        <tr>
                            <th colspan="2">Medical History</th>
                            <th colspan="2">Report Form</th>
                        </tr>
                    </thead>
                    <tbody style="background-color: #e3f0ff;">
                <?php
                $per_page_record = 10;  // Number of entries to show in a page.   
                // Look for a GET variable page if not found default is 1.        
                if (isset($_GET["page"])) {    
                    $page  = $_GET["page"];    
                }    
                else {    
                $page=1;    
                }    
            
                $start_from = ($page-1) * $per_page_record;     
            
                $query = "SELECT a.mrn, name, ic_passport, address, email, telephone, lastUpdateMH, b.lastUpdate, registeredOn, b.package, b.visits FROM patient a INNER JOIN record b
                ON a.mrn = b.mrn WHERE b.lastUpdate BETWEEN '".$startDate."' AND '".$endDate."' ORDER BY lastUpdate DESC LIMIT ". $start_from. ", " .$per_page_record;
                $rs_result = mysqli_query ($conn, $query);     

                while ($row = mysqli_fetch_array($rs_result)) {  
                ?> 
                        <tr>
                            <td><?php echo $row['mrn'];?></td>
                            <td><?php echo $row['name'];?></td>
                            <td><?php echo $row['ic_passport'];?></td>
                            <td><?php echo $row['address'];?></td>
                            <td><?php echo $row['email'];?></td>
                            <td><?php echo $row['telephone'];?></td>
                            <td colspan="2"><?php echo $row['lastUpdateMH'];?></td>
                            <td colspan="2"><?php echo $row['lastUpdate'];?></td>
                            <td><?php echo $row['registeredOn'];?></td>
                            <td><?php echo $row['package'];?></td>
                        </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>
            <?php
            $query = "SELECT COUNT(*) FROM patient a INNER JOIN record b
            ON a.mrn = b.mrn WHERE b.lastUpdate BETWEEN '".$startDate."' AND '".$endDate."'";     
            $rs_result = mysqli_query($conn, $query);     
            $row = mysqli_fetch_row($rs_result);     
            $total_records = $row[0];     
            $total_pages = ceil($total_records / $per_page_record); 
            $start = "";
            $end = "";
            if($total_records == 0){
                echo "<span class='text-center' style='color: white;'>No Record Found</span>";
            }
            else{
                $start = $per_page_record * ($page-1) + 1;
                if($total_records%$per_page_record != 0){
                    if($page == $total_pages){
                        $end = $total_records;
                    }
                    else{
                        $end = $per_page_record * ($page);
                    }
                }
                else{
                    $end = $per_page_record * ($page);
                }
                    echo "<span style='color: white;'>Showing " .$start. '-' .$end. ' of ' . $total_records . " result(s).</span>";
                    echo "</br>"; 
                }  
            $pagLink = "";       

            echo "<nav aria-label='page nav'>";
            echo "<ul class='pagination justify-content-center'>";
            if($page>=2){   
                echo "<li class='page-item'><form method='post'><input type='hidden' value='$startDate' name='startDate'><input type='hidden' value='$endDate' name='endDate'>
                <button class='page-link' formaction='searchReport.php?page=".($page-1)."'>  Prev </button></form></li>";   
            }       
                    
            for ($i=1; $i<=$total_pages; $i++) {   
            if ($i == $page) {   
                $pagLink .= "<li class='page-item active'><form method='post'><input type='hidden' value='$startDate' name='startDate'><input type='hidden' value='$endDate' name='endDate'>
                <button class='page-link' formaction='searchReport.php?page=" .$i."'>".$i." </button></form></li>"; 
                                                      
            }               
            else  {   
                $pagLink .= "<li class='page-item'><form method='post'><input type='hidden' value='$startDate' name='startDate'><input type='hidden' value='$endDate' name='endDate'>
                <button class='page-link' formaction='searchReport.php?page=".$i."'> ".$i." </button></form></li>";  
                                                         
            }   
            };     
            echo $pagLink;   
    
            if($page<$total_pages){   
                echo "<li class='page-item'><form method='post'><input type='hidden' value='$startDate' name='startDate'><input type='hidden' value='$endDate' name='endDate'>
                <button class='page-link' formaction='searchReport.php?page=".($page+1)."'>  Next </button></form></li>";   
            }  
            echo "</ul>";
            echo "</nav>";

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
        </body>
</html>