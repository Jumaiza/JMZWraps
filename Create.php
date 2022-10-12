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
        <h1>Create a Client's Account</h1>
        <?php

        $con = mysqli_connect($servername, $username, $password, $dbname);

        if (isset($_POST['submit'])) {

            $idNum = $_SESSION["idSession"];
            $ClientFName = $_POST["ClientFName"];
            $ClientLName = $_POST["ClientLName"];
            $ClientID = $_POST["ClientID"];

            $sqlClientExists = "SELECT * FROM `tbl2` WHERE `Client First Name`='$ClientFName' AND `Client Last Name`='$ClientLName' AND `Client ID`='$ClientID'";
            $resultClientExists = $con->query($sqlClientExists);

            if ($resultClientExists->num_rows > 0) {

                echo '<script>alert("Client already has an account.")</script>';
            } else {

                $sqlCreate = "INSERT INTO `tbl2`(`Client First Name`, `Client Last Name`, `Client ID`) VALUES ('$ClientFName','$ClientLName','$ClientID')";

                if ($con->query($sqlCreate) === TRUE) {
                    echo '<script>alert("Client Account Created")</script>';
                } else {
                    echo '<script>alert("Error Creating Client Account")</script>';
                }
            }
        }

        ?>
        <div class="form">
            <form action="Create.php" method="POST">
                <label for="ClientFName">Client First Name:</label>
                <input id="ClientFName" name="ClientFName" type=text required> Required
                <br>
                <label for="ClientLName">Client Last Name:</label>
                <input id="ClientLName" name="ClientLName" type=text required> Required
                <br>
                <label for="ClientID">Client ID Number:</label>
                <input id="ClientID" name="ClientID" type=text required> Required
                <br>
                <input type="submit" id="submit" name="submit" />
            </form>
        </div>
    </div>
</body>

</html>