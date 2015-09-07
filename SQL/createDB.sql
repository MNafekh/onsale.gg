CREATE DATABASE onsale;
USE onsale;

CREATE TABLE pricing (tier VARCHAR(20) NOT NULL, cost INTEGER, PRIMARY KEY (tier));

CREATE TABLE champions (champion_id int NOT NULL AUTO_INCREMENT, champion_name VARCHAR(50), price_ip int, price_rp int, 
sale_price_ip int, sale_price_rp int, release_date DATE, last_on_sale DATE, PRIMARY KEY (champion_id));

CREATE TABLE skins (skin_id int NOT NULL AUTO_INCREMENT, skin_name VARCHAR(50), champion_id int, splash_num int, tier VARCHAR(20), 
	sale_price INT, released DATE, last_on_sale DATE, available BOOLEAN, comment VARCHAR(250), PRIMARY KEY (skin_id), 
	FOREIGN KEY (tier) REFERENCES pricing(tier), FOREIGN KEY (champion_id) REFERENCES champions(champion_id));
