<?php include('includes/config.php');

function escape_string($string)
{
    global $connection;
    return mysqli_real_escape_string($connection, $string);
}

include('Header.php');
$id = $_GET['Uid'];
$query = " SELECT * FROM `student` where id='$id'";
$result = mysqli_query($connection, $query);
$row = mysqli_fetch_assoc($result);

$id = $row['id'];
$noom = $row['FullName'];
$Phoone = $row['Phone'];
$Suubjects = $row['Subjects'];
$datepay = $row['DatePayment'];
$Price = $row['Price'];
$levell = $row['levell'];
$Inscr = $row['Dateinst'];




        if (isset($_POST['modifie'])) {
            $nom = escape_string($_POST['name']);
            $mobile = escape_string($_POST['phone']);
            $subje = escape_string($_POST['subject']);
            $datepaym = escape_string($_POST['datet']);
            $prix = escape_string($_POST['price']);
            $leveles = escape_string($_POST['level']);
            $Inscr = escape_string($_POST['dateins']);

            $sql = "UPDATE student set FullName='$nom', Phone='$mobile', Subjects='$subje', DatePayment='$datepaym' ,Price='$prix' ,levell='$leveles',Dateinst='$Inscr' WHERE id='" . $id . "'";
            if (mysqli_query($connection, $sql)) {
                header("Location: home.php");
            } else {
                echo "Error deleting record: " . mysqli_error($connection);
            }
            mysqli_close($connection);
        }

?>

<form method="POST" action="" id="formsiz">
   
    <div class="form-group m-3  text-white " id="formse">
    <br>
        <label for="exampleFormControlInput1">Full Name :</label>
        <input type="text" class="form-control" name="name" id="name" placeholder="Full Name" value="<?php echo $noom;?>">
        <label for="exampleFormControlInput1">Phone :</label>
        <input type="tel" class="form-control" name="phone" id="phone" placeholder="Phone" pattern="[0-9]{10}" value="<?php echo $Phoone;?>">
        <label for="exampleFormControlInput1">Subjects :</label>
        <input type="text" class="form-control" name="subject" id="subject" placeholder="Subjects" value="<?php echo $Suubjects;?>">
        <label for="exampleFormControlInput1">Date Payment:</label>
        <input type="date" class="form-control" name="datet" id="datet" placeholder="Datetime" value="<?php echo $datepay;?>">
        <label for="exampleFormControlInput1">Price :</label>
        <input type="text" class="form-control" name="price" id="price" placeholder="Price" value="<?php echo $Price;?>">
        <div class="form-group">
            <label for="exampleFormControlSelect1">Choose Level:</label>
            <select class="form-control text-center" name="level" value="<?php $levell;?>">
                <option name="level">Choose Level</option>
                <option name="level">1 college</option>
                <option name="level">2 college</option>
                <option name="level">3 college</option>
                <option name="level">Trun commun</option>
                <option name="level">1 bac</option>
                <option name="level">2 bac</option>
            </select>
        </div>
        <label for="exampleFormControlInput1" >Inscription:</label>
        <input type="date" class="form-control" name="dateins" id="dateins" placeholder="Datetime" value="<?php echo $Inscr;?>">
        
            <button type="submit" name="modifie" class="btn btn-success mt-5 mb-3 " id="btnform">Modifie Student</button>
            <a class="btn btn-success mb-5 p-2" href="home.php"  id="btnform">Home</a>
        
    
    </div>


</form>

</body>