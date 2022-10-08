<?php
session_start();
$conn=mysqli_connect("localhost","root","","alumni_db") or die("connection error");

$msg = $_POST['first_msg'];
$uname=$_POST['uname'];
$n = $_SESSION['login_name'];
// echo $_SESSION['login_name'];

$sql = "INSERT INTO `chat_msg` (`id`,`name` `msg`, `date`) VALUES (NULL,'$uname','$msg', current_timestamp())";
// $sql = "INSERT INTO chat_msg(name,msg)VALUES('{$n}','{$m}')";

if(mysqli_query($conn,$sql)){
    echo 1;
}
else{
    echo 0;
}

?>