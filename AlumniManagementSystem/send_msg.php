<?php
session_start();
include 'admin/db_connect.php'; 
$msg=$_POST['msg'];
$name=$_SESSION['login_name'];

$sql = "insert into messages(name,msg)values('$name','$msg')";
$result=$conn->query($sql);
header("location:chat_home.php");

?>