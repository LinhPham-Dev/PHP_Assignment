CREATE DATABASE IF NOT EXISTS `php_btl`; 
CHARACTER SET `utf8` ;

-- Create Table Category
CREATE TABLE IF NOT EXISTS `category` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL UNIQUE,
  `status` TINYINT DEFAULT 1
);

-- Create Table Product
CREATE TABLE IF NOT EXISTS `product` (
  `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `name` VARCHAR(150) NOT NULL,
  `image` VARCHAR(150),
  `status` TINYINT DEFAULT 1,
  `price` FLOAT NOT NULL,
  `sale_price` FLOAT DEFAULT 0,
  `description` TEXT,
  `created_date` DATE DEFAULT CURRENT_TIMESTAMP,
  `category_id` INT NOT NULL, 
   FOREIGN KEY (category_id) REFERENCES category(id)
);

-- Create Table Account
CREATE TABLE IF NOT EXISTS `account` (
  `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL UNIQUE,
  `role` TINYINT NOT DEFAULT 0,
  `password` VARCHAR(255) NOT NULL,
) ENGINE = InnoDB CHARSET = utf8 COLLATE utf8_persian_ci;

-- Admin Account
INSERT INTO `account` (name, email, password) VALUES ('Phạm Ngọc Linh', 'phamlinh@gmail.com', '18122002');