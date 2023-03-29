<?php

require('includes/config.php');
session_start();

function escape_string($string)
{
    global $connection;
    return mysqli_real_escape_string($connection, $string);
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
    $num_per_page = 10;

    if (isset($_GET["page"])) {
        $page = $_GET["page"];
    } else {
        $page = 1;
    }

    $start_from = ($page - 1) * 10;
    ?>
<div class="btnn2">
    <div class="row">
    
        <div class="">
            <a class="btn btn-success  btn-block ml-2 " href="insert.php" id="headbtn">ADD STUDENT</a>
        </div>
        
        <div class="">
            <a class="btn btn-danger ml-2" href="home.php" id="headbtn">Home</a>
        </div>
        <div class="">
            <a class="btn btn-success ml-2" href="export_excel.php" id="headbtn">Excel</a>
        </div>
        <div class="">
            <form action="" method="GET">
                <div class="input-group">
                    <input type="text" id="searc1" name="search" id="searchbar" required value="<?php if (isset($_GET['search'])) {
                                                                                                    echo $_GET['search'];
                                                                                                } ?>" class="form-control ml-2" placeholder="Search data">
                    <input type="submit" id="searc2" value="search" class="btn  btn-danger"></button>
                </div>
            </form>
        </div>
     

        </div>

    </div>







    <table class=" table table-dark table-striped tbmargin">
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
                <th>Invoice</th>
                <th>Action</th>


            </tr>
            <?php
            if (!isset($_GET['search'])) {
                $sqlm = "SELECT * FROM `student` WHERE `DatePayment`<= CURRENT_DATE- INTERVAL 30 DAY limit $start_from,$num_per_page";
                $result = mysqli_query($connection, $sqlm);
                while ($res = mysqli_fetch_array($result)) {
                    echo "<tr>
                                  <td>" . $res['id'] . "</td>
                                  <td>" . $res['FullName'] . "</td>
                                  <td>" . $res['Phone'] . "</td>
                                  <td>" . $res['Subjects'] . "</td>
                                  <td>" . $res['DatePayment'] . "</td>
                                  <td>" . $res['levell'] . "</td>
                                  <td>" . $res['Dateinst'] . "</td>
                                  <td>" . $res['Price'] . ' DH'  . "</td>
                                  <td> 
                                 <a href='pdf.php?id=" . $res['id'] . "' class='btn btn-danger' id='notpaydbtn' >Invoice</a>
                                 </td>
                                 <td> 
                                 <a href='setdate.php?id=" . $res['id'] . "' class='btn btn-success' id='notpaydbtn'>Payer</a>
                                 </td>
   
                                 </tr>";
                }
            } else if (isset($_GET['search'])) {
                $filtervalues = $_GET['search'];
                $query = "SELECT * FROM `student` WHERE CONCAT(`id`,`FullName`,`levell`) LIKE '%" . $filtervalues . "%' AND `DatePayment`<= CURRENT_DATE- INTERVAL 30 DAY";
                $query_run = mysqli_query($connection, $query);

                if (mysqli_num_rows($query_run) > 0) {
                    foreach ($query_run as $items) {
            ?>
                        <tr>
                            <td><?= $items['id']; ?></td>
                            <td><?= $items['FullName']; ?></td>
                            <td><?= $items['Phone']; ?></td>
                            <td><?= $items['Subjects']; ?></td>
                            <td><?= $items['DatePayment']; ?></td>
                            <td><?= $items['levell']; ?></td>
                            <td><?= $items['Dateinst']; ?></td>
                            <td><?= $items['Price']; ?></td>
                            <td>
                                <a href='pdf.php?id=" . $res[' id'] . "' class='btn btn-danger btn-sm py-0.8' style='font-size: 12px;'>Invoice</a>
                                    </td>
                                    <td> 
                                    <a href='setdate.php?id=" . $res['id'] . "' class='btn btn-success btn-sm py-0.8' style='font-size: 12px;'>Payer</a>
                                    </td>
                                </tr>
                            <?php
                        }
                    } else {

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



    echo "<div class='divbtn'>";
    if ($page > 1) {
        echo "<a href='{$_SERVER['PHP_SELF']}?page=" . ($page - 1) . "' class='btn btn-dark' id='nexpre'><<</a>";
    }

    for ($i = 1; $i <= $total_pages; $i++) {
        echo "<a i href='{$_SERVER['PHP_SELF']}?page=" . $i . "' class='btn btn-dark text-center' id='nexpre' >" . $i . "</a>";
    }

    if ($i > $page) {
        echo "<a href='{$_SERVER['PHP_SELF']}?page=" . ($page + 1) . "' class='btn btn-dark' id='nexpre'>>></a>";
    }

    echo "</div>";



    ?>

    </div>
    </div>
</body>

</html>