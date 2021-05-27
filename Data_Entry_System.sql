-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 08, 2021 at 01:56 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `data_entry_system`
--
CREATE DATABASE IF NOT EXISTS `data_entry_system` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `data_entry_system`;

-- --------------------------------------------------------

DELIMITER $$
--
-- Functions
--
CREATE FUNCTION `Get_Availability` (`Sensor_id` INT) RETURNS DECIMAL(50,2) BEGIN
 DECLARE sensor_value varchar(25);
 DECLARE v_MTBF decimal;
 DECLARE v_MTTR decimal;
 
  Select MTBF into v_MTBF from controller_data where id = sensor_id;
  
  Select MTTR into v_MTTR from controller_data where id = sensor_id;
 
 RETURN (v_MTBF / (v_MTBF + v_MTTR)) * 100;
END$$

--
-- Procedures
--
CREATE PROCEDURE `Calculate_Availability_for_all` ()  BEGIN
 DECLARE loop_count INT;
 DECLARE i INT DEFAULT 1;
 
 select count(*) into loop_count from controller_data;
 
WHILE i <= loop_count DO
    UPDATE controller_data set Availability = get_availability(i) where id = i;

    SET i = i + 1;
END WHILE;
 
END$$

CREATE PROCEDURE `Calculate_TBF_for_all` ()  BEGIN
 DECLARE loop_count INT;
 DECLARE i INT DEFAULT 1;
 
 select count(*) into loop_count from controller_data_detail;
 
WHILE i <= loop_count DO
	update controller_data_detail
	set TBF = DATEDIFF(Failure_start_date,(select Failure_end_date from controller_data_detail where id = i))
	where id = (i+1)
    and id not in (1,4,7,10,13,16,19,22,25,28,31,34,37,40,43,46,49,52,55,58,61,64,67,70,73,76,79,82,85,88,91,94,97,100);

    SET i = i + 1;
END WHILE;
 
END$$

DELIMITER ;

--
-- Table structure for table `ship_data`
--

CREATE TABLE `ship_data` (
  `ID` bigint(20) NOT NULL,
  `Ship_name` varchar(30) NOT NULL,
  `Status` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ship_data`
--
insert into ship_data values (1,'ShipA','Working');
insert into ship_data values (2,'ShipB','Working');

--
-- Table structure for table `controller_data`
--

CREATE TABLE `controller_data` (
  `ID` bigint(20) NOT NULL,
  `Controller_type` varchar(30) NOT NULL,
  `Controller_Name` varchar(30) NOT NULL,
  `Controller_Code` varchar(30),
  `Ship_ID` bigint(20),
  `ESWB` varchar(30) NOT NULL,
  `Includes` varchar(50) DEFAULT NULL,
  `Not_Includes` varchar(50) DEFAULT NULL,
  `Associated_Equipment` varchar(50) DEFAULT NULL,
  `MTBF` decimal(8,2) DEFAULT NULL,
  `MTTR` decimal(8,2) DEFAULT NULL,
  `Availability` decimal(8,2) DEFAULT NULL,
  `Reliability` decimal(8,2) DEFAULT NULL,
  `Default_Reliability` decimal(8,2) DEFAULT 0.00,
  `Comission_date` date DEFAULT NULL,
  `Total_Equipped` int
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Table structure for table `controller_data_detail`
--

CREATE TABLE `controller_data_detail` (
  `id` bigint(20) NOT NULL,
  `Controller_Data_ID` bigint(20) NOT NULL,
  `Failure_start_date` date,
  `Failure_end_date` date,  
  `TBF` decimal(8,2) DEFAULT NULL,
  `TCM` decimal(8,2) DEFAULT NULL,
  `TCM_Desc` varchar(1000) DEFAULT NULL,
  `TPM` decimal(8,2) DEFAULT NULL,
  `TPM_Desc` varchar(1000) DEFAULT NULL,
  `ADLT` decimal(8,2) DEFAULT NULL,
  `ADLT_Desc` varchar(1000) DEFAULT NULL,
  `TTR` decimal(8,2) DEFAULT NULL,
  `RegDate` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



-- --------------------------------------------------------

--
-- Table structure for table `security_info`
--

CREATE TABLE `security_info` (
  `id` bigint(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `reg_data` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('technician','manager','hod','weo','co','admin','typecdr') NOT NULL,
  `ship_ID` bigint(20) 
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `security_info` (`id`, `username`, `password`, `reg_data`, `status`,`ship_ID`) VALUES
(1, 'admin', '$2y$10$uVajLuVrXeV2S4TWWuH4a.CLTS4LW92nmGiitB94akkA6pAWMJyI2', '2021-05-21 19:00:00', 'admin',NULL);

-- --------------------------------------------------------

--
-- Table structure for table `weapon_systems`
--

CREATE TABLE `weapon_systems` (
  `id` bigint(20) NOT NULL,
  `weapon_name` varchar(30) NOT NULL,
  `Availability` decimal(8,2) DEFAULT NULL,
  `Default_Reliability` decimal(8,2) DEFAULT NULL,
  `Reliabbility` decimal(8,2) DEFAULT NULL,
  `Mission_name` varchar(30) DEFAULT NULL,
  `Ship_ID` bigint(20),
  `Description` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `weapon_system_config`
--

CREATE TABLE `weapon_system_config` (
  `id` bigint(20) NOT NULL,
  `weapon_id` bigint(20) NOT NULL,
  `sensor_id` bigint(20) NOT NULL,
  `connection_type` varchar(1) NOT NULL,
  `connection_group` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `missions`
--

CREATE TABLE `missions` (
  `id` bigint(20) NOT NULL,
  `Mission_name` varchar(30) NOT NULL,
  `Mission_desc` varchar(300) DEFAULT NULL,
  `Availability` decimal(8,2) DEFAULT NULL,
  `Reliability` decimal(8,2) DEFAULT NULL,
  `Ship_ID` bigint(20)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `missions`
--
insert into missions values (1,'AAW','Anti Air war mission',0.00,0.00,1);
insert into missions values (2,'ASuW','Anti Surface war mission',0.00,0.00,1);
insert into missions values (3,'ASW','Anti Submarine war mission',0.00,0.00,1);
insert into missions values (4,'EW','Electronic war mission',0.00,0.00,1);

-- Ship B Data
insert into missions values (5,'AAW','Anti Air war mission',0.00,0.00,2);
insert into missions values (6,'ASuW','Anti Surface war mission',0.00,0.00,2);
insert into missions values (7,'ASW','Anti Submarine war mission',0.00,0.00,2);
insert into missions values (8,'EW','Electronic war mission',0.00,0.00,2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `controller_data`
--
ALTER TABLE `controller_data`
  ADD PRIMARY KEY (`ID`,`Controller_type`,`Controller_Name`,`Ship_ID`,`ESWB`);

--
-- Indexes for table `controller_data_detail`
--
ALTER TABLE `controller_data_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Controller_Data_ID` (`Controller_Data_ID`);

--
-- Indexes for table `security_info`
--
ALTER TABLE `security_info`
  ADD PRIMARY KEY (`id`);
  
--
-- Indexes for table `ship_data`
--
ALTER TABLE `ship_data`
  ADD PRIMARY KEY (`ID`);


--
-- Indexes for table `weapon_systems`
--
ALTER TABLE `weapon_systems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `weapon_system_config`
--
ALTER TABLE `weapon_system_config`
  ADD PRIMARY KEY (`id`),
  ADD KEY `weapon_id` (`weapon_id`),
  ADD KEY `sensor_id` (`sensor_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `controller_data`
--
ALTER TABLE `controller_data`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `controller_data_detail`
--
ALTER TABLE `controller_data_detail`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `security_info`
--
ALTER TABLE `security_info`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
  
  
--
-- AUTO_INCREMENT for table `ship_data`
--
ALTER TABLE `ship_data`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT;
  

--
-- AUTO_INCREMENT for table `weapon_systems`
--
ALTER TABLE `weapon_systems`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `weapon_system_config`
--
ALTER TABLE `weapon_system_config`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `controller_data`
--
-- ALTER TABLE `controller_data`
--  ADD CONSTRAINT `controller_data_ibfk_1` FOREIGN KEY (`Ship_ID`) REFERENCES `Ship_data` (`ID`);

--
-- Constraints for table `controller_data_detail`
--
ALTER TABLE `controller_data_detail`
  ADD CONSTRAINT `controller_data_detail_ibfk_1` FOREIGN KEY (`Controller_Data_ID`) REFERENCES `controller_data` (`ID`);
  

--
-- Constraints for table `weapon_system_config`
--
ALTER TABLE `weapon_system_config`
  ADD CONSTRAINT `weapon_system_config_ibfk_1` FOREIGN KEY (`weapon_id`) REFERENCES `weapon_systems` (`id`),
  ADD CONSTRAINT `weapon_system_config_ibfk_2` FOREIGN KEY (`sensor_id`) REFERENCES `controller_data` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


delete from weapon_system_config;
delete from controller_data_detail;
delete from controller_data;
delete from weapon_systems;

insert into controller_data values (1,'Sensor','S1','S1',1,'1001','','','',0.00,0.00,0.00,0.00,0.00,'2019-07-01',4);
insert into controller_data values (2,'Sensor','S2','S2',1,'1002','','','',0.00,0.00,0.00,0.00,0.00,'2019-12-01',4);
insert into controller_data values (3,'Sensor','CCS','CCS',1,'1003','','','',0.00,0.00,0.00,0.00,0.00,'2020-01-01',4);

insert into controller_data values (4,'Fire Controller','FC1','FC1',1,'2001','','','',0.00,0.00,0.00,0.00,0.00,'2019-08-01',4);
insert into controller_data values (5,'Fire Controller','FC2','FC2',1,'2002','','','',0.00,0.00,0.00,0.00,0.00,'2019-11-01',4);
insert into controller_data values (6,'Fire Controller','FC3','FC3',1,'2003','','','',0.00,0.00,0.00,0.00,0.00,'2020-01-01',4);
insert into controller_data values (7,'Fire Controller','FC4','FC4',1,'2004','','','',0.00,0.00,0.00,0.00,0.00,'2020-01-15',4);

-- AAW Mission
insert into controller_data values (8,'Weapon','SAM','SAM',1,'3001','','','',0.00,0.00,0.00,0.00,0.00,'2019-06-01',4);
insert into controller_data values (9,'Weapon','Main Gun','MG',1,'3002','','','',0.00,0.00,0.00,0.00,0.00,'2020-01-01',4);
insert into controller_data values (10,'Weapon','CRG (Port)','CP',1,'3003','','','',0.00,0.00,0.00,0.00,0.00,'2019-12-01',4);
insert into controller_data values (11,'Weapon','CRG (STDB)','CS',1,'3004','','','',0.00,0.00,0.00,0.00,0.00,'2019-11-01',4);

-- ASuW Mission
insert into controller_data values (12,'Weapon','SSM','SSM',1,'3005','','','',0.00,0.00,0.00,0.00,0.00,'2020-01-01',4);

-- ASW Mission
insert into controller_data values (13,'Weapon','Torpedo','TOR',1,'3006','','','',0.00,0.00,0.00,0.00,0.00,'2019-10-01',4);
insert into controller_data values (14,'Weapon','RDC','RDC',1,'3007','','','',0.00,0.00,0.00,0.00,0.00,'2019-12-01',4);
insert into controller_data values (15,'Sensor','SONAR','SONAR',1,'1004','','','',0.00,0.00,0.00,0.00,0.00,'2020-01-01',4);

-- EW Mission
insert into controller_data values (16,'Weapon','NRJ','NRJ',1,'3008','','','',0.00,0.00,0.00,0.00,0.00,'2019-12-01',4);
insert into controller_data values (17,'Weapon','PJ-46','PJ-46',1,'3009','','','',0.00,0.00,0.00,0.00,0.00,'2020-01-01',4);

-- -- Data for Ship B
insert into controller_data values (18,'Sensor','S1','S1',2,'1001','','','',0.00,0.00,0.00,0.00,0.00,'2019-11-01',4);
insert into controller_data values (19,'Sensor','S2','S2',2,'1002','','','',0.00,0.00,0.00,0.00,0.00,'2019-12-01',4);
insert into controller_data values (20,'Sensor','CCS','CCS',2,'1003','','','',0.00,0.00,0.00,0.00,0.00,'2019-10-01',4);

insert into controller_data values (21,'Fire Controller','FC1','FC1',2,'2001','','','',0.00,0.00,0.00,0.00,0.00,'2019-12-01',4);
insert into controller_data values (22,'Fire Controller','FC2','FC2',2,'2002','','','',0.00,0.00,0.00,0.00,0.00,'2019-11-01',4);
insert into controller_data values (23,'Fire Controller','FC3','FC3',2,'2003','','','',0.00,0.00,0.00,0.00,0.00,'2019-10-01',4);
insert into controller_data values (24,'Fire Controller','FC4','FC4',2,'2004','','','',0.00,0.00,0.00,0.00,0.00,'2019-09-15',4);

-- AAW Mission
insert into controller_data values (25,'Weapon','SAM','SAM',2,'3001','','','',0.00,0.00,0.00,0.00,0.00,'2019-06-01',4);
insert into controller_data values (26,'Weapon','Main Gun','MG',2,'3002','','','',0.00,0.00,0.00,0.00,0.00,'2019-10-01',4);
insert into controller_data values (27,'Weapon','CRG (Port)','CP',2,'3003','','','',0.00,0.00,0.00,0.00,0.00,'2019-12-01',4);
insert into controller_data values (28,'Weapon','CRG (STDB)','CS',2,'3004','','','',0.00,0.00,0.00,0.00,0.00,'2019-11-01',4);

-- ASuW Mission
insert into controller_data values (29,'Weapon','SSM','SSM',2,'3005','','','',0.00,0.00,0.00,0.00,0.00,'2019-12-01',4);

-- ASW Mission
insert into controller_data values (30,'Weapon','Torpedo','TOR',2,'3006','','','',0.00,0.00,0.00,0.00,0.00,'2019-11-01',4);
insert into controller_data values (31,'Weapon','RDC','RDC',2,'3007','','','',0.00,0.00,0.00,0.00,0.00,'2019-12-01',4);
insert into controller_data values (32,'Sensor','SONAR','SONAR',2,'1004','','','',0.00,0.00,0.00,0.00,0.00,'2019-10-01',4);

-- EW Mission
insert into controller_data values (33,'Weapon','NRJ','NRJ',2,'3008','','','',0.00,0.00,0.00,0.00,0.00,'2019-11-01',4);
insert into controller_data values (34,'Weapon','PJ-46','PJ-46',2,'3009','','','',0.00,0.00,0.00,0.00,0.00,'2019-12-01',4);

-- -------------------------

insert into weapon_systems values (1,'SAM',0.00,0.00,0.00,'AAW',1,'Anti Air war mission');
insert into weapon_systems values (2,'Main Gun',0.00,0.00,0.00,'AAW',1,'Anti Air war mission');
insert into weapon_systems values (3,'CRG (Port)',0.00,0.00,0.00,'AAW',1,'Anti Air war mission');
insert into weapon_systems values (4,'CRG (STDB)',0.00,0.00,0.00,'AAW',1,'Anti Air war mission');



insert into weapon_system_config values (1,1,3,'P','1');
insert into weapon_system_config values (2,1,1,'P','1');
insert into weapon_system_config values (3,1,4,'S','1');
insert into weapon_system_config values (4,1,8,'S','1');

insert into weapon_system_config values (5,2,3,'P','1');
insert into weapon_system_config values (6,2,1,'P','1');
insert into weapon_system_config values (7,2,5,'S','1');
insert into weapon_system_config values (8,2,9,'S','1');

insert into weapon_system_config values (9,3,3,'P','1');
insert into weapon_system_config values (10,3,1,'P','1');
insert into weapon_system_config values (11,3,6,'P','2');
insert into weapon_system_config values (12,3,7,'P','2');
insert into weapon_system_config values (13,3,10,'S','1');

insert into weapon_system_config values (14,4,3,'P','1');
insert into weapon_system_config values (15,4,1,'P','1');
insert into weapon_system_config values (16,4,6,'P','2');
insert into weapon_system_config values (17,4,7,'P','2');
insert into weapon_system_config values (18,4,11,'S','1');

-- ASuW Mission Entries
insert into weapon_systems values (5,'SSM',0.00,0.00,0.00,'ASuW',1,'Anti Surface war mission');
insert into weapon_systems values (6,'Main Gun',0.00,0.00,0.00,'ASuW',1,'Anti Surface war mission');
insert into weapon_systems values (7,'CRG (Port)',0.00,0.00,0.00,'ASuW',1,'Anti Surface war mission');
insert into weapon_systems values (8,'CRG (STDB)',0.00,0.00,0.00,'ASuW',1,'Anti Surface war mission');

insert into weapon_system_config values (19,5,1,'P','1');
insert into weapon_system_config values (20,5,2,'P','1');
insert into weapon_system_config values (21,5,12,'S','1');

insert into weapon_system_config values (23,6,3,'P','1');
insert into weapon_system_config values (24,6,1,'P','1');
insert into weapon_system_config values (25,6,5,'S','1');
insert into weapon_system_config values (26,6,9,'S','1');

insert into weapon_system_config values (27,7,3,'P','1');
insert into weapon_system_config values (28,7,1,'P','1');
insert into weapon_system_config values (29,7,6,'P','2');
insert into weapon_system_config values (30,7,7,'P','2');
insert into weapon_system_config values (31,7,10,'S','1');

insert into weapon_system_config values (32,8,3,'P','1');
insert into weapon_system_config values (33,8,1,'P','1');
insert into weapon_system_config values (34,8,6,'P','2');
insert into weapon_system_config values (35,8,7,'P','2');
insert into weapon_system_config values (36,8,11,'S','1');

-- ASW Mission Entries
insert into weapon_systems values (9,'Torpedo',0.00,0.00,0.00,'ASW',1,'Anti-submarine warfare mission');
insert into weapon_systems values (10,'RDC',0.00,0.00,0.00,'ASW',1,'Anti-submarine warfare mission');

insert into weapon_system_config values (37,9,15,'S','1');
insert into weapon_system_config values (38,9,13,'S','1');

insert into weapon_system_config values (39,10,15,'S','1');
insert into weapon_system_config values (40,10,14,'S','1');

-- EW Mission Entries 
insert into weapon_systems values (11,'NRJ',0.00,0.00,0.00,'EW',1,'Electronic warfare mission');
insert into weapon_systems values (12,'PJ-46',0.00,0.00,0.00,'EW',1,'Electronic warfare mission');

insert into weapon_system_config values (41,11,16,'S','1');

insert into weapon_system_config values (42,12,3,'P','1');
insert into weapon_system_config values (43,12,16,'P','1');
insert into weapon_system_config values (44,12,17,'S','1');

-- ship B data

insert into weapon_systems values (13,'SAM',0.00,0.00,0.00,'AAW',2,'Anti Air war mission');
insert into weapon_systems values (14,'Main Gun',0.00,0.00,0.00,'AAW',2,'Anti Air war mission');
insert into weapon_systems values (15,'CRG (Port)',0.00,0.00,0.00,'AAW',2,'Anti Air war mission');
insert into weapon_systems values (16,'CRG (STDB)',0.00,0.00,0.00,'AAW',2,'Anti Air war mission');

-- ship B data
insert into weapon_systems values (17,'SSM',0.00,0.00,0.00,'ASuW',2,'Anti Surface war mission');
insert into weapon_systems values (18,'Main Gun',0.00,0.00,0.00,'ASuW',2,'Anti Surface war mission');
insert into weapon_systems values (19,'CRG (Port)',0.00,0.00,0.00,'ASuW',2,'Anti Surface war mission');
insert into weapon_systems values (20,'CRG (STDB)',0.00,0.00,0.00,'ASuW',2,'Anti Surface war mission');

insert into weapon_systems values (21,'Torpedo',0.00,0.00,0.00,'ASW',2,'Anti-submarine warfare mission');
insert into weapon_systems values (22,'RDC',0.00,0.00,0.00,'ASW',2,'Anti-submarine warfare mission');

insert into weapon_systems values (23,'NRJ',0.00,0.00,0.00,'EW',2,'Electronic warfare mission');
insert into weapon_systems values (24,'PJ-46',0.00,0.00,0.00,'EW',2,'Electronic warfare mission');

-- Sample Data Insertion 

insert into controller_data_detail values (1,1,'2020-03-01','2020-04-01',280,20,'',40,'',25,'',0.00, CURDATE());
insert into controller_data_detail values (2,1,'2020-06-01','2020-07-15',250,30,'',50,'',35,'',0.00, CURDATE());
insert into controller_data_detail values (3,1,'2021-02-01','2021-03-01',320,20,'',10,'',15,'',0.00, CURDATE());

insert into controller_data_detail values (4,2,'2020-04-01','2020-05-01',300,20,'',25,'',20,'',0.00, CURDATE());
insert into controller_data_detail values (5,2,'2020-07-01','2020-08-01',310,10,'',25,'',20,'',0.00, CURDATE());
insert into controller_data_detail values (6,2,'2021-01-01','2021-03-01',250,30,'',50,'',35,'',0.00, CURDATE());

insert into controller_data_detail values (7,3,'2020-07-01','2020-09-01',290,20,'',25,'',30,'',0.00, CURDATE());
insert into controller_data_detail values (8,3,'2020-11-01','2020-11-15',310,10,'',25,'',20,'',0.00, CURDATE());
insert into controller_data_detail values (9,3,'2021-01-01','2021-03-01',280,20,'',40,'',25,'',0.00, CURDATE());

insert into controller_data_detail values (10,4,'2020-04-01','2020-04-25',280,20,'',40,'',25,'',0.00, CURDATE());
insert into controller_data_detail values (11,4,'2020-08-01','2020-09-15',290,20,'',35,'',20,'',0.00, CURDATE());
insert into controller_data_detail values (12,4,'2021-01-01','2021-03-01',250,30,'',50,'',35,'',0.00, CURDATE());

insert into controller_data_detail values (13,5,'2020-02-01','2020-02-20',280,20,'',40,'',25,'',0.00, CURDATE());
insert into controller_data_detail values (14,5,'2020-04-01','2020-05-01',310,10,'',25,'',20,'',0.00, CURDATE());
insert into controller_data_detail values (15,5,'2021-01-01','2021-03-01',320,20,'',10,'',15,'',0.00, CURDATE());

insert into controller_data_detail values (16,6,'2020-03-01','2020-03-15',250,30,'',50,'',35,'',0.00, CURDATE());
insert into controller_data_detail values (17,6,'2020-12-01','2020-12-25',340,10,'',5,'',10,'',0.00, CURDATE());
insert into controller_data_detail values (18,6,'2021-01-01','2021-03-01',280,20,'',40,'',25,'',0.00, CURDATE());

insert into controller_data_detail values (19,7,'2020-03-01','2020-03-15',300,20,'',25,'',20,'',0.00, CURDATE());
insert into controller_data_detail values (20,7,'2020-10-01','2020-11-01',290,30,'',25,'',20,'',0.00, CURDATE());
insert into controller_data_detail values (21,7,'2021-01-01','2021-03-01',250,30,'',50,'',35,'',0.00, CURDATE());

insert into controller_data_detail values (22,8,'2020-04-01','2020-04-15',300,20,'',25,'',20,'',0.00, CURDATE());
insert into controller_data_detail values (23,8,'2020-06-01','2020-06-25',330,10,'',15,'',10,'',0.00, CURDATE());
insert into controller_data_detail values (24,8,'2021-01-01','2021-03-01',320,20,'',10,'',15,'',0.00, CURDATE());

insert into controller_data_detail values (25,9,'2020-03-01','2020-03-10',280,20,'',40,'',25,'',0.00, CURDATE());
insert into controller_data_detail values (26,9,'2020-05-01','2020-05-25',250,30,'',50,'',35,'',0.00, CURDATE());
insert into controller_data_detail values (27,9,'2021-01-01','2021-03-01',320,20,'',10,'',15,'',0.00, CURDATE());

insert into controller_data_detail values (28,10,'2020-07-01','2020-07-25',300,20,'',25,'',20,'',0.00, CURDATE());
insert into controller_data_detail values (29,10,'2020-09-01','2020-10-15',310,10,'',25,'',20,'',0.00, CURDATE());
insert into controller_data_detail values (30,10,'2021-01-01','2021-03-01',250,30,'',50,'',35,'',0.00, CURDATE());

insert into controller_data_detail values (31,11,'2020-03-01','2020-04-25',300,20,'',25,'',20,'',0.00, CURDATE());
insert into controller_data_detail values (32,11,'2020-05-01','2020-06-30',340,5,'',10,'',10,'',0.00, CURDATE());
insert into controller_data_detail values (33,11,'2021-01-01','2021-03-01',320,20,'',10,'',15,'',0.00, CURDATE());

insert into controller_data_detail values (34,12,'2020-04-01','2020-05-05',300,20,'',25,'',20,'',0.00, CURDATE());
insert into controller_data_detail values (35,12,'2020-06-01','2020-07-10',310,10,'',25,'',20,'',0.00, CURDATE());
insert into controller_data_detail values (36,12,'2021-01-01','2021-03-01',250,30,'',50,'',35,'',0.00, CURDATE());

insert into controller_data_detail values (37,13,'2020-07-01','2020-08-15',300,20,'',25,'',20,'',0.00, CURDATE());
insert into controller_data_detail values (38,13,'2020-09-01','2020-10-20',310,10,'',25,'',20,'',0.00, CURDATE());
insert into controller_data_detail values (39,13,'2021-01-01','2021-03-01',320,10,'',20,'',15,'',0.00, CURDATE());

insert into controller_data_detail values (40,14,'2020-10-01','2020-11-15',300,20,'',25,'',20,'',0.00, CURDATE());
insert into controller_data_detail values (41,14,'2020-12-01','2020-12-30',310,10,'',25,'',20,'',0.00, CURDATE());
insert into controller_data_detail values (42,14,'2021-01-01','2021-03-01',250,30,'',50,'',35,'',0.00, CURDATE());

insert into controller_data_detail values (43,15,'2020-09-01','2020-09-30',300,20,'',25,'',20,'',0.00, CURDATE());
insert into controller_data_detail values (44,15,'2020-11-01','2020-11-15',310,10,'',25,'',20,'',0.00, CURDATE());
insert into controller_data_detail values (45,15,'2021-01-01','2021-03-01',280,20,'',40,'',25,'',0.00, CURDATE());

insert into controller_data_detail values (46,16,'2020-04-01','2020-04-25',300,20,'',25,'',20,'',0.00, CURDATE());
insert into controller_data_detail values (47,16,'2020-05-01','2020-05-20',310,10,'',25,'',20,'',0.00, CURDATE());
insert into controller_data_detail values (48,16,'2021-01-01','2021-03-01',330,10,'',10,'',15,'',0.00, CURDATE());

insert into controller_data_detail values (49,17,'2020-06-01','2020-07-01',300,20,'',25,'',20,'',0.00, CURDATE());
insert into controller_data_detail values (50,17,'2020-08-01','2020-09-01',250,30,'',50,'',35,'',0.00, CURDATE());
insert into controller_data_detail values (51,17,'2021-01-01','2021-03-01',330,10,'',10,'',15,'',0.00, CURDATE());


-- Data for ship B sensors

insert into controller_data_detail values (52,18,'2020-03-01','2020-04-01',280,20,'',40,'',25,'',0.00, CURDATE());
insert into controller_data_detail values (53,18,'2020-06-01','2020-07-15',250,30,'',50,'',35,'',0.00, CURDATE());
insert into controller_data_detail values (54,18,'2021-02-01','2021-03-01',320,20,'',10,'',15,'',0.00, CURDATE());

insert into controller_data_detail values (55,19,'2020-04-01','2020-05-01',300,20,'',25,'',20,'',0.00, CURDATE());
insert into controller_data_detail values (56,19,'2020-07-01','2020-08-01',310,10,'',25,'',20,'',0.00, CURDATE());
insert into controller_data_detail values (57,19,'2021-01-01','2021-03-01',250,30,'',50,'',35,'',0.00, CURDATE());

insert into controller_data_detail values (58,20,'2020-07-01','2020-09-01',290,20,'',25,'',30,'',0.00, CURDATE());
insert into controller_data_detail values (59,20,'2020-11-01','2020-11-15',310,10,'',25,'',20,'',0.00, CURDATE());
insert into controller_data_detail values (60,20,'2021-01-01','2021-03-01',280,20,'',40,'',25,'',0.00, CURDATE());

insert into controller_data_detail values (61,21,'2020-04-01','2020-04-25',280,20,'',40,'',25,'',0.00, CURDATE());
insert into controller_data_detail values (62,21,'2020-08-01','2020-09-15',290,20,'',35,'',20,'',0.00, CURDATE());
insert into controller_data_detail values (63,21,'2021-01-01','2021-03-01',250,30,'',50,'',35,'',0.00, CURDATE());

insert into controller_data_detail values (64,22,'2020-02-01','2020-02-20',280,20,'',40,'',25,'',0.00, CURDATE());
insert into controller_data_detail values (65,22,'2020-04-01','2020-05-01',310,10,'',25,'',20,'',0.00, CURDATE());
insert into controller_data_detail values (66,22,'2021-01-01','2021-03-01',320,20,'',10,'',15,'',0.00, CURDATE());

insert into controller_data_detail values (67,23,'2020-03-01','2020-03-15',250,30,'',50,'',35,'',0.00, CURDATE());
insert into controller_data_detail values (68,23,'2020-12-01','2020-12-25',340,10,'',5,'',10,'',0.00, CURDATE());
insert into controller_data_detail values (69,23,'2021-01-01','2021-03-01',280,20,'',40,'',25,'',0.00, CURDATE());

insert into controller_data_detail values (70,24,'2020-03-01','2020-03-15',300,20,'',25,'',20,'',0.00, CURDATE());
insert into controller_data_detail values (71,24,'2020-10-01','2020-11-01',290,30,'',25,'',20,'',0.00, CURDATE());
insert into controller_data_detail values (72,24,'2021-01-01','2021-03-01',250,30,'',50,'',35,'',0.00, CURDATE());

insert into controller_data_detail values (73,25,'2020-04-01','2020-04-15',300,20,'',25,'',20,'',0.00, CURDATE());
insert into controller_data_detail values (74,25,'2020-06-01','2020-06-25',330,10,'',15,'',10,'',0.00, CURDATE());
insert into controller_data_detail values (75,25,'2021-01-01','2021-03-01',320,20,'',10,'',15,'',0.00, CURDATE());

insert into controller_data_detail values (76,26,'2020-03-01','2020-03-10',280,20,'',40,'',25,'',0.00, CURDATE());
insert into controller_data_detail values (77,26,'2020-05-01','2020-05-25',250,30,'',50,'',35,'',0.00, CURDATE());
insert into controller_data_detail values (78,26,'2021-01-01','2021-03-01',320,20,'',10,'',15,'',0.00, CURDATE());

insert into controller_data_detail values (79,27,'2020-07-01','2020-07-25',300,20,'',25,'',20,'',0.00, CURDATE());
insert into controller_data_detail values (80,27,'2020-09-01','2020-10-15',310,10,'',25,'',20,'',0.00, CURDATE());
insert into controller_data_detail values (81,27,'2021-01-01','2021-03-01',250,30,'',50,'',35,'',0.00, CURDATE());

insert into controller_data_detail values (82,28,'2020-03-01','2020-04-25',300,20,'',25,'',20,'',0.00, CURDATE());
insert into controller_data_detail values (83,28,'2020-05-01','2020-06-30',340,5,'',10,'',10,'',0.00, CURDATE());
insert into controller_data_detail values (84,28,'2021-01-01','2021-03-01',320,20,'',10,'',15,'',0.00, CURDATE());

insert into controller_data_detail values (85,29,'2020-04-01','2020-05-05',300,20,'',25,'',20,'',0.00, CURDATE());
insert into controller_data_detail values (86,29,'2020-06-01','2020-07-10',310,10,'',25,'',20,'',0.00, CURDATE());
insert into controller_data_detail values (87,29,'2021-01-01','2021-03-01',250,30,'',50,'',35,'',0.00, CURDATE());

insert into controller_data_detail values (88,30,'2020-07-01','2020-08-15',300,20,'',25,'',20,'',0.00, CURDATE());
insert into controller_data_detail values (89,30,'2020-09-01','2020-10-20',310,10,'',25,'',20,'',0.00, CURDATE());
insert into controller_data_detail values (90,30,'2021-01-01','2021-03-01',320,10,'',20,'',15,'',0.00, CURDATE());

insert into controller_data_detail values (91,31,'2020-10-01','2020-11-15',300,20,'',25,'',20,'',0.00, CURDATE());
insert into controller_data_detail values (92,31,'2020-12-01','2020-12-30',310,10,'',25,'',20,'',0.00, CURDATE());
insert into controller_data_detail values (93,31,'2021-01-01','2021-03-01',250,30,'',50,'',35,'',0.00, CURDATE());

insert into controller_data_detail values (94,32,'2020-09-01','2020-09-30',300,20,'',25,'',20,'',0.00, CURDATE());
insert into controller_data_detail values (95,32,'2020-11-01','2020-11-15',310,10,'',25,'',20,'',0.00, CURDATE());
insert into controller_data_detail values (96,32,'2021-01-01','2021-03-01',280,20,'',40,'',25,'',0.00, CURDATE());

insert into controller_data_detail values (97,33,'2020-04-01','2020-04-25',300,20,'',25,'',20,'',0.00, CURDATE());
insert into controller_data_detail values (98,33,'2020-05-01','2020-05-20',310,10,'',25,'',20,'',0.00, CURDATE());
insert into controller_data_detail values (99,33,'2021-01-01','2021-03-01',330,10,'',10,'',15,'',0.00, CURDATE());

insert into controller_data_detail values (100,34,'2020-06-01','2020-07-01',300,20,'',25,'',20,'',0.00, CURDATE());
insert into controller_data_detail values (101,34,'2020-08-01','2020-09-01',250,30,'',50,'',35,'',0.00, CURDATE());
insert into controller_data_detail values (102,34,'2021-01-01','2021-03-01',330,10,'',10,'',15,'',0.00, CURDATE());



-- Configuration Values for Ship B

insert into weapon_system_config values (45,13,20,'P','1');
insert into weapon_system_config values (46,13,18,'P','1');
insert into weapon_system_config values (47,13,21,'S','1');
insert into weapon_system_config values (48,13,25,'S','1');
insert into weapon_system_config values (49,14,20,'P','1');
insert into weapon_system_config values (50,14,18,'P','1');
insert into weapon_system_config values (51,14,22,'S','1');
insert into weapon_system_config values (52,14,26,'S','1');
insert into weapon_system_config values (53,15,20,'P','1');
insert into weapon_system_config values (54,15,18,'P','1');
insert into weapon_system_config values (55,15,23,'P','2');
insert into weapon_system_config values (56,15,24,'P','2');
insert into weapon_system_config values (57,15,27,'S','1');
insert into weapon_system_config values (58,16,20,'P','1');
insert into weapon_system_config values (59,16,18,'P','1');
insert into weapon_system_config values (60,16,23,'P','2');
insert into weapon_system_config values (61,16,24,'P','2');
insert into weapon_system_config values (62,16,28,'S','1');
insert into weapon_system_config values (63,17,18,'P','1');
insert into weapon_system_config values (64,17,19,'P','1');
insert into weapon_system_config values (65,17,29,'S','1');
insert into weapon_system_config values (66,18,20,'P','1');
insert into weapon_system_config values (67,18,18,'P','1');
insert into weapon_system_config values (68,18,22,'S','1');
insert into weapon_system_config values (69,18,26,'S','1');
insert into weapon_system_config values (70,19,20,'P','1');
insert into weapon_system_config values (71,19,18,'P','1');
insert into weapon_system_config values (72,19,23,'P','2');
insert into weapon_system_config values (73,19,24,'P','2');
insert into weapon_system_config values (74,19,27,'S','1');
insert into weapon_system_config values (75,20,20,'P','1');
insert into weapon_system_config values (76,20,18,'P','1');
insert into weapon_system_config values (77,20,23,'P','2');
insert into weapon_system_config values (78,20,24,'P','2');
insert into weapon_system_config values (79,20,28,'S','1');
insert into weapon_system_config values (80,21,32,'S','1');
insert into weapon_system_config values (81,21,30,'S','1');
insert into weapon_system_config values (82,22,32,'S','1');
insert into weapon_system_config values (83,22,31,'S','1');
insert into weapon_system_config values (84,23,33,'S','1');
insert into weapon_system_config values (85,24,20,'P','1');
insert into weapon_system_config values (86,24,33,'P','1');
insert into weapon_system_config values (87,24,34,'S','1');


update controller_data_detail set TTR = DATEDIFF(Failure_end_date, Failure_start_date);

update controller_data_detail
set TCM = FLOOR(TTR / 3),	TPM = FLOOR(TTR / 3), ADLT = CEIL(TTR / 3);

update controller_data_detail
set TCM = TCM + 1 
where id in (select id from controller_data_detail where TCM + TPM + ADLT <> TTR);

UPDATE controller_data_detail cdd JOIN controller_data cd ON cdd.Controller_Data_ID = cd.ID
  SET cdd.TBF = DATEDIFF(cdd.Failure_start_date, cd.Comission_date)
WHERE cdd.id in (1,4,7,10,13,16,19,22,25,28,31,34,37,40,43,46,49,52,55,58,61,64,67,70,73,76,79,82,85,88,91,94,97,100);

call calculate_TBF_for_all;

update controller_data
set MTBF = (select sum(cdd.TBF)/3
            from controller_data_detail cdd
			where controller_data.ID = cdd.Controller_Data_ID),
    MTTR = (select sum(cdd.TTR)/3
            from controller_data_detail cdd
			where controller_data.ID = cdd.Controller_Data_ID);


call calculate_availability_for_all;


Drop procedure calculate_availability_for_all;
Drop Function get_availability;
Drop PROCEDURE calculate_TBF_for_all;