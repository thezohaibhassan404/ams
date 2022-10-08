<?php
session_start();
header("Refresh:60");
include 'admin/db_connect.php'; 
if(isset($_SESSION['login_id'])){
include('header.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Discussion Room</title>
    <style>
        body{
            background-color: #0088cc73;
        
        }
        /* .fcontainer{
            display:flex;
        }
        	header.masthead {
		  background: url(admin/assets/uploads/<?php echo $_SESSION['system']['cover_img'] ?>);
		  background-repeat: no-repeat;
		  background-size: cover;
		}
        .output{
            margin : 10px;
            padding :10px;
            text-align:center;
            font-size:18px;

        }
        #textarea{
            display:block;
            width:50%;
            margin:10px 0px 10px 10px;
        
        }
        #sndbtn{
            display:block;
            float:right;
        }
        #txtform{
            position: absolute;
            bottom: 0;
            left: 0;
        }
        .main{
            width: 100%;
            position:relative;
            overflow: auto;
            height: 50%;
        }*/
        #chatdiv{
            display:flex;
            width : 100%;
           flex-flow:column;
           position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            
            color: white;
            text-align: center;
           
            height 300px;
        } 
        #txtform{
            
            width : 100%;

            
        }
        tr:hover 

        {background-color: #fff;
        
        }
    </style>
</head>

<body id="page-top">
        <div class= "fcontainer">
        <div class="toast" id="alert_toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-body text-white">
        </div>
      </div>
<nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
    <div class="container">
                <a class="navbar-brand js-scroll-trigger" href="./"><?php echo $_SESSION['system']['name'] ?></a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto my-2 my-lg-0">
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php?page=home">Home</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php?page=alumni_list">Alumni</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php?page=gallery">Gallery</a></li>
                        <?php if(isset($_SESSION['login_id'])): ?>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php?page=careers">Jobs</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php?page=forum">Forums</a></li>
                        <?php endif; ?>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php?page=about">About</a></li>
                        <?php if(!isset($_SESSION['login_id'])): ?>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#" id="login">Login</a></li>
                        
                        <?php else: ?>
                            
                            <li class="nav-item">
                          <div class=" dropdown mr-4">
                              <a href="#" class="nav-link js-scroll-trigger"  id="account_settings" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['login_name'] ?> <i class="fa fa-angle-down"></i></a>
                                <div class="dropdown-menu" aria-labelledby="account_settings" style="left: -2.5em;">
                                    <a class="dropdown-item" href="index.php?page=my_account" id="manage_my_account"><i class="fa fa-cog"></i> Manage Account</a>
                                    <a class="dropdown-item" href="admin/ajax.php?action=logout2"><i class="fa fa-power-off"></i> Logout</a>
                                </div>
                          </div>
                        </li>
                        <?php endif; ?>
                        
                     
                    </ul>
                </div>
            </div>
        </nav>
        
    <div class="main">
        
        <div id="status" style="text-align:center;background-color:yellow;">
            <?php echo $_SESSION['login_name'];
                echo "-online"?>
    </div>
    <div class="output">
        
        <?php 
        
        $sql = "SELECT * FROM `messages` order by id desc limit 25";
        $result=$conn->query($sql);
        if($result->num_rows >0){
            $output ='<table width = "100%" cellspacing="10" cellpadding="10">
            <tr align="">
            <th width = "100px">Name</th>
                <th >Message</th>
                </tr>';
                while($row = $result->fetch_assoc()){
                    $output .= "<tr align ='' >
                    <td>{$row["name"]}<td width='80%'>{$row["msg"]}&nbsp&nbsp&nbsp&nbsp&nbsp{$row["date"]}</td>
                    </tr>";
                    // echo "".$row['name'].""." -&nbsp&nbsp&nbsp&nbsp&nbsp".$row['msg']."&nbsp&nbsp&nbsp&nbsp&nbsp-".$row['date']."<br>";
                }
                echo $output;
                
            }
            
            ?>
    </div>
    <br><br>
    <a href="index.php" style="text-decoration:none;margin-top: 10px;float:right;color:red;" >Close Chat [X]</a>
</div>
</div>

<div id="chatdiv">
        <form action="send_msg.php" method="POST" id="txtform">
            <textarea name="msg" placeholder="type your message here..." id="textarea"></textarea>
            <input type="submit" value ="send" id="#sndbtn">
        </form>
</div>

</body>
</html>

<?php }
else {
    echo "Please Login To Connect To the Discusion"."<br>";
    echo '<a href="index.php" style="text-decoration:none;">Back</a>'; 
}?>
