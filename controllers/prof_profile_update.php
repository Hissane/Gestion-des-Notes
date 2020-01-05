<?php
session_start();

if (isset($_POST["nom"]) && isset($_POST["prenom"]) && !empty($_POST["nom"]) && !empty($_POST["prenom"])) {
  include("../helpers/db_connect.php");
  $query = "UPDATE `professeurs` SET `professeur_nom`=?, `professeur_prenom`=?, `professeur_email`=?,`professeur_departement`=?,`professeur_tel`=? WHERE `professeur_id`=?";
  $stmt = $pdo->prepare($query);
  $result = $stmt->execute([$_POST["nom"], $_POST["prenom"], $_POST["email"], $_POST["departement"], $_POST["telephone"], (int)$_SESSION["id"]]);
  $_SESSION["nom"] = $_POST["nom"];
  $_SESSION["prenom"] = $_POST["prenom"];
  $_SESSION["email"] = $_POST["email"];
  $_SESSION["telephone"] = $_POST["telephone"];
  $_SESSION["departement"] = $_POST["departement"];
  header("Location:/pfa-mouna/prof/profile.php");
} else {
  header("Location:/pfa-mouna/prof/profile_update.php?error");
}