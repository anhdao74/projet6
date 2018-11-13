<?php

class SearchManager extends Manager {

    public function search($q) {
        $req = $this->pdo->query('SELECT id, title, content, file, file2 FROM article WHERE title LIKE "%'.$q.'%" ORDER BY id');

        return $req;
    }
}
