SET foreign_key_checks=0;

DROP TABLE IF EXISTS  users;
DROP TABLE IF EXISTS  products;
SET FOREIGN_KEY_CHECKS = 1;

CREATE TABLE users
(
  username char(15),
  hash char(72) NOT NULL, #hash and salt is included here
  adress char(30),
  PRIMARY KEY (username)
);

CREATE TABLE products
(
  productId int auto_increment,
  name char(15),
  description char(100),
  price int,
  color char(30),
  username char(15),
  PRIMARY KEY (productId)
);


INSERT INTO Users (username, hash, adress) VALUES ("AAAA", "aaa", "AAAAAb");
INSERT INTO Products (name, description, price, color, username) VALUES ('Blue', 'Ice Cold Blue', 322, 'blue', 'admin');

