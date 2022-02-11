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
            <button onclick="location.href='SearchOrders.php'" class="button">Search Your Client Orders</button>
            <button onclick="location.href='Book.php'" class="button">Book a Client’s Appointment</button>
            <button onclick="location.href='Place.php'" class="button">Place a Client’s Order</button>
            <button onclick="location.href='Update.php'" class="button">Update a Client's Order</button>
            <button onclick="location.href='Cancel.php'" class="button">Cancel a Client's Appointemnt</button>
            <button onclick="location.href='CancelOrder.php'" class="button">Cancel a Client's Order</button>
            <button onclick="location.href='Create.php'" class="button">Create a Client's Account</button>
        </div>
        <h1>Book a Client's Appointment</h1>
        <?php

    $servername = "sql1.njit.edu";
    $username = "zma4";
    $password = "Z_viper908";
    $dbname = "zma4";
    $con = mysqli_connect($servername, $username, $password, $dbname);

    if (isset($_POST['submit'])) {

      $idNum = $_SESSION["idSession"];
      $ClientFName = $_POST["ClientFName"];
      $ClientLName = $_POST["ClientLName"];
      $ClientID = $_POST["ClientID"];
      $ApptType = $_POST["ApptType"];
      $Date = strval($_POST["Date"]);

      $sqlid = "SELECT * FROM `tbl2` WHERE `Client First Name`='$ClientFName'AND `Client Last Name`='$ClientLName' AND `Client ID`='$ClientID'";

      $resultid = $con->query($sqlid);

      if ($resultid->num_rows > 0) {

        $randomNum = rand(30, 300);

        $sql = "INSERT INTO `tbl3` (`Client ID`, `Stylist ID`, `Appointment Type`, `Date and Time`, `Appointment ID`) VALUES ('$ClientID','$idNum','$ApptType','$Date','$randomNum')";

        if ($con->query($sql) === TRUE) {
          echo '<script>alert("Client Appointment Placed")</script>';
        } else {
          echo '<script>alert("Error")</script>';
        }
      } else {
        echo '<script>alert("Client cannot be found. Recheck data entered otherwise you need to create an account for client.")</script>';
      }
    }

    ?>
        <div class="form">
            <form action="Book.php" method="POST">
                <label for="ClientFName">Client's First Name:</label>
                <input id="ClientFName" name="ClientFName" type=text required> Required
                <br>
                <label for="ClientLName">Client's Last Name:</label>
                <input id="ClientLName" name="ClientLName" type=text required> Required
                <br>
                <label for="ClientID">Client's ID Number:</label>
                <input id="ClientID" name="ClientID" type=text required> Required
                <br>
                <label for="ApptType">Appointment Type:</label>
                <input id="ApptType" name="ApptType" type=text required> Required
                <br>
                <label for="Date">Date and Time:</label>
                <input id="Date" name="Date" type=date required> Required
                <br>
                <input type="submit" id="submit" name="submit" />
            </form>
        </div>
    </div>
</body>

</html>