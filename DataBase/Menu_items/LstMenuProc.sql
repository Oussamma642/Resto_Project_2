

drop PROCEDURE GetMenuItems;

DELIMITER //
CREATE PROCEDURE    ()
BEGIN
    SELECT
        item_id,
        name,
        description,
        picturePath,
        price,
        created_at,
        updated_at
    FROM menu_items;
END //

DELIMITER ;

