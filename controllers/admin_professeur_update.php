<?php
session_start();

if (isset($_POST["nom"]) && isset($_POST["prenom"]) && !empty($_POST["nom"]) && !empty($_POST["prenom"])) {
  include("../helpers/db_connect.php");
  $query = "INSERT INTO professeurs VALUES 
(NULL, ?, '123456', ?, ?, ?, ?, ?)";
  $stmt = $pdo->prepare($query);
  $result = $stmt->execute([$_POST["username"], $_POST["nom"], $_POST["prenom"], $_POST["email"], $_POST["telephone"], $_POST["departement"]]);


  header("Location:/pfa-mouna/admin/professeur_update.php");
} else {
  header("Location:/pfa-mouna/admin/admin_professeur_update.php?error");
}