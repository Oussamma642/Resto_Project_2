<?php

class clsOpeningClose
{
    private static function Conncect()
    {
        include_once 'C:\xampp\desktop\htdocs\Resto_Project\Dashbord-Menu\Classes\DbhConnection\Dbh.php';
        return Dbh::connect();
    }

    public static function ListOpCl()
    {
        // Conncet with DB
        $conn = self::Conncect();
        
        // Prepare and execute the statement
        $stmt = $conn->prepare("SELECT * FROM ouverturefermeture");
        $stmt->execute();

        // Fetch all reservations as an associative array
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function Modify($id, $ouv, $ferm)
    {
        $conn = self::Conncect();
        
        // Prepare and execute the statement
        $stmt = $conn->prepare("UPDATE OuvertureFermeture
                                SET ouverture = '$ouv',
                                    fermeture = '$ferm'
                                WHERE id = $id;");
        $stmt->execute();
        
        // $_SESSION['Message'] = ($stmt->affected_rows > 0)? "The change has been done succufully!!" : "The change has been failed!!";

        // header('location:../../OuvertureFermeture.php');
    }

}