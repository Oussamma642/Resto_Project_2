
CREATE TABLE orders (
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    total_amount DECIMAL(10, 2) NOT NULL,
    status ENUM('pending', 'completed', 'canceled') DEFAULT 'pending',
    payment_status ENUM('paid', 'unpaid') DEFAULT 'unpaid',
    delivery_method ENUM('takeaway', 'delivery') NOT NULL,
    delivery_address VARCHAR(255),
    description TEXT DEFAULT NULL,  -- Colonne description pour les commandes spécifiques
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);


DELIMITER //
CREATE PROCEDURE ModifyOrder(in idOrd int, in st VARCHAR(20))
begin 
    update orders 
    set status = st
    where order_id = idOrd;

end //
DELIMITER ;

