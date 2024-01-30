-- SQLite
CREATE TABLE IF NOT EXISTS User ( 
	id            INTEGER         PRIMARY KEY AUTOINCREMENT,
	username         VARCHAR( 250 ),
	password       VARCHAR( 250 )
);