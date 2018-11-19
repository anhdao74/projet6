<?php
class CommentManager extends Manager
{
	public function getComments($articleId)
	{
	    $query= $this ->pdo-> prepare('SELECT id, author,content, signaled, DATE_FORMAT(date_comment, \'%d/%m/%Y à %Hh%i\') AS creation_date_fr FROM comments WHERE articleId=? ORDER BY signaled DESC');
	    $query->execute(array($articleId));
	    return $query;
	}
	
	public function getSignaledComment($articleId)
	{
	    $query = $this ->pdo-> prepare('UPDATE comments SET signaled=1 WHERE id = ?');
	    $signaled=$query-> execute(array($articleId));
	    return $signaled;
	}
	
	public function getComment($commentId)
	{
	    $req= $this->pdo-> prepare('SELECT id, author, content, articleId, DATE_FORMAT(date_comment, \'%d/%m/%Y à %Hh%i\') AS creation_date_fr FROM comments WHERE id=?');
	    $req->execute(array($commentId));
        $comment = $req->fetch();
	    
	    return $comment;
	}

	public function postComment($articleId, $author, $content)
	{
	    $query= $this ->pdo->prepare('INSERT INTO comments(articleId, author, content, date_comment, signaled) VALUES (?,?,?,NOW(),0)');
	    $affectedLines=$query -> execute(array($articleId, $author, $content));
	    return $affectedLines;
	}

	public function cancelComment($articleId)
	{
	    $query= $this ->pdo->prepare('DELETE FROM comments WHERE id=?');
	    $removeLine=$query-> execute(array($articleId));
	    return $removeLine;
	}
}