<?php
$title = 'Commentaires sur les habitats';
ob_start();
?>

<main>
    <h1 class="page-title">Commentaires sur les habitats</h1>

    <!-- Alert -->
    <div class="alert-container">
        <?php
        if (isset($_COOKIE['ADD_HABITAT_COMMENT_SUCCESS']) && $_COOKIE['ADD_HABITAT_COMMENT_SUCCESS'] == true) :
        ?>
            <div class="alert alert-success" role="alert">
                Le commentaire sur l'habitat a été modifié.
                <button type='button' class="btn-close ms-auto" data-bs-dismiss='alert'></button>
            </div>
        <?php elseif (isset($_COOKIE['ADD_HABITAT_COMMENT_ERROR'])) : ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $_COOKIE['ADD_HABITAT_COMMENT_ERROR']; ?>
                <button type='button' class="btn-close ms-auto" data-bs-dismiss='alert'></button>
            </div>
        <?php endif; ?>
    </div>

    <!-- Comment list table -->
    <div class="animal-list-container">
        <table class="animal-list">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Commentaire actuel</th>
                    <th>Modifier le commentaire</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($commentList as $com) : ?>
                    <tr class='table-row'>
                        <td><?php echo $com['nom']; ?></td>
                        <td class="table-col-textarea"><?php echo $com['comment']; ?></td>
                        <td>
                            <form action="index?action=addHabitatComment" method="post" class="habitat-comment-form">
                                <textarea name="habitatComment" class="input-form" cols="8" rows="15" maxlength="255"></textarea>
                                <button type="submit" name="habitatId" value="<?php echo $com['id'] ?>" class="button-crud">Modifier</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script src="script/frameScript.js"></script>
</main>

<?php
$content = ob_get_clean();
require('layout.php');
?>