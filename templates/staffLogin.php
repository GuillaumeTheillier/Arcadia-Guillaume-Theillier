<?php
$title = 'Espace du personnel';
ob_start();
?>

<main class="login">
    <h1 class="page-title">Espace de connexion du personnel</h1>

    <p class="login-info">Cette page est réservé à la connexion du personnel</p>

    <?php if (isset($_COOKIE['LOGIN_ERROR'])) : ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $_COOKIE['LOGIN_ERROR']; ?>
        </div>
    <?php endif; ?>


    <form action="index.php?action=login" method="post" class="login-form">
        <div class="login-form-input">
            <label for="login-username">Nom d'utilisateur</label>
            <input type="text" name="loginUsername" id="login-username" required>
        </div>
        <div class="login-form-input">
            <label for="login-password">Mot de passe</label>
            <input type="text" name="loginPassword" id="login-password" required>
        </div>
        <button type="submit">Se connecter</button>
    </form>

</main>

<?php
$content = ob_get_clean();
require('layout.php');
?>