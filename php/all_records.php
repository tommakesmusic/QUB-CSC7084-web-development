<?php
    // Get all records from the db
    include('connection.php');
 
    $slt="SELECT * from user";
    $rec=mysqli_query($connection,$slt);
    while($row=mysqli_fetch_array($rec))
    {
        $resultData[] = array('username' => $row['username'], 'first_name' => $row['first_name'], 'last_name' => $row['last_name'],'user_role'=>$row['user_role']);
    }
    // header('content-type: application/json');
    echo json_encode($resultData);
    // echo $resultData;
    @mysqli_close($conn);
?>