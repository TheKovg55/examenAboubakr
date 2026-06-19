<?php
$bd = mysqli_connect("localhost", "root", "", "fifa2026_stats");

$country = $_POST['country'] ?? '';
$buts_exact = $_POST['buts_exact'] ?? '';
$buts_min = $_POST['buts_min'] ?? '';
$buts_max = $_POST['buts_max'] ?? '';

$query = "SELECT * FROM joueurs WHERE 1=1";

if (!empty($country)) {
    $query .= " AND equipe = '$country'";
}

if (!empty($buts_exact)) {
    $query .= " AND buts = $buts_exact";
}

if (!empty($buts_min) && !empty($buts_max)) {
    $query .= " AND buts BETWEEN $buts_min AND $buts_max";
}
$result = mysqli_query($bd, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rechercher Joueur</title>
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
                        <a class="nav-link" href="ajouter_joueur.php">Ajouter Joueur</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="rechercher_joueur.php">Rechercher Joueur</a>
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
                <h2 class="mb-4">Rechercher un Joueur</h2>
                <form method="post">
                    <div class="mb-3">
                        <label for="country" class="form-label">Pays</label>
                        <input type="text" class="form-control" id="country" name="country" placeholder="Entrez le pays...">
                    </div>
                    <div class="mb-3">
                        <label for="buts_exact" class="form-label">Nombre de Buts (exact)</label>
                        <input type="number" class="form-control" id="buts_exact" name="buts_exact" placeholder="Entrez un nombre...">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nombre de Buts (entre)</label>
                        <div class="row">
                            <div class="col">
                                <input type="number" class="form-control" id="buts_min" name="buts_min" placeholder="Min">
                            </div>
                            <div class="col">
                                <input type="number" class="form-control" id="buts_max" name="buts_max" placeholder="Max">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Rechercher</button>
                </form>
            </div>
        </div>
    </div>


    <div class="container mt-4">
        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Nom</th>
                        <th>Prenom</th>
                        <th>Age</th>
                        <th>Equipe</th>
                        <th>Buts</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result && mysqli_num_rows($result) > 0): ?>
                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['id']); ?></td>
                                <td><?php echo htmlspecialchars($row['nom']); ?></td>
                                <td><?php echo htmlspecialchars($row['prenom']); ?></td>
                                <td><?php echo htmlspecialchars($row['age']); ?></td>
                                <td><?php echo htmlspecialchars($row['equipe']); ?></td>
                                <td><?php echo htmlspecialchars($row['buts']); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>