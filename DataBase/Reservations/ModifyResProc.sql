

drop procedure ModifyReservationStatus;

delimiter //
CREATE PROCEDURE ModifyReservationStatus(in idRes int, in st varchar(30))

begin 
    update
        reservations 
    set 
        status = st
    where 
        reservation_id = idRes;

end //

delimiter ;
