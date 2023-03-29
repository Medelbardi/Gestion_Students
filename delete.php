<?php
include('includes/config.php');
session_start();
if(!isset($_SESSION["Username"])){
    header("location:index.php");
  }
$id = $_GET['id'];
$sql = "DELETE FROM student WHERE id='$id'";
if (mysqli_query($connection, $sql)) {
    header("Location: home.php");
} else {
    echo "Error deleting record: " . mysqli_error($connection);
}
mysqli_close($connection);
?>