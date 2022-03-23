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
      echo  '<th>Comments:</th>';
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
        echo "<td><button class='stdButton'><a href='update_user-Admin.php?userName=$name'>Update User</a></button></td>";
        echo "<td><button class='stdButton'><a href='approveComment.php?user_id=".$row['user_id']."&userName=".$name."'>Approve comments</a></button></td>";
        if ($name!=$_SESSION['user']){
        echo "<td><form action='user_model.php' method='GET'><input type='hidden' name='userDeleteAdmin' value='true'><input type='hidden' name='user_id' value='".$row['userName']."'><button class='stdButton' id='submit' type='submit' value='Submit'>Delete User</button></form></td>";
       }
        echo '</tr>';
      }
      echo '</table>';
  } else {
    echo "0 results";
  }

$connection->close();
    
?>