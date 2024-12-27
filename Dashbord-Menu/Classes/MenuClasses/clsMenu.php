<?php


// class clsMenu
// {  
//     private static function Conncect()
//     {
//         include_once 'C:\xampp\desktop\htdocs\Resto_Project\Dashbord-Menu\Classes\DbhConnection\Dbh.php';
//         return Dbh::connect();
//     }

//     public static function ListMenu()
//     { 
//         // Conncet with DB
//         $conn = self::Conncect();

//         // Prepare and execute the statement
//         $stmt = $conn->prepare("CALL GetMenuItems()");
//         $stmt->execute();

//         // Fetch all reservations as an associative array
//         return $stmt->fetchAll(PDO::FETCH_ASSOC);
//     }

//     public static function deleteMenuItem($itemId) {
//         $conn = self::Conncect(); // Remplacez avec votre méthode de connexion
//         $stmt = $conn->prepare("CALL DeleteMenuItem($itemId)");
//         return $stmt->execute();
//     }
    

//     public static function ModifyItem($itemId, $name, $description, $picturePath, $price) {
        
//         $conn = self::Conncect(); // Remplacez avec votre méthode de connexion
//         $stmt = $conn->prepare("CALL UpdateMenuItem($itemId, '$name', '$description', '$picturePath', $price)");
//         return $stmt->execute();
//     }

// }


class clsMenu
{  
    private static function Conncect()
    {
        include_once 'C:\xampp\desktop\htdocs\Resto_Project\Dashbord-Menu\Classes\DbhConnection\Dbh.php';
        return Dbh::connect();
    }

    public static function ListMenu()
    { 
        // Connect with DB
        $conn = self::Conncect();

        // Prepare and execute the statement
        $stmt = $conn->prepare("CALL GetMenuItems()");
        $stmt->execute();

        // Fetch all reservations as an associative array
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function deleteMenuItem($itemId) {
        $conn = self::Conncect(); // Remplacez avec votre méthode de connexion
        $stmt = $conn->prepare("CALL DeleteMenuItem($itemId)");
        return $stmt->execute();
    }
    
    public static function ModifyItem($itemId, $name, $description, $picturePath, $price) {
        $conn = self::Conncect(); // Remplacez avec votre méthode de connexion
        $stmt = $conn->prepare("CALL UpdateMenuItem($itemId, '$name', '$description', '$picturePath', $price)");
        return $stmt->execute();
    }

    public static function addMenuItem($name, $description, $picturePath, $price) {
        $conn = self::Conncect(); // Connectez-vous à la base de données

        // Utilisation de requêtes préparées pour éviter les injections SQL
        $stmt = $conn->prepare("CALL add_menu_item(:name, :description, :picturePath, :price)");

        // Lier les paramètres de la requête préparée
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':picturePath', $picturePath);
        $stmt->bindParam(':price', $price);

        // Exécuter la requête et retourner si l'ajout a réussi
        return $stmt->execute();
    }
}