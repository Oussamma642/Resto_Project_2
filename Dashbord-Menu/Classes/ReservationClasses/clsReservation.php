<?php

include_once 'C:\xampp\desktop\htdocs\Resto_Project\Dashbord-Menu\Classes\ContactsClasses\clsContact.php';
class clsReservation
{

    protected $Contact;
    
    private static function Conncect()
    {
        include_once 'C:\xampp\desktop\htdocs\Resto_Project\Dashbord-Menu\Classes\DbhConnection\Dbh.php';
        return Dbh::connect();
    }

    // Reservations List
    public static function ListReservation()
    { 
        // Conncet with DB
        $conn = clsReservation::Conncect();

        // Prepare and execute the statement
        $stmt = $conn->prepare("CALL Reservation_List()");
        $stmt->execute();

        // Fetch all reservations as an associative array
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
  
    public function __construct()
    {
        $this->Contact = new clsContact();   
    }

    public static function ModifyReservation($id, $status, $email, $lname) : bool
    {
        $conn = clsReservation::Conncect();
        
        $stmt = $conn->prepare("CALL ModifyReservationStatus($id, '$status')");
        $stmt->execute();

        if ($stmt)
        {
            // private static function _SendMail($To, $fullname , $subject, $response, $reservation=false, $status="", $order=false, $statusOrder="") : void

            clsContact::SendMail($email, $lname, "Votre Reservation", "", true, $status);
            return true;
        }
        else {
            return false;
        }

    }

    // public static function AddNewReservation(
    //     $userId,
    //     $resDate, 
    //     $resTime, 
    //     $nbrGuest,
    //     $nbrTables
    // ){
    //     $conn = self::Conncect();
    //     $stmt = $conn->prepare("CALL add_new_reservation($userId, '$resDate', '$resTime', $nbrGuest, $nbrTables)");
    //     return $stmt->execute();
    // }   

    public static function AddNewReservation($userId, $resDate, $resTime, $nbrGuest, $nbrTables)
    {
        $conn = self::Conncect(); // Connexion à la base de données
    
        try {
            // Préparer la requête pour appeler la procédure stockée
            $stmt = $conn->prepare("CALL add_new_reservation(:userId, :resDate, :resTime, :nbrGuest, :nbrTables)");
    
            // Lier les paramètres à la requête préparée
            $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
            $stmt->bindParam(':resDate', $resDate, PDO::PARAM_STR);
            $stmt->bindParam(':resTime', $resTime, PDO::PARAM_STR);
            $stmt->bindParam(':nbrGuest', $nbrGuest, PDO::PARAM_INT);
            $stmt->bindParam(':nbrTables', $nbrTables, PDO::PARAM_INT);
    
            // Exécuter la requête
            $stmt->execute();
    
            return true; // Succès
        } catch (PDOException $e) {
            // Afficher un message d'erreur dans la console
            echo '<script> console.error("Erreur : ' . $e->getMessage() . '") </script>';
            return false; // Échec
        }
    }
    

}