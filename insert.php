
<?php include('includes/config.php');

function escape_string($string)
{
    global $connection;
    return mysqli_real_escape_string($connection, $string);
}

include('Header.php');



?>

<form method="POST" action="" id="formsiz">
    <div class="form-group text-white" id="formse">
   
   <!--      <a href="logout.php">
        <img src="includes/logout.png" alt="Girl in a jacket" width="30px" height="30px">
        </a>
     -->
        <br>
        <label for="exampleFormControlInput1" >Full Name :</label>
        <input type="text" class="form-control" name="name"  placeholder="Full Name" >
        <label for="exampleFormControlInput1" >Phone :</label>
        <input type="tel" class="form-control" name="phone" placeholder="Phone" pattern="[0-9]{10}" >
        <label for="exampleFormControlInput1" >Subjects :</label>
        <input type="text" class="form-control" name="subject" placeholder="Subjects">
       
        <label for="exampleFormControlInput1" >Date Payment :</label>
        <input type="date" class="form-control" name="datep" placeholder="Datetime" >
        <label for="exampleFormControlInput1" >Price :</label>
        <input type="text" class="form-control" name="price"  placeholder="Price">
        <div class="form-group">
            <label for="exampleFormControlSelect1" >Choose Level:</label>
            <select class="form-control text-center"  name="level" value="<?php echo $row['levell']; ?>" >
                <option name="level" >Choose Level</option>
                <option name="level">1 college</option>
                <option name="level">2 college</option>
                <option name="level">3 college</option>
                <option name="level">Trun commun</option>
                <option name="level">1 bac</option>
                <option name="level">2 bac</option>
            </select>
        </div>
        <button type="submit" name="add" class="btn btn-success mt-2 mb-3" id="btnform">Add Student</button>
        <a class="btn btn-success mb-5 p-2" href="home.php"  id="btnform">Home</a>
        <?php

        if (isset($_POST['add'])) {

            $nom = escape_string($_POST['name']);
            $mobile = escape_string($_POST['phone']);
            $subje = escape_string($_POST['subject']);
            $datepay =  escape_string($_POST['datep']);
            $prix = escape_string($_POST['price']);
            $leveles = escape_string($_POST['level']);
            $dateinsc = date("Y/m/d");

            // checking empty fields
            if (empty($nom) || empty($mobile) && empty($subje)  || empty($datepay)  || empty($prix)  || empty($leveles)) {
                echo '<div class="alert alert-danger aler">Error 404!!!!</div><br>';
            } else {
                $res = mysqli_query($connection, "INSERT INTO student VALUES ('','$nom','$mobile','$subje','$datepay','$prix','$leveles','$dateinsc')");
                header("Location: home.php");
            }

        }

        ?>
    </div>


</form>
