<?php
$title = 'Listes des comptes';
ob_start();
?>

<main>
    <h1 class="page-title">Listes des comptes</h1>
    <div class="account-list-container">

        <?php require_once('crudForm/createAccountForm.php'); ?>
        <?php require_once('crudForm/updateAccountForm.php'); ?>

        <div class="alert-container">
            <?php if (isset($_COOKIE['CREATE_ACCOUNT_SUCCESS'])) : ?>
                <div class="alert alert-success" role="alert">
                    Le compte a été créé avec succès.
                    <button type='button' class="btn-close ms-auto" data-bs-dismiss='alert'></button>
                </div>
            <?php elseif (isset($_COOKIE['CREATE_ACCOUNT_ERROR'])) : ?>
                <script>
                    createAccountFrame.style.display = 'block';
                </script>
            <?php endif; ?>
        </div>

        <button type="button" id="btn-open-add-account" class="button-crud">Ajouter un compte</button>

        <table class="account-list">
            <thead>
                <tr>
                    <th>Nom d'utilisateur</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Rôle</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($allAccount as $account) : ?>
                    <tr>
                        <td> <?php echo $account['username'] ?> </td>
                        <td> <?php echo $account['surname'] ?> </td>
                        <td> <?php echo $account['first_name'] ?> </td>
                        <td> <?php echo $account['role'] ?> </td>
                        <td>
                            <form method="post" class="account-list-button">
                                <button type="button" name="username" value="<?php echo $account['username'] ?>" class="button-crud" id="btn-open-update-account">Modifier</button>
                                <button type="submit" name="username" value="<?php echo $account['username'] ?>" formaction="index.php?action=deleteStaffAccount" class="button-crud">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
    <script src="script/crudScript.js"></script>
</main>

<?php
$content = ob_get_clean();
require('layout.php');
?>