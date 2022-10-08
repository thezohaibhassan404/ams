<?php
session_start();
header("Refresh:60");
include 'admin/db_connect.php'; 
// if(isset($_SESSION['login_id'])){
include('header.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>CSS Template</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {
  box-sizing: border-box;
  font-family: Arial, Helvetica, sans-serif;
}

body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

/* Style the top navigation bar */
.topnav {
  overflow: hidden;
  background-color: #333;
}

/* Style the topnav links */
.topnav a {
  float: left;
  display: block;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

/* Change color on hover */
.topnav a:hover {
  background-color: #ddd;
  color: black;
}

/* Style the content */
.content {
  /* background-color: ; */
  padding: 10px;
  height: 200px; /* Should be removed. Only for demonstration */
}

/* Style the footer */
.footer {
    position: fixed;
   left: 0;
   bottom: 0;
   width: 100%;
   background-color: grey;
   color: white;
   text-align: center;
}

</style>
</head>
<body>
<div class="content">
<!-- <div id="status" style="text-align:center;background-color:yellow;">
            <?php echo $_SESSION['login_name'];
                echo "-online"?>
</div> -->
<?php 
        $sql="SELECT * FROM messages LIMIT 10";
        // $sql = "select * from messages ";
        $result=$conn->query($sql);
        if($result->num_rows >0){
            $output ='<table width = "100%" cellspacing="10" cellpadding="0">
            <tr align="center">
            <th width = "100px">Name</th>
                <th >Message</th>
                </tr>';
                while($row = $result->fetch_assoc()){
                    $output .= "<tr align ='center'>
                    <td>{$row["name"]}<td>{$row["msg"]}&nbsp&nbsp&nbsp&nbsp&nbsp{$row["date"]}</td>
                    </tr>";
                    // echo "".$row['name'].""." -&nbsp&nbsp&nbsp&nbsp&nbsp".$row['msg']."&nbsp&nbsp&nbsp&nbsp&nbsp-".$row['date']."<br>";
                }
                echo $output;
                
            }
            
            ?>

<div class="footer">

        <form action="send_msg.php" method="POST" id="txtform">
            <textarea name="msg" placeholder="type your message here..." id="textarea"></textarea>
            <input type="submit" value ="send" id="#sndbtn">
        </form>
</div>

</body>
</html>


