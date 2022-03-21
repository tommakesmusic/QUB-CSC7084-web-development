<?php
// Get all records from the db...
require_once 'connection.php';
session_start();
$userRole = $_SESSION['userRole'];
// alertMessage(400, $userRole);
$slt = "SELECT * from Album";
$result = $connection->query($slt);

$row_number = 0;
if ($result->num_rows > 0) {

  echo '<table>';
    echo '<tr>';
    echo  '<th>Chart position:</th>';
    echo  '<th>Album Name:</th>';
    echo  '<th>Album year:</th>';
    echo  '<th>Artist:</th>';
    echo  '<th>Genre;</th>';
    echo  '<th>Subgenre:</th>';
    echo  '<th>Delete user:</th>';
    echo '</tr>';
      // output data of each row
    while($row = $result->fetch_assoc()) {
      $row_number++;
      $date = date("d/m/y, H:i:s", strtotime($row["date_joined"]));
      $name = $row["username"];
      echo '<div>';
      echo '</div>';
    }
  } else {
    echo "0 results";
  }
// $row_number = 1;
//foreach ($resultData as $row) {
//        echo '<div class="content-single-record-box" id="row_$row_number" border-primary-400>';
//        // $temp = (string)$row;
//        echo implode(" ", $row);
//        echo "</div>";
//        $row_number += 1;
//}

$connection->close();
    
?>