<!DOCTYPE html>
<html>
    <?php
        session_start();
        if(isset($_SESSION["username"])) {
    ?>
    <head>
        <title>KPJ Klang Wellness IS</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="test.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>
        <?php
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
                <div class="container-sm">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="homepage.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="viewRecord.php">Patient's Record</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="selectRecord.php">Fill form</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="selectPatient.php">Search Patient</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="viewReport.php">Chronological Summary</a>
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
            <h1>Patient's Record</h1>
            <br>
            <form method="post" style="text-align: center; color: white;">
                Between <input type="date" name="startDate"> And
                <input type="date" name="endDate">
                <button formaction="searchReport.php" class="btn btn-primary">Search</button>
            </form>
            <div class="text-center" style="color: white;" >
                Click <a href="viewRecord.php">here</a> if you want to search by keyword.
            </div>
            <br><br>
            <table style="width: 100%;" class="table table-bordered">
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
                        <th rowspan="2">

                        </th>
                    </tr>
                    <tr>
                        <th colspan="2">Medical History</th>
                        <th colspan="2">Report Form</th>
                    </tr>
                </thead>
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
        
            $query = "SELECT a.mrn, name, ic_passport, address, email, telephone, lastUpdateMH, lastUpdate, registeredOn, package  FROM patient a, record b WHERE a.mrn = b.mrn ORDER BY lastUpdate DESC LIMIT ". $start_from. ", " .$per_page_record;
            $rs_result = mysqli_query ($conn, $query);     

            while ($row = mysqli_fetch_array($rs_result)) {  
            ?> 
                <tbody style="background-color:white;">
                    <tr>
                        <td><?php echo $row['mrn'];?></td>
                        <td><?php echo $row['name'];?></td>
                        <td><?php echo $row['ic_passport'];?></td>
                        <td><?php echo nl2br($row['address']);?></td>
                        <td><?php echo $row['email'];?></td>
                        <td><?php echo $row['telephone'];?></td>
                        <td colspan="2"><?php echo $row['lastUpdateMH'];?></td>
                        <td colspan="2"><?php echo $row['lastUpdate'];?></td>
                        <td><?php echo $row['registeredOn'];?></td>
                        <td><?php echo $row['package'];?></td>
                        <td>
                            <form method="post">
                            <input type="hidden" name="mrn" value="<?php echo $row['mrn'];?>">
                            <button formaction="viewPatient.php" class="btn btn-primary">View</button>
                            </form>
                        </td>
                    </tr>
                </tbody>
            <?php
            }  
            ?>
            </table>
                <?php
                
                $query = "SELECT COUNT(*) FROM patient";     
                $rs_result = mysqli_query($conn, $query);     
                $row = mysqli_fetch_row($rs_result);     
                $total_records = $row[0];     
                $total_pages = ceil($total_records / $per_page_record); 
                $start = "";
                $end = "";
                if($total_records == 0){
                    echo "<span class='text-center' style='color:white;'>No Record Found</span>";
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
                    echo "<span style='color:white;'>Showing " .$start. '-' .$end. ' of ' . $total_records . " result(s).</span>";
                    echo "</br>"; 
                }            
                $pagLink = "";       

                echo "<nav aria-label='page nav'>";
                echo "<ul class='pagination justify-content-center'>";
                if($page>=2){   
                    echo "<li class='page-item'><a class='page-link' href='viewReport.php?page=".($page-1)."'>  Prev </a></li>";   
                }       
                        
                for ($i=1; $i<=$total_pages; $i++) {   
                if ($i == $page) {   
                    $pagLink .= "<li class='page-item active'><a class ='page-link' href='viewReport.php?page=" .$i."'>".$i." </a> </li>"; 
                                                          
                }               
                else  {   
                    $pagLink .= "<li class='page-item'><a class='page-link' href='viewReport.php?page=".$i."'> ".$i." </a> </li>";  
                                                             
                }   
                };     
                echo $pagLink;   
        
                if($page<$total_pages){   
                    echo "<li class='page-item'><a class='page-link' href='viewReport.php?page=".($page+1)."'>  Next </a></li>";   
                }  
                echo "</ul>";
                echo "</nav>";

                $conn->close();
                }
                else
                {
                    echo "No session exist or session has expired. Please log in again.<br>";
                    echo "<a href=log-in.html> Login </a>";
                }
                ?> 
        </body>
</html>