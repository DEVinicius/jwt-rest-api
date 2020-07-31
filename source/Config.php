<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

define("ROOT","http://localhost/jwt-rest-api");
define("DATABASE", [
    "host" => "localhost",
    "dbName" => "jwt",
    "password" => "Ralph@2411",
    "user" => "vini"
]);


function url(string $uri = null) : string{
    if($uri){
        return ROOT."/{$uri}";
    }

    return ROOT;
}

//conexão com o banco de dados
function connect(){

    try {
        $conn = new PDO("mysql:host=".DATABASE["host"].";dbname=".DATABASE["dbName"], DATABASE["user"], DATABASE["password"], [
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            PDO::ATTR_CASE => PDO::CASE_NATURAL
            ]);
            
        return $conn;
    } catch (PDOException $e) {
        echo "Connection error: ".$e->getMessage();
    }
}