-- init.sql : run once on your MySQL to create table + test user
CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(100) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL
);

-- Test user (username: admin, password: 1234) -- change later
INSERT INTO users (username, password) VALUES ('admin', '1234')
ON DUPLICATE KEY UPDATE username=username;
