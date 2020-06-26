<?php
$servername="";
$username="";
$password="";
$dbname="";

try {
    $strConnection = 'mysql:host='.$servername.";dbname=".$dbname; //Ligne 1
    $arrExtraParam= array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"); //Ligne 2
    $pdo = new PDO($strConnection,$username, $password, $arrExtraParam); //Ligne 3; Instancie la connexion
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//Ligne 4
}
catch(PDOException $e) {
    $msg = 'ERREUR PDO dans ' . $e->getFile() . ' L.' . $e->getLine() . ' : ' . $e->getMessage();
    die($msg);
}

$query="INSERT IGNORE INTO table_user (attribut1,attribut2,attribut3,attribut4)
VALUES (?,?,?,?)";

$prep=$pdo->prepare($query);
$prep->bindValue(1,$_GET["username"],PDO::PARAM_STR);
$prep->bindValue(1,$_GET["password"], PDO::PARAM_STR);
$prep->bindValue(2,$_GET["email"], PDO::PARAM_STR);
$prep->execute();