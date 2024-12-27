

DELIMITER $$

CREATE PROCEDURE AddMenuItem(
    IN p_name VARCHAR(100),
    IN p_description TEXT,
    IN p_picturePath VARCHAR(255),
    IN p_price DECIMAL(10, 2)
)
BEGIN
    -- Insert the new menu item into the menu_items table
    INSERT INTO menu_items (name, description, picturePath, price)
    VALUES (p_name, p_description, p_picturePath, p_price);
END $$

DELIMITER ;


call AddMenuItem(
    'amiricane Source Mushroom',
    'amiricane Source Mushroom',
    'assets/images/p1.png',
    12
);


call AddMenuItem(
    'morocan Source Mushroom',
    'morocan Source Mushroom',
    'assets/images/p2.png',
    11
);

call AddMenuItem(
    'algirian Source Mushroom',
    'algirian Source Mushroom',
    'assets/images/p3.png',
    17
);

call AddMenuItem(
    'Italian Source Mushroom',
    'Italian Source Mushroom',
    'assets/images/p4.png',
    22
);

call AddMenuItem(
    'germaner Source Mushroom',
    'germaner Source Mushroom',
    'assets/images/p5.png',
    10
);

call AddMenuItem(
    'Italian Source Mushroom',
    'Italian Source Mushroom',
    'assets/images/p6.png',
    20
);

call AddMenuItem(
    'brazilian Source Mushroom',
    'brazilian Source Mushroom',
    'assets/images/p7.png',
    15
);

call AddMenuItem(
    'tunusian Source Mushroom',
    'tunusian Source Mushroom',
    'assets/images/p8.png',
    30
);




