<?php
class HomeController 
{
    public function home()
    {
        $articleManager = new ArticleManager(); 
        $articles = $articleManager->getArticles(); 
        $articleTrousseManager = new ArticleTrousseManager(); 
        $articlesTrousseSoinVisage = $articleTrousseManager->getArticlesTrousseByType(1); 
        $articlesTrousseSoinCorp = $articleTrousseManager->getArticlesTrousseByType(2);
        $articlesTrousseMakeUpYeux = $articleTrousseManager->getArticlesTrousseByType(3); 
        $articlesTrousseMakeUpLevre = $articleTrousseManager->getArticlesTrousseByType(4); 
        $articlesTrousseMakeUpTeint = $articleTrousseManager->getArticlesTrousseByType(5); 
        $connect= new UserSession();
        $logged=$connect->isLogged();
        $req = new FlashMessageSession();
        $flash = $req->asMessage();
        $template = 'home';
        $title = 'Page Accueil';
        
        require('view/layoutView.phtml');
        
    }
    public function article()
    {
        $articleManager = new ArticleManager();
        $commentManager = new CommentManager();
        $verif = new VerifyId();
        $article = $verif-> getArticleId();
        
        $article = $articleManager->getArticle(strip_tags($_GET['id']));
        
        $comments = $commentManager->getComments(strip_tags($_GET['id']));
        $connected= new UserSession();
        $logged=$connected->isLogged();
        $req = new FlashMessageSession();
        $flash = $req->asMessage();
        $template = 'article';
        $title = 'Page article';
        
        require('view/layoutView.phtml');
    }
    public function articles()
    {
        $articleManager = new ArticleManager(); 
        $articles = $articleManager->getArticles(); 
        
        $connected= new UserSession();
        $logged=$connected->isLogged();
        
        $template = 'articles';
        $title = 'Page des articles';
        
        require('view/layoutView.phtml');
    }
    public function articleTrousse()
    {
        $articleTrousseManager = new ArticleTrousseManager();
        $commentTrousseManager = new CommentTrousseManager();
        $verif = new VerifyId();
        $articleTrousse = $verif-> getArticleIdTrousse();
        
        $articleTrousse = $articleTrousseManager->getArticleTrousse(strip_tags($_GET['id']));
        
        $comments = $commentTrousseManager->getComments(strip_tags($_GET['id']));
        $connected= new UserSession();
        $logged=$connected->isLogged();
        $req = new FlashMessageSession();
        $flash = $req->asMessage();
        $template = 'articleTrousse';
        $title = 'Page trousse des articles';
        
        require('view/layoutView.phtml');
    }
    public function articlesTrousse()
    {
        $articleTrousseManager = new ArticleTrousseManager(); 
        $articlesTrousseSoinVisage = $articleTrousseManager->getArticlesTrousseByType(1); 
        $articlesTrousseSoinCorp = $articleTrousseManager->getArticlesTrousseByType(2);
        $articlesTrousseMakeUpYeux = $articleTrousseManager->getArticlesTrousseByType(3); 
        $articlesTrousseMakeUpLevre = $articleTrousseManager->getArticlesTrousseByType(4); 
        $articlesTrousseMakeUpTeint = $articleTrousseManager->getArticlesTrousseByType(5); 
        
        $connected= new UserSession();
        $logged=$connected->isLogged();
        
        $template = 'articlesTrousse';
        $title = 'Page trousse';
        
        require('view/layoutView.phtml');
    }
}