



drop procedure if exists Reservation_List;


DELIMITER //
CREATE PROCEDURE Reservation_List()
BEGIN
    SELECT 
        u.user_id, 
        r.reservation_id, 
        u.last_name, 
        u.email, 
        r.reservation_date, 
        r.time_slot, 
        r.nbrTable, 
        r.number_of_guests, 
        r.status
    FROM 
        users u
    INNER JOIN 
        reservations r 
    ON 
        u.user_id = r.user_id
    WHERE 
        u.role = 'client'
    ORDER BY 
        (r.status = 'pending') DESC,
        (r.status = 'confirmed') DESC,   -- Priorité aux statuts 'pending'
        r.reservation_date DESC;       -- Puis par date de réservation récente
END //
DELIMITER ;


DELIMITER //
CREATE PROCEDURE Reservation_List()
BEGIN
    SELECT u.user_id, r.reservation_id, u.first_name, u.last_name, u.email, r.reservation_date, r.time_slot,r.nbrTable r.number_of_guests, r.status 
    FROM users u 
    INNER JOIN reservations r ON u.user_id = r.user_id
    WHERE u.role = "client"
    order by r.reservation_date desc;
END //
DELIMITER ;

