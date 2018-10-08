<?php

class ConnexionController 
{
    function connexion()
    {
       // $connected= new UserSession();
        //$logged=$connected->isLogged();
        //$req= new FlashMessageSession();
        //$message = $req->setFlash('Entrez votre identifiant et votre mot de passe');
        //$flash = $req->asMessage();
        
        require('view/connexionView.phtml');
    }
    function deconnexion()
    {
        $user = new UserSession();
        $sign = $user->logOut(); 
        
        header('location: index.php');
        exit();
    }
    function verifyController()
    {
        $userManager = new ConnexionManager();
        $user = $userManager->verifModel(strip_tags($_POST['login']), strip_tags($_POST['pass']));
        
        
        if (!$user)  
        {
            /*$connected= new UserSession();
            $logged=$connected->isLogged();
            $_SESSION['user'] = FALSE;
            $req = new FlashMessageSession();
            $flash = $req->setFlash('Mot de passe ou identifiant erroné, vérifiez');*/
            $template = 'connexion';
            $title = 'Page de connexion';
        
            require('view/layoutView.phtml');
        }
        
        else 
        {  
        /*$user = new UserSession();
        $sign = $user->signIn();
        $logged=$user->isLogged();
        
        $req = new FlashMessageSession();
        $message = $req->setFlash('Vous êtes connecté');
        $flash = $req->asMessage();*/
        $articleManager = new ArticleManager();
        $articles = $articleManager->getArticles();
        
        $template = 'admin';
        $title = 'Page administration';
        
        require('view/layoutView.phtml');    
        }  	
    }
}