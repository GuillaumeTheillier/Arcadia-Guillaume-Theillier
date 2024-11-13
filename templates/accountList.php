<script>
    document.title = 'Liste des comptes';
</script>
<h1 class="page-title">Listes des comptes</h1>
<div class="account-list-container">
    <!--require frame for the form of account creation and update -->
    <?php require_once('crudForm/createAccountForm.php'); ?>

    <div class="alert-container">
        <!-- Alert for account creation -->
        <?php if (isset($_COOKIE['CREATE_ACCOUNT_SUCCESS'])) : ?>
            <?php if ($_COOKIE['CREATE_ACCOUNT_SUCCESS']) : ?>
                <div class="alert alert-success" role="alert">
                    Le compte a été créé avec succès.
                    <button type='button' class="btn-close ms-auto" data-bs-dismiss='alert'></button>
                </div>
            <?php else : ?>
                <div class="alert alert-success" role="alert">
                    Une erreur est survenue avec le serveur.
                    <button type='button' class="btn-close ms-auto" data-bs-dismiss='alert'></button>
                </div>
            <?php endif; ?>
        <?php elseif (isset($_COOKIE['CREATE_ACCOUNT_ERROR'])) : ?>
            <script>
                document.querySelector('.crud-frame').classList.add('visible');
                document.querySelector('body').style.overflow = 'hidden';
            </script>
        <?php endif; ?>
        <!-- Alert for account update -->
        <?php if (isset($_COOKIE['UPDATE_ACCOUNT_SUCCESS'])) : ?>
            <?php if ($_COOKIE['UPDATE_ACCOUNT_SUCCESS']) : ?>
                <div class="alert alert-success" role="alert">
                    Le compte a été modifié avec succès.
                    <button type='button' class="btn-close ms-auto" data-bs-dismiss='alert'></button>
                </div>
            <?php else : ?>
                <div class="alert alert-success" role="alert">
                    Une erreur est survenue avec le serveur.
                    <button type='button' class="btn-close ms-auto" data-bs-dismiss='alert'></button>
                </div>
            <?php endif; ?>
        <?php elseif (isset($_COOKIE['UPDATE_ACCOUNT_ERROR'])) : ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $_COOKIE['UPDATE_ACCOUNT_ERROR']; ?>
                <button type='button' class="btn-close ms-auto" data-bs-dismiss='alert'></button>
            </div>
        <?php endif; ?>
    </div>

    <button type="button" class="button-crud btn-open-frame">Ajouter un compte</button>

    <div class="table-container">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>Nom d'utilisateur</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Rôle</th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <?php foreach ($allAccount as $account) : ?>
                    <tr>
                        <td> <?php echo $account['username'] ?> </td>
                        <td> <?php echo $account['surname'] ?> </td>
                        <td> <?php echo $account['first_name'] ?> </td>
                        <td> <?php echo $account['role'] ?> </td>
                        <td>
                            <form method="post">
                                <button type="submit" name="username" value="<?php echo $account['username'] ?>" formaction="index.php?action=updateAccount" class="button-crud">Modifier</button>
                                <button type="submit" name="username" value="<?php echo $account['username'] ?>" formaction="index.php?action=deleteStaffAccount" class="button-crud">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>
<script src="script\frameScript.js"></script>