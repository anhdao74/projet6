<?php

class ArticlesTrousseController 
{
function addArticleTrousse()
{
    $userSession = new UserSession();
    $logged = $userSession->isLogged();

    if ($logged===False)
    {
        $template = 'connexion';
        $title = 'Page de connexion';

        require('view/layoutView.phtml'); 
    } else {
        if (empty($_POST['title']) || empty($_POST['content']) || empty($_FILES))
        {
            $template = 'postArticleTrousse';
            $title = "Page ajout d'article trousse";

            require('view/layoutView.phtml'); 
        } else {
            $fileName = $_FILES['file']['name'];
            $fileExtension = strrchr($fileName, ".");
            $fileTmpName = $_FILES['file']['tmp_name'];
            $fileDestination = 'images/'.$fileName;
            $autorisedExtension = array('.jpg', '.JPG', '.jpeg', '.JPEG');
            if (in_array($fileExtension, $autorisedExtension)){
                if (move_uploaded_file($fileTmpName, $fileDestination)){
                    $articleTrousseManager = new ArticleTrousseManager;
                    $affectedLines= $articleTrousseManager->postArticleTrousse(strip_tags($_POST['title']), $_POST['content'], $_FILES['file']['name'], $_POST['maliste']);
                    $req = new FlashMessageSession();
                    $flash = $req->setFlash('Le chapitre a bien été ajouté');
                    header('Location: index.php?action=showAdmin');
                    exit();
                }
            } else {
                echo 'Seul les fichiers jpg et jpeg sont autoris�s';
            }
        }  
    }
}
    
function editArticleTrousse()
{
    $userSession = new UserSession();
    $logged = $userSession->isLogged();
    if ($logged===False)
    {
        $template = 'connexion';
        $title = 'Page de connexion';

        require('view/layoutView.phtml'); 
    }else {
        if (isset($_POST['newtitle']) && isset($_POST['newcontent'])) {
            $fileName = $_FILES['file']['name'];
            $fileExtension = strrchr($fileName, ".");
            $fileTmpName = $_FILES['file']['tmp_name'];
            $fileDestination = 'images/'.$fileName;
            $autorisedExtension = array('.jpg', '.JPG', '.jpeg', '.JPEG');
            if (in_array($fileExtension, $autorisedExtension)){
                if (move_uploaded_file($fileTmpName, $fileDestination)){
                    $newtitle_article_trousse = strip_tags($_POST['newtitle']);
                    $newcontent_article_trousse  = $_POST['newcontent'];
                    $articleIdTrousse = $_POST['id_article_trousse'];
                    $newfile_article_trousse = $fileName;
                    $articleTrousseManager = new ArticleTrousseManager();
                    $articleTrousse= $articleTrousseManager-> getArticleTrousse($articleIdTrousse);
                    $articleTrousseManager->modifyArticleTrousse($articleIdTrousse, $newtitle_article_trousse, $newcontent_article_trousse , $newfile_article_trousse);
                    $req = new FlashMessageSession();
                    $message = $req->setFlash('Le chapitre a bien été modifié');
                    $flash = $req->asMessage();
                    header('Location: index.php?action=showAdmin');
                    exit();
                }
            } else {
                echo 'Seul les fichiers jpg et jpeg sont autoris�s';
            }
        }else{
            $verif = new VerifyId();
            $articleTrousse = $verif-> getArticleIdTrousse();
            $articleTrousseManager = new ArticleTrousseManager();
            $articleTrousse = $articleTrousseManager->getArticleTrousse(strip_tags($_GET['id']));

            $req = new FlashMessageSession();
            $message = $req->setFlash('Votre chapitre est prêt a être modifié');
            $flash = $req->asMessage();

            $template = 'editArticleTrousse';
            $title = 'Page modification chapitre';

            require('view/layoutView.phtml'); 
        }
    } 
}
function removeArticleTrousse()
    {
        $verif = new VerifyId();
        $articleTrousse = $verif-> getArticleIdTrousse();
        $articleTrousseManager = new ArticleTrousseManager();
        $articleTrousses=$articleTrousseManager->getArticleTrousse(strip_tags($_GET['id']));
        $removeLine=$articleTrousseManager->cancelArticleTrousse(strip_tags($_GET['id']));
        $req = new FlashMessageSession();
        $message = $req->setFlash('Le chapitre a bien été supprimé');
        $flash = $req->asMessage();
        header('Location: index.php?action=showAdmin');
        exit();
    }
}