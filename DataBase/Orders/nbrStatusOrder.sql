

delimiter // 
create function nbrPending()
returns int
reads sql data
begin 

    declare c int;
    set c = (select count(*) from orders where status = 'pending');
    return c;
end //
delimiter ;


delimiter // 
create function nbrCompleted()
returns int
reads sql data
begin 

    declare c int;
    set c = (select count(*) from orders where status = 'completed');
    return c;
end //
delimiter ;


delimiter // 
create function nbrCanceled()
returns int
reads sql data
begin 

    declare c int;
    set c = (select count(*) from orders where status = 'canceled');
    return c;
end //
delimiter ;
