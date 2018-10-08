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
                //$req = new FlashMessageSession();
                //$flash = $req->asMessage();
                //$flash = $req->setFlash('Vous n\'avez pas rempli tous les champs');
                header('Location: index.php?action=showAdmin');
                exit();  
            }            
        else 
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
                $affectedLines= $articleManager->postArticle(strip_tags($_POST['title']), strip_tags($_POST['content']), $_FILES['file']['name']);
                //$req = new FlashMessageSession();
                //$flash = $req->setFlash('Le chapitre a bien été ajouté');
            	header('Location: index.php?action=showAdmin');
               	exit();
            }    
    }
    
function editArticle()
    {
        //$userSession = new UserSession();
        //$logged = $userSession->isLogged();
        /*if ($logged===False)
        {
            $template = 'connexion';
            $title = 'Page de connexion';
            
            require('view/layoutView.phtml'); 
        }
        else
        {*/
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
                $newtitle = strip_tags($_POST['newtitle']);
                $newcontent = strip_tags($_POST['newcontent']);
                $articleId = strip_tags($_POST['id']);
                $newfile = $fileName;
                $articleManager = new ArticleManager();
                $article= $articleManager-> getArticle($articleId);
                $editArticle=$articleManager->modifyArticle($articleId, $newtitle, $newcontent, $newfile);
                //$req = new FlashMessageSession();
                //$message = $req->setFlash('Le chapitre a bien été modifié');
                //$flash = $req->asMessage();
                header('Location: index.php?action=showAdmin');
                exit();
            }  
            else
            {
                //$verif = new VerifyId();
                //$article = $verif-> getArticleId();
                $articleManager = new ArticleManager();
                $article = $articleManager->getArticle(strip_tags($_GET['id']));
                
                //$req = new FlashMessageSession();
                //$message = $req->setFlash('Votre chapitre est prêt a être modifié');
                //$flash = $req->asMessage();
                
                $template = 'editArticle';
                $title = 'Page modification chapitre';
        
                require('view/layoutView.phtml'); 
            }
        //} 
    }
function removeArticle()
    {
        //$verif = new VerifyId();
        //$article = $verif-> getArticleId();
        $articleManager = new ArticleManager();
        $articles=$articleManager->getArticles();
        $removeLine=$articleManager->cancelArticle(strip_tags($_GET['id']));
        //$req = new FlashMessageSession();
        //$message = $req->setFlash('Le chapitre a bien été supprimé');
        //$flash = $req->asMessage();
        header('Location: index.php?action=showAdmin');
        exit();
    }
}