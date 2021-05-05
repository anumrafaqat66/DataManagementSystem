CREATE TABLE `security_info` (
  `id` bigint(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `reg_data` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('technician','manager','hod','weo','other') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



INSERT INTO `security_info` (`id`, `username`, `password`, `reg_data`, `status`) VALUES
(1, 'hod', '12345', '2021-04-28 07:25:58', 'hod'),
(2, 'weo', '12345', '2021-04-28 07:26:37', 'weo'),
(3, 'manager', '12345', '2021-04-28 07:26:59', 'manager'),
(4, 'technician', '12345', '2021-04-28 07:27:19', 'technician'),
(5, 'other', '12345', '2021-04-28 07:27:38', 'other');

ALTER TABLE `security_info`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `security_info`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

CREATE TABLE Controller_Data (
ID BIGINT AUTO_INCREMENT NOT NULL,
Controller_type VARCHAR(30) NOT NULL,
Controller_Name VARCHAR(30) NOT NULL,
ESWB VARCHAR(30) NOT NULL,
Includes VARCHAR(50),
Not_Includes VARCHAR(50),
Associated_Equipment VARCHAR(50),
MTBF NUMERIC(8,2),
MTTR NUMERIC(8,2),
Availability NUMERIC(8,2),
Reliability NUMERIC(8,2),
 PRIMARY KEY(ID,Controller_type, Controller_Name, ESWB) 
);

CREATE TABLE Controller_Data_Detail (
id BIGINT AUTO_INCREMENT NOT NULL PRIMARY KEY,
Controller_Data_ID BIGINT NOT NULL,
TBF NUMERIC(8,2),
TCM NUMERIC(8,2),
TCM_Desc VARCHAR(50),
TPM NUMERIC(8,2),
TPM_Desc VARCHAR(50),
ADLT NUMERIC(8,2),
ADLT_Desc VARCHAR(50),
TTR NUMERIC(8,2),
RegDate Date DEFAULT CURRENT_TIMESTAMP,
FOREIGN KEY (Controller_Data_ID) REFERENCES Controller_Data(ID)
);

create table weapon_systems (
    id bigint NOT NULL AUTO_INCREMENT PRIMARY KEY,
	weapon_name varchar(30) not null,
	Availability NUMERIC(8,2),
	Reliabbility  NUMERIC(8,2),
	Mission_name varchar(30),
    Description varchar(100)
    );
    
create table weapon_system_config (
    id bigint NOT NULL AUTO_INCREMENT PRIMARY KEY,
	weapon_id bigint not null,
	sensor_id bigint not null,
	connection_type varchar(1) not null,
	connection_group int not null,
    FOREIGN KEY (weapon_id) REFERENCES weapon_systems ( id ) ,
    FOREIGN KEY (sensor_id) REFERENCES controller_data ( ID )
    );

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
