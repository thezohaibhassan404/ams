<?php

$conn=mysqli_connect("localhost","root","","alumni_db") or die("connection error");

$wn = $_POST['web-name'];
$wl = $_POST['web-link'];
$wdsc = $_POST['web-dsc'];

$sql = "INSERT INTO links(web_name,web_link,web_about)VALUES('{$wn}','{$wl}','{$wdsc}')";
mysqli_query($conn,$sql);
?>