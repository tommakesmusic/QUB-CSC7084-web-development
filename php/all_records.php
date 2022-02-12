<?php
    include('connection.php');
 
    $slt="select * from register";
    $rec=mysqli_query($connection,$slt);
    while($row=mysqli_fetch_array($rec))
    {
        $resultData[] = array('user_name' => $row['user_name'], 'first_name' => $row['first_name'], 'last_name' => $row['last_name'],'email'=>$row['email']);
    }
 header('content-type: application/json');
    echo json_encode($resultData);
    @mysqli_close($conn);
?>