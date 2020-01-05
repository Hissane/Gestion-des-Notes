<?php
session_start();

function check_professeur_exists($pdo, $username, $password)
{
  $stmt = $pdo->prepare("SELECT * FROM professeurs WHERE professeur_login=? AND professeur_pwd=?");
  $stmt->bindParam(1, $username);
  $stmt->bindParam(2, $password);
  $stmt->execute();
  $result = $stmt->fetch();
  $pdo = null;
  return $result;
}

function check_etudiant_exists($pdo, $username, $password)
{
  $stmt = $pdo->prepare("SELECT * FROM etudiants WHERE etudiant_login=? AND etudiant_pwd=?");
  $stmt->bindParam(1, $username);
  $stmt->bindParam(2, $password);
  $stmt->execute();
  $result = $stmt->fetch();
  $pdo = null;
  return $result;
}

function check_admin_exists($pdo, $username, $password)
{
  $stmt = $pdo->prepare("SELECT * FROM administrateurs WHERE admin_login=? AND admin_pwd=?");
  $stmt->bindParam(1, $username);
  $stmt->bindParam(2, $password);
  $stmt->execute();
  $result = $stmt->fetch();
  $pdo = null;
  return $result;
}

if (
  isset($_POST["username"]) && isset($_POST["password"]) &&
  !empty($_POST["username"]) && !empty($_POST["password"])
) {
  include("../helpers/db_connect.php");
  $result;
  if (($result = check_professeur_exists($pdo, $_POST["username"], $_POST["password"]))) {
    $_SESSION["connected"] = true;
    $_SESSION["id"] = $result["professeur_id"];
    $_SESSION["role"] = "prof";
    $_SESSION["nom"] = $result["professeur_nom"];
    $_SESSION["prenom"] = $result["professeur_prenom"];
    $_SESSION["email"] = $result["professeur_email"];
    $_SESSION["telephone"] = $result["professeur_tel"];
    $_SESSION["departement"] = $result["professeur_departement"];
    header("Location:/pfa-mouna/prof/profile.php");
  } else if (($result = check_admin_exists($pdo, $_POST["username"], $_POST["password"]))) {
    $_SESSION["connected"] = true;
    $_SESSION["role"] = "admin";
    $_SESSION["id"] = $result["admin_id"];
    $_SESSION["nom"] = $result["admin_nom"];
    $_SESSION["prenom"] = $result["admin_prenom"];
    $_SESSION["email"] = $result["admin_email"];
    $_SESSION["telephone"] = $result["admin_tel"];
    header("Location:/pfa-mouna/admin/profile.php");
  } else if (($result = check_etudiant_exists($pdo, $_POST["username"], $_POST["password"]))) {
    $_SESSION["connected"] = true;
    $_SESSION["role"] = "etudiant";
    $_SESSION["id"] = $result["etudiant_id"];
    $_SESSION["nom"] = $result["etudiant_nom"];
    $_SESSION["prenom"] = $result["etudiant_prenom"];
    $_SESSION["email"] = $result["etudiant_email"];
    $_SESSION["cin"] = $result["etudiant_cin"];
    $_SESSION["cne"] = $result["etudiant_cne"];
    $_SESSION["filiere"] = $result["etudiant_filiere"];
    $_SESSION["date"] = $result["etudiant_date_naissance"];
    header("Location:/pfa-mouna/etudiant/profile.php");
  } else {
    header("Location:/pfa-mouna/?error");
  }
} else {
  header("Location:/pfa-mouna/?error");
}