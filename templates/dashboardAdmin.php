<?php
$title = 'Tableau de bord';
ob_start();
?>

<main>
        <h1 class="page-title"> Tableau de bord </h1>
        <!-- Alert -->
        <div class="alert-container">
                <?php // Alert update schedule
                if (isset($_COOKIE['UPDATE_SCHEDULE_SUCCESS']) && $_COOKIE['UPDATE_SCHEDULE_SUCCESS'] == true) :
                ?>
                        <div class="alert alert-success" role="alert">
                                Les horaires ont bien été modifiés.
                                <button type='button' class="btn-close ms-auto" data-bs-dismiss='alert'></button>
                        </div>
                <?php elseif (isset($_COOKIE['UPDATE_SCHEDULE_ERROR'])) : ?>
                        <div class="alert alert-danger" role="alert">
                                <?php echo $_COOKIE['UPDATE_SCHEDULE_ERROR'] ?>
                                <button type='button' class="btn-close ms-auto" data-bs-dismiss='alert'></button>
                        </div>
                <?php endif; ?>
        </div>
        <div class="dashboard-container">
                <section class="dashboard-section">
                        <h4>Nombre de consultation des animaux</h4>
                        <table class="table table-hover align-middle consult-animal">
                                <thead>
                                        <th>Animal</th>
                                        <th>Nombre de visite</th>
                                </thead>
                                <tbody>
                                        <?php foreach ($animalVisit as $ani) : ?>
                                                <tr>
                                                        <td><?php echo $ani['name'] ?></td>
                                                        <td><?php echo $ani['count_visit'] ?></td>
                                                </tr>
                                        <?php endforeach ?>
                                </tbody>
                        </table>
                </section>
                <section class="dashboard-section">
                        <h4>Listes des comptes</h4>
                        <table class="table table-hover">
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
                                                        <td>
                                                                <?php echo $users[$i]['username'] ?>
                                                        </td>
                                                        <td>
                                                                <?php echo $users[$i]['surname'] ?>
                                                        </td>
                                                        <td>
                                                                <?php echo $users[$i]['first_name'] ?>
                                                        </td>
                                                        <td>
                                                                <?php echo $users[$i]['role'] ?>
                                                        </td>
                                                </tr>
                                        <?php endfor ?>
                                </tbody>
                        </table>
                        <button type="button"><a href="index.php?action=accountList">Voir tous les comptes</a></button>
                </section>
                <section class="dashboard-section">
                        <h4>Horaires</h4>
                        <form action="index.php?action=updateSchedule" method="post">
                                <table class="schedule">
                                        <?php
                                        $semaine = array(
                                                " Lundi ",
                                                " Mardi ",
                                                " Mercredi ",
                                                " Jeudi ",
                                                " Vendredi ",
                                                " Samedi ",
                                                " Dimanche "
                                        );
                                        for ($i = 1; $i < count($schedule); $i++) :
                                        ?>
                                                <tr>
                                                        <?php $dayEn = strtolower(date('l', 259200 + (86400 * $i))); ?>
                                                        <td><?php echo $semaine[$i - 1] ?></td>
                                                        <td>
                                                                <p>
                                                                        <input type="time" name="<?php echo $dayEn ?>Opening" class="input-form" value="<?php echo $schedule[$dayEn]['ouverture'] ?>">
                                                                        -
                                                                        <input type="time" name="<?php echo $dayEn ?>Closing" class="input-form" value="<?php echo $schedule[$dayEn]['fermeture'] ?>">
                                                                </p>
                                                        </td>
                                                </tr>
                                        <?php endfor ?>
                                </table>
                                <button type="submit" class="button-crud" formaction="index.php?action=updateSchedule">Modifier</button>
                        </form>
                </section>
        </div>
</main>

<?php
$content = ob_get_clean();
require('index.php');
?>