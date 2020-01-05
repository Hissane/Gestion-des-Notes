<?php
session_start();
if (isset($_SESSION["connected"]) && isset($_SESSION["role"]) && $_SESSION["role"] === "etudiant") {
  $full_name = $_SESSION["nom"] . " " . $_SESSION["prenom"];
  $prenom = $_SESSION["prenom"];
  $nom = $_SESSION["nom"];

  include_once("../helpers/db_connect.php");

  $stmt = $pdo->prepare("select el.element_nom, re.reponse_desc, re.reclamation_status from reclamations re, elements el where re.element_id = el.element_id and re.etudiant_id =?");
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
  <title>Etudiant - Reclamations</title>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />

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
        <li class="nav-item">
          <a class="nav-link" href="./notes.php">Notes</a>
        </li>
        <li class="nav-item dropdown active">
          <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">Reclamations</a>
          <div class="dropdown-menu" aria-labelledby="dropdown01">
            <a class="dropdown-item" href="./new_reclamation.php">Nouvelle Reclamation</a>
            <a class="dropdown-item" href="#">Mes Reclamations</a>
          </div>
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
            <h3 class="card-title text-center p-4">Notes</h3>
            <div class="card-body p-5">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Element de module</th>
                    <th scope="col">Statut</th>
                    <th scope="col">Description </th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  while($row = $stmt->fetch()) {
                  ?>
                  <tr>
                    <td><?= $row["element_nom"] ?></td>
                    <td><?php if($row["reclamation_status"] === 0){
                                    echo "Refusée";
                              }else if($row["reclamation_status"] === 1){
                                    echo "Acceptée";
                              }else{
                                    echo "En attente";
                              } ?></td>
                    <td><?= $row["reponse_desc"] ?></td>
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
</body>

</html>