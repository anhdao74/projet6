<?php

class AdminController 
{
        public function showAdmin()
        {
        $articleManager = new ArticleManager(); 
        $articles = $articleManager->getArticles(); 
        //$connected= new UserSession();
        //$logged=$connected->isLogged();
        //$req = new FlashMessageSession();
        //$flash = $req->asMessage();
        $template = 'admin';
        $title = 'Page administration';

        require('view/layoutView.phtml');
        }
}