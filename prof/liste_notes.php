<?php
session_start();
if (isset($_SESSION["connected"]) && isset($_SESSION["role"]) && $_SESSION["role"] === "prof") {
  $full_name = $_SESSION["nom"] . " " . $_SESSION["prenom"];
  $prenom = $_SESSION["prenom"];
  $nom = $_SESSION["nom"];

  include_once("../helpers/db_connect.php");

  $stmt = $pdo->prepare("SELECT * FROM notes, elements, etudiants WHERE note_element=element_id and note_etudiant=etudiant_id and element_responsable_id=?");
  $stmt->execute([$_SESSION["id"]]);
} else {
  header("Location:/pfa-mouna");
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Professeur - Afficher Notes</title>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />

  <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css" />

  <link rel="stylesheet" href="./index.css" />
</head>

<body>
  <nav id="page-navbar" class="navbar navbar-expand-md navbar-light bg-light fixed-top">
    <a class="navbar-brand" href="#">Gestion Notes</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbar">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="./profile.php">Profil</a>
        </li>
        <li class="nav-item dropdown active">
          <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">Notes</a>
          <div class="dropdown-menu" aria-labelledby="dropdown01">
            <a class="dropdown-item" href="./notes_saisie.php">Saisir Notes</a>
            <a class="dropdown-item" href="#">Liste des Notes</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./reclamations.php">Reclamations</a>
        </li>
      </ul>
      <div class="navbar-nav">
        <div class="dropdown">
          <a class="btn btn-outline-secondary dropdown-toggle" href="#" role="button" data-toggle="dropdown">
            <?= $full_name ?>
          </a>

          <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="../controllers/logout.php">Déconnexion</a>
          </div>
        </div>
      </div>
    </div>
  </nav>

  <div class="container">
    <div class="row">
      <div class="col-2"></div>
      <div class="col-8">
        <div id="info-wrapper" class="pt-5">
          <div class="card">
            <h3 class="card-title text-center p-4">Liste des notes</h3>
            <div class="card-body p-5">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Etudiant</th>
                    <th scope="col">Element de Module</th>
                    <th scope="col">Note avant rattrapage</th>
                    <th scope="col">Note apres rattrapage</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  while($row = $stmt->fetch()) {
                  ?>
                  <tr>
                    <td><?= $row["etudiant_nom"]." ".$row["etudiant_prenom"] ?></td>
                    <td><?= $row["element_nom"] ?></td>
                    <td><?= $row["note_avant_ratt"] ?></td>
                    <td><?= $row["note_apres_ratt"] ?></td>
                  </tr>
                <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
</body>

</html>