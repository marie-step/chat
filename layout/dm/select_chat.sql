use chat;

-- vyber vsechny  uzivatele
SELECT * FROM users;

-- uzivatele, kteri nemaji jmeno NULL
select * from users
where name is not null;

-- uzivatele, kteri maji jmeno NULL
select * from users
where name is null;

select name as nm from users; 
-- uzivatele, kteri maji jmeno NULL, nebo prazdny retezec
select * from users
where name is null or name = '';

select * from users
order by passwd;

select distinct blocked from users;

select id, login, role
from users;

select * -- vsechny sloupce
from users
where role = 'user'; -- jen ty co maji roli user

-- vsichni bezni uzivatele jmenujici se Pavel
select login, name, role
from users
where 
    role = 'user'
    and name = 'Pavel';
    
-- uzivatele kteri se jmenuji Alena nebo Pavel
select login, name, role
from users
where 
    name = 'Alena' or name = 'Pavel';
    
-- uzivatele kteri se NEjmenuji Alena nebo Pavel
select login, name, role
from users
where 
    not(name = 'Alena' or name = 'Pavel');

-- uzivatele, kteri maji ve jmenu pismenko n
select * from users
where name like '%n%'; -- % zn. lib. retezec

-- uzivatele kteri zacinaji pismenkem P
select name as  jmeno from users -- as prejmenuje sloupec (jen pro dotaz)
where name like 'P%'; -- % zn. lib. retezec

-- in pro seznam
select * from users
where name in ('Pavel', 'Petr');

-- uzivatele s id 2..100
select * from users
where id between 2 and 100;

