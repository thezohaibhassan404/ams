<?php

$buttonid =$_POST["bid"];
$conn=mysqli_connect("localhost","root","","alumni_db");
$sql = "DELETE from chat_msg where id = {$buttonid}";

if(mysqli_query($conn,$sql)){
    echo 1;
}
else{
    echo 0;
}