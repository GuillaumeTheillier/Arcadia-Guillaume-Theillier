<div id="updateAccountFrame">
    <button type='button' class="btn-close" id="btn-crud-close" onclick="closeUpdateAccount()"></button>

    <form action="index.php?action=createStaffAccount" method="post">
        <div class="input-container">
            <label for="username" class="label-input-form">Nom d'utilisateur</label>
            <input type="email" class="input-form" name="username" id="username" required>
        </div>
        <div class="input-container">
            <label for="surname" class="label-input-form">Nom</label>
            <input type="text" class="input-form" name="surname" id="surname" required>
        </div>
        <div class="input-container">
            <label for="firstName" class="label-input-form">Prénom</label>
            <input type="text" class="input-form" name="firstName" id="firstName" required>
        </div>
        <div class="input-container">
            <label for="role" class="label-input-form">Rôle</label>
            <select name="role" id="role" class="input-form" required>
                <option value="1">Employé</option>
                <option value="2">Vétérinaire</option>
            </select>
        </div>
        <div class="input-container">
            <label for="password" class="label-input-form">Mot de passe</label>
            <div class="input-form">
                <input type="password" class="input-form" name="password" id="password" minlength="8" required>
                <input type="checkbox" onclick="showPassword()"> Afficher mot de passe
            </div>
            <p class="input-password-instruction">Le mot de passe doit contenir au moins 8 caractères, 1 minuscule, 1 majuscule et 1 chiffre.</p>
        </div>
        <button type="submit">Modifier</button>
    </form>
</div>