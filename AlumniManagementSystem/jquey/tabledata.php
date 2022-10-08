<?php

$conn=mysqli_connect("localhost","root","","ajax") or die("connection failed");
$sql = "SELECT * from students";

$result=mysqli_query($conn,$sql) or die("query error");

$output="";

if(mysqli_num_rows($result)>0){
    $output = '<table border="1" width ="100%" align="center" cellspacing="0" cellpadding = "10px">
                <tr align="center">
                    <th>ID</th>
                    <th>Your Name</th>
    
                </tr>';
               
    while($row=mysqli_fetch_assoc($result)){
        $output .= "<tr align='center'><td>{$row["id"]}</td>
                    <td>{$row["first_name"]} {$row["last_name"]}</td>
                    </tr>";
    }
    $output.= '</table>';
    echo $output;
    
}
else{
    echo "no record found";
}




?>