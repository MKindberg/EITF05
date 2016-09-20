SET foreign_key_checks=0;

DROP TABLE IF EXISTS  users;
DROP TABLE IF EXISTS  products;
SET FOREIGN_KEY_CHECKS = 1;

CREATE TABLE users
(
  username char(15),
  password char(30) NOT NULL,
  adress char(30),
  salt char(16)
  PRIMARY KEY(username)
);

CREATE TABLE products
(
  productId int,
  name char(15),
  description char(100),
  price int,
  color char(30)
  PRIMARY KEY(productId)
);



INSERT INTO Users VALUES ("AAAA", "aaa", "AAAAAb", "AA");
