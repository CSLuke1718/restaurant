DROP DATABASE IF EXISTS Restaurant;
CREATE DATABASE IF NOT EXISTS Restaurant;
USE Restaurant;


-- creating tables
CREATE TABLE Customers(
	CustID	INT		PRIMARY KEY,
	Name	VARCHAR(25)	NOT NULL,
	email	VARCHAR(25));

CREATE TABLE Locations(
	LocNo	INT		PRIMARY KEY,
	Address	VARCHAR(25)	NOT NULL,
	Zip		INT		NOT NULL,
	City	VARCHAR(25)	NOT NULL,
	LocState	VARCHAR(10)	NOT NULL);

CREATE TABLE Menu(
	ItemNo	INT		PRIMARY KEY,
	ItemName	VARCHAR(10)	NOT NULL,
	ItemPrice	NUMERIC(4,2) NOT NULL);

CREATE TABLE RestOrder(
	OrderID		INT		PRIMARY KEY,
	CustID		INT		NOT NULL,
	LocNo		INT		NOT NULL,
	OrderDate	DATE	NOT NULL,
	Amount		NUMERIC(5,2)	NOT NULL,
CONSTRAINT FK1_RestOrder FOREIGN KEY (CustID) REFERENCES Customers(CustID),
CONSTRAINT FK2_RestOrder FOREIGN KEY (LocNo) REFERENCES Locations(LocNo));

CREATE TABLE OrderItems(
	OrderItemID		INT	PRIMARY KEY,
	OrderID		INT		NOT NULL,
	ItemNo 		INT		NOT NULL,
CONSTRAINT FK1_OrderItems FOREIGN KEY (OrderID) REFERENCES RestOrder(OrderID),
CONSTRAINT FK2_OrderItems FOREIGN KEY (ItemNo) REFERENCES Menu(ItemNo));


-- inserting data into tables
-- CustID, Name, email
INSERT INTO Customers VALUES(10001, 'Jake Turner','');
INSERT INTO Customers VALUES(10002, 'Jenipher Thatcher','');

-- LocNo, Address, Zip, City, LocState
INSERT INTO Locations VALUES(101, '1600 Pennsylvania Avenue NW', 20500, 'Washington', 'DC');

-- ItemNo, ItemName, ItemPrice
INSERT INTO Menu VALUES(1, 'Chicken Teriyaki', 10.00);
INSERT INTO Menu VALUES(2, 'Salmon and Scalop Sushi', 10.00);
INSERT INTO Menu VALUES(3, 'Spring Rolls', 10.00);
INSERT INTO Menu VALUES(4, 'Egg Rolls', 10.00);
INSERT INTO Menu VALUES(5, 'Lobster Tail', 10.00);
INSERT INTO Menu VALUES(6, 'Butter Chicken Curry', 10.00);
INSERT INTO Menu VALUES(7, 'Pheasant', 10.00);
INSERT INTO Menu VALUES(8, 'Buttered Pork Chops', 10.00);
INSERT INTO Menu VALUES(9, 'Pho', 10.00);
INSERT INTO Menu VALUES(10, 'Salmon', 10.00);
INSERT INTO Menu VALUES(11, 'Lentils', 10.00);
INSERT INTO Menu VALUES(12, 'Potato Soup', 10.00);

-- OrderID, CustID, LocNo, OrderDate, Amount
INSERT INTO RestOrder VALUES(100001, 10001, 101, '2022-01-01', 10.00);

-- OrderItemID, OrderID, ItemNo
INSERT INTO OrderItems VALUES(1000001, 100001, 1);





