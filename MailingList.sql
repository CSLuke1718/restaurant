DROP DATABASE IF EXISTS MailingList;
CREATE DATABASE IF NOT EXISTS MailingList;
USE MailingList;

CREATE TABLE Subscribers(
	ID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	FirstName	VARCHAR(25) NOT NULL,
	LastName	VARCHAR(25)	NOT NULL,
	email		VARCHAR(35)	NOT NULL,
	Phone		VARCHAR(14)	NOT NULL,
	MailList	VARCHAR(25) NOT NULL);