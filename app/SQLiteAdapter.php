<?php

namespace App;

use PDO;


class SQLiteAdapter implements IDatabaseAdapter {

    private $dbh;

    public function __construct($dsn, $username = null, $password = null, $options = []) {
        $this->dbh = new PDO($dsn, $username, $password, $options);
        $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function query(string $query) {
        $stmt = $this->dbh->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function close()
    {
    }

    public function connect()
    {
    }

}