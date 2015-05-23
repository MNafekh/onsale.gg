CREATE DATABASE onsale.gg;
USE onsale.gg;

CREATE TABLE skins (ID int NOT NULL AUTO_INCREMENT, skin_name VARCHAR(50), tier VARCHAR(20), 
	sale_price DOUBLE, released DATE, last_on_sale DATE, PRIMARY KEY (ID), 
	FOREIGN KEY (tier) REFERENCES pricing(tier));

CREATE TABLE pricing (cost INTEGER, tier VARCHAR(20), PRIMARY KEY (tier));
