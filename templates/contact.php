<?php
$title = 'Contact';
ob_start();
//index.php?action=sendContact
?>

<main>
    <h1 class="page-title">Contact</h1>

    <?php
    if (isset($_COOKIE['CONTACT_SUCCESS'])) {
        echo $_COOKIE['CONTACT_DESC'];
    } elseif (isset($_COOKIE['CONTACT_ERROR'])) {
        echo $_COOKIE['CONTACT_ERROR'];
    }
    ?>


    <form action="index.php?action=sendContact" method="post" class="contact-form">
        <div class="contact-form-input">
            <label for="contact-email">Email</label>
            <input type="email" name="emailContact" id="contact-email" placeholder="exemple@mail.fr" required>
        </div>

        <div class="contact-form-input">
            <label for="contact-title">Titre</label>
            <input type="text" name="titleContact" id="contact-title" placeholder="Titre de votre message" required>
        </div>
        <div class="contact-form-input">
            <label for="contact-description">Description</label>
            <textarea name="descriptionContact" id="contact-description" placeholder="Ecriver votre message" cols="40" rows="7" maxlength="300" required></textarea>
        </div>
        <button type="submit">Envoyer</button>
    </form>
</main>

<?php
$content = ob_get_clean();
require('layout.php');
?>