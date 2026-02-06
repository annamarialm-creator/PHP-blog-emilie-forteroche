<?php
    /**
     * Ce template affiche un article et ses commentaires.
     * Il affiche également un formulaire pour ajouter un commentaire.
     */
?>

<article class="mainArticle">
    <h2><?= Utils::format($article->getTitle()) ?></h2>
    <span class="quotation">«</span>
    <p><?= Utils::format($article->getContent()) ?></p>

    <div class="footer">
        <span class="info">
            Publié le <?= Utils::convertDateToFrenchFormat($article->getDateCreation()) ?>
        </span>
        <?php if ($article->getDateUpdate() !== null): ?>
            <span class="info">
                Modifié le <?= Utils::convertDateToFrenchFormat($article->getDateUpdate()) ?>
            </span>
        <?php endif; ?>
    </div>
</article>

<div class="comments">
    <h2 class="commentsTitle">Vos Commentaires</h2>

    <?php if (empty($comments)): ?>
        <p class="info">Aucun commentaire pour cet article.</p>
    <?php else: ?>
        <ul>
            <?php foreach ($comments as $comment): ?>
                <li>
                    <div class="smiley">☻</div>

                    <div class="detailComment">
                        <h3 class="info">
                            Le <?= Utils::convertDateToFrenchFormat($comment->getDateCreation()) ?>,
                            <?= Utils::format($comment->getPseudo()) ?> a écrit :
                        </h3>

                        <p class="content">
                            <?= Utils::format($comment->getContent()) ?>
                        </p>

                        <?php if (isset($_SESSION['user'])): ?>
                            <a
                                class="submit"
                                href="index.php?action=deleteComment&id=<?= $comment->getId() ?>"
                                <?= Utils::askConfirmation("Êtes-vous sûr de vouloir supprimer ce commentaire ?") ?>
                            >
                                Supprimer
                            </a>
                        <?php endif; ?>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form action="index.php" method="post" class="foldedCorner">
    <h2>Commenter</h2>

    <div class="formComment formGrid">
        <label for="pseudo">Pseudonyme</label>
        <input type="text" name="pseudo" id="pseudo" required>

        <label for="content">Commentaire</label>
        <textarea name="content" id="content" required></textarea>

        <input type="hidden" name="action" value="addComment">
        <input type="hidden" name="idArticle" value="<?= $article->getId() ?>">

        <button class="submit">Ajouter un commentaire</button>
    </div>
</form>

