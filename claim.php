<?php
$room=$_POST["room"];

if(strlen($room)>20 || strlen($room)<2){
    $message="please make a room name with less than 20 character and more than 20 character";
    // echo `<script language="javascript"> alert("$message");
    // console.log("hello");
    // </script>`;
    echo '<script language="javascript">';
    echo 'alert("'.$message.'");';   
    echo 'window.location="http://localhost/chatapp";';  
    echo '</script>';
}
else if(!ctype_alnum($room)){
    $message="please use only alpha numeric character";
    echo '<script language="javascript">';
    echo 'alert("'.$message.'");';   
    echo 'window.location="http://localhost/chatapp";';  
    echo '</script>';
}
else{
    include "dbconnect.php";
}

$sql="SELECT * FROM `rooms` WHERE `roomname` LIKE '$room'";
$result=mysqli_query($conn,$sql);
if($result){
    if(mysqli_num_rows($result)>0){
        $message="room already exist";
        echo $message;
        echo '<script language="javascript">';
        echo 'alert("'.$message.'");';   
        echo 'window.location="http://localhost/chatapp";';  
        echo '</script>';
    }else{
        $sql="INSERT INTO `rooms` (`srno`, `roomname`, `stime`) VALUES (NULL, '$room', current_timestamp())";
        if(mysqli_query($conn,$sql)){
            $message="Your room is ready";
            echo $message;
            echo '<script language="javascript">';
            echo 'alert("'.$message.'");';   
            echo 'window.location="http://localhost/chatapp/rooms.php?roomname='.$room.'";';  
            echo '</script>';
        }
    }
}else{
    echo "EROOR:".mysqli_error($result);
}
?>