<?php
include "dbconnect.php";

$msg=$_POST['text'];
$room=$_POST['room'];
$ip=$_POST['ip'];

$sql="INSERT INTO `msgs` (`srno`, `message`, `room`, `ip`, `stime`) VALUES (NULL, '$msg', '$room', '$ip', current_timestamp());";
$result=mysqli_query($conn,$sql);
mysqli_close($conn);
?>