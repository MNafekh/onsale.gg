CREATE DATABASE onsale.gg;
USE onsale.gg;

CREATE TABLE skins (name VARCHAR(50), cost INTEGER, released DATE, last_on_sale DATE);

CREATE TABLE pricing (cost INTEGER, tier VARCHAR(20));
