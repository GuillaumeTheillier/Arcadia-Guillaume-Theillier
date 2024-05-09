<?php
$title = 'Listes des comptes';
ob_start();
?>

<main>
    <h1 class="page-title">Listes des comptes</h1>
    <div class="account-list-container">

        <button type="button" id="btn-crud-add" class="button-crud">Ajouter un compte</button>
        <?php require_once('crudForm/accountCrud.php') ?>

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
                            <div class="account-list-button">
                                <button type="button" name="accountName" value="<?php echo $account['username'] ?>" class="button-crud">Modifier</button>
                                <button type="button" name="accountName" value="<?php echo $account['username'] ?>" formaction="index.php?action=deleteHabitat" class="button-crud">Supprimer</button>
                            </div>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</main>

<?php
$content = ob_get_clean();
require('layout.php');
?>