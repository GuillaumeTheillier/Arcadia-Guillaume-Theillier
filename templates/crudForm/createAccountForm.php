<div class="crud-frame" id="createAccountFrame">
    <button type='button' class="btn-close" id="btn-close-add-account"></button>

    <div class="alert-container">
        <?php if (isset($_COOKIE['CREATE_ACCOUNT_ERROR'])) : ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $_COOKIE['CREATE_ACCOUNT_ERROR']; ?>
                <button type='button' class="btn-close ms-auto" data-bs-dismiss='alert'></button>
            </div>
        <?php endif; ?>
    </div>

    <form action="index.php?action=createStaffAccount" method="post">
        <div class="input-container">
            <label for="create-username" class="label-input-form">Nom d'utilisateur</label>
            <input type="email" class="input-form" name="username" id="create-username" required>
        </div>
        <div class="input-container">
            <label for="create-surname" class="label-input-form">Nom</label>
            <input type="text" class="input-form" name="surname" id="create-surname" required>
        </div>
        <div class="input-container">
            <label for="create-firstName" class="label-input-form">Prénom</label>
            <input type="text" class="input-form" name="firstName" id="create-firstName" required>
        </div>
        <div class="input-container">
            <label for="create-role" class="label-input-form">Rôle</label>
            <select name="role" id="create-role" class="input-form" required>
                <option value="1">Employé</option>
                <option value="2">Vétérinaire</option>
            </select>
        </div>
        <div class="input-container">
            <label for="create-password" class="label-input-form">Mot de passe</label>

            <input type="password" class="input-form" name="password" id="create-password" minlength="8" required>
            <div class="display-form-password">
                <input type="checkbox" id="checkbox-display-password"> <!--onclick="showPassword(passwordInputCreate)"-->
                <label id="label-display-password">Afficher mot de passe</label>
            </div>

            <p class="input-password-instruction">Le mot de passe doit contenir au moins 8 caractères, 1 minuscule, 1 majuscule et 1 chiffre.</p>
        </div>
        <button type="submit">Confirmer</button>
    </form>
</div>