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
        <h1>Cancel a Client's Order</h1>
        <?php

        $servername = "sql1.njit.edu";
        $username = "zma4";
        $password = "Z_viper908";
        $dbname = "zma4";
        $con = mysqli_connect($servername, $username, $password, $dbname);

        if (isset($_POST['submit'])) {

            echo "
      <script>
      var r = confirm('You are about to Cancel this Order. Are you sure you want to CANCEL?');
      if(r==true){

      }
      else{
        window.location.href = 'CancelOrder.php';
      }
      </script>
      ";

            $idNum = $_SESSION["idSession"];
            $ClientID = $_POST["ClientID"];
            $ClientOrderNum = $_POST["ClientOrderNum"];

            $sqlOrderExists = "SELECT * FROM `tbl4` WHERE `Client ID`='$ClientID' AND `Order Number`='$ClientOrderNum'";
            $resultOrderExists = $con->query($sqlOrderExists);

            if ($resultOrderExists->num_rows > 0) {

                $sqlOrder = "DELETE FROM `tbl4` WHERE `Order Number`='$ClientOrderNum'";

                if ($con->query($sqlOrder) === TRUE) {
                    echo '<script>alert("Customer Order Cancelled")</script>';
                } else {
                    echo '<script>alert("Error Canceling Order")</script>';
                }
            } else {
                echo '<script>alert("Order Number does not exist for the client. Please check and re-enter order number.")</script>';
            }
        }

        ?>
        <div class="form">
            <form action="CancelOrder.php" method="POST">
                <label for="ClientID">Client's ID Number:</label>
                <input id="ClientID" name="ClientID" type=text required> Required
                <br>
                <label for="ClientOrderNum">Client Order Number:</label>
                <input id="ClientOrderNum" name="ClientOrderNum" type=text required> Required
                <br>
                <input type="submit" id="submit" name="submit" />
            </form>
        </div>
    </div>
</body>

</html>