<?php

$bd = mysqli_connect("localhost", "root", "", "fifa2026_stats");

$select_query = "SELECT nom FROM joueurs";
$result = mysqli_query($bd, $select_query);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $player_name = $_POST['player'] ?? '';
    $new_goals = $_POST['goals'] ?? '';

    if (!empty($player_name) && is_numeric($new_goals)) {
        $update_query = "UPDATE joueurs SET buts = $new_goals WHERE nom = '$player_name'";
        mysqli_query($bd, $update_query);
        echo "<div class='alert alert-success text-center'>Buts modifiés avec succès pour $player_name.</div>";
    } else {
        echo "<div class='alert alert-danger text-center'>Veuillez sélectionner un joueur et entrer un nombre valide de buts.</div>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
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
                        <a class="nav-link" href="ajouter_joueur.php">Ajouter Joueur</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="rechercher_joueur.php">Rechercher Joueur</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="modifier_buts.php">Modifier Buts</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="card shadow-lg p-5" style="width: 400px; border-radius: 20px;">
            <h3 class="text-center mb-4">Modifier les Buts</h3>
            <form method="POST" action="">
                <?php
                    $players = [];
                    while ($row = mysqli_fetch_assoc($result)) {
                        $players[] = $row['nom'];
                    }
                ?>
                <div class="mb-3">
                    <label for="player" class="form-label">Sélectionner un joueur</label>
                    <select name="player" id="player" class="form-select" required>
                        <option value="">Sélectionnez un joueur</option>
                        <?php foreach ($players as $player) : ?>
                            <option value="<?= htmlspecialchars($player) ?>"><?= htmlspecialchars($player) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="goals" class="form-label">Nombre de buts</label>
                    <input type="number" name="goals" id="goals" class="form-control" min="0" required>
                </div>

                <button type="submit" class="btn btn-primary w-100">Modifier</button>
            </form>
        </div>
    </div>
    
</body>
</html>