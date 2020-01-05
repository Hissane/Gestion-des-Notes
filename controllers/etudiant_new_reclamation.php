<?php
session_start();

if (isset($_POST["element"]) && !empty($_POST["element"]) && isset($_POST["description"]) && !empty($_POST["description"])) {
  include("../helpers/db_connect.php");
  $query = "INSERT INTO reclamations VALUES (NULL, ?, ?, ?, 0, NULL)";
  $stmt = $pdo->prepare($query);
  $result = $stmt->execute([ $_SESSION["id"], $_POST["element"], $_POST["description"]]);

  header("Location:/pfa-mouna/etudiant/new_reclamation.php?success");
} else {
  header("Location:/pfa-mouna/etudiant/new_reclamation.php?error");
}