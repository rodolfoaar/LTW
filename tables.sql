CREATE TABLE users
(
	idUser INTEGER PRIMARY KEY,
	username TEXT NOT NULL,
	password TEXT NOT NULL,
	age INTEGER NOT NULL,
	gender TEXT NOT NULL,
	email TEXT NOT NULL
);

CREATE TABLE polls
(
	idPoll INTEGER PRIMARY KEY,
	idUser INTEGER NOT NULL,
	title TEXT NOT NULL,
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
	FOREIGN KEY(idPollQuestion) REFERENCES pollsQuestions(idPollQuestion)
);

CREATE TABLE pollsAnswers
(
	id INTEGER PRIMARY KEY,
	idPoll INTEGER NOT NULL,
	idPollQuestion INTEGER NOT NULL,
	idPollChoice INTEGER NOT NULL,
	count INTEGER NOT NULL,
	FOREIGN KEY(idPoll) REFERENCES polls(idPoll),
	FOREIGN KEY(idPollQuestion) REFERENCES pollsQuestions(idPollQuestion),
	FOREIGN KEY(idPollChoice) REFERENCES pollsChoices(idPollChoice)
);
