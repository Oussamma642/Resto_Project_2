

delimiter //
create procedure list_users_admin()
begin
    select * from users where role = 'admin';
end //
delimiter ;

