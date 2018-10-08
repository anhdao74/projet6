<?php
class HomeController 
{
    public function home()
    {
        $articleManager = new ArticleManager(); 
        $articles = $articleManager->getArticles(); 
        //$connect= new UserSession();
        //$logged=$connect->isLogged();
        //$req = new FlashMessageSession();
        //$flash = $req->asMessage();
        $template = 'home';
        $title = 'Page Accueil';
        
        require('view/layoutView.phtml');
        
    }
    public function article()
    {
        $articleManager = new ArticleManager();
        //$commentManager = new CommentManager();
        //$verif = new VerifyId();
        //$article = $verif-> getArticleId();
        
        $article = $articleManager->getArticle(strip_tags($_GET['id']));
        
        //$comments = $commentManager->getComments(strip_tags($_GET['id']));
        //$connected= new UserSession();
        //$logged=$connected->isLogged();
        //$req = new FlashMessageSession();
        //$flash = $req->asMessage();
        $template = 'article';
        $title = 'Page article';
        
        require('view/layoutView.phtml');
    }
}