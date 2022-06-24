<!DOCTYPE html>
<html>
    <head>
        <title>Patient's Record</title>
        <link rel="stylesheet" href="test.css">
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

            $display = "SELECT a.mrn, name, ic_passport, address, email, lastUpdateMH, lastUpdate, registeredOn, package  FROM patient a, record b WHERE a.mrn = b.mrn";
            $data = $conn->query($display);
        ?>
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <script>
            $(document).ready(function () {
                var table = $('#example').DataTable();
                $('#example tbody').on('click', 'tr', function () {
                    if ($(this).hasClass('selected')) {
                        $(this).removeClass('selected');
                    }
                    else {
                        table.$('tr.selected').removeClass('selected');
                        $(this).addClass('selected');
                    }
                });
            });
    </script>
    </script>
    </head>

    <body>
        <div class="button">
            <a href="homepage.html"><img src="home.png" height="40px" width="40px"></a>
        </div>
        <h1>Patient's Record</h1>
        <table style="width: 100%;" id="example" class="display">
            <thead>
                <tr>
                    <th rowspan="2">MRN</th>
                    <th rowspan="2">Name</th>
                    <th rowspan="2">I/C No/Passport</th>
                    <th rowspan="2">Address</th>
                    <th rowspan="2">Email</th>
                    <th colspan="4">Last Updated On</th>
                    <th rowspan="2">Registered On</th>
                    <th rowspan="2">Package</th>
                </tr>
                <tr>
                    <th colspan="2">Medical History</th>
                    <th colspan="2">Report Form</th>
                </tr>
            </thead>
        <?php
        if ($data->num_rows > 0)
        {
            while($row = $data->fetch_assoc())
            {
        ?> 
            <tbody class="whitebody">
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
        }
        else
        {
            echo "<tr><td colspan = '8'>No Patient Found</td></tr>";
        }
        ?>
        </table>
        <?php
        $conn->close();
        ?>
    </body>
</html>