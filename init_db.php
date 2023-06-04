<?php
$host = "localhost";
$uname = "root";
$pass = "";
$dbname = "physiohut";





$dbh = mysqli_connect($host, $uname, $pass) or die("cannot connect");
mysqli_query($dbh, "DROP DATABASE IF EXISTS physiohut");
$dbinit = "CREATE DATABASE physiohut;";
mysqli_query($dbh, $dbinit);
mysqli_select_db($dbh, $dbname);




echo $dbinit;
$createTables = "CREATE DATABASE IF NOT EXISTS physiohut;
USE physiohut;
CREATE TABLE IF NOT EXISTS doctors(
    id INT NOT NULL AUTO_INCREMENT,
    NAME VARCHAR(255),
    address VARCHAR(255),
    afm CHAR(9),
    PRIMARY KEY(id)
); CREATE TABLE IF NOT EXISTS patients(
    id int(100) AUTO_INCREMENT,
    doc_id INT NOT NULL,
    NAME VARCHAR(255),
    address VARCHAR(255),
    amka CHAR(11),
    FOREIGN KEY(doc_id) REFERENCES doctors(id),
    PRIMARY KEY(id)
); CREATE TABLE IF NOT EXISTS provisions(
    id INT AUTO_INCREMENT,
    date VARCHAR(20),
    CODE VARCHAR(20),
    description VARCHAR(255),
    price DECIMAL(5, 2),
    PRIMARY KEY(id)
); CREATE TABLE IF NOT EXISTS users(
    username VARCHAR(20) UNIQUE NOT NULL,
    PASSWORD VARCHAR(20) UNIQUE NOT NULL,
    TYPE ENUM('doctor', 'patient', 'psf'),
    id INT(100)
); CREATE TABLE IF NOT EXISTS visits(
    patient_id INT,
    provision_id INT,
    -- doctor_id INT,
    time_stamp VARCHAR(255),
    FOREIGN KEY (patient_id) REFERENCES patients(id),
    FOREIGN KEY (provision_id) REFERENCES provisions(id)
    -- FOREIGN KEY (doctor_id) REFERENCES doctors(id)

);
CREATE TABLE IF NOT EXISTS pending(
    pending_id INT NOT NULL AUTO_INCREMENT,
    patient_id INT,
    doctor_id INT,
    patient_name  VARCHAR(100),
    comment TEXT NOT NULL,
    created_at VARCHAR(20),
    location VARCHAR(100),
    created_at_time VARCHAR(10),
    FOREIGN KEY (patient_id) REFERENCES patients(id),
    FOREIGN KEY (doctor_id) REFERENCES doctors(id),
    PRIMARY KEY(pending_id)
);
CREATE TABLE IF NOT EXISTS comments(
    ap_id INT NOT NULL AUTO_INCREMENT,
    patient_id INT,
    doctor_id INT,
    comment VARCHAR(255),
    provision VARCHAR(255),
    created_at VARCHAR(255),
    FOREIGN KEY (patient_id) REFERENCES patients(id),
    FOREIGN KEY (doctor_id) REFERENCES doctors(id),
    PRIMARY KEY(ap_id)
); CREATE TABLE IF NOT EXISTS finalAppoint(
    ap_id INT NOT NULL UNIQUE,
    provision VARCHAR(255),
    FOREIGN KEY (ap_id) REFERENCES comments(ap_id)
);";
mysqli_query($dbh, $createTables);


$sqldoctors = "INSERT INTO doctors VALUES (DEFAULT,'Giannhs Karagiwrgos','Champs Elysee 32','123456789'),
            (DEFAULT,'Giwrgos Karagiannhs','Rue de Tour Eiffel 32','987654321'),
            (DEFAULT,'Giannhs xatzigiwrgos','Lion 15','123456788');";
echo $sqldoctors;
mysqli_query($dbh, $sqldoctors);
$sqlpatients = "INSERT INTO patients VALUES (DEFAULT,2,'Dhmhtris Karamitsos','Champs Elysee 32','123456789'),
            (DEFAULT,3,'Mitsos Karadhmhtris','Rue de Tour Eiffel 32','987654321'),
            (DEFAULT,1,'Dimitris xatzimitsos','Lion 15','123456789');";
echo $sqlpatients;
mysqli_query($dbh, $sqlpatients);
$sqlusers =  "INSERT INTO users VALUES ('dhm','karad','patient',1),
            ('mits','karam','patient',2),
            ('jim','xatzim','patient',3);";
echo $sqlusers;
mysqli_query($dbh, $sqlusers);
$sqlprovisions = "INSERT INTO provisions VALUES (DEFAULT,'10/12/2023','CDE12','You relax a lot',10.40),
            (DEFAULT,'10/12/2023','CVCE123','HELLO WORLD',15.20),
            (DEFAULT,'10/12/2023','hpk12$#','Treats mental illnesses',2.30);";
echo $sqlprovisions;
mysqli_query($dbh, $sqlprovisions);
$sqlvisits = "INSERT INTO visits VALUES(1,2,'12/22/23'),
            (2,1,'12/22/23'),
            (3,1,'12/25/22');";
mysqli_query($dbh, $sqlvisits);
$sqlpending1 = 'INSERT INTO `pending` (`pending_id`, `patient_id`, `doctor_id`, `patient_name`, `comment`, `created_at`, `location`, `created_at_time`) VALUES (DEFAULT, 1, 1, "Mparmpas", "mh tou milas kan", "10/12/2023", "thesallougk", "18:15:16");';
$sqlpending2 = 'INSERT INTO `pending` (`pending_id`, `patient_id`, `doctor_id`, `patient_name`, `comment`, `created_at`, `location`, `created_at_time`) VALUES (DEFAULT, 1, 1, "Mparmpas", "mh tou milas kan", "10/12/2023", "PAPAPAPAP", "00:00:00");';
$sqlcomments1 = "INSERT into comments values(DEFAULT,1,1,'mh ton milas kan auton','cx785856','10/12/2023');";
$sqlcomments2 = "INSERT into comments values(DEFAULT,1,1,'mh ton milas kan auton','askdgvcx123','10/12/2023');";
echo $sqlvisits;
mysqli_query($dbh, $sqlpending1);
mysqli_query($dbh, $sqlpending2);
mysqli_query($dbh, $sqlcomments1);
mysqli_query($dbh, $sqlcomments2);
mysqli_close($dbh);
