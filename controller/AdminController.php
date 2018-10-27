<?php

class AdminController 
{
    public function showAdmin()
    {
        $articleManager = new ArticleManager(); 
        $articles = $articleManager->getArticles(); 
        $articleTrousseManager = new ArticleTrousseManager(); 
        $articlesTrousseSoinVisage = $articleTrousseManager->getArticlesTrousseByType(1); 
        $articlesTrousseSoinCorp = $articleTrousseManager->getArticlesTrousseByType(2);
        $articlesTrousseMakeUpYeux = $articleTrousseManager->getArticlesTrousseByType(3); 
        $articlesTrousseMakeUpLevre = $articleTrousseManager->getArticlesTrousseByType(4); 
        $articlesTrousseMakeUpTeint = $articleTrousseManager->getArticlesTrousseByType(5); 
        
        $connected= new UserSession();
        $logged=$connected->isLogged();
        $req = new FlashMessageSession();
        $flash = $req->asMessage();
        $template = 'admin';
        $title = 'Page administration';

        require('view/layoutView.phtml');
    }
}