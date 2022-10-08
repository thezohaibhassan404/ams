<?php
include '../admin/db_connect.php';
session_start();


    
    //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    
    //Load Composer's autoloader
    require 'vendor/autoload.php';
    
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

        // $sql = "SELECT * FROM `messages` order by id desc limit 25";
        $result=$conn->query($sql);
        if($result->num_rows >0){
          /*  $output ='<table width = "100%" cellspacing="10" cellpadding="10">
            <tr align="center" width = "100%">
                <th width = "100%">Mailing address of all registered alumnus</th>
                </tr>';
                */
                while($row = $result->fetch_assoc()){
                 /*   $output .= "<tr align ='' >
                    <td>{$row["username"]}<td width='80%'></td>
                    </tr>";
                    */
                    $mail->addAddress($row["username"], 'client');     //Add a recipient

                   
                }
              //  echo $output;
                
            }
            
    
        
    
    
    
        
        // $mail->addAddress('ellen@example.com');               //Name is optional
        // $mail->addReplyTo('info@example.com', 'Information');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');
    
        //Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
    
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'test';
        $mail->Body    = 'testing php mailer<b></b>';
        // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    
        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }