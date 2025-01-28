use chat;

select * from users;

-- automaticke potvrzovani transakci - vychozi chovani
set autocommit=1;


-- naplnime uzivatele
INSERT INTO users (passwd, login, role)
VALUES ('12345', 'admin', 'admin');

INSERT INTO users (name, surname, passwd, login, role)
VALUES ('Jan', 'Novak', '12345', 'jnovak', 'user');

-- zmenime Jan Novak na Petr Novak a heslo na 45678
UPDATE users 
SET name = 'Petr', passwd = '45678'
WHERE id = 3; -- !!!! bez podminky zmeni vsechny zaznamy!!!

-- smazani  uzivatele
DELETE FROM users
WHERE id = 3; -- !!!! bez podminky zmeni vsechny zaznamy!!!


-- naplnime mistnosti
insert into rooms(name, public, descr)
values('room1', 'Y', 'Místnost pro všechny');

-- vypneme automaticke potvrzovani transakci
set autocommit=0;

insert into rooms(name, public, descr)
values('room2', 'N', 'Místnost 2');

rollback; -- odvolavam posl. transakci (insert room2)
commit; -- potvrdim explicitne posl. transakci

select * from rooms;




