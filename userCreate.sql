drop user if exists 'bonnie'@'localhost';
create user if not exists 'bonnie'@'localhost' identified by 'bon';
grant select, insert, delete, create, drop, references, execute on *.* to 'bonnie'@'localhost';
select user from mysql.user;