/*
create_chat.sql
Zakladaci skript DB pro Chat.

Changelog:
2024-10-02 - jmarianek - komentare
                       - uprava create ...;
2024-10-09 - jmarianek - collate;
                       - users.avatar;
                       - users.surname z 30 na 50zn.;
2024-11-13 - jmarianek - login je unikatni;
                       - znovuvytvoreni cizich klicu posts;
                       - sekvence pro posts.id;
*/


-- -----------------------------------------------------
-- Schema chat 
-- -----------------------------------------------------
-- odstranime cele schema chat
drop schema chat;

-- vytvori schema (database) chat
-- CREATE DATABASE IF NOT EXISTS chat DEFAULT CHARACTER SET utf8;
CREATE SCHEMA IF NOT EXISTS chat
DEFAULT CHARACTER SET utf8
collate = utf8_czech_ci; -- CZ razeni, CH je za H


-- prepni se do schematu chat (tj. nebudeme muset psat chat.NECO)
USE chat ;

-- -----------------------------------------------------
-- Table users
-- -----------------------------------------------------
-- odstranime tabulku users
-- drop table users;

CREATE TABLE IF NOT EXISTS users (
  id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(20),
  surname VARCHAR(30),
  passwd VARCHAR(20) NOT NULL,
  login VARCHAR(20) NOT NULL,
  -- vychozi role je 'user'
  `role` ENUM('admin', 'moderator', 'user') not null default 'user',
  blocked ENUM('Y', 'N') not NULL DEFAULT 'N'
  )
ENGINE = InnoDB;

-- pridame sloupec avatar aniz bychom tabulku odstranili (beze ztraty dat)
alter table users
add avatar varchar(50); -- 50zn. rel. cesta k obrazku

-- surname zvedneme ze 30 na 50zn.
alter table users
modify column surname varchar(50);

-- login unikatni
alter table users
modify login VARCHAR(20) NOT NULL unique;


-- -----------------------------------------------------
-- Table rooms - chatovaci mistnosti
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS rooms (
  id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL UNIQUE, -- name (jmeno mist.) je unikatni
  public ENUM('Y', 'N') NOT NULL DEFAULT 'N',
  descr VARCHAR(1000) NULL -- popis mistnosti
)  
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table users_rooms - vazba mezi users a rooms (vazebni tabulka)
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS users_rooms (
  users_id INT NOT NULL, -- id uzivatele
  rooms_id INT NOT NULL, -- id mistnosti
  INDEX `fk_users_rooms_users_idx` (`users_id` ASC) VISIBLE,
  INDEX `fk_users_rooms_rooms1_idx` (`rooms_id` ASC) VISIBLE,
  CONSTRAINT `fk_users_rooms_users`
    FOREIGN KEY (`users_id`)
    REFERENCES `chat`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_rooms_rooms1`
    FOREIGN KEY (`rooms_id`)
    REFERENCES `chat`.`rooms` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table posts - prispevky (v dane mistnosti)
-- -----------------------------------------------------
-- drop table posts;

CREATE TABLE IF NOT EXISTS posts (
  id INT PRIMARY KEY NOT NULL,
  msg VARCHAR(1000) NOT NULL, -- obsah prispevku
  blocked ENUM('Y', 'N') NOT NULL DEFAULT 'N',
  rooms_id INT NOT NULL, -- id mistnosti, do ktere prip. patri
  users_id INT NOT NULL) -- id uzivatele, ktery prisp. vyrobil
ENGINE = InnoDB;

-- doplnime cizi klice (ref. integrita)
alter table posts add constraint posts_fk1
foreign key(users_id) references users(id);

alter table posts add constraint posts_fk2
foreign key(rooms_id) references rooms(id);

-- sekvence pro id
alter table posts
drop primary key;

alter table posts
modify id INT PRIMARY KEY NOT NULL AUTO_INCREMENT;

desc posts; -- FK nejsou videt (pise jen MUL)
show index from posts; -- ukaze vsechny klice
show create table posts; -- zobr. zaladaci skript


