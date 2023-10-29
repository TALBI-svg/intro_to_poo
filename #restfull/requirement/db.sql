create database restfull;

create table student(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100),
    mobile VARCHAR(100),
    status BOOLEAN default(true),
    create_at TIMESTAMP
);

create table users(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100),
    password VARCHAR(100),
    create_at TIMESTAMP
);

create table projects(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    name VARCHAR(100),
    description text,
    status ENUM('pending', 'ongoing', 'hold', 'completed'),
    create_at TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE 
);
