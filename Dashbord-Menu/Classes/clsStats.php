<?php
include_once 'C:\xampp\desktop\htdocs\Resto_Project\Dashbord-Menu\Classes\ContactsClasses\clsContact.php';

class Stats {

    private static function Conncect()
    {
        include_once 'C:\xampp\desktop\htdocs\Resto_Project\Dashbord-Menu\Classes\DbhConnection\Dbh.php';
        return Dbh::connect();
    }


    public static function getStatistics($month, $year) {
        $conn = self::Conncect();


        // Récupérer le nombre de commandes
        $ordersQuery = "SELECT COUNT(*) AS total_orders FROM orders WHERE MONTH($month) = ? AND YEAR(order_date) = ?";
        $stmt = $conn->prepare($ordersQuery);
        // $stmt->bind_param($month, $year);
        $stmt->execute();
        $orderResult = $stmt->get_result()->fetch_assoc();
        $totalOrders = $orderResult['total_orders'];

        // Récupérer le nombre de réservations
        $reservationsQuery = "SELECT COUNT(*) AS total_reservations FROM reservations WHERE MONTH(reservation_date) = ? AND YEAR(reservation_date) = ?";
        $stmt = $conn->prepare($reservationsQuery);
        // $stmt->bind_param("ii", $month, $year);
        $stmt->execute();
        $reservationResult = $stmt->get_result()->fetch_assoc();
        $totalReservations = $reservationResult['total_reservations'];

        return [
            'totalOrders' => $totalOrders,
            'totalReservations' => $totalReservations
        ];
    }
}

// Exemple d'utilisation
$month = 1;  // Janvier
$year = 2024;
$stats = Stats::getStatistics($month, $year);
?>