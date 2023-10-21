CREATE DATABASE todolist;
use todolist;


CREATE TABLE users(
    username VARCHAR(20) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    PRIMARY KEY(username)
);


CREATE TABLE tasks(
    id_task         INT AUTO_INCREMENT,
    username        VARCHAR(20),
    title           VARCHAR(30) NOT NULL,
    task_desc       VARCHAR(255),
    created         DATE,
    isComplete      BOOLEAN NOT NULL,
    progress        VARCHAR(30) NOT NULL,

    PRIMARY KEY(id_task),
    FOREIGN KEY(username) REFERENCES users(username)
);

-- dummy values
INSERT INTO users (username, password) VALUES
('admin', 'admin'),
('rehan', 'guaganteng'),
('tio', 'puhsepuh');

INSERT INTO tasks (username, title, task_desc, created, isComplete, progress) VALUES
('admin', 'Task 1', 'Description 1', '2023-10-18', 1, 'In Progress'),
('admin', 'Task 2', 'Description 2', '2023-10-19', 0, 'Not Started'),
('admin', 'Task 3', 'Description 3', '2023-10-20', 0, 'Not Started'),
('admin', 'Task 4', 'Description 4', '2023-10-21', 1, 'Completed'),
('admin', 'Task 5', 'Description 5', '2023-10-22', 0, 'Not Started'),
('admin', 'Task 6', 'Description 6', '2023-10-23', 1, 'In Progress'),
('admin', 'Task 7', 'Description 7', '2023-10-24', 1, 'In Progress'),
('admin', 'Task 8', 'Description 8', '2023-10-25', 0, 'Not Started'),
('admin', 'Task 9', 'Description 9', '2023-10-26', 0, 'Not Started'),
('admin', 'Task 10', 'Description 10', '2023-10-27', 1, 'Completed');

INSERT INTO tasks (username, title, task_desc, created, isComplete, progress) VALUES
('rehan', 'Task 11', 'Description 11', '2023-10-18', 1, 'In Progress'),
('rehan', 'Task 12', 'Description 12', '2023-10-19', 0, 'Not Started'),
('rehan', 'Task 13', 'Description 13', '2023-10-20', 0, 'Not Started'),
('rehan', 'Task 14', 'Description 14', '2023-10-21', 1, 'Completed'),
('rehan', 'Task 15', 'Description 15', '2023-10-22', 0, 'Not Started'),
('rehan', 'Task 16', 'Description 16', '2023-10-23', 1, 'In Progress'),
('rehan', 'Task 17', 'Description 17', '2023-10-24', 1, 'In Progress'),
('rehan', 'Task 18', 'Description 18', '2023-10-25', 0, 'Not Started'),
('rehan', 'Task 19', 'Description 19', '2023-10-26', 0, 'Not Started'),
('rehan', 'Task 20', 'Description 20', '2023-10-27', 1, 'Completed');

INSERT INTO tasks (username, title, task_desc, created, isComplete, progress) VALUES
('tio', 'Task 21', 'Description 21', '2023-10-18', 1, 'In Progress'),
('tio', 'Task 22', 'Description 22', '2023-10-19', 0, 'Not Started'),
('tio', 'Task 23', 'Description 23', '2023-10-20', 0, 'Not Started'),
('tio', 'Task 24', 'Description 24', '2023-10-21', 1, 'Completed'),
('tio', 'Task 25', 'Description 25', '2023-10-22', 0, 'Not Started'),
('tio', 'Task 26', 'Description 26', '2023-10-23', 1, 'In Progress'),
('tio', 'Task 27', 'Description 27', '2023-10-24', 1, 'In Progress'),
('tio', 'Task 28', 'Description 28', '2023-10-25', 0, 'Not Started'),
('tio', 'Task 29', 'Description 29', '2023-10-26', 0, 'Not Started'),
('tio', 'Task 30', 'Description 30', '2023-10-27', 1, 'Completed');
