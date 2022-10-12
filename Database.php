<?php

session_start();

include 'Connect.php';

?>
<?php
$pic = "cropped.jpg";
$con = mysqli_connect($servername, $username, $password, $dbname);

if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$fName = $_POST['firstName'];
$_SESSION["fNameSession"] = $_POST['firstName'];
$lName = $_POST['lastName'];
$_SESSION["lNameSession"] = $_POST['lastName'];
$pass = $_POST['password'];
$_SESSION["passSession"] = $_POST['password'];
$id = $_POST['idNum'];
$_SESSION["idSession"] = $_POST['idNum'];
$trans = $_POST["transaction"];
$phoneNum = $_POST["phoneNum"];

$sql = "SELECT * FROM `it3` WHERE `Stylist First Name`='$fName' and `Stylist Last Name`='$lName' and `Stylist Password`='$pass' and `Stylist ID Number`='$id' and `Stylist Phone Number`='$phoneNum'";
$result = $con->query($sql);

$verified = "false";
if ($result->num_rows > 0) {
  echo "Verified";
  $verified = "true";
}

if ($verified == "true") {

  if ($trans == "Search the Stylist's Records") {
    header("Location: https://web.njit.edu/~zma4/Search.php");
  } else if ($trans == "Search the Stylist's Orders") {
    header("Location: https://web.njit.edu/~zma4/SearchOrders.php");
  } else if ($trans == "Book a Client’s Appointment") {
    header("Location: https://web.njit.edu/~zma4/Book.php");
  } else if ($trans == "Place a Client’s Order") {
    echo "
      <script>
      var r = confirm('Before you place an order you must have booked an appointment/event. Did you have an appointment/event?');
      if(r==true){
        window.location.href = 'Place.php';
      }
      else{
        window.location.href = 'Book.php';
      }
      </script>
      ";
    //header("Location: https://web.njit.edu/~zma4/Place.php");
  } else if ($trans == "Update a Client's Order") {
    header("Location: https://web.njit.edu/~zma4/Update.php");
  } else if ($trans == "Cancel a Client's Appointemnt") {
    header("Location: https://web.njit.edu/~zma4/Cancel.php");
  } else if ($trans == "Cancel a Client's Order") {
    header("Location: https://web.njit.edu/~zma4/CancelOrder.php");
  } else if ($trans == "Create a Client's Account") {
    header("Location: https://web.njit.edu/~zma4/Create.php");
  }
} else {
  echo "<script>
    alert('Stylist cannot be found. Recheck your info and retry.');
    window.location.href = 'Login.html';
    </script>
    ";
  //header("Location: https://web.njit.edu/~zma4/Login.html");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <style>
    body {
        background-image: url('<?php echo $pic; ?>');
    }
    </style>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Backend</title>
</head>

<body>

</body>

</html>