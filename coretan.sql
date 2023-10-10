CREATE DATABASE todolist;
use todolist;


CREATE TABLE tasks(
    id_workspace    INT AUTO_INCREMENT,
    id_user         INT,
    title           VARCHAR(30) NOT NULL,
    isComplete      BOOLEAN NOT NULL,
    progress        VARCHAR(30) NOT NULL,

    PRIMARY KEY(id_workspace),
    FOREIGN KEY(id_user) REFERENCES users(id_user)
);

CREATE TABLE users(
    username VARCHAR(20) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    PRIMARY KEY(username)
);

