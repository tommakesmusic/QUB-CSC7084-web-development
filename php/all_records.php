<?php
// Get all records from the db
require_once 'connection.php';
 
$slt = "SELECT * from user";
$result = $connection->query($slt);
// while ($row = mysqli_fetch_array($rec)) {
//        $resultData[] = array('username' => $row['username'], 'first_name' => $row['first_name'], 'last_name' => $row['last_name'],'user_role'=>$row['user_role']);
// }

if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
          echo '<div class="content-single-record-box" id="row_$row_number" border-primary-400>';
          echo "uid: " . $row["uid"] . " Username: " . $row["username"] . " - Name: " . $row["first_name"]. " " . $row["last_name"]. " User role: " . $row["user_role"] . "<br>";
          echo "</div>";
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