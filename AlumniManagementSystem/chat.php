<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ajax delete record</title>
</head>
<body>
<form id="form">
        <textarea name="msg" id="msg" cols="30" rows="10" placeholder="Enter message here..."></textarea>
        <button id ="savebtn" >send</button>
    </form>
    <table width="100%">
        <tr>
            <td id="loadhere">
                
            </td>
        </tr>
    </table>
    <script type = "text/javascript" src="jquey/jquery.js"></script>
    <script>
        $(document).ready(function(){
            function loadprevdata(){
                $.ajax({
                    url:"chat_loaddb.php",
                    type:"POST",
                    success:function(data){
                        $("#loadhere").html(data);
                    }
                });
            }
            loadprevdata();
            $("#savebtn").on("click",function(e){
                e.preventDefault();
                var msg = $("#msg").val();
                var username= <?php echo $_SESSION['login_name'] ?>;
                
                if(msg==""){
                    alert("fields are empty");
                }
                else{
                    $.ajax({
                        url:"chat_insertdb.php",
                        type:"POST",
                        data:{first_msg:msg,
                                uname:username},
                        success:function(data){
                            if(data==1){
                                loadprevdata();
                                $("#form").trigger("reset");
                            }
                            else{
                                alert("no data inserted");
                            }
                        }


                    });
                }
                
            });

            $(document).on("click",".del-btn",function(){
                var btnid= $(this).data("id");
                var element= this;

                $.ajax({
                    url:"chat_delete.php",
                    type:"POST",
                    data:{bid:btnid},
                    success:function(data){
                        if(data==1){
                            $(element).closest("tr").fadeOut();
                        }
                        else{
                            alert("error message from db");
                        }
                    }
                });
            });


        });
    </script>
</body>
</html>