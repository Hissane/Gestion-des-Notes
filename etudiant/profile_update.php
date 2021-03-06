<?php
session_start();
$error = isset($_GET['error']);
if (isset($_SESSION["connected"]) && isset($_SESSION["role"]) && $_SESSION["role"] === "etudiant") {
  $full_name = $_SESSION["nom"] . " " . $_SESSION["prenom"];
  $prenom = $_SESSION["prenom"];
  $nom = $_SESSION["nom"];
} else {
  header("Location:/pfa-mouna");
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Etudiant - Modifier profil</title>

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
        <li class="nav-item active">
          <a class="nav-link" href="#">Profil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="notes.php">Notes</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">Reclamations</a>
          <div class="dropdown-menu" aria-labelledby="dropdown01">
            <a class="dropdown-item" href="./new_reclamation.php">Nouvelle Reclamation</a>
            <a class="dropdown-item" href="./old_reclamation.php">Mes Reclamations</a>
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
            <h3 class="card-title text-center p-4">Modifier informations</h3>
            <?php
            if ($error) {
              ?>
            <div class="pl-5 pr-5">
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Erreur</strong> Informations invalides.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            </div>
            <?php
          }
          ?>
            <div class="card-body p-5">
              <form method="POST" action="../controllers/etudiant_profile_update.php">
                <div class="row">
                  <div class="col-1"></div>
                  <div class="col-4">
                    <label for="prenom">Prenom</label>
                  </div>
                  <div class="col">
                    <input type="text" class="form-control" name="prenom" id="prenom" placeholder="John" required
                      value="<?= $prenom ?>" />
                  </div>
                  <div class="col-1"></div>
                </div>
                <div class="row mt-4">
                  <div class="col-1"></div>
                  <div class="col-4">
                    <label for="nom">Nom</label>
                  </div>
                  <div class="col">
                    <input type="text" class="form-control" name="nom" id="nom" placeholder="Doe" required
                      value="<?= $nom ?>" />
                  </div>
                  <div class="col-1"></div>
                </div>
                <div class="row mt-4">
                  <div class="col-1"></div>
                  <div class="col-4">
                    <label for="email">Email</label>
                  </div>
                  <div class="col">
                    <input type="text" class="form-control" name="email" id="email" placeholder="" required
                      value="<?= $_SESSION["email"] ?>" />
                  </div>
                  <div class="col-1"></div>
                </div>
                <div class="row mt-4">
                  <div class="col-1"></div>
                  <div class="col-4">
                    <label for="filiere">Filiere</label>
                  </div>
                  <div class="col">
                    <input type="text" class="form-control" name="filiere" id="filiere" placeholder="" required
                      value="<?= $_SESSION["filiere"] ?>" />
                  </div>
                  <div class="col-1"></div>
                </div>
                <div class="row mt-4">
                  <div class="col-1"></div>
                  <div class="col-4">
                    <label for="cin">CIN</label>
                  </div>
                  <div class="col">
                    <input type="text" class="form-control" name="cin" id="cin" placeholder="" required
                      value="<?= $_SESSION["cin"] ?>" />
                  </div>
                  <div class="col-1"></div>
                </div>
                <div class="row mt-4">
                  <div class="col-1"></div>
                  <div class="col-4">
                    <label for="cne">CNE</label>
                  </div>
                  <div class="col">
                    <input type="text" class="form-control" name="cne" id="cne" placeholder="" required
                      value="<?= $_SESSION["cne"] ?>" />
                  </div>
                  <div class="col-1"></div>
                </div>
                <div class="row mt-4">
                  <div class="col-1"></div>
                  <div class="col-4">
                    <label for="date">Date de Naissance</label>
                  </div>
                  <div class="col">
                    <input type="text" class="form-control" name="date" id="date" placeholder="" required
                      value="<?= $_SESSION["date"] ?>" />
                  </div>
                  <div class="col-1"></div>
                </div>
                <div class="row mt-5 mb-4">
                  <div class="col">
                    <input type="submit" href="../controllers/etudiant_profile_update.php" class="btn btn-outline-secondary"
                      id="profile-update-button" role="button" value="Save" />
                  </div>
                </div>
              </form>
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