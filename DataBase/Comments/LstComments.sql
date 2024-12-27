
drop PROCEDURE Comments_List;

DELIMITER //
CREATE PROCEDURE Comments_List()
BEGIN
    SELECT 
        reviews.review_id as id,
        users.first_name AS FirstName,
        users.last_name AS LastName,
        reviews.comment AS Comment,
        reviews.status AS Status
    FROM 
        reviews
    INNER JOIN users ON reviews.user_id = users.user_id
    WHERE 
        reviews.status = 'pending';
END //

DELIMITER ;
