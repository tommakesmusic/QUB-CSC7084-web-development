<?php
// Get all records from the db
require_once 'connection.php';
session_start();
$userRole = $_SESSION['userRole'];
// alertMessage(400, $userRole);
$slt = "SELECT * from user";
$result = $connection->query($slt);
// while ($row = mysqli_fetch_array($rec)) {
//        $resultData[] = array('username' => $row['username'], 'first_name' => $row['first_name'], 'last_name' => $row['last_name'],'user_role'=>$row['user_role']);
// }
$row_number = 0;
if ($result->num_rows > 0) {
        // output data of each row
      while($row = $result->fetch_assoc()) {
        $row_number++;
        $date = date("d/m/y, H:i:s", strtotime($row["date_joined"]));
        $name = $row["username"];
        echo '<div>';
        echo 'user_id: '.$row["user_id"] . ' Username: '. $name.' Name: '.$row["first_name"].' '. $row["last_name"].' User role: '.$row["user_role"].' Member since '.$date;
        if ($userRole=='admin'){
        
        echo "<a href='update_user-Admin.php?user=$name'>Update User</a> <form action='../userApi/userModel.php?deleteUser=$name' method='DELETE'><button type='submit'>Delete</button>";
        }
        
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