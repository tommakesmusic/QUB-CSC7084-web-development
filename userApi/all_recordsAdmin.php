<?php
// Get all records from the db
require_once '../php/connection.php';
$select = "SELECT * from user";
$result = $connection->query($select);

$row_number = 0;
if ($result->num_rows > 0) {
        // output data of each row
      echo '<table>';
      echo '<tr>';
      echo  '<th>Username:</th>';
      echo  '<th>First name:</th>';
      echo  '<th>Last name:</th>';
      echo  '<th>User role:</th>';
      echo  '<th>Member since;</th>';
      echo  '<th>Update:</th>';
      echo  '<th>Delete user:</th>';
      echo '</tr>';
      while($row = $result->fetch_assoc()) {
        $row_number++;
        $date = date("d/m/y, H:i:s", strtotime($row["date_joined"]));
        $name = $row["username"];
        echo '<tr>';
        echo '<td>'.$name.'</td>';
        echo '<td>'.$row["first_name"].'</td>';
        echo '<td>'.$row["last_name"].'</td>';
        echo '<td>'.$row["user_role"].'</td>';
        echo '<td>'.$date.'</td>';
        echo "<td><button class='stdButton'><a href='update_user-Admin.php?user=$name'>Update User</a></button></td>";
        echo "<td><button class='stdButtonRd'><a href='user_model.php?userDeleteAdmin=$name'>Delete User</a></button></td>";
        echo '</tr>';
      }
      echo '</table>';
  } else {
    echo "0 results";
  }

$connection->close();
    
?>