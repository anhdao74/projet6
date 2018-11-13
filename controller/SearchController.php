<?php

class SearchController 
{
    public function search()
    {
        $connected= new UserSession();
        $logged=$connected->isLogged();
        
        $searchManager = new SearchManager(); 
        $searchResults = $searchManager->search($_POST['rechercher']); 
        
        $template = 'search';
        $title = 'Page de recherche';

        require('view/layoutView.phtml');
    
    }
}