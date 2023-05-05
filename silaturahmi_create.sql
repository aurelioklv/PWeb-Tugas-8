-- Created by Vertabelo (http://vertabelo.com)
-- Last modification date: 2023-05-04 06:08:22.963

DROP DATABASE IF EXISTS silaturahmi;
CREATE DATABASE silaturahmi;
USE silaturahmi;

-- tables
-- Table: reply
CREATE TABLE reply (
    id int  NOT NULL AUTO_INCREMENT,
    content varchar(255)  NOT NULL,
    createdAt timestamp  NOT NULL DEFAULT CURRENT_TIMESTAMP,
    ucapan_id int  NOT NULL,
    user_id int  NOT NULL,
    CONSTRAINT reply_pk PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Table: ucapan
CREATE TABLE ucapan (
    id int  NOT NULL AUTO_INCREMENT,
    content varchar(255)  NOT NULL,
    createdAt timestamp  NOT NULL DEFAULT CURRENT_TIMESTAMP,
    user_id int  NOT NULL,
    CONSTRAINT ucapan_pk PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Table: user
CREATE TABLE user (
    user_id int  NOT NULL AUTO_INCREMENT,
    name varchar(60)  NOT NULL,
    createdAt timestamp  NOT NULL DEFAULT CURRENT_TIMESTAMP,
    permission varchar(10)  NOT NULL,
    password varchar(128)  NOT NULL,
    CONSTRAINT user_pk PRIMARY KEY (user_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- foreign keys
-- Reference: reply_ucapan (table: reply)
ALTER TABLE reply ADD CONSTRAINT reply_ucapan FOREIGN KEY reply_ucapan (ucapan_id)
    REFERENCES ucapan (id);

-- Reference: reply_user (table: reply)
ALTER TABLE reply ADD CONSTRAINT reply_user FOREIGN KEY reply_user (user_id)
    REFERENCES user (user_id);

-- Reference: ucapan_user (table: ucapan)
ALTER TABLE ucapan ADD CONSTRAINT ucapan_user FOREIGN KEY ucapan_user (user_id)
    REFERENCES user (user_id);

-- End of file.

