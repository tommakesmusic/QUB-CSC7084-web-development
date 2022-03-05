<?php
    // Get all records from the db
    include('connection.php');
 
    $slt="SELECT * from user";
    $rec=mysqli_query($connection,$slt);
    while($row=mysqli_fetch_array($rec))
    {
        $resultData[] = array('username' => $row['username'], 'first_name' => $row['first_name'], 'last_name' => $row['last_name'],'user_role'=>$row['user_role']);
    }

    $row_number = 1;
    foreach ($resultData as $row) {
        echo '<div class="content-single-record-box" id="row_$row_number" border-primary-400>';
        // $temp = (string)$row;
        echo implode(" ", $row);
        echo "</div>";
        $row_number += 1;
    }
    mysqli_close($connection);
    
?>