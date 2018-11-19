<?php

class SearchManager extends Manager {

    public function search($q) {
        $req = $this->pdo->query('SELECT id, title, content, file, file2 FROM article WHERE title LIKE "%'.$q.'%" ORDER BY id') AND
        	
                ('SELECT id_article_trousse, title_article_trousse, content_article_trousse, file_article_trousse , type_article  FROM trousse WHERE title_article_trousse LIKE "%'.$q.'%"');

        return $req;
    }
}
