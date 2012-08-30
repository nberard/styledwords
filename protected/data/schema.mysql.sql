CREATE TABLE user (
    id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(128) NOT NULL,
    password VARCHAR(128) NOT NULL,
    email VARCHAR(128) NOT NULL
);

INSERT INTO user (username, password, email) VALUES ('admin', md5('eclipse'), 'berard.nicolas@gmail.com');

/*
CREATE TABLE word (
    id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    word VARCHAR(128) NOT NULL
);
*/

CREATE TABLE record (
    id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT, 
	record VARCHAR(1024) NOT NULL,
	user_id INTEGER NOT NULL COMMENT "CONSTRAINT FOREIGN KEY (user_id) REFERENCES user(id)"
);

/*
CREATE TABLE word_in_record (
    id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    word_id INTEGER NOT NULL COMMENT "CONSTRAINT FOREIGN KEY (word_id) REFERENCES word(id)",
    record_id INTEGER NOT NULL COMMENT "CONSTRAINT FOREIGN KEY (record_id) REFERENCES record(id)",
    rank TINYINT UNSIGNED NOT NULL
);
*/

CREATE TABLE notation (
    id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    word_id INTEGER NOT NULL COMMENT "CONSTRAINT FOREIGN KEY (word_id) REFERENCES word(id)",
    user_id INTEGER NOT NULL COMMENT "CONSTRAINT FOREIGN KEY (user_id) REFERENCES user(id)",
    note TINYINT UNSIGNED NOT NULL
);
