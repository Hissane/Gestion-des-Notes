<?php
session_start();

if (isset($_POST["reponse"]) && !empty($_POST["reponse"]) && isset($_POST["description"]) && !empty($_POST["description"])) {

  $statut = $_POST["reponse"]==="accepter" ? 1 : 0;

  include("../helpers/db_connect.php");
  $query = "UPDATE reclamations SET reclamation_status = ? WHERE reclamation_id=?";
  $stmt = $pdo->prepare($query);
  $result = $stmt->execute([$statut, $_POST["reclamation_id"]]);

  header("Location:/pfa-mouna/prof/reclamations.php");
} else {
  header("Location:/pfa-mouna/prof/repondre_reclamation.php?reclamation=" . $_POST["reclamation_id"] . "&error");
}