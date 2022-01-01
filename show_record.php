<?php
require "connection.php";
$sql = "SELECT * FROM `contact_details` ORDER BY username";
$result = $conn->query($sql);
$slno = 1;
while ($row = $result->fetch_assoc()) {
   $date = strtotime($row['created_at']);
?>
   <tr>
      <td><?php echo $slno++; ?></td>
      <td><?php echo ucwords($row['username']); ?></td>
      <td><?php echo $row['mobile']; ?></td>
      <td>
         <img src="uploaded/<?php echo $row['imgname'] ?>" alt="" height="50px">
      </td>
      <td><?php echo date('d-m-Y', $date); ?></td>
      <td><span style="cursor:pointer;" class="badge rounded-pill bg-danger" onclick="delete_data(<?php echo $row['contact_id']; ?>)">Delete</span></td>
   </tr>
<?php } ?>