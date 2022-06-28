<?php
    $host = 'localhost';
    $user = 'root';
    $pass = '';

    try{
        $conn = new PDO("mysql:host=$host;dbname=exemplophp", $user,$pass);

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Conectou!";
    }catch(PDOException $ex){
        echo "Erro: ". $ex->getMessage();
    }