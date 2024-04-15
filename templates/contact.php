<?php
$title = 'Contact';
ob_start();
//phpinfo();
?>

<main>
    <h1 class="page-title">Contact</h1>

    <?php
    /*
    if (isset($_COOKIE['CONTACT_SUCCESS'])) {
        echo 'working';
    } elseif (isset($_COOKIE['CONTACT_ERROR'])) {
        echo $_COOKIE['CONTACT_ERROR'];
    }*/
    ?>

    <div class="alert-container">
        <?php if (isset($_COOKIE['CONTACT_SUCCESS'])) : ?>
            <div class="alert alert-success" role="alert">
                Votre message a bien été envoyé.
                <button type='button' class="btn-close ms-auto" data-bs-dismiss='alert'></button>
            </div>
        <?php elseif (isset($_COOKIE['CONTACT_ERROR'])) : ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $_COOKIE['CONTACT_ERROR']; ?>
                <button type='button' class="btn-close ms-auto" data-bs-dismiss='alert'></button>
            </div>
        <?php endif; ?>
    </div>

    <form action="index.php?action=sendContact" method="post" class="contact-form">
        <div class="input-container">
            <label for="contact-email" class="label-input-form">Email</label>
            <input type="email" class="input-form" name="emailContact" id="contact-email" placeholder="exemple@mail.fr" required>
        </div>

        <div class="input-container">
            <label for="contact-title" class="label-input-form">Titre</label>
            <input type="text" class="input-form" name="titleContact" id="contact-title" placeholder="Titre de votre message" minlength="5" maxlength="50" required>
        </div>
        <div class="input-container">
            <label for="contact-description" class="label-input-form">Description</label>
            <textarea class="input-form" name="descriptionContact" id="contact-description" placeholder="Ecriver votre message" cols="40" rows="7" minlength="10" maxlength="300" required></textarea>
        </div>
        <button type="submit">Envoyer</button>
    </form>
</main>

<?php
$content = ob_get_clean();
require('layout.php');
?>