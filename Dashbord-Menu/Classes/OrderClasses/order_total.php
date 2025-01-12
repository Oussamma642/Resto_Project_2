<?php
header('Content-Type: application/json');

if (isset($_GET['orderId'])) {
    $orderId = intval($_GET['orderId']);

    try {
        // Database connection
        $dsn = 'mysql:host=localhost;dbname=restaurant;charset=utf8';
        $username = 'root';
        $password = '';
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];

        $pdo = new PDO($dsn, $username, $password, $options);

        // Call the MySQL function
        $stmt = $pdo->prepare('SELECT Total_Order_Amount(:orderId) AS total_amount');
        $stmt->bindParam(':orderId', $orderId, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch();

        echo json_encode($result);
    } catch (PDOException $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'Order ID not provided']);
}
?>