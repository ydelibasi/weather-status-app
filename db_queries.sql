
-- db queries

CREATE DATABASE IF NOT EXISTS `weather_status_app` DEFAULT CHARACTER SET = `utf8` DEFAULT COLLATE = `utf8_general_ci`;

CREATE TABLE `weather_status_app`.`user` (`id` bigint NOT NULL AUTO_INCREMENT,`email` varchar(255) NOT NULL,`password` varchar(255) NOT NULL,`city_id` int NOT NULL,`timezone` varchar(255) NOT NULL,`language` char(4) DEFAULT NULL,`device_os` text DEFAULT NULL,`notify_token` varchar(255) DEFAULT NULL, PRIMARY KEY (id));

CREATE TABLE `weather_status_app`.`subscription` (`id` serial NOT NULL,`user_id` int NOT NULL,`service_id` int NOT NULL,`foc` tinyint DEFAULT '0',`status` tinyint DEFAULT '1',`start_date` datetime DEFAULT NULL,`end_date` datetime DEFAULT NULL,`updated_at` timestamp DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (id));

CREATE TABLE `weather_status_app`.`weather_status` (`id` serial NOT NULL,`city_id` int NOT NULL,`min_degree` tinyint NOT NULL,`max_degree` tinyint NOT NULL ,`description` varchar(255), `forecast_date` date DEFAULT NULL, PRIMARY KEY (id));

CREATE TABLE `weather_status_app`.`gift_code` (`code` varchar(255) NOT NULL, `user_id` int NULL, `usage_date` datetime NULL, PRIMARY KEY (code));

CREATE TABLE `weather_status_app`.`token` (`user_id` int NOT NULL,`token` varchar(255) NOT NULL,`expire_at` datetime NOT NULL, PRIMARY KEY (token));

INSERT INTO `weather_status_app`.`weather_status` (`city_id`, `min_degree`, `max_degree`, `description`, `forecast_date`) VALUES 
('34', '10', '16', 'Güneşli', '2020.04.27'),
('35', '11', '18', 'Güneşli', '2020.04.27'),
('52', '15', '20', 'Bulutlu', '2020.04.27'),
('32', '14', '18', 'Güneşli', '2020.04.27'),
('42', '12', '22', 'Yağmurlu', '2020.04.27'),
('48', '11', '24', 'Sisli', '2020.04.27'),
('17', '9', '19', 'Bulutlu', '2020.04.27'),
('18', '5', '12', 'Güneşli', '2020.04.27'),
('20', '8', '14', 'Yağmurlu', '2020.04.27'),
('55', '13', '21', 'Güneşli', '2020.04.27');

INSERT INTO `weather_status_app`.`gift_code` (`code`) VALUES ('XJJD3H79'), ('82LCGDLT'), ('SGJF53D3'), ('1TPLRY9K'), ('FC075UW7'), ('XA02HR6T'), ('ZGC7IS61'), ('AQ7TF2F5'), ('BVPT28IL'), ('QBMK0VU0'), ('RK0OWRC8'), ('S4BIS965'), ('8I52R5GR'), ('6IPPHFCX'), ('H0CCTKEJ'), ('3AA98TI9'), ('HZ1G5G7P'), ('CDO1UBZG'), ('D694MLFG'), ('9OZKMTHY'), ('K34ND3T3'), ('BR2T4OML'), ('EK2NRTJ9'), ('NY44WBSJ'), ('ZPPJ94X6'), ('DSB5RAJM'), ('ADOY8IQJ'), ('7WODXRH3'), ('HGO4N9FF'), ('CEV73HE8'), ('FCGKPX9Q'), ('U0XVWU1F'), ('QRA9R0O9'), ('MUFDRAUK'), ('BQDXPV9Q'), ('4SLCAIUW'), ('LJTFE54T'), ('SUDCZCSV'), ('CZ30XLX4'), ('U28Y2ISU'), ('S7CHKPNF'), ('FWT12VAP'), ('F8YMHX5V'), ('TF4YB2L0'), ('DU2322L3'), ('5MB79M44'), ('Q3QQIU6I'), ('SO9CEQ3G'), ('N09DCXXP'), ('KUAUMQCB'), ('7H8PDUMD'), ('GHV3K08S'), ('R3DF0HL7'), ('WAKB5KDY'), ('UJ9NAXMQ'), ('XH4Y8C4Q'), ('80CT3677'), ('0LH7UNMY'), ('XA1PIPL8'), ('VTXEIZHY'), ('FTHQHCQG'), ('KKV90V1B'), ('LKKXBJGT'), ('Y6URNM1H'), ('HIJ2TQ9Z'), ('T6UGQ7IL'), ('ND4K9AHS'), ('9Z67TLBX'), ('TK4LD0HE'), ('9EHTMZ08'), ('Q04LDN52'), ('HWWGNXGX'), ('MG0H0CNU'), ('J64UV9FL'), ('RGI1O00W'), ('P80SK72H'), ('M41Z3SEP'), ('LX7AQP5B'), ('5FUO5EU6'), ('6ZMUHGJY'), ('Y2G4ZUQO'), ('9DCZ2MVF'), ('3XSRVFWP'), ('3TTT6QBI'), ('TOQP7AVC'), ('IJ7540K0'), ('MVFW9TJT'), ('DNV8L8HS'), ('5JGL7W21'), ('U9TV8SV9'), ('06EJLUUV'), ('JFKOUYE5'), ('Q6F6IID1'), ('NAEJVAV6'), ('UV4VXKFZ'), ('0FYDAMUB'), ('8C4L7F4T'), ('AO22AD0E'), ('AI30LZRS'), ('A9I4KHVL');

ALTER TABLE `weather_status_app`.`token` ADD COLUMN `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '';
ALTER TABLE `weather_status_app`.`user` ADD COLUMN `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '';
ALTER TABLE `weather_status_app`.`user` ADD COLUMN `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '';
