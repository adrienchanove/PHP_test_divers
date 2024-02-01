-- SQLite

-- Pragma
PRAGMA foreign_keys = ON;


-- Drop tables
DROP TABLE IF EXISTS posts;
DROP TABLE IF EXISTS User;
DROP TABLE IF EXISTS Groupe;
DROP TABLE IF EXISTS UserGroupe;
DROP TABLE IF EXISTS privateMessage;



-- Create tables
CREATE TABLE IF NOT EXISTS User ( 
	id            INTEGER         PRIMARY KEY AUTOINCREMENT,
	username         VARCHAR( 250 ),
	password       VARCHAR( 250 )
);

CREATE TABLE IF NOT EXISTS Groupe ( 
	id            INTEGER         PRIMARY KEY AUTOINCREMENT,
	name         VARCHAR( 250 )
);

CREATE TABLE IF NOT EXISTS UserGroupe ( 
	user_id         INTEGER,
	group_id         INTEGER
);

CREATE TABLE IF NOT EXISTS privateMessage ( 
	id            INTEGER         PRIMARY KEY AUTOINCREMENT,
	sender_id         INTEGER,
	receiver_id         INTEGER,
	message         VARCHAR( 500 )
);

-- Foreign keys
-- ALTER TABLE UserGroupe ADD FOREIGN KEY (user_id) REFERENCES User(id);
-- ALTER TABLE UserGroupe ADD FOREIGN KEY (group_id) REFERENCES Groupe(id);
-- ALTER TABLE privateMessage ADD FOREIGN KEY (sender_id) REFERENCES User(id);
-- ALTER TABLE privateMessage ADD FOREIGN KEY (receiver_id) REFERENCES User(id);

-- Insert data
-- 		User
INSERT INTO User (username, password) VALUES ('admin', 'admin');
INSERT INTO User (username, password) VALUES ('user', 'user');
-- 		Groupe
INSERT INTO Groupe (name) VALUES ('admin');
INSERT INTO Groupe (name) VALUES ('user');
-- 		UserGroupe
INSERT INTO UserGroupe (user_id, group_id) VALUES (1, 1);
INSERT INTO UserGroupe (user_id, group_id) VALUES (2, 2);

