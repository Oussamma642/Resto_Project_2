

drop PROCEDURE UpdateMenuItem;
DELIMITER $$
CREATE PROCEDURE UpdateMenuItem(
    IN p_item_id INT,
    IN p_name VARCHAR(100),
    IN p_description TEXT,
    IN p_picturePath VARCHAR(255),
    IN p_price DECIMAL(10, 2)
    )
BEGIN
    UPDATE menu_items
    SET 
        name = p_name,
        description = p_description,
        picturePath = p_picturePath,
        price = p_price,
        updated_at = CURRENT_TIMESTAMP
    WHERE item_id = p_item_id;
END$$

DELIMITER ;


