<?php

include_once 'C:\xampp\desktop\htdocs\Resto_Project\Dashbord-Menu\Classes\ContactsClasses\clsContact.php';


class clsComment 
{

    protected $Contact;
    
    private static function Conncect()
    {
        include_once 'C:\xampp\desktop\htdocs\Resto_Project\Dashbord-Menu\Classes\DbhConnection\Dbh.php';
        return Dbh::connect();
    }

    public static function ListComments()
    { 
        // Conncet with DB
        $conn = self::Conncect();

        // Prepare and execute the statement
        $stmt = $conn->prepare("CALL Comments_List()");
        $stmt->execute();

        // Fetch all reservations as an associative array
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public static function ModifyComment($id, $status){
        
        $conn = self::Conncect();
        $stmt = $conn->prepare("CALL Update_Comment_Status($id, '$status')");
        return $stmt->execute();
    }
    

}