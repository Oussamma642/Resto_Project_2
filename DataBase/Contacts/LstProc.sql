delimiter //
create procedure List_Contacts()
begin 

    select 
        c.contact_id, 
        concat(u.first_name, ' ', u.last_name) as fullName,
        c.user_id, 
        c.email, 
        c.subject, 
        c.message, 
        c.status,
        c.created_at
    from 
        contacts c
    inner join users u  on c.user_id = u.user_id
    order by c.created_at desc;

end //
delimiter ;

