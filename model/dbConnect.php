<?php

function dbConnection(){
    $dsn = 'mysql:dbname=shift;host=localhost;charset=utf8';
    $user = 'root';
    $password = '';

    try{
        $dbh = new PDO($dsn, $user, $password);
        $dbh -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        return $dbh;
    }catch (PDOException $e){
        print $e;
        return false;
    }
}

?>