<?php

namespace App;

interface IDatabaseAdapter{
    public function connect();
    public function query(string $query, array $params);
    public function close();
    public function escapeString(string $value);
}