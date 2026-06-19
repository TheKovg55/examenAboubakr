<?php
$bd = mysqli_connect("localhost", "root", "", "fifa2026_stats");
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    $username = mysqli_real_escape_string($bd, $username);
    $password = mysqli_real_escape_string($bd, $password);
    
    $login_query = "SELECT * FROM utilisateurs WHERE Username='$username' AND Password='$password'";
    $login_result = mysqli_query($bd, $login_query);
    
    if ($login_result && mysqli_num_rows($login_result) > 0) {
        header("Location: /php/menu.php");
        exit(); 
    } else {
        $message = "Nom d'utilisateur ou mot de passe invalide.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - FIFA 2026</title>
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
                        <a class="nav-link active" aria-current="page" href="login.php">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="d-flex align-items-center justify-content-center min-vh-100">
        <div class="card p-4 shadow-sm" style="width:100%; max-width:420px;">
            <h3 class="card-title text-center mb-3">Connexion</h3>
            
            <?php if (!empty($message)): ?>
                <div class="alert alert-danger"><?php echo htmlspecialchars($message); ?></div>
            <?php endif; ?>
            
            <form method="post" action="">
                <div class="mb-3">
                    <label for="username" class="form-label small">Nom d'utilisateur</label>
                    <input type="text" class="form-control form-control-sm" id="username" name="username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label small">Mot de passe</label>
                    <input type="password" class="form-control form-control-sm" id="password" name="password" required>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-sm">Se connecter</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>