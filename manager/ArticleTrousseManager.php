<?php

class ArticleTrousseManager extends Manager {

    public function getArticlesTrousse($typeArticle) {
        $req = $this->pdo->prepare('SELECT id_article_trousse, title_article_trousse , content_article_trousse , file_article_trousse, DATE_FORMAT(date_article_trousse, \'%d/%m/%Y à %Hh%i\') AS article_date_fr, type_article FROM trousse WHERE type_article=?');
        $req->execute(array($typeArticle));
        return $req;
    }

    public function getArticleTrousse($articleIdTrousse) {
        $req = $this->pdo->prepare('SELECT id_article_trousse, title_article_trousse , content_article_trousse , file_article_trousse, DATE_FORMAT(date_article_trousse, \'%d/%m/%Y à %Hh%i\') AS article_date_fr FROM trousse WHERE id_article_trousse=?');
        $req->execute(array($articleIdTrousse));
        $article = $req->fetch();

        return $article;
    }

    public function postArticleTrousse($title_article_trousse , $content_article_trousse , $file_article_trousse) {
        $query = $this->pdo->prepare('INSERT INTO trousse(title_article_trousse , content_article_trousse , date_article_trousse, file_article_trousse) VALUES (?,?,NOW(),?)');
        $affectedLines = $query->execute(array($title_article_trousse , $content_article_trousse , $file_article_trousse));
        return $affectedLines;
    }

    public function modifyArticleTrousse($articleIdTrousse, $newtitle_article_trousse , $newcontent_article_trousse , $newfile_article_trousse) {
        $query = $this->pdo->prepare('UPDATE trousse SET title_article_trousse  = :newtitle_article_trousse , content_article_trousse = :newcontent_article_trousse  , file_article_trousse = :newfile_article_trousse WHERE id_article_trousse= :id_article_trousse');
        $editedLines = $query->execute(array('id_article_trousse' => $articleIdTrousse, 'newtitle_article_trousse' => $newtitle_article_trousse , 'newcontent_article_trousse' => $newcontent_article_trousse , 'newfile_article_trousse' => $newfile_article_trousse));
        return $editedLines;
    }

    public function cancelArticleTrousse($articleIdTrousse) {
        $query = $this->pdo->prepare('DELETE FROM trousse WHERE id_article_trousse=?');
        $removeLine = $query->execute(array($articleIdTrousse));
        return $removeLine;
    }

}
