<?php
class CommentController 
{
function listComments()
    {
        $db = Db::getConnexionPDO();
        $commentManager = new CommentManager($db); 
	    $comments = $commentManager->getComments($articleId); 
	    
    }
function listCommentsAdmin()
    {
        $commentManager = new CommentManager(); 
        $listcomments = $commentManager->getCommentsAdmin(); 
        $template = 'admin';
        $title = 'Page administration';
        
        require('view/layoutView.phtml');
        
    }
function addComment()
    {
        $commentManager = new CommentManager(); 
        if (isset($_POST['id']))
                {
                if (!empty($_POST['author']) && !empty($_POST['content']))
                {
                    $affectedLines = $commentManager->postComment(strip_tags($_POST['id']),strip_tags($_POST['author']), ($_POST['content']));
                    //$req = new FlashMessageSession();
                    //$message = $req->setFlash('Votre commentaire a bien été ajouté');
                    //$flash = $req->asMessage();
                }
                else 
                {
                    $req = new FlashMessageSession();
                    $flash = $req->asMessage();
                    $flash = $req->setFlash('Vous n\'avez pas rempli tous les champs');
                    header('Location: index.php?action=article&id=' . strip_tags($_POST['id']));
                    exit();
                }
                }
        else 
        {
            $verif = new VerifyId();
            $comment = $verif-> getAddCommentId(); 
        }
        header('Location: index.php?action=article&id=' . strip_tags($_POST['id']));
        exit();
    }
    function removeComment()
    {
        $verif = new VerifyId();
        $comment = $verif-> getCommentId();
        $commentManager = new CommentManager();  
        $removeLine=$commentManager->cancelComment(strip_tags($_GET['id']));
        $req = new FlashMessageSession();
        $flash = $req->asMessage();
        $flash = $req->setFlash('Le commentaire a bien été supprimé');
        header('Location: index.php?action=showAdmin');
        exit();
               
    }
    function signaledComment()
    {
        $verif = new VerifyId();
        $comment = $verif-> getCommentId();
        $commentManager = new CommentManager();
        $signaled = $commentManager->getSignaledComment(strip_tags($_GET['id']));
        $req = new FlashMessageSession();
        $flash = $req->asMessage();
        $flash = $req->setFlash('Votre message a bien été signalé');
        
        header('Location: index.php?action=article&id=' . strip_tags($comment['articleId']));
        exit();
                        
    }
}