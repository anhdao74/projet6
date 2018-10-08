<?php
class Routeur
{
    public function getAction()
    {
    try
    {
        if (isset($_GET['action'])) 
        {
            if ($_GET['action'] == 'home') 
            { 
                $controller = new HomeController;
                
                return [$controller, 'home'];
            
            }
            elseif ($_GET['action'] == 'article') 
            {
                $controller = new HomeController;
                
                return [$controller, 'article'];
            }
            elseif ($_GET['action'] == 'connexion') 
            {
                $connexionController = new ConnexionController;
                return [$connexionController, 'connexion'];
            }
            elseif ($_GET['action'] == 'deconnexion') 
            {
                $connexionController= new ConnexionController;
                return [$connexionController, 'deconnexion'];
            }
            elseif ($_GET['action'] == 'verifyController') 
            {                 
                $connexionController = new ConnexionController;
                return [$connexionController,'verifyController'];  
                 
            }
            elseif ($_GET['action'] == 'showAdmin') 
            {                 
                $adminController = new AdminController;
                return [$adminController,'showAdmin'];  
                 
            }
            elseif ($_GET['action'] == 'addArticle') 
            {
                $articleController = new ArticleController;
                return [$articleController, 'addArticle'];
            }
            elseif ($_GET['action'] == 'addComment') 
            {
                $commentController = new CommentController;
                return [$commentController, 'addComment'];
            }
             
            
            elseif ($_GET['action'] == 'editArticle') 
            {
                $articleController = new ArticleController;
                return [$articleController, 'editArticle'];
                
            }
            elseif ($_GET['action'] == 'removeArticle') 
            {
                $articleManager = new ArticleManager;
                $articleController = new ArticleController;
                return [$articleController, 'removeArticle'];
            }
            elseif ($_GET['action'] == 'removeComment') 
            {
                $commentManager = new CommentManager;                
                $commentController = new CommentController;
                return [$commentController, 'removeComment'];
            }
            elseif ($_GET['action'] == 'signaledComment') 
            {
                $commentManager = new CommentManager;
                $commentController = new CommentController;
                return [$commentController, 'signaledComment'];
            }
        }
        else 
        {
            $controller = new HomeController;
                
            return [$controller, 'home'];
        }
    }
    catch(Exception $e) 
    { // S'il y a eu une erreur, alors...
        echo 'Erreur : ' . $e->getMessage();
    }
    }
}