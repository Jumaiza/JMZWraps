<?php

session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>JMZ Wraps BSS</title>
    <style>
    body {
        background-image: url("cropped.jpg");
    }

    div.box {
        line-height: 2;
        text-align: center;
        margin: auto;
        width: 90%;
        background-color: #ffffff;
        border: 2px solid black;
        opacity: 0.8;
    }

    .button:hover {
        background-color: lightblue;
    }
    </style>
</head>

<body>
    <div class="box">
        <div class="topnav">
            <button onclick="location.href='Login.html'" class="button">Home</button>
            <button onclick="location.href='Search.php'" class="button">Search Your Client's Appointments</button>
            <button onclick="location.href='SearchOrders.php'" class="button">Search Your Client's Orders</button>
            <button onclick="location.href='Book.php'" class="button">Book a Client’s Appointment</button>
            <button onclick="location.href='Place.php'" class="button">Place a Client’s Order</button>
            <button onclick="location.href='Update.php'" class="button">Update a Client's Order</button>
            <button onclick="location.href='Cancel.php'" class="button">Cancel a Client's Appointemnt</button>
            <button onclick="location.href='CancelOrder.php'" class="button">Cancel a Client's Order</button>
            <button onclick="location.href='Create.php'" class="button">Create a Client's Account</button>
        </div>
        <h1>Your Client's Appointments</h1>
        <?php

        $servername = "sql1.njit.edu";
        $username = "zma4";
        $password = "Z_viper908";
        $dbname = "zma4";
        $con = mysqli_connect($servername, $username, $password, $dbname);

        $idName = $_SESSION["idSession"];

        $sql = "SELECT `it3`.*,`tbl2`.*,`tbl3`.*,`tbl4`.* 
        FROM `it3` 
        inner join `tbl3` on `it3`.`Stylist ID Number`='$idName' AND `tbl3`.`Stylist ID`='$idName'
        inner join `tbl2` on `tbl2`.`Client ID`=`tbl3`.`Client ID`
        inner join `tbl4` on `tbl4`.`Client ID`=`tbl2`.`Client ID` AND `tbl4`.`Stylist ID`='$idName'";

        $result = $con->query($sql);

        if ($result->num_rows > 0) {

            echo "<table><tr><th>Staff First Name</th><th>Staff Last Name</th><th>Staff ID</th><th>Staff Phone Number</th><th>Staff Email Address</th><th>Client First Name</th><th>Client Last Name</th><th>Client ID</th><th>Appointment Type</th><th>Date and Time</th><th>Appointment ID</th></tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row['Stylist First Name'] . "</td><td>" . $row['Stylist Last Name'] . "</td><td>" . $row['Stylist ID'] . "</td><td>" . $row['Stylist Phone Number'] . "</td><td>" . $row['Stylist Email Address'] . "</td><td>" . $row['Client First Name'] . "</td><td>" . $row['Client Last Name'] . "</td><td>" . $row['Client ID'] . "</td><td>" . $row['Appointment Type'] . "</td><td>" . $row['Date and Time'] . "</td><td>" . $row['Appointment ID'] . "</td></tr>";
            }
            echo "</table>";
        } else {
            echo "No appointments";
        }

        ?>
    </div>
    <script>

    </script>
</body>

</html>