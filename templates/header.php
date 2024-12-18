<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <h1 class="logo">ARCADIA</h1>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <svg xmlns="http://www.w3.org/2000/svg" width="42" height="38" fill="white" class="bi bi-list" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
            </svg>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <div class="navbar-nav">
                <?php if (isset($_SESSION['LOGGED_USER'])) : ?>
                    <?php $role = $_SESSION['ROLE_USER']; ?>
                    <?php
                    switch ($role):
                            //Employee
                        case 1:
                    ?>
                            <a class="header-link" href="index.php?action=animalList">Animaux</a>
                            <a class="header-link" href="index.php?action=services">Services</a>
                            <a class="header-link" href="index.php?action=commentManager">Avis</a>
                            <a class="header-link" href="index.php?action=logout">Déconnexion</a>
                            <?php break; ?>
                        <?php
                            //Veterinarian
                        case 2:
                        ?>
                            <a class="header-link" href="index.php?action=animalList">Animaux</a>
                            <a class="header-link" href="index.php?action=habitatComment">Habitats</a>
                            <a class="header-link" href="index.php?action=logout">Déconnexion</a>
                            <?php break; ?>
                        <?php
                            //Admin
                        case 3:
                        ?>
                            <a class="header-link" href="index.php?action=dashboard">Tableau de bord</a>
                            <a class="header-link" href="index.php?action=veterinarianReportList">Compte rendu</a>
                            <a class="header-link" href="index.php?action=services">Services</a>
                            <a class="header-link" href="index.php?action=habitatsList">Habitats</a>
                            <a class="header-link" href="index.php?action=logout">Déconnexion</a>
                            <?php break; ?>
                    <?php endswitch; ?>
                <?php else : ?>
                    <a class="header-link" href="index.php?action=homepage">Accueil</a>
                    <a class="header-link" href="index.php?action=services">Services</a>
                    <a class="header-link" href="index.php?action=habitatsList">Habitats</a>
                    <a class="header-link" href="index.php?action=practicalInformation">Infos pratiques</a>
                    <a class="header-link" href="index.php?action=contact">Contact</a>
                    <a class="header-link" href="index.php?action=staffLogin">Espace du personnel</a>
                <?php endif ?>
            </div>
        </div>

    </div>
</nav>