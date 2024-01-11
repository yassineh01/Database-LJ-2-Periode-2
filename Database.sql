CREATE TABLE IF NOT EXISTS students
(
    id INT PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(30) NOT NULL,
    last_name VARCHAR(30) NOT NULL,
    email VARCHAR(255) NOT NULL,
    birth_date DATE NOT NULL
);

CREATE TABLE IF NOT EXISTS user_logs
(
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_name VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL
);

INSERT INTO students (first_name, last_name, email, birth_date)
VALUES
('John', 'Doe', 'john@doe.com', '1990-01-01');

INSERT INTO students (first_name, last_name, email, birth_date)
VALUES
('Alice', 'Smith', 'alice@smith.com', '1999-01-01');

