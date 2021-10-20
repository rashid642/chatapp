<?php
$roomname=$_GET['roomname'];
include "dbconnect.php";

//check wheater room exist

$sql="SELECT * FROM `rooms` WHERE `roomname` LIKE '$roomname'";
$result=mysqli_query($conn,$sql);
if($result){
    if(mysqli_num_rows($result)==0){
        $message="Room does'nt exist";
        echo $message;
        echo '<script language="javascript">';
        echo 'alert("'.$message.'");';   
        echo 'window.location="http://localhost/chatapp;';  
        echo '</script>';
    }
}else{
    echo "ERROR:".mysqli_error($conn);
}
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link href="/docs/5.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<style>
body {
  margin: 0 auto;
  max-width: 800px;
  padding: 0 20px;
}

.container {
  border: 2px solid #dedede;
  background-color: #f1f1f1;
  border-radius: 5px;
  padding: 10px;
  margin: 10px 0;
}

.darker {
  border-color: #ccc;
  background-color: #ddd;
}

.container::after {
  content: "";
  clear: both;
  display: table;
}

.container img {
  float: left;
  max-width: 60px;
  width: 100%;
  margin-right: 20px;
  border-radius: 50%;
}

.container img.right {
  float: right;
  margin-left: 20px;
  margin-right:0;
}

.time-right {
  float: right;
  color: #aaa;
}

.time-left {
  float: left;
  color: #999;
}
.anyClass{
    height:350px;
    overflow-y:scroll;
}
</style>
</head>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Chat App</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About</a>
        </li>
      </ul>
      <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
<body>
<h2>Chat Messages-<?php echo $roomname?></h2>


<div class="container">
    <div class="anyClass">
  <!-- <img src="/w3images/bandmember.jpg" alt="Avatar" style="width:100%;">
  <p>Hello. How are you today?</p>
  <span class="time-right">11:00</span> -->
</div>
</div>


<input type="text" class="form-control" id="usermsg" name="usermsg" placeholder="Add message">
<button class="btn btn-dark my-3" name="submitting" id="submitting">Submit</button>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>

<script>

//check message every 1 sec
setInterval(runFunction,1000);
function runFunction(){
    $.post("htcont.php",{room:"<?php echo $roomname; ?>"},
    function(data,status){
        document.getElementsByClassName('anyClass')[0].innerHTML=data;
    }
    )
}


// Get the input field
//submit when clicked enter
var input = document.getElementById("usermsg");

// Execute a function when the user releases a key on the keyboard
input.addEventListener("keyup", function(event) {
  // Number 13 is the "Enter" key on the keyboard
  if (event.keyCode === 13) {
    // Cancel the default action, if needed
    event.preventDefault();
    // Trigger the button element with a click
    document.getElementById("submitting").click();
  }
});

    $("#submitting").click(function(){
        var clientmsg=$("#usermsg").val();
  $.post("postingmsg.php",{
      text:clientmsg,
      room:'<?php echo $roomname; ?>',
      ip:'<?php echo $_SERVER['REMOTE_ADDR']; ?>'}, 
  function(data,status){
    document.getElementsByClassName('anyClass')[0].innerHTML=data;
    $("#usermsg").val("");
      return false;
  });
});
</script>


</body>
</html>
