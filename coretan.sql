CREATE DATABASE todolist;
use todolist;


CREATE TABLE users(
    username VARCHAR(20) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    PRIMARY KEY(username)
);


CREATE TABLE tasks(
    id_task    INT AUTO_INCREMENT,
    username         VARCHAR(20),
    title           VARCHAR(30) NOT NULL,
    isComplete      BOOLEAN NOT NULL,
    progress        VARCHAR(30) NOT NULL,

    PRIMARY KEY(id_task),
    FOREIGN KEY(username) REFERENCES users(username)
);
