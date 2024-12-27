
drop procedure add_new_user;

delimiter //
CREATE PROCEDURE add_new_user(
    IN fname VARCHAR(255),
    IN lname VARCHAR(255),
    IN em VARCHAR(255),
    IN pswd VARCHAR(255),
    IN rle VARCHAR(255),
    IN phone VARCHAR(255),
    IN perm INT
)
BEGIN
    INSERT INTO users (first_name, last_name, email, password, role, phone_number, permissions)
    VALUES (fname, lname, em, pswd, rle, phone, perm);

END //

delimiter ;
