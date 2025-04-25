<?php
define('HOST', 'localhost');
define('USER', 'root');
define('PASS', '');
define('DBNAME', 'pdv');

try {
  $conn = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME . ";charset=utf8mb4", USER, PASS, [
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"
  ]);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $err) {
  die("Erro na conexão: " . $err->getMessage());
}
