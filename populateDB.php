<?php
    $host="localhost";
    $uname="root";
    $pass="";
    $dbname="physiohut";
    
    $dbh = mysqli_connect($host,$uname,$pass) or die("cannot connect");
    mysqli_select_db($dbh, $dbname);
    
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
    $sqlprovisions = "INSERT INTO provisions VALUES (DEFAULT,'21-02-2021','CDE12','You relax a lot',10.40),
            (DEFAULT,'21-02-2021','CVCE123','HELLO WORLD',15.20),
            (DEFAULT,'21-02-2021','hpk12$#','Treats mental illnesses',2.30);";
    echo $sqlprovisions;
    mysqli_query($dbh, $sqlprovisions);
    $sqlvisits = "INSERT INTO visits VALUES(1,2,'12/22/23'),
            (2,1,'12/22/23'),
            (3,1,'12/25/22');"; 
            
    echo $sqlvisits;
    mysqli_query($dbh, $sqlvisits);
    mysqli_close($dbh);
?>