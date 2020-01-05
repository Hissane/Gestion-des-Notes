<?php
session_start();

if (isset($_POST["nom"])  && !empty($_POST["nom"])) {
  include("../helpers/db_connect.php");
  $query = "INSERT INTO filieres VALUES (null, ?)";
  $stmt = $pdo->prepare($query);
  $result = $stmt->execute([$_POST["nom"]]);


  header("Location:/pfa-mouna/admin/filiere_update.php?success");
} else {
  header("Location:/pfa-mouna/admin/filiere_update.php?error");
}