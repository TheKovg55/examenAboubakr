<?php
$bd = mysqli_connect("localhost", "root", "", "fifa2026_stats");


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'] ?? '';
    $prenom = $_POST['prenom'] ?? '';
    $age = $_POST['age'] ?? '';
    $equipe = $_POST['equipe'] ?? '';
    $buts = $_POST['buts'] ?? '';
    $message = '';
    

    $stmt = "INSERT INTO joueurs (nom, prenom, age, equipe, buts) VALUES ('$nom', '$prenom', '$age', '$equipe', '$buts')";
    if (mysqli_query($bd, $stmt)) {
        $message = "Joueur ajouté avec succès.";
    } else {
        $message = "Error: " . $stmt . "<br>" . mysqli_error($bd);
    }

    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter Joueur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="../index.php">FIFA 2026</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php">Acceuil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="liste_joueurs.php">Liste des Joueurs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="ajouter_joueur.php">Ajouter Joueur</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="rechercher_joueur.php">Rechercher Joueur</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="modifier_buts.php">Modifier Buts</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="mb-4">Ajouter un Joueur</h2>
                <?php if (!empty($message)): ?>
                <div class="alert alert-success"><?php echo htmlspecialchars($message); ?></div>
            <?php endif; ?>
                <form method="post">
                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="nom" name="nom" required>
                    </div>
                    <div class="mb-3">
                        <label for="prenom" class="form-label">Prénom</label>
                        <input type="text" class="form-control" id="prenom" name="prenom" required>
                    </div>
                    <div class="mb-3">
                        <label for="age" class="form-label">Âge</label>
                        <input type="number" class="form-control" id="age" name="age" required>
                    </div>
                    <div class="mb-3">
                        <label for="equipe" class="form-label">Équipe</label>
                        <input type="text" class="form-control" id="equipe" name="equipe" required>
                    </div>
                    <div class="mb-3">
                        <label for="buts" class="form-label">Buts</label>
                        <input type="number" class="form-control" id="buts" name="buts" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>