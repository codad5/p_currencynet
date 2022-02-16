CREATE TABLE account_holder (
	account_id int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    email varchar(300) NOT NULL,
    pwd varchar(300) NOT NULL,
    name varchar(300) NOT NULL,
    verify boolean NOT NULL

);
CREATE TABLE request_orders (
	order_id int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    email varchar(300) NOT NULL,
    website_domain varchar(300) NOT NULL,
    refrence_key varchar(300) NOT NULL,
    authorization_url varchar(300) NOT NULL,
    access_code varchar(300) NOT NULL,
    rate int(11) NOT NULL,
    amount int(11) NOT NULL,
    verify boolean NOT NULL

);
CREATE TABLE websites (
	website_id int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
   	website_domain varchar(300) NOT NULL,
    website_TLD varchar(300) NOT NULL,
    website_owner varchar(300) NOT NULL,
    website_currency  varchar(300) NOT NULL,
	request_total int(225) PRIMARY KEY AUTO_INCREMENT NOT NULL,
	request_made int(225) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    verify boolean NOT NULL

);