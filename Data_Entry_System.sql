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

--
-- Table structure for table `controller_data`
--

CREATE TABLE `controller_data` (
  `ID` bigint(20) NOT NULL,
  `Controller_type` varchar(30) NOT NULL,
  `Controller_Name` varchar(30) NOT NULL,
  `ESWB` varchar(30) NOT NULL,
  `Includes` varchar(50) DEFAULT NULL,
  `Not_Includes` varchar(50) DEFAULT NULL,
  `Associated_Equipment` varchar(50) DEFAULT NULL,
  `MTBF` decimal(8,2) DEFAULT NULL,
  `MTTR` decimal(8,2) DEFAULT NULL,
  `Availability` decimal(8,2) DEFAULT NULL,
  `Reliability` decimal(8,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Table structure for table `controller_data_detail`
--

CREATE TABLE `controller_data_detail` (
  `id` bigint(20) NOT NULL,
  `Controller_Data_ID` bigint(20) NOT NULL,
  `TBF` decimal(8,2) DEFAULT NULL,
  `TCM` decimal(8,2) DEFAULT NULL,
  `TCM_Desc` varchar(50) DEFAULT NULL,
  `TPM` decimal(8,2) DEFAULT NULL,
  `TPM_Desc` varchar(50) DEFAULT NULL,
  `ADLT` decimal(8,2) DEFAULT NULL,
  `ADLT_Desc` varchar(50) DEFAULT NULL,
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
  `status` enum('technician','manager','hod','weo','co') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `security_info`
--

INSERT INTO `security_info` (`id`, `username`, `password`, `reg_data`, `status`) VALUES
(1, 'hod', '12345', '2021-04-28 02:25:58', 'hod'),
(2, 'weo', '12345', '2021-04-28 02:26:37', 'weo'),
(3, 'manager', '12345', '2021-04-28 02:26:59', 'manager'),
(4, 'technician', '12345', '2021-04-28 02:27:19', 'technician'),
(5, 'co', '12345', '2021-04-28 02:27:38', 'co');

-- --------------------------------------------------------

--
-- Table structure for table `weapon_systems`
--

CREATE TABLE `weapon_systems` (
  `id` bigint(20) NOT NULL,
  `weapon_name` varchar(30) NOT NULL,
  `Availability` decimal(8,2) DEFAULT NULL,
  `Reliabbility` decimal(8,2) DEFAULT NULL,
  `Mission_name` varchar(30) DEFAULT NULL,
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
-- Indexes for dumped tables
--

--
-- Indexes for table `controller_data`
--
ALTER TABLE `controller_data`
  ADD PRIMARY KEY (`ID`,`Controller_type`,`Controller_Name`,`ESWB`);

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

insert into controller_data values (1,'Sensor','S1','1001','','','',0.00,0.00,0.00,0.00);
insert into controller_data values (2,'Sensor','S2','1002','','','',0.00,0.00,0.00,0.00);
insert into controller_data values (3,'Sensor','CCS','1003','','','',0.00,0.00,0.00,0.00);

insert into controller_data values (4,'Fire Controller','FC1','2001','','','',0.00,0.00,0.00,0.00);
insert into controller_data values (5,'Fire Controller','FC2','2002','','','',0.00,0.00,0.00,0.00);
insert into controller_data values (6,'Fire Controller','FC3','2003','','','',0.00,0.00,0.00,0.00);
insert into controller_data values (7,'Fire Controller','FC4','2004','','','',0.00,0.00,0.00,0.00);

insert into controller_data values (8,'Weapon','SAM','3001','','','',0.00,0.00,0.00,0.00);
insert into controller_data values (9,'Weapon','Main Gun','3002','','','',0.00,0.00,0.00,0.00);
insert into controller_data values (10,'Weapon','CRG (Port)','3003','','','',0.00,0.00,0.00,0.00);
insert into controller_data values (11,'Weapon','CRG (STDB)','3004','','','',0.00,0.00,0.00,0.00);

insert into controller_data values (12,'Weapon','SSM','3005','','','',0.00,0.00,0.00,0.00);


insert into weapon_systems values (1,'SAM',0.00,0.00,'AAW','Anti Air war mission');

insert into weapon_system_config values (1,1,3,'P','1');
insert into weapon_system_config values (2,1,1,'P','1');
insert into weapon_system_config values (3,1,4,'S','1');
insert into weapon_system_config values (4,1,8,'S','1');

insert into weapon_systems values (2,'Main Gun',0.00,0.00,'AAW','Anti Air war mission');

insert into weapon_system_config values (5,2,3,'P','1');
insert into weapon_system_config values (6,2,1,'P','1');
insert into weapon_system_config values (7,2,5,'S','1');
insert into weapon_system_config values (8,2,9,'S','1');

insert into weapon_systems values (3,'CRG (Port)',0.00,0.00,'AAW','Anti Air war mission');

insert into weapon_system_config values (9,3,3,'P','1');
insert into weapon_system_config values (10,3,1,'P','1');
insert into weapon_system_config values (11,3,6,'P','2');
insert into weapon_system_config values (12,3,7,'P','2');
insert into weapon_system_config values (13,3,10,'S','1');

insert into weapon_systems values (4,'CRG (STDB)',0.00,0.00,'AAW','Anti Air war mission');

insert into weapon_system_config values (14,4,3,'P','1');
insert into weapon_system_config values (15,4,1,'P','1');
insert into weapon_system_config values (16,4,6,'P','2');
insert into weapon_system_config values (17,4,7,'P','2');
insert into weapon_system_config values (18,4,11,'S','1');


--ASuW Mission Entries
insert into weapon_systems values (5,'SSM',0.00,0.00,'ASuW','Anti Surface war mission');
insert into weapon_systems values (6,'Main Gun',0.00,0.00,'ASuW','Anti Surface war mission');
insert into weapon_systems values (7,'CRG (Port)',0.00,0.00,'ASuW','Anti Surface war mission');
insert into weapon_systems values (8,'CRG (STDB)',0.00,0.00,'ASuW','Anti Surface war mission');

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