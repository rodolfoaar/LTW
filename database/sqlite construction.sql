CREATE TABLE users(
 id INTEGER PRIMARY KEY AUTOINCREMENT,
 username VARCHAR(25) NOT NULL,
 password VARCHAR(25) NOT NULL
);

INSERT INTO users (username, password) VALUES ('Angelo', 'password');
INSERT INTO users (username, password) VALUES ('Leonel', 'password');
INSERT INTO users (username, password) VALUES ('Rodolfo', 'password');
