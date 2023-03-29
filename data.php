<?php



$result = mysqli_query($connection, "SELECT * FROM student ORDER BY id DESC Limit $start_from,$num_per_page"); // using mysqli_query instead
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
}










?>