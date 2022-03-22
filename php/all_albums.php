<?php
// Get all records from the db...
require_once 'connection.php';
session_start();

$slt = "SELECT * from album ORDER by position";
$result = $connection->query($slt);

// if (isset($_SESSION['user']))

if ($result->num_rows > 0) {
  echo '<div style="overflow-x:auto;">';
  echo '<table>';
    echo '<tr>';
    echo  '<th>Chart position:</th>';
    echo  '<th>Album year:</th>';
    echo  '<th>Album name:</th>';
    echo  '<th>Artist</th>';
    echo  '<th>Genre</th>';
    echo  '<th>Subgenre</th>';
    echo '</tr>';
      // output data of each row
      
    while($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>'.$row["position"].'</td>';
        echo '<td>'.$row["year"].'</td>';
        echo '<td>'.$row["album_name"].'</td>';
        echo '<td>'.$row["artist_name"].'</td>';
        echo '<td>'.$row["genre"].'</td>';
        echo '<td>'.$row["subgenre"].'</td>';
        echo '</tr>';
    }
    echo '</table>';
    echo '</div>';
  } else {
    echo '<div class="content-genre-box content-grid-col-span-2 flow bg-primary-400 text-neutral-100">';
    echo "<h2>0 results</h2>";
  }

$connection->close();
    
?>