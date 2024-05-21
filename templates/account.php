<?php
$title = 'Compte';
ob_start();
?>

<main>
    <h1 class="page-title">Modification de compte</h1>

    <div class="alert-container">
        <?php if (isset($_COOKIE['UPDATE_ACCOUNT_ERROR'])) : ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $_COOKIE['UPDATE_ACCOUNT_ERROR']; ?>
                <button type='button' class="btn-close ms-auto" data-bs-dismiss='alert'></button>
            </div>
        <?php endif; ?>
    </div>

    <form action="index.php?action=updateStaffAccount" method="post">
        <input type="text" name="oldUsername" value="<?php echo $account['username']; ?>" hidden>
        <div class="input-container">
            <label for="update-username" class="label-input-form">Nom d'utilisateur</label>
            <input type="email" class="input-form" name="newUsername" value="<?php echo $account['username']; ?>" id="update-username" required>
        </div>
        <div class="input-container">
            <label for="update-surname" class="label-input-form">Nom</label>
            <input type="text" class="input-form" name="surname" value="<?php echo $account['surname']; ?>" id="update-surname" required>
        </div>
        <div class="input-container">
            <label for="update-firstName" class="label-input-form">Prénom</label>
            <input type="text" class="input-form" name="firstName" value="<?php echo $account['firstName']; ?>" id="update-firstName" required>
        </div>
        <div class="input-container">
            <label for="update-role" class="label-input-form">Rôle</label>
            <?php if ($account['role'] === 1) : ?>
                <select name="role" id="update-role" class="input-form" required>
                    <option value="1" selected>Employé</option>
                    <option value="2">Vétérinaire</option>
                </select>
            <?php else : ?>
                <select name="role" id="update-role" class="input-form" required>
                    <option value="1">Employé</option>
                    <option value="2" selected>Vétérinaire</option>
                </select>
            <?php endif ?>
        </div>
        <div class="input-container">
            <label for="update-password" class="label-input-form">Mot de passe (optionnel, pour changer le mot de passe)</label>
            <input type="password" class="input-form" name="password" id="update-password" minlength="8">
            <div class="display-form-password">
                <input type="checkbox" id="checkbox-display-password"><!--onclick="showPassword(passwordInputUpdate)"-->
                <label id="label-display-password">Afficher mot de passe</label>
            </div>
            <p class="input-password-instruction">Le mot de passe doit contenir au moins 8 caractères, 1 minuscule, 1 majuscule et 1 chiffre.</p>
        </div>
        <button type="submit">Modifier</button>
    </form>
    <script src="script/updateAccountScript.js"></script>
</main>

<?php
$content = ob_get_clean();
require('layout.php');
?>