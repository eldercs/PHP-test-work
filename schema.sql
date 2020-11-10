CREATE TABLE users(
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(128),
    name VARCHAR(86),
    password VARCHAR(120),
    avatar VARCHAR,
    contacts VARCHAR
);
CREATE TABLE lots(
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT(12) DEFAULT NULL,
    img CHAR(100),
    title CHAR(86),
    price INT(100),
    price_now INT(100),
    category_id INT(11),
    bet_step INT(100),
    start_date DATETIME,
    end_date DATETIME,
    KEY user_id(user_id),
    KEY category_id(category_id),
    CONSTRAINT `lots_1` FOREIGN KEY (`category_id`) REFERENCES `category`(`id`)
);
CREATE TABLE category(
    id INT AUTO_INCREMENT PRIMARY KEY,
    title CHAR(86)
);
CREATE TABLE bets(
    id INT AUTO_INCREMENT PRIMARY KEY,
    date DATETIME,
    value INT(100),
    user_id INT(12) DEFAULT NULL,
    lot_id INT(12) DEFAULT NULL,
    KEY user_id(user_id),
    KEY lot_id(lot_id)
);