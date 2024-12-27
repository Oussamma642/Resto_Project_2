

DELIMITER $$

CREATE PROCEDURE add_menu_item(
    IN p_name VARCHAR(100),
    IN p_description TEXT,
    IN p_picturePath VARCHAR(255),
    IN p_price DECIMAL(10, 2)
)
BEGIN
    INSERT INTO menu_items (name, description, picturePath, price)
    VALUES (p_name, p_description, p_picturePath, p_price);
END$$

DELIMITER ;



