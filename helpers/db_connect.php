<?php

$host = 'localhost';
$db   = 'gestion_notes';
$user = 'root';
$pass = '';
$dsn = "mysql:host=$host;dbname=$db";

try {
  $pdo = new PDO($dsn, $user, $pass);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (\PDOException $e) {
  throw new \PDOException($e->getMessage(), (int)$e->getCode());
}