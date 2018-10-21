<?php

class VerifyId
{
	public function getCommentId()
	{
		if (array_key_exists('id',$_GET))
            {
                if (!empty($_GET['id']))
                {
                    if (ctype_digit($_GET['id']))
                    {
                        $commentManager = new CommentManager();
                        $comment = $commentManager->getComment($_GET['id']);
                        if ($comment == TRUE)
                        {
                            return $comment;
                        }
                        else
                        {
                            $req = new FlashMessageSession();
                            $flash = $req->asMessage();
                            $flash = $req->setFlash('Le commentaire demandé n\'existe pas');
                            header('Location: index.php');
                            exit();
                        }
                    }
                    else
                    {
                        $req = new FlashMessageSession();
                        $flash = $req->asMessage();
                        $flash = $req->setFlash('L\'identifiant d\'un commentaire doit être un nombre entier');
                        header('Location: index.php');
                        exit(); 
                    }
                }
                else
                {
                    $req = new FlashMessageSession();
                    $flash = $req->asMessage();
                    $flash = $req->setFlash('L\'identifiant du commentaire ne peut être vide');
                    header('Location: index.php');
                    exit();
                }
            }
        else
        {
            $req = new FlashMessageSession();
            $flash = $req->asMessage();
            $flash = $req->setFlash('Aucun identifiant de commentaire envoyé');
            header('Location: index.php');
            exit();
        }          
	}
	public function getAddCommentId()
	{
		if (array_key_exists('id',$_GET))
            {
                if (!empty($_GET['id']))
                {
                    if (ctype_digit($_GET['id']))
                    {
                        $commentManager = new CommentManager();
                        $comment = $commentManager->getComment($_GET['id']);
                        if ($comment == TRUE)
                        {
                            $req = new FlashMessageSession();
                            $flash = $req->asMessage();
                            $flash = $req->setFlash('L\'identifiant de ce commentaire existe déja');
                            header('Location: index.php');
                            exit();
                        }
                        else
                        {
                            $req = new FlashMessageSession();
                            $flash = $req->asMessage();
                            $flash = $req->setFlash('Le commentaire demandé n\'existe pas');
                            header('Location: index.php');
                            exit();
                        }
                    }
                    else
                    {
                        $req = new FlashMessageSession();
                        $flash = $req->asMessage();
                        $flash = $req->setFlash('L\'identifiant d\'un commentaire doit être un nombre entier');
                        header('Location: index.php');
                        exit(); 
                    }
                }
                else
                {
                    $req = new FlashMessageSession();
                    $flash = $req->asMessage();
                    $flash = $req->setFlash('L\'identifiant du commentaire ne peut être vide');
                    header('Location: index.php');
                    exit();
                }
            }
        else
        {
            $req = new FlashMessageSession();
            $flash = $req->asMessage();
            $flash = $req->setFlash("Aucun identifiant d'article envoyé2");
            header('Location: index.php');
            exit();
        }          
	}
	public function getArticleId()
	{
		if (array_key_exists('id',$_GET))
            {
                if (!empty($_GET['id']))
                {
                    if (ctype_digit($_GET['id']))
                    {
                        $articleManager = new ArticleManager();
                        $article= $articleManager->getArticle($_GET['id']);
                        if ($article == TRUE)
                        {
                            return $article;
                        }
                        else
                        {
                            $req = new FlashMessageSession();
                            $flash = $req->asMessage();
                            $flash = $req->setFlash('Le article demandé n\'existe pas');
                            header('Location: index.php');
                            exit();
                        }
                    }
                    else
                    {
                        $req = new FlashMessageSession();
                        $flash = $req->asMessage();
                        $flash = $req->setFlash('L\'identifiant d\'un article doit être un nombre entier');
                        header('Location: index.php');
                        exit(); 
                    }
                }
                else
                {
                    $req = new FlashMessageSession();
                    $flash = $req->asMessage();
                    $flash = $req->setFlash('L\'identifiant du article ne peut être vide');
                    header('Location: index.php');
                    exit();
                }
            }
        else
        {
            $req = new FlashMessageSession();
            $flash = $req->asMessage();
            $flash = $req->setFlash("Aucun identifiant d'article envoyé2");
            header('Location: index.php');
            exit();
        }          
	}
	public function getAddArticleId()
	{
            if (array_key_exists('id',$_GET))
            {
                if (!empty($_GET['id']))
                {
                    if (ctype_digit($_GET['id']))
                    {
                        $articleManager = new ArticleManager();
                        $article = $articleManager->getArticle($_GET['id']);
                        if ($article == TRUE)
                        {
                            $req = new FlashMessageSession();
                            $flash = $req->asMessage();
                            $flash = $req->setFlash('L\'identifiant de cet article existe déja');
                            header('Location: index.php?action=showAdmin');
                            exit();
                        }
                        else
                        {
                            $req = new FlashMessageSession();
                            $flash = $req->asMessage();
                            $flash = $req->setFlash("L'article demandé n\'existe pas");
                            header('Location: index.php?action=showAdmin');
                            exit();
                        }
                    }
                    else
                    {
                        $req = new FlashMessageSession();
                        $flash = $req->asMessage();
                        $flash = $req->setFlash('L\'identifiant d\'un article doit être un nombre entier');
                        header('Location: index.php?action=showAdmin');
                        exit(); 
                    }
                }
                else
                {
                    $req = new FlashMessageSession();
                    $flash = $req->asMessage();
                    $flash = $req->setFlash("L'identifiant de l'article ne peut être vide");
                    header('Location: index.php?action=showAdmin');
                    exit();
                }
            }
            else
            {
                $req = new FlashMessageSession();
                $flash = $req->asMessage();
                $flash = $req->setFlash("Aucun identifiant d'article envoyé2");
                header('Location: index.php?action=showAdmin');
                exit();
            }          
	}
        public function getArticleIdTrousse()
	{
            var_dump(array_key_exists('id',$_GET));
            if (array_key_exists('id',$_GET))
            {
                if (!empty($_GET['id']))
                {
                    if (ctype_digit($_GET['id']))
                    {
                        $articleTrousseManager = new ArticleTrousseManager();
                        $articleTrousse= $articleTrousseManager->getArticleTrousse($_GET['id']);
                        if ($articleTrousse == TRUE)
                        {
                            return $articleTrousse;
                        }
                        else
                        {
                            $req = new FlashMessageSession();
                            $flash = $req->asMessage();
                            $flash = $req->setFlash("L'article demandé n\'existe pas");
                            header('Location: index.php');
                            exit();
                        }
                    }
                    else
                    {
                        $req = new FlashMessageSession();
                        $flash = $req->asMessage();
                        $flash = $req->setFlash('L\'identifiant d\'un article doit être un nombre entier');
                        header('Location: index.php');
                        exit(); 
                    }
                }
                else
                {
                    $req = new FlashMessageSession();
                    $flash = $req->asMessage();
                    $flash = $req->setFlash('L\'identifiant du article ne peut être vide');
                    header('Location: index.php');
                    exit();
                }
            }
            else
            {
                $req = new FlashMessageSession();
                $flash = $req->asMessage();
                $flash = $req->setFlash("Aucun identifiant d'article envoyé2");
                header('Location: index.php');
                exit();
            }          
	}
}