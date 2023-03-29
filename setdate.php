<?php

include('includes/config.php');

session_start();
if(!isset($_SESSION["Username"])){
    header("location:index.php");
  }

$id = $_GET['id'];
$query = "UPDATE student SET DatePayment = CURRENT_DATE() WHERE id='$id'";
$result = mysqli_query($connection, $query);
if ($result) {
    header("Location: notpayed.php");
} else {
    echo "Error deleting record: " . mysqli_error($connection);
}
mysqli_close($connection);
?>