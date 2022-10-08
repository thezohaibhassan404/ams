<?php
session_start();
$n = $_SESSION['login_name'];
$conn=mysqli_connect("localhost","root","","alumni_db");
$sql = "SELECT * from chat_msg";

$result = mysqli_query($conn,$sql) or die("connection error");
$output = "";
if(mysqli_num_rows($result) > 0 ){
    $output ='<table width = "100%" cellspacing="0" cellpadding="0">
                <tr align="center">
                <th width = "100px">ID</th>
                <th >Messages</th>
                <th width = "100px">Delete</th>
                </tr>';

    while($row=mysqli_fetch_assoc($result)){
             $output .= "<tr align ='center'><td>{$row["id"]}</td>
                        <td>{$row["name"]}{$row["msg"]} {$row["date"]} </td><td><button class = 'del-btn' data-id='{$row["id"]}'>Delete</button></td>
             </tr>";

    }

    $output .= '</table>';
    
    echo $output;

}
else{
    echo ("no record found");
}