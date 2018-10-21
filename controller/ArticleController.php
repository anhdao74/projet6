<?php
class ArticleController 
{
function addArticle()
    {
        $articleManager = new ArticleManager();
        $articles= $articleManager->getArticles();
		if (empty($_POST['title']) && empty($_POST['content']) && empty(($_FILES))) 
            {
                $verif = new VerifyId();
                $article = $verif-> getAddArticleId(); 
                $req = new FlashMessageSession();
                $flash = $req->asMessage();
                $flash = $req->setFlash('Vous n\'avez pas rempli tous les champs');
                header('Location: index.php?action=showAdmin');
                exit();  
            }            
        else 
            {
            var_dump($_FILES);
                $fileName = $_FILES['file']['name'];
                $fileExtension = strrchr($fileName, ".");
                $fileTmpName = $_FILES['file']['tmp_name'];
                $fileDestination = 'images/'.$fileName;
                $autorisedExtension = array('.jpg', '.JPG', '.jpeg', '.JPEG');
                if (in_array($fileExtension, $autorisedExtension)){
                    if (move_uploaded_file($fileTmpName, $fileDestination)){
                        echo 'Image envoy� avec succ�s';
                    }
                } else {
                    echo 'Seul les fichiers jpg et jpeg sont autoris�s';
                }
                $affectedLines= $articleManager->postArticle(strip_tags($_POST['title']), $_POST['content'], $_FILES['file']['name'], $_FILES['file2']['name']);
                $req = new FlashMessageSession();
                $flash = $req->setFlash('Le chapitre a bien été ajouté');
            	header('Location: index.php?action=showAdmin');
               	exit();
            }    
    }
    
function editArticle()
    {
        $userSession = new UserSession();
        $logged = $userSession->isLogged();
        if ($logged===False)
        {
            $template = 'connexion';
            $title = 'Page de connexion';
            
            require('view/layoutView.phtml'); 
        }
        else
        {
         if (isset($_POST['newtitle']) && isset($_POST['newcontent']))
            
            {
                $fileName = $_FILES['file']['name'];
                $fileExtension = strrchr($fileName, ".");
                $fileTmpName = $_FILES['file']['tmp_name'];
                $fileDestination = 'images/'.$fileName;
                $autorisedExtension = array('.jpg', '.JPG', '.jpeg', '.JPEG');
                if (in_array($fileExtension, $autorisedExtension)){
                    if (move_uploaded_file($fileTmpName, $fileDestination)){
                        echo 'Image envoy� avec succ�s';
                    }
                } else {
                    echo 'Seul les fichiers jpg et jpeg sont autoris�s';
                }
                $fileName2 = $_FILES['file2']['name'];
                $fileExtension2 = strrchr($fileName2, ".");
                $fileTmpName2 = $_FILES['file2']['tmp_name'];
                $fileDestination2 = 'images/'.$fileName2;
                $autorisedExtension2 = array('.jpg', '.JPG', '.jpeg', '.JPEG');
                if (in_array($fileExtension2, $autorisedExtension2)){
                    if (move_uploaded_file($fileTmpName2, $fileDestination2)){
                        echo 'Image envoy� avec succ�s';
                    }
                } else {
                    echo 'Seul les fichiers jpg et jpeg sont autoris�s';
                }
                $newtitle = strip_tags($_POST['newtitle']);
                $newcontent = $_POST['newcontent'];
                $articleId = strip_tags($_POST['id']);
                $newfile = $fileName;
                $newfile2 = $fileName2;
                $articleManager = new ArticleManager();
                $article= $articleManager-> getArticle($articleId);
                $editArticle=$articleManager->modifyArticle($articleId, $newtitle, $newcontent, $newfile, $newfile2);
                $req = new FlashMessageSession();
                $message = $req->setFlash('Le chapitre a bien été modifié');
                $flash = $req->asMessage();
                header('Location: index.php?action=showAdmin');
                exit();
            }  
            else
            {
                $verif = new VerifyId();
                $article = $verif-> getArticleId();
                $articleManager = new ArticleManager();
                $article = $articleManager->getArticle(strip_tags($_GET['id']));
                
                $req = new FlashMessageSession();
                $message = $req->setFlash('Votre chapitre est prêt a être modifié');
                $flash = $req->asMessage();
                
                $template = 'editArticle';
                $title = 'Page modification chapitre';
        
                require('view/layoutView.phtml'); 
            }
        } 
    }
function removeArticle()
    {
        $verif = new VerifyId();
        $article = $verif-> getArticleId();
        $articleManager = new ArticleManager();
        $articles=$articleManager->getArticles();
        $removeLine=$articleManager->cancelArticle(strip_tags($_GET['id']));
        $req = new FlashMessageSession();
        $message = $req->setFlash('Le chapitre a bien été supprimé');
        $flash = $req->asMessage();
        header('Location: index.php?action=showAdmin');
        exit();
    }
}