<?php
    $host="localhost";
    $uname="root";
    $pass="";
    $dbname="physiohut";
    
    



    $dbh = mysqli_connect($host,$uname,$pass) or die("cannot connect");
    mysqli_select_db($dbh, $dbname);

    $dbinit = "DROP DATABASE IF EXISTS physiohut;
            CREATE DATABASE physiohut;
            USE physiohut;";
    mysqli_query($dbh, $dbinit);
    echo $dbinit;
    $createTables = "CREATE TABLE doctors(
        id INT NOT NULL AUTO_INCREMENT,
        NAME VARCHAR(255),
        address VARCHAR(255),
        afm CHAR(9),
        PRIMARY KEY(id)
    ); 
    CREATE TABLE patients(
        id int(100) AUTO_INCREMENT,
        doc_id INT NOT NULL,
        NAME VARCHAR(255),
        address VARCHAR(255),
        amka CHAR(11),
        FOREIGN KEY(doc_id) REFERENCES doctors(id),
        PRIMARY KEY(id)
    ); 
    CREATE TABLE provisions(
        id INT AUTO_INCREMENT,
        date VARCHAR(20),
        CODE VARCHAR(20),
        description VARCHAR(255),
        price DECIMAL(5, 2),
        PRIMARY KEY(id)
    ); 
    CREATE TABLE users(
        username VARCHAR(20) UNIQUE NOT NULL,
        PASSWORD VARCHAR(20) UNIQUE NOT NULL,
        TYPE ENUM('doctor', 'patient', 'psf'),
        id INT(100)
    ); 
    CREATE TABLE visits(
        patient_id INT,
        provision_id INT,
        -- doctor_id INT,
        time_stamp VARCHAR(255),
        FOREIGN KEY (patient_id) REFERENCES patients(id),
        FOREIGN KEY (provision_id) REFERENCES provisions(id)
        -- FOREIGN KEY (doctor_id) REFERENCES doctors(id)
    );
    CREATE TABLE comments(
        ap_id INT,
        patient_id INT,
        doctor_id INT,
        comment VARCHAR(255),
        provision VARCHAR(255),
        created_at VARCHAR(255),
        FOREIGN KEY (patient_id) REFERENCES patients(id),
        FOREIGN KEY (doctor_id) REFERENCES doctors(id),
        PRIMARY KEY(ap_id)
    ); 
    CREATE TABLE finalAppoint(
        ap_id INT,
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
    $sqlusers =    "INSERT INTO users VALUES ('dhm','karad','patient',1),
            ('mits','karam','patient',2),
            ('jim','xatzim','patient',3);";
    echo $sqlusers;
    mysqli_query($dbh, $sqlusers);        
    $sqlprovisions = "INSERT INTO provisions VALUES (DEFAULT,'CDE12','You relax a lot',10.40),
            (DEFAULT,'CVCE123','HELLO WORLD',15.20),
            (DEFAULT,'hpk12$#','Treats mental illnesses',2.30);";
    echo $sqlprovisions;
    mysqli_query($dbh, $sqlprovisions);
    $sqlvisits = "INSERT INTO visits VALUES(1,2,'12/22/23'),
            (2,1,'12/22/23'),
            (3,1,'12/25/22');"; 
            
    echo $sqlvisits;
    mysqli_query($dbh, $sqlvisits);
    mysqli_close($dbh);
?>