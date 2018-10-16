<?php

class ArticleManager extends Manager {

    public function getArticles() {
        $req = $this->pdo->query('SELECT id, title, content, file, file2, DATE_FORMAT(article_date, \'%d/%m/%Y à %Hh%i\') AS article_date_fr FROM article ORDER BY id');

        return $req;
    }

    public function getArticle($articleId) {
        $req = $this->pdo->prepare('SELECT id, title, content, file, file2, DATE_FORMAT(article_date, \'%d/%m/%Y à %Hh%i\') AS article_date_fr FROM article WHERE id=?');
        $req->execute(array($articleId));
        $article = $req->fetch();

        return $article;
    }

    public function postArticle($title, $content, $file, $file2) {
        $query = $this->pdo->prepare('INSERT INTO article(title, content, article_date, file, file2) VALUES (?,?,NOW(),?,?)');
        $affectedLines = $query->execute(array($title, $content, $file, $file2));
        return $affectedLines;
    }

    public function modifyArticle($articleId, $newtitle, $newcontent, $newfile, $newfile2) {
        $query = $this->pdo->prepare('UPDATE article SET title = :newtitle, content= :newcontent , file= :newfile, file2= :newfile2 WHERE id= :id');
        $editedLines = $query->execute(array('id' => $articleId, 'newtitle' => $newtitle, 'newcontent' => $newcontent, 'newfile' => $newfile, 'newfile2' => $newfile2));
        return $editedLines;
    }

    public function cancelArticle($articleId) {
        $query = $this->pdo->prepare('DELETE FROM article WHERE id=?');
        $removeLine = $query->execute(array($articleId));
        return $removeLine;
    }

}
