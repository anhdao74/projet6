<?php

class AdminController 
{
    public function showAdmin()
    {
        $articleManager = new ArticleManager(); 
        $articles = $articleManager->getArticles(); 
        $articleTrousseManager = new ArticleTrousseManager(); 
        $articlesTrousseSoinVisage = $articleTrousseManager->getArticlesTrousse(1); 
        $articlesTrousseSoinCorp = $articleTrousseManager->getArticlesTrousse(2);
        $articlesTrousseMakeUpYeux = $articleTrousseManager->getArticlesTrousse(3); 
        $articlesTrousseMakeUpLevre = $articleTrousseManager->getArticlesTrousse(4); 
        $articlesTrousseMakeUpTeint = $articleTrousseManager->getArticlesTrousse(5); 
        
        $connected= new UserSession();
        $logged=$connected->isLogged();
        $req = new FlashMessageSession();
        $flash = $req->asMessage();
        $template = 'admin';
        $title = 'Page administration';

        require('view/layoutView.phtml');
    }
}