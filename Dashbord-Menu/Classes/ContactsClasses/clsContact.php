<?php

// Important File to send an email
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
    
//required files
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';


class clsContact
{
    // Send Email 
    private static function _SendMail($To, $fullname , $subject, $response, $reservation, $status, $order, $statusOrder)
    {
        $mail = new PHPMailer(true);
        //Server settings
        $mail->isSMTP();                              //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';       //Set the SMTP server to send through
        $mail->SMTPAuth   = true;             //Enable SMTP authentication
        $mail->Username   = 'sadosami297@gmail.com';   //SMTP write your email
        $mail->Password   = 'egtmqgkttoorpfek';      //SMTP password
        $mail->SMTPSecure = 'ssl';            //Enable implicit SSL encryption
        $mail->Port       = 465;                                    
    
        //Recipients
        $mail->setFrom('sadosami297@gmail.com', "Oussama"); // Sender Email and name
        $mail->addAddress($To);     //Add a recipient email  
        $mail->addReplyTo('sadosami297@gmail.com', "Oussama"); // reply to sender email
    
        //Content
        $mail->isHTML(true);               //Set email format to HTML
        $mail->Subject = $subject;   // email subject headings
        

        if ($reservation == true && $status != ""){
            
            // $messageResOrd = self::handleStatusResOrd(true, $status);
            
            $mail->Body = "Cher $fullname,
            Concernant votre Reservation:
            Nous voudrons vous dire qu'il a été {$status},
            Si vous avez des questions supplémentaires, n'hésitez pas à nous contacter.
            Cordialement,
            L'équipe de Resto_Project"; 
        }
        else if($order == true && $statusOrder != ""){

            $mail->Body = "Cher $fullname,
            Concernant votre Commande:
            Nous voudrons vous dire qu'il a été {$statusOrder},
            Si vous avez des questions supplémentaires, n'hésitez pas à nous contacter.
            Cordialement,
            L'équipe de Resto_Project"; 
        }
        else{
            $mail->Body = " Cher $fullname
            Nous avons bien reçu votre message, Concernant votre demande:
            <br>-------------------------------------<br>
            {$response}
            <br>-------------------------------------<br>
            
            Si vous avez des questions supplémentaires, n'hésitez pas à nous contacter.
            
            Cordialement,
            L'équipe de Resto_Project" ;
        }
        $mail->send();
    }

    private static function Connect()
    {
        include_once 'C:\xampp\desktop\htdocs\Resto_Project\Dashbord-Menu\Classes\DbhConnection\Dbh.php';
        return Dbh::connect();
    }

    public static function ListContacts()
    {
        // Conncet with DB
        $conn = self::Connect();

        $stmt = $conn->prepare("CALL List_Contacts()");

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function ModifyContact($contactID, $adminRep, $email , $p_status)
    {
        try {
            $conn = self::Connect();
        
            // Préparer la requête avec des paramètres liés
            $stmt = $conn->prepare('CALL UpdateContactResponse(?, ?, ?, ?)');
        
            // Exécuter la requête en passant les paramètres
            return $stmt->execute([$contactID, $adminRep, $email, $p_status]);
        
        } catch (PDOException $e) {
            // Gérer les erreurs PDO (log ou affichage d'un message)
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }

    public static function SendMail($To, $fullname , $subject, $response, $reservation=false, $status="",$order=false, $statusOrder="")
    {        
        self::_SendMail($To, $fullname , $subject, trim($response), $reservation, $status, $order, $statusOrder);   
    }

    public static function AddContact($name, $email, $subject, $message)
    {
        // Conncet with DB
        $conn = self::Connect();
        $stmt = $conn->prepare("CALL AddNewContact('$name','$email', '$subject', '$message', 'pending')");
        return $stmt->execute();
        
    }
}