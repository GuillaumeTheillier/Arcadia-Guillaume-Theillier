<script>
    document.title = 'Espace du personnel';
</script>
<div class="login">
    <h1 class="page-title">Espace du personnel</h1>
    <p class="login-info">Cette page est réservée à la connexion du personnel</p>
    <div class="alert-container">
        <?php if (isset($_COOKIE['LOGIN_ERROR'])) : ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $_COOKIE['LOGIN_ERROR']; ?>
                <button type='button' class="btn-close ms-auto" data-bs-dismiss='alert'></button>
            </div>
        <?php endif; ?>
    </div>
    <form action="index.php?action=login" method="post" class="login-form">
        <div class="input-container">
            <label for="login-username" class="label-input-form">Nom d'utilisateur</label>
            <input type="text" class="input-form" name="loginUsername" id="login-username" maxlength="50" required>
        </div>
        <div class="input-container">
            <label for="login-password" class="label-input-form">Mot de passe</label>
            <input type="password" class="input-form" name="loginPassword" id="login-password" maxlength="20" required>
        </div>
        <button type="submit">Se connecter</button>
    </form>
</div>