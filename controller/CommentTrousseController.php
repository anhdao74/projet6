<?php

class CommentTrousseController 
{
function listComments()
{
    $db = Db::getConnexionPDO();
    $commentTrousseManager = new CommentTrousseManager($db); 
        $commentsTrousse = $commentTrousseManager->getComments($articleId); 

}
function listCommentsAdmin()
{
    $commentTrousseManager = new CommentTrousseManager(); 
    $listcomments = $commentTrousseManager->getCommentsAdmin(); 
    $template = 'admin';
    $title = 'Page administration';

    require('view/layoutView.phtml');

} 
function editCommentArticleTrousse()
{
    $db = Db::getConnexionPDO();
    $commentTrousseManager = new CommentTrousseManager($db); 
    $commentsTrousse = $commentTrousseManager->getComments($_GET['articleId']); 
    $connected= new UserSession();
    $logged=$connected->isLogged();
    $template = 'editCommentArticleTrousse';
    $title = 'G�rer les commentaire';

    require('view/layoutView.phtml');

}
function addCommentTrousse()
{
    $commentTrousseManager = new CommentTrousseManager(); 
    if (isset($_POST['id']))
    {
        if (isset($_POST['author']) && isset($_POST['content']))
        {
            $affectedLines = $commentTrousseManager->postComment(strip_tags($_POST['id']),strip_tags($_POST['author']), ($_POST['content']));
            $req = new FlashMessageSession();
            $message = $req->setFlash('Votre commentaire a bien été ajouté');
            $flash = $req->asMessage();
        }
        else 
        {
            $req = new FlashMessageSession();
            $flash = $req->asMessage();
            $flash = $req->setFlash('Vous n\'avez pas rempli tous les champs');
            header('Location: index.php?action=articleTrousse&id=' . strip_tags($_POST['id']));
            exit();
        }
    }else {
        $verif = new VerifyId();
        $commentTrousse = $verif-> getAddCommentTrousseId(); 
    }
    header('Location: index.php?action=articleTrousse&id=' . strip_tags($_POST['id']));
    exit();
}
    function removeCommentTrousse()
    {
        $verif = new VerifyId();
        $comment = $verif-> getCommentTrousseId();
        $commentTrousseManager = new CommentTrousseManager();  
        $removeLine=$commentTrousseManager->cancelComment(strip_tags($_GET['id']));
        $req = new FlashMessageSession();
        $flash = $req->asMessage();
        $flash = $req->setFlash('Le commentaire a bien été supprimé');
        header('Location: index.php?action=editCommentArticleTrousse&articleId='. strip_tags($_POST['id']));
        exit();
               
    }
    function signaledCommentTrousse()
    {
        $verif = new VerifyId();
        $comment = $verif-> getCommentId();
        $commentTrousseManager = new CommentTrousseManager();
        $signaled = $commentTrousseManager->getSignaledComment(strip_tags($_GET['id']));
        $req = new FlashMessageSession();
        $flash = $req->asMessage();
        $flash = $req->setFlash('Votre message a bien été signalé');
        
        header('Location: index.php?action=article&id=' . strip_tags($comment['articleId']));
        exit();
                        
    }
}