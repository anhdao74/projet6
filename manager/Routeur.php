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
            if ($_GET['action'] == 'search') 
            { 
                $controller = new SearchController;
                
                return [$controller, 'search'];
            
            }
            elseif ($_GET['action'] == 'article') 
            {
                $controller = new HomeController;
                
                return [$controller, 'article'];
            }
            elseif ($_GET['action'] == 'articles') 
            {
                $controller = new HomeController;
                
                return [$controller, 'articles'];
            }
            elseif ($_GET['action'] == 'articleTrousse') 
            {
                $controller = new HomeController;
                
                return [$controller, 'articleTrousse'];
            }
            elseif ($_GET['action'] == 'articlesTrousse') 
            {
                $controller = new HomeController;
                
                return [$controller, 'articlesTrousse'];
            }
            elseif ($_GET['action'] == 'editArticleTrousse') 
            {
                $articleTrousseController = new ArticlesTrousseController;
                return [$articleTrousseController, 'editArticleTrousse'];
                
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
            elseif ($_GET['action'] == 'addArticleTrousse') 
            {
                $articleTrousseController = new ArticlesTrousseController;
                return [$articleTrousseController, 'addArticleTrousse'];
            }
            elseif ($_GET['action'] == 'addComment') 
            {
                $commentController = new CommentController;
                return [$commentController, 'addComment'];
            }
            elseif ($_GET['action'] == 'editCommentArticle') 
            {
                $commentController = new CommentController;
                return [$commentController, 'editCommentArticle'];
                
            }
            elseif ($_GET['action'] == 'addCommentTrousse') 
            {
                $commentTrousseController = new CommentTrousseController;
                return [$commentTrousseController, 'addCommentTrousse'];
            }
            elseif ($_GET['action'] == 'editCommentArticleTrousse') 
            {
                $commentTrousseController = new CommentTrousseController;
                return [$commentTrousseController, 'editCommentArticleTrousse'];
                
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
            elseif ($_GET['action'] == 'removeCommentTrousse') 
            {
                $commentTrousseController = new CommentTrousseController;
                return [$commentTrousseController, 'removeCommentTrousse'];
            }
            elseif ($_GET['action'] == 'signaledComment') 
            {
                $commentManager = new CommentManager;
                $commentController = new CommentController;
                return [$commentController, 'signaledComment'];
            }
            elseif ($_GET['action'] == 'removeArticleTrousse') 
            {
                $articleTrousseManager = new ArticleTrousseManager;
                $articleTrousseController = new ArticlesTrousseController;
                return [$articleTrousseController, 'removeArticleTrousse'];
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