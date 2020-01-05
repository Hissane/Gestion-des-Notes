<?php
session_start();

if (isset($_POST["nom"]) && isset($_POST["prenom"]) && isset($_POST["email"]) && isset($_POST["filiere"]) && isset($_POST["cin"]) && isset($_POST["cne"]) && isset($_POST["date"]) && !empty($_POST["nom"]) && !empty($_POST["prenom"])) {
  include("../helpers/db_connect.php");
  $query = "UPDATE `etudiants` SET `etudiant_nom`=?, `etudiant_prenom`=?, `etudiant_email`=?,`etudiant_filiere`=?,`etudiant_cin`=?,`etudiant_cne`=?,`etudiant_date_naissance`=? WHERE `etudiant_id`=?";
  $stmt = $pdo->prepare($query);
  $result = $stmt->execute([$_POST["nom"], $_POST["prenom"], $_POST["email"], $_POST["filiere"], $_POST["cin"], $_POST["cne"], $_POST["date"], (int)$_SESSION["id"]]);

  $_SESSION["nom"] = $_POST["nom"];
  $_SESSION["prenom"] = $_POST["prenom"];
  $_SESSION["email"] = $_POST["email"];
  $_SESSION["filiere"] = $_POST["filiere"];
  $_SESSION["cin"] = $_POST["cin"];
  $_SESSION["cne"] = $_POST["cne"];
  $_SESSION["date"] = $_POST["date"];
  header("Location:/pfa-mouna/etudiant/profile.php");
} else {
  header("Location:/pfa-mouna/etudiant/profile_update.php?error");
}