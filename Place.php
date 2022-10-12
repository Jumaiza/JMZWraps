<?php

session_start();
include 'Connect.php';

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
        <h1>Place a Client’s Order</h1>
        <?php

        $con = mysqli_connect($servername, $username, $password, $dbname);

        if (isset($_POST['submit'])) {

            $idNum = $_SESSION["idSession"];
            $ClientFName = $_POST["ClientFName"];
            $ClientLName = $_POST["ClientLName"];
            $ClientID = $_POST["ClientID"];
            $ApptID = $_POST["ApptID"];
            $OrderDesc = $_POST["OrderDesc"];
            $Address = $_POST["address"];

            $sqlid = "SELECT * FROM `tbl2` WHERE `Client First Name`='$ClientFName'AND `Client Last Name`='$ClientLName' AND `Client ID`='$ClientID'";
            $resultid = $con->query($sqlid);

            if ($resultid->num_rows > 0) {

                $sqlApptID = "SELECT * FROM `tbl3` WHERE `Client ID`='$ClientID' AND `Appointment ID`='$ApptID'";
                $resultApptID = $con->query($sqlApptID);

                if ($resultApptID->num_rows > 0) {

                    $randomNum = rand(300, 400);

                    $sqlOrder = "INSERT INTO `tbl4`(`Client ID`, `Stylist ID`, `Appointment ID`, `Products and Quantity`, `Shipping Address`, `Order Number`) VALUES ('$ClientID','$idNum','$ApptID','$OrderDesc','$Address','$randomNum')";
                    if ($con->query($sqlOrder) === TRUE) {
                        echo '<script>alert("Order Placed")</script>';
                    } else {
                        echo '<script>alert("Error Placing Order")</script>';
                    }
                } else {
                    echo '<script>alert("Appointment not found. Recheck data entered othwerwise you need to book an appointment for client before placing an order.")</script>';
                }
            } else {
                echo '<script>alert("Client cannot be found. Recheck data entered otherwise you need to create an account for client.")</script>';
            }
        }

        ?>
        <div class="form">
            <form action="Place.php" method="POST">
                <label for="ClientFName">Client's First Name:</label>
                <input id="ClientFName" name="ClientFName" type=text required> Required
                <br>
                <label for="ClientLName">Client's Last Name:</label>
                <input id="ClientLName" name="ClientLName" type=text required> Required
                <br>
                <label for="ClientID">Client's ID Number:</label>
                <input id="ClientID" name="ClientID" type=text required> Required
                <br>
                <label for="ApptID">Client Appointment ID:</label>
                <input id="ApptID" name="ApptID" type=text required> Required
                <br>
                <label for="OrderDesc">Product Order</label>
                <input id="OrderDesc" name="OrderDesc" type=text required> Required
                <br>
                <label for="address">Shipping Address</label>
                <input id="address" name="address" type=text required> Required
                <br>
                <input type="submit" id="submit" name="submit" />
            </form>
        </div>
    </div>
</body>

</html>