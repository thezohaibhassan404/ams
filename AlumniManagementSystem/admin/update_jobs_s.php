<?php include('db_connect.php');
 //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    
session_start();?>
<?php

$id= $_POST['id'];
$s= $_POST['s'];

//echo $s;

//echo $d;

if($s==1){

$sql = "UPDATE careers SET job_status=1 WHERE id=".$id."";

if ($conn->query($sql) === TRUE) {


    //Load Composer's autoloader
    require 'PHPMailer/vendor/autoload.php';
    
    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);
    
    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'malickzohaib2@gmail.com';                     //SMTP username
        $mail->Password   = 'cbepsczqkvkjljxv';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
        $mail->setFrom('malickzohaib2@gmail.com', 'Zohaib');
    
        $sql = "SELECT `username` FROM `users` WHERE type = 3";

    
        $result=$conn->query($sql);
        if($result->num_rows >0){
      
                while($row = $result->fetch_assoc()){
              
                    $mail->addAddress($row["username"], 'client');     //Add a recipient


                            // $mail->addAddress('ellen@example.com');               //Name is optional
                            // $mail->addReplyTo('info@example.com', 'Information');
                            // $mail->addCC('cc@example.com');
                            // $mail->addBCC('bcc@example.com');
                        
                            //Attachments
                            // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
                            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
                        
                            //Content
                            $mail->isHTML(true);                                  //Set email format to HTML
                            $mail->Subject = 'Job notification';

                            $sql2 = "SELECT * FROM careers WHERE id =".$id."";

                            // $sql = "SELECT * FROM `messages` order by id desc limit 25";
                            $result2=$conn->query($sql2);
                            if($result2->num_rows >0){
                          
                                    while($row2 = $result2->fetch_assoc()){
                                  
                                        $mail->Body    = '<b>'.$row2["job_title"].'</b><br>
                                                        Company: <b>'.$row2["company"].'</b><br>
                                                        Location: <b>'.$row2["location"].'</b><br>
                                                        '.$row2["description"];

                                      
                                    }
                              
                                    
                                }



                          
                            // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                        
                            $mail->send();














                   
                }
           
                
            }
            
    
        
    
    
    
        
  
      
    } catch (Exception $e) {
        // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }





//sending 0 to show in-active button
  echo "0";

  
}
}else{


    $sql = "UPDATE careers SET job_status=0 WHERE id=".$id."";

    if ($conn->query($sql) === TRUE) {
      echo "1";
    
      
    }


}






    
?>