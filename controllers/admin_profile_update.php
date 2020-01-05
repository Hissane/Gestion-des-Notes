<?php
session_start();

if (isset($_POST["nom"]) && isset($_POST["prenom"]) && !empty($_POST["nom"]) && !empty($_POST["prenom"])) {
  include("../helpers/db_connect.php");
  $query = "UPDATE `administrateurs` SET `admin_nom`=?, `admin_prenom`=?, `admin_email`=?,`admin_tel`=? WHERE `admin_id`=?";
  $stmt = $pdo->prepare($query);
  $result = $stmt->execute([$_POST["nom"], $_POST["prenom"], $_POST["email"], $_POST["telephone"], (int)$_SESSION["id"]]);
  $_SESSION["nom"] = $_POST["nom"];
  $_SESSION["prenom"] = $_POST["prenom"];
  $_SESSION["email"] = $_POST["email"];
  $_SESSION["telephone"] = $_POST["telephone"];
  header("Location:/pfa-mouna/admin/profile.php");
} else {
  header("Location:/pfa-mouna/admin/profile_update.php?error");
}