<?php
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=student_list.xls");
header("Pragma: no-cache");
header("Expires: 0");

require_once 'includes/config.php';

$output = "";

$output .= "
		<table>
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
				</tr>
			<tbody>
	";

$query = $connection->query("SELECT * FROM `student`") or die(mysqli_errno($connection));
while ($fetch = $query->fetch_array()) {

	$output .= "
				<tr>
					<td>" . $fetch['id'] . "</td>
					<td>" . $fetch['FullName'] . "</td>
					<td>" . $fetch['Phone'] . "</td>
					<td>" . $fetch['Subjects'] . "</td>
					<td>" . $fetch['DatePayment'] . "</td>
					<td>" . $fetch['levell'] . "</td>
					<td>" . $fetch['Dateinst'] . "</td>
					<td>" . $fetch['Price'] . "</td>	
				</tr>
	";
}

$output .= "
			</tbody>
 
		</table>
	";

echo $output;
