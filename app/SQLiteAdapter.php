<?php


namespace App;

use PDO;

class SQLiteAdapter implements IDatabaseAdapter {

    private PDO|null $dbh;

    public function __construct($dsn, $username = null, $password = null, $options = []) {
        $this->dbh = new PDO($dsn, $username, $password, $options);
        $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function query(string $query, array $params) {
        $stmt = $this->dbh->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function escapeString(string $value): string
    {
        return $this->dbh->quote($value);
    }

    public function close()
    {
        $this->dbh = null;
    }

    public function connect()
    {
    }

}