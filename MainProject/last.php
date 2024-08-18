<?php
session_start();
if(!isset($_SESSION['uid'])){
    header('Location:index.php');
}
$uuid = $_GET['uuid'];
$uid = $_SESSION['uid'];
$db=mysqli_connect('localhost','root',null,'onlinevoting' );

                                   if ($db->connect_error) 
                                     {
                                           die("Connection failed: " . $db->connect_error);
                                     } 
             $sql="update candidate set count=IFNULL(count,0)+1  where uid='$uuid'";
             
if (mysqli_query($db, $sql)) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . mysqli_error($conn);
}

/* $sql="update candidate set time=IFNULL(time,current_timestamp) where uid='$uuid'";
if (mysqli_query($db, $sql)) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . mysqli_error($conn);
} */


 $sql="update voter set vstatus=TRUE  where uid='$uid'";

 if (mysqli_query($db, $sql)) {
    //echo "Record updated successfully";
     header('Location:tick.html');
} else {
    echo "Error updating record: " . mysqli_error($conn);
}
            
mysqli_close($db);
session_destroy();
?>