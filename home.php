<?php

require('includes/config.php');



function escape_string($string)
{
    global $connection;
    return mysqli_real_escape_string($connection, $string);
}

function query_prepare($query)
{
    global $connection;
    return mysqli_prepare($connection, $query);
}

function query($sql)
{
    global $connection;
    return mysqli_query($connection, $sql);
}

function fetch_array($result)
{
    return mysqli_fetch_array($result);
}



function get_error()
{
    global $connection;
    return mysqli_error($connection);
}
?>

<?php include('Header.php'); ?>
<script type="text/javascript">
    window.addEventListener('keydown', function(e) {
        if (e.keyIdentifier == 'U+000A' || e.keyIdentifier == 'Enter' || e.keyCode == 13) {
            if (e.target.nodeName == 'INPUT' && e.target.type == 'text') {
                e.preventDefault();
                return false;
            }
        }
    }, true);
</script>



<body>

    <?php
    $num_per_page = 8;

    if (isset($_GET["page"])) {
        $page = $_GET["page"];
    } else {
        $page = 1;
    }

    $start_from = ($page - 1) * 8;
    ?>
    
    <div class="row">
        <div class="">
            <a class="btn btn-success  btn-block ml-2" href="insert.php" id="headbtn">ADD STUDENT</a>
        </div>
        <a href="logout.php">
        <img src="includes/logout.png" alt="" width="40px" height="40px">
        </a>
        <div class="">
            <a class="btn btn-danger  btn-block ml-2" href="notpayed.php" id="headbtn">NOT PAYER</a>
        </div>
        
        
        <div class="">
            <a class="btn btn-success btn-block ml-2" href="export_excel.php" id="headbtn">EXPORT EXCEL</a>
        </div>
        <div class="">
            <a class="btn btn-danger  btn-block ml-2" href="home.php" id="headbtn">HOME</a>
        </div>


        <div class="">
            <form action="" method="GET">
                <div class="input-group" style="width: 320px;">
                    <input type="text"  id="searc1" name="search" id="searchbar" required value="<?php if (isset($_GET['search'])) {
                                                                                        echo $_GET['search'];
                                                                                    } ?>" class="form-control btn-block ml-2" placeholder="Search">
                    <input type="submit" id="searc2" value="search" class="btn  btn-danger btn-block"></button>
                </div>
            </form>
        </div>
        
       
    </div>

    <table class="table table-dark table-striped tbmargin">
        <thead>
            <tr>
                <th>Id</th>
                <th>Full Name</th>
                <th>Phone</th>
                <th>Subjects</th>
                <th>Payer</th>
                <th>Level</th>
                <th>Inscirption</th>
                <th>Price</th>
                <th>Delete</th>
                <th>Modifie</th>

            </tr>
            <?php  ?>
            <?php

            if (!isset($_GET['search'])) {
                include('data.php');
            } else if (isset($_GET['search'])) {
                $filtervalues = $_GET['search'];
                $query = "SELECT * FROM student WHERE CONCAT(id,FullName,levell) LIKE '%$filtervalues%'";
                $result = mysqli_query($connection, $query);

                if (mysqli_num_rows($result) > 0) {
                   while ($res = mysqli_fetch_array($result)) {
   echo "
   <tr id='tblong'>
      <td>" . $res['id'] . "</td>
      <td>" . $res['FullName'] . "</td>
      <td>" . $res['Phone'] . "</td>
      <td>" . $res['Subjects'] . "</td>
      <td>" . $res['DatePayment'] . "</td>
      <td>" . $res['levell'] . "</td>
      <td>" . $res['Dateinst'] . "</td>
      <td>" . $res['Price'] . ' DH'  . "</td>
      <td> 
      <a href='delete.php?id=" . $res['id'] . "' class='btn btn-danger' id='dtbtn'>Delete</a>
      </td>
      <td> 
      <a href='modifie.php?Uid=" . $res['id'] . "' class='btn btn-success' id='dtbtn'>Modifie</a>
      </td>
   
   </tr>";
                    }} else {

                            ?>
                            <tr>
                                <td colspan=" 12" style="text-align: center;">No Record Found
                            </td>
                        </tr>
                <?php

                    }
                }
                ?>
        </thead>
    </table>

    <?php
    $sql = "SELECT *FROM student";
    $rs_result = mysqli_query($connection, $sql);
    $total_records = mysqli_num_rows($rs_result);
    $total_pages = ceil($total_records / $num_per_page);

    $sumle = "SELECT SUM(Price) AS sum FROM student";
    $query_resultsum = mysqli_query($connection, $sumle);

    while ($row = mysqli_fetch_assoc($query_resultsum)) {
        $output = $row['sum'];
    }




    echo "<div class='divbtn'>";

    if ($page > 1) {
        echo "<a href='home.php?page=" . ($page - 1) . "' class='btn btn-dark' id='nexpre'><<</a>";
    }

    for ($i = 1; $i <= $total_pages; $i++) {
        echo "<a i href='home.php?page=" . $i .  "' class='btn btn-dark text-center' id='nexpre' >" . $i . "</a>";
    }

    if ($i > $page) {
        echo "<a href='home.php?page=" . ($page + 1) . "' class='btn btn-dark' id='nexpre'>>></a>";
    }

    echo "</div>";

    echo "<label  class='float-right' type='text' id='dlk'> $output DH</label>";


    ?>

</body>