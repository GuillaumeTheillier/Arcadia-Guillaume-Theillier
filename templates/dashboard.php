<?php
$title = 'Tableau de bord';
ob_start();
?>

<main>
        <h1 class="page-title"> Tableau de bord </h1>

        <div class="dashboard-container">

                <section class="dashboard-section">
                        <h4>Statistique sur la consultation des animaux</h4>
                </section>

                <section class="dashboard-section">
                        <h4>Listes des comptes</h4>
                        <table class="dashboard-users-list">
                                <thead>
                                        <tr>
                                                <th>Nom d'utilisateur</th>
                                                <th>Nom</th>
                                                <th>Prénom</th>
                                                <th>Rôle</th>
                                        </tr>
                                </thead>
                                <tbody>
                                        <?php
                                        //if the users array length is more than 5 data we constaint to show only 5 datas
                                        if (count($users) > 5) {
                                                $len = 5;
                                        } else $len = count($users);
                                        ?>

                                        <?php for ($i = 0; $i < $len; $i++) : ?>
                                                <tr>
                                                        <td> <?php echo $users[$i]['username'] ?> </td>
                                                        <td> <?php echo $users[$i]['surname'] ?> </td>
                                                        <td> <?php echo $users[$i]['first_name'] ?> </td>
                                                        <td> <?php echo $users[$i]['role'] ?> </td>
                                                </tr>
                                        <?php endfor ?>
                                </tbody>
                        </table>
                        <button type="button"><a href="index.php?action=userslist">Voir tous les comptes</a></button>
                        <button type="button"><a href="index.php?action=userslist">Créer un compte</a></button>
                </section>

                <section class="dashboard-section">
                        <h4>Horaires</h4>
                        <p>
                                Lundi 09:00 - 19:00 <br>
                                Mardi 09:00 - 19:00 <br>
                                Mercredi 09:00 - 19:00 <br>
                                Jeudi 09:00 - 19:00 <br>
                                Vendredi 09:00 - 19:00 <br>
                                Samedi 09:00 - 19:00 <br>
                                Dimanche 09:00 - 19:00
                        </p>
                        <button><a href="index.php?action=schedules">Modifier</a></button>
                </section>
        </div>
</main>

<?php
$content = ob_get_clean();
require('layout.php');
?>