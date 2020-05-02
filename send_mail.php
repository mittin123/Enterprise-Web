<?php
include_once("Mail/PHPMailer.php");
include_once("Mail/Exception.php");
include_once("Mail/OAuth.php");
include_once("Mail/POP3.php");
include_once("Mail/SMTP.php");
 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
class SendMail{
    public function send_mail($to, $title, $body){
        //mail spam
        date_default_timezone_set('Etc/UTC');
            $nFrom = "eLearning";    
            $mFrom = 'brinybria24429@gmail.com';  
            $mPass = 'SQmgnumse46509';      
            $nTo = 'Student';        
            //$mTo = 'dominhhoang1999@gmail.com';   
            $mail             = new PHPMailer();
            //$body             = 'You have been allocated to a tutor. Please check for details on the website.';  
            //$title = 'You have been allocated to a tutor';   
            $mail->IsSMTP();             
            $mail->CharSet  = "utf-8";
            $mail->SMTPDebug  = 2;   
            $mail->SMTPAuth   = true;    
            $mail->SMTPSecure = 'ssl';
            $mail->Host       = 'smtp.gmail.com';   
            $mail->Port       = 465;         
        
            $mail->Username   = $mFrom;  
            $mail->Password   = $mPass;           
            $mail->SetFrom($mFrom, $nFrom);
            $mail->AddReplyTo('brinybria24429@gmail.com', 'eLearning');
            $mail->Subject    = $title;
            $mail->MsgHTML($body);
            $mail->AddAddress($mTo, $nTo);
            // thuc thi lenh gui mail 
            if(!$mail->Send()) {
                return 'Co loi!'.'<br>';  
            } else {  
                return 'mail của bạn đã được gửi đi hãy kiếm tra hộp thư đến để xem kết quả. ';
            }
        }
}
    
?>