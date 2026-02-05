<?php

class CommentController 
{
    /**
     * Ajoute un commentaire.
     * @return void
     */
    public function addComment() : void
    {
        // Récupération des données du formulaire.
        $pseudo = Utils::request("pseudo");
        $content = Utils::request("content");
        $idArticle = Utils::request("idArticle");

        // On vérifie que les données sont valides.
        if (empty($pseudo) || empty($content) || empty($idArticle)) {
            throw new Exception("Tous les champs sont obligatoires. 3");
        }

        // On vérifie que l'article existe.
        $articleManager = new ArticleManager();
        $article = $articleManager->getArticleById($idArticle);
        if (!$article) {
            throw new Exception("L'article demandé n'existe pas.");
        }

        // On crée l'objet Comment.
        $comment = new Comment([
            'pseudo' => $pseudo,
            'content' => $content,
            'idArticle' => $idArticle
        ]);

        // On ajoute le commentaire.
        $commentManager = new CommentManager();
        $result = $commentManager->addComment($comment);

        // On vérifie que l'ajout a bien fonctionné.
        if (!$result) {
            throw new Exception("Une erreur est survenue lors de l'ajout du commentaire.");
        }

        // On redirige vers la page de l'article.
        Utils::redirect("showArticle", ['id' => $idArticle]);
    }

     /**
     * Supprime un commentaire.
     * @return void
     */
    public function deleteComment() : void
    {
        if (!isset($_SESSION['user'])) {
            throw new Exception("Accès non autorisé.");
        }

        $idComment = Utils::request("id", -1);

        if ($idComment === -1) {
            throw new Exception("Commentaire invalide.");
        }

        $commentManager = new CommentManager();
        $comment = $commentManager->getCommentById($idComment);

        if (!$comment) {
            throw new Exception("Le commentaire demandé n'existe pas.");
        }

        $commentManager->deleteComment($comment);

        Utils::redirect("showArticle", [
            'id' => $comment->getIdArticle()
        ]);
    }
}