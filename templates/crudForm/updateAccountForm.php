<div class="crud-frame" id="updateAccountFrame">
    <button type='button' class="btn-close" id="btn-close-update-account"></button>

    <form action="index.php?action=createStaffAccount" method="post">
        <div class="input-container">
            <label for="update-username" class="label-input-form">Nom d'utilisateur</label>
            <input type="email" class="input-form" name="username" id="update-username" required>
        </div>
        <div class="input-container">
            <label for="update-surname" class="label-input-form">Nom</label>
            <input type="text" class="input-form" name="surname" id="update-surname" required>
        </div>
        <div class="input-container">
            <label for="update-firstName" class="label-input-form">Prénom</label>
            <input type="text" class="input-form" name="firstName" id="update-firstName" required>
        </div>
        <div class="input-container">
            <label for="update-role" class="label-input-form">Rôle</label>
            <select name="role" id="update-role" class="input-form" required>
                <option value="1">Employé</option>
                <option value="2">Vétérinaire</option>
            </select>
        </div>
        <div class="input-container">
            <label for="update-password" class="label-input-form">Mot de passe</label>
            <input type="password" class="input-form" name="password" id="update-password" minlength="8" required>
            <div class="display-form-password">
                <input type="checkbox" id="checkbox-display-password" onclick="showPassword()">
                <label for="checkbox-display-password" id="label-display-password">Afficher mot de passe</label>
            </div>
            <p class="input-password-instruction">Le mot de passe doit contenir au moins 8 caractères, 1 minuscule, 1 majuscule et 1 chiffre.</p>
        </div>
        <button type="submit">Modifier</button>
    </form>
</div>