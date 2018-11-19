<?php
class CommentTrousseManager extends Manager
{
	public function getComments($articleTrousseId)
	{
	    $query= $this ->pdo-> prepare('SELECT id_trousse, author_trousse,content_trousse, signaled_trousse, DATE_FORMAT(date_comment_trousse, \'%d/%m/%Y à %Hh%i\') AS creation_date_fr FROM commentsTrousse WHERE id_article_trousse =? ORDER BY signaled_trousse DESC');
	    $query->execute(array($articleTrousseId));
	    return $query;
	}

	public function getComment($commentId)
	{
	    $req= $this->pdo-> prepare('SELECT id_trousse, author_trousse, content_trousse, id_article_trousse , DATE_FORMAT(date_comment_trousse, \'%d/%m/%Y à %Hh%i\') AS creation_date_fr FROM commentsTrousse WHERE id_trousse=?');
	    $req->execute(array($commentId));
        $comment = $req->fetch();
	    
	    return $comment;
	}

	
	public function getSignaledComment($articleTrousseId)
	{
	    $query = $this ->pdo-> prepare('UPDATE commentsTrousse SET signaled_trousse=1 WHERE id_trousse = ?');
	    $signaled_trousse=$query-> execute(array($articleTrousseId));
	    return $signaled_trousse;
	}

	public function postComment($articleTrousseId, $author_trousse, $content_trousse)
	{
	    $query= $this ->pdo->prepare('INSERT INTO commentsTrousse(id_article_trousse , author_trousse, content_trousse, date_comment_trousse, signaled_trousse) VALUES (?,?,?,NOW(),0)');
	    $affectedLines=$query -> execute(array($articleTrousseId, $author_trousse, $content_trousse));
	    return $affectedLines;
	}
	
	public function cancelComment($articleTrousseId)
	{
	    $query= $this ->pdo->prepare('DELETE FROM commentsTrousse WHERE id_trousse=?');
	    $removeLine=$query-> execute(array($articleTrousseId));
	    return $removeLine;
	}
}