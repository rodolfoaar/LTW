CREATE TABLE users
(
	idUser INTEGER PRIMARY KEY,
	username TEXT NOT NULL,
	password TEXT NOT NULL,
	age INTEGER,
	gender TEXT,
	email TEXT NOT NULL
);

CREATE TABLE polls
(
	idPoll INTEGER PRIMARY KEY,
	idUser INTEGER NOT NULL,
	title TEXT NOT NULL,
  sharing TEXT NOT NULL,
	FOREIGN KEY(idUser) REFERENCES users(idUser)
);

CREATE TABLE pollsQuestions
(
	idPollQuestion INTEGER PRIMARY KEY,
	idPoll INTEGER NOT NULL,
	question TEXT NOT NULL,
	FOREIGN KEY(idPoll) REFERENCES polls(idPoll)
);

CREATE TABLE pollsChoices
(
	idPollChoice INTEGER PRIMARY KEY,
	idPollQuestion INTEGER NOT NULL,
	choice TEXT NOT NULL,
	choiceCount INTEGER NOT NULL,
	FOREIGN KEY(idPollQuestion) REFERENCES pollsQuestions(idPollQuestion)
);
