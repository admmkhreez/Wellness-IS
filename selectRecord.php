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
        <link rel="stylesheet" href="test.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>
    <body>
        <?php
            $mrn = $_POST["mrn"];

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
                            <a class="nav-link" href="fillForm.php">Fill form</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="selectPatient.php">Search Patient</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="viewReport.php">Chronological Summary</a>
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
        <h1>Select Record</h1>
        <br>
        <div class="container">
        <form method="post" style="text-align: center;">
            <label for="mrn">Enter Patient's MRN</label><br>
            <input type="text" id="mrn" name="mrn" maxlength="10" required autofocus><br>
            <button formaction="selectRecord.php" class="btn btn-primary">Search</button>
        </form>
        <br>
        <?php 
            $check ="SELECT mrn FROM patient WHERE mrn = '".$mrn."'";
            $data = $conn->query($check);

            if($data->num_rows > 0)
            {
                while ($row = $data->fetch_assoc())
                {
        ?>
                    <form method="post" action="editProfile.php" style="text-align: center;">
                        <h5>MRN: <?php echo $mrn;?></h5>
                        <input type="submit" value="View Profile" class="btn btn-primary">
                        <button formaction="historyUpdateForm.php" class="btn btn-primary">Update Medical History</button>  
                        <input type="hidden" name="mrn" value="<?php echo $mrn;?>">
                    </form>
        <?php
                }
            }
                    else
                    {
        ?>
                        <p>Patient does not exist, register <a href="homepage.php">here</a></p>
        <?php 
                    }
        ?>
        </div>
        <br>
        <div>    
            <h3 style="color: white; text-align: center;">Records History</h3>
            <table style="width: 100%;" class="table table-bordered">
                <thead class="table-dark" style="text-align:center;">
                    <tr>
                        <th rowspan="2">
                            No.
                        </th>
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
                            Email
                        </th>
                        <th rowspan="2">
                            Telephone
                        </th>
                        <th rowspan="2">
                            Screening Date
                        </th>
                        <th rowspan="2">
                            Package
                        </th>
                        <th rowspan="2">

                        </th>
                    </tr>
                </thead>
                <tbody style="background-color:white;">
                <?php
                    $per_page_record = 1;  // Number of entries to show in a page.   
                    // Look for a GET variable page if not found default is 1.        
                    if (isset($_GET["page"])) {    
                        $page  = $_GET["page"];    
                    }    
                    else {    
                    $page=1;    
                    }    
                
                    $start_from = ($page-1) * $per_page_record;     
                
                    $query = "SELECT a.mrn, name, ic_passport, email, telephone, lastUpdate, b.package, visits  FROM patient a, record b WHERE a.mrn = $mrn and b.mrn = $mrn ORDER BY lastUpdate DESC LIMIT ". $start_from. ", " .$per_page_record;
                    $rs_result = mysqli_query ($conn, $query);     
                    $i = 1;
                    while ($row = mysqli_fetch_array($rs_result)) {  
                ?> 
                    <tr>
                        <td>
                            <?php echo $i;?>
                        </td>
                        <td>
                            <?php echo $row["mrn"];?>
                        </td>
                        <td>
                            <?php echo $row["name"];?>
                        </td>
                        <td>
                            <?php echo $row["ic_passport"];?>
                        </td>
                        <td>
                            <?php echo $row["email"];?>
                        </td>
                        <td>
                            <?php echo $row["telephone"];?>
                        </td>
                        <td>
                            <?php echo $row["lastUpdate"];?>
                        </td>
                        <td>
                            <?php echo $row["package"];?>
                        </td>
                        <td>
                            <form method="post">
                                <input type="hidden" name="mrn" value="<?php echo $row["mrn"];?>">
                                <input type="hidden" name="visits" value="<?php echo $row["visits"];?>">
                                <button formaction="viewDetails.php" class="btn btn-primary">View</button>
                            </form>
                        </td>
                    </tr>
                <?php
                    $i++;
                    }
                ?>
                </tbody>
            </table>
        </div>
            <?php
                $query = "SELECT COUNT(*) FROM record WHERE mrn = $mrn";     
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
                    echo "<li class='page-item'><form method='post'><input type='hidden' value='$mrn' name='mrn'><button class='page-link' formaction='selectRecord.php?page=".($page-1)."'>  Prev </button></form></li>";   
                }       
                        
                for ($i=1; $i<=$total_pages; $i++) {   
                if ($i == $page) {   
                    $pagLink .= "<li class='page-item active'><form method='post'><input type='hidden' value='$mrn' name='mrn'><button class='page-link' formaction='selectRecord.php?page=" .$i."'>".$i." </button></form></li>"; 
                                                          
                }               
                else  {   
                    $pagLink .= "<li class='page-item'><form method='post'><input type='hidden' value='$mrn' name='mrn'><button class='page-link' formaction='selectRecord.php?page=".$i."'> ".$i." </button></form></li>";  
                                                             
                }   
                };     
                echo $pagLink;   
        
                if($page<$total_pages){   
                    echo "<li class='page-item'><form method='post'><input type='hidden' value='$mrn' name='mrn'><button class='page-link' formaction='selectRecord.php?page=".($page+1)."'>  Next </button></form></li>";   
                }  
                echo "</ul>";
                echo "</nav>";
            ?>
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