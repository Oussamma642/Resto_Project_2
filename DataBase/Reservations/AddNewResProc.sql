

CREATE TABLE reservations (
    reservation_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    reservation_date DATE NOT NULL,
    time_slot TIME NOT NULL,
    number_of_guests INT NOT NULL,  -- Suppression du CHECK
    status ENUM('pending', 'confirmed', 'canceled') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);


drop procedure add_new_reservation;

delimiter //
create procedure add_new_reservation(
    in userId int,
    in resDate date, 
    in resTime time, 
    in nbrGuest int,
    in nbrTables 
    )
begin 
    insert into reservations (user_id, reservation_date, time_slot, number_of_guests, nbrTable)
    VALUES (userId, resDate, resTime, nbrGuest, nbrTables);
end //
delimiter ;

