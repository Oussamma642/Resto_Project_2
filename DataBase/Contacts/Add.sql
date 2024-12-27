


drop procedure if exists AddNewContact;

DELIMITER //

CREATE procedure AddNewContact(
    in nameU varchar(50),
    in emailC varchar(50), 
    in subjectC varchar(50),
    in messageC varchar(100),
    in statusC varchar(50)
    )
BEGIN 

    insert into contacts (name, email, subject, message, status)
    values (nameU, emailC, subjectC, messageC, statusC);

END //
DELIMITER ;

