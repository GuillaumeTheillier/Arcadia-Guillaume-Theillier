<?php
$title = 'Avis';
ob_start();
?>

<main>
    <h1 class="page-title">Gestion des avis</h1>
    <section class="mana-comments-lists">
        <?php
        foreach ($allcomment as $comment) :
            $visible = $comment['isVisible'];
        ?>
            <div id="<?php echo $comment['id'] ?>" class="mana-comment-container">
                <p class="mana-comment-pseudo"><?php echo $comment['pseudo'] ?></p>
                <p class="mana-comment"><?php echo $comment['commentaire'] ?></p>
                <p class="mana-comment-date"><?php echo $comment['date'] ?></p>
                <form action="index.php?action=editVisibleComment" method="post">
                    <div>
                        <?php if ($visible) : ?>
                            <div class="mana-comment-radio">
                                <input type="radio" name="visible" id="valid" value=1 checked>
                                <label for="valid">Valider</label>
                            </div>
                            <div class="mana-comment-radio">
                                <input type="radio" name="visible" id="invalid" value=0>
                                <label for="invalid">Invalider</label>
                            </div>
                        <?php else : ?>
                            <div class="mana-comment-radio">
                                <input type="radio" name="visible" id="valid" value=1>
                                <label for="valid">Valider</label>
                            </div>
                            <div class="mana-comment-radio">
                                <input type="radio" name="visible" id="invalid" value=0 checked>
                                <label for="invalid">Invalider</label>
                            </div>
                        <?php endif ?>
                    </div>
                    <button type="submit" name="commentId" value="<?php echo $comment['id'] ?>">Valider</button>
                </form>
            </div>
        <?php endforeach ?>
    </section>
</main>

<?php
$content = ob_get_clean();
require('layout.php');
?>