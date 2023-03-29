<?php

include('includes/config.php');
session_start();
if(!isset($_SESSION["Username"])){
    header("location:index.php");
  }
require_once 'vendor/autoload.php';
use Dompdf\Dompdf;
$id = $_GET['id'];

$query = " SELECT FullName,Price FROM `student` where id='$id'";
$result = mysqli_query($connection, $query);
$row = mysqli_fetch_assoc($result);

$noom = $row['FullName'];
$prix = $row['Price'];


$html = '
<!DOCTYPE html>
<html lang="en">
<head>
     
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF</title>
</head>
<body>
    <body style="font-size: 12px;  height:300px; margin:auto; margin-top: 30px;">
     <div style = "text-align: center; margin: 50px; font-family: DejaVu Sans;">
     Lorem Ipsum is simply dummy <b style="text-transform: capitalize;">'.$noom .'</b> text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it <b>'.$prix.' DH</b> to make a type specimen book. It has survived not only five centuries .<br><br>
     Signature
     </div>
    </body>
</body>
</html>';

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();


// Output the generated PDF to Browser
$dompdf->stream('invoice.pdf');

?>








