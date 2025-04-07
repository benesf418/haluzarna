/* CLEAN UP */

DROP TABLE IF EXISTS users;


/* TABLES */

CREATE TABLE users (
    id INTEGER PRIMARY_KEY AUTO_INCREMENT,
    username VARCHAR(25) UNIQUE,
    balance NUMBER DEFAULT 0
);


/* DATA */

INSERT INTO users (id, username, balance)
VALUES (1, 'admin', 100);