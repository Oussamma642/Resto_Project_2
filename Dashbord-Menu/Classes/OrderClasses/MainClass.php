<?php

include_once 'C:\xampp\desktop\htdocs\Resto_Project\Dashbord-Menu\Classes\ContactsClasses\clsContact.php';
class clsOrders
{

    private static function Conncect()
    {
        include_once 'C:\xampp\desktop\htdocs\Resto_Project\Dashbord-Menu\Classes\DbhConnection\Dbh.php';
        return Dbh::connect();
    }

    public static function LstOrders()
    {
        // Conncet with DB
        $conn = clsOrders::Conncect();
        // Prepare and execute the statement
        $stmt = $conn->prepare("CALL Orders_Liste()");
        $stmt->execute();
        
        // Fetch all reservations as an associative array
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function LstContentOrder($orderID)
    {
        // Conncet with DB
        $conn = clsOrders::Conncect();
        // Prepare and execute the statement
        $stmt = $conn->prepare("CALL Order_Items_Details($orderID)");
        $stmt->execute();
        // Fetch all reservations as an associative array
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function ModifyOrder($id, $status, $email, $lname) : bool
    {
        // Conncet with DB
        $conn = clsOrders::Conncect();
        // Prepare and execute the statement
        $stmt = $conn->prepare("CALL ModifyOrder($id, '$status')");
        $stmt->execute();

        if ($stmt){
            clsContact::SendMail($email, $lname, "Votre commande", "", false, "", true, $status);
            return true;
        }
        return false;
    }


    // Number of Pneding orders
    public static function nbrOrder_Pending() {
        $conn = clsOrders::Conncect();
        // Prepare and execute the statement
        $stmt = $conn->prepare("SELECT nbrPending() AS pending_count");
        $stmt->execute();
        // Fetch the result as an associative array
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['pending_count'];
    }

    // Number of canceled  orders 
    public static function nbrOrder_Canceled() {
        $conn = clsOrders::Conncect();
        // Prepare and execute the statement
        $stmt = $conn->prepare("SELECT nbrCanceled() AS canceled_count");
        $stmt->execute();
        // Fetch the result as an associative array
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['canceled_count'];
    }

    // Number of completed  orders
    public static function nbrOrder_Completed() {
        $conn = clsOrders::Conncect();
        // Prepare and execute the statement
        $stmt = $conn->prepare("SELECT nbrCanceled() AS completed_count");
        $stmt->execute();
        // Fetch the result as an associative array
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['completed_count'];
    }


}