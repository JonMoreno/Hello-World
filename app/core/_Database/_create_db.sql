

/*
|------------------------------------------------------
| Create MYSQL Database
| Name: db_quantum
|------------------------------------------------------
**/
DROP DATABASE IF EXISTS db_quantum;
CREATE DATABASE db_quantum;
USE db_quantum; 


/*
|------------------------------------------------------
| Create table
| Name: products
|------------------------------------------------------
**/
CREATE TABLE products (
    productID        INT            NOT NULL   AUTO_INCREMENT,
    ASIN             VARCHAR(255)   DEFAULT NULL,
    Title            VARCHAR(255)   DEFAULT NULL,
    MPN              INT            DEFAULT NULL,
    Price            DECIMAL(10,2)  DEFAULT NULL,

  PRIMARY KEY (productID)
);


/*
|------------------------------------------------------
| Create table
| Name: users
|------------------------------------------------------
*/
CREATE TABLE users (
    userID           INT            NOT NULL AUTO_INCREMENT,
    userName         VARCHAR(255)   NOT NULL,
    password         VARCHAR(255)   NOT NULL,
  PRIMARY KEY (userID)

);

