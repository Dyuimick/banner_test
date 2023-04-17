<?php

namespace App;

interface IDatabaseAdapter{
    public function connect();
    public function query(string $query);
    public function close();
}