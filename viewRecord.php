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

            $conn = new mysqli($servername, $username, $password, $db);

            if ($conn->connect_error)
            {
                die("Connection failed: " . $conn->connect_error);
            }
        ?>
        <body>
            <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
                <div class="container-fluid">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="homepage.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="viewRecord.php">View Patients</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="selectRecord.php">Fill form</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="selectPatient.php">Search Patient</a>
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
                    <a class="nav-link" href="logout.php">Logout</a>
                </div>
            </nav>
            <br>
            <h1>Patient's Record</h1>
            <br>
            <form method="post" style="text-align: center;">
                <input type="text" placeholder="MRN/Name/IC/Passport/Email" name="keyword">
                <button formaction="searchRecord.php" class="btn btn-primary">Search</button>
            </form>
            <br><br>
        <?php    
            $query = "SELECT a.mrn, name, ic_passport, address, email, lastUpdateMH, lastUpdate, registeredOn, package  FROM patient a, record b WHERE a.mrn = b.mrn ORDER BY registeredOn DESC LIMIT 10";
            $data = $conn->query($query);
        ?>
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
            <?php
            $per_page_record = 5;  // Number of entries to show in a page.   
            // Look for a GET variable page if not found default is 1.        
            if (isset($_GET["page"])) {    
                $page  = $_GET["page"];    
            }    
            else {    
              $page=1;    
            }    
        
            $start_from = ($page-1) * $per_page_record;     
        
            $query = "SELECT a.mrn, name, ic_passport, address, email, lastUpdateMH, lastUpdate, registeredOn, package  FROM patient a, record b WHERE a.mrn = b.mrn ORDER BY registeredOn DESC LIMIT ". $start_from. ", " .$per_page_record;
            $rs_result = mysqli_query ($conn, $query);     

            while ($row = mysqli_fetch_array($rs_result)) {  
            ?> 
                <tbody style="background-color:white;">
                    <tr>
                        <td><?php echo $row['mrn'];?></td>
                        <td><?php echo $row['name'];?></td>
                        <td><?php echo $row['ic_passport'];?></td>
                        <td><?php echo $row['address'];?></td>
                        <td><?php echo $row['email'];?></td>
                        <td colspan="2"><?php echo $row['lastUpdateMH'];?></td>
                        <td colspan="2"><?php echo $row['lastUpdate'];?></td>
                        <td><?php echo $row['registeredOn'];?></td>
                        <td><?php echo $row['package'];?></td>
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
                
                echo "</br>";     
                // Number of pages required.   
                $total_pages = ceil($total_records / $per_page_record);     
                $pagLink = "";       

                echo "<nav aria-label='page nav'>";
                echo "<ul class='pagination justify-content-center'>";
                if($page>=2){   
                    echo "<li class='page-item'><a class='page-link' href='viewRecord.php?page=".($page-1)."'>  Prev </a></li>";   
                }       
                        
                for ($i=1; $i<=$total_pages; $i++) {   
                if ($i == $page) {   
                    $pagLink .= "<li class='page-item active'><a class ='page-link' href='viewRecord.php?page=" .$i."'>".$i." </a> </li>"; 
                                                          
                }               
                else  {   
                    $pagLink .= "<li class='page-item'><a class='page-link' href='viewRecord.php?page=".$i."'> ".$i." </a> </li>";  
                                                             
                }   
                };     
                echo $pagLink;   
        
                if($page<$total_pages){   
                    echo "<li class='page-item'><a class='page-link' href='viewRecord.php?page=".($page+1)."'>  Next </a></li>";   
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