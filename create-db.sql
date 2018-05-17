CREATE DATABASE messageboard;

CREATE TABLE messageboard.messages (
    id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    post_title VARCHAR(100),
    post_message VARCHAR(100),
    post_image VARCHAR(100),
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);