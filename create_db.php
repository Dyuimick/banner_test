<?php
$dsn = './banner.db';
if (!file_exists($dsn)) {
    touch($dsn);
}
$username = null;
$password = null;
$options = [];
$dbh = new PDO('sqlite:' . $dsn, $username, $password, $options);

$sql = file_get_contents('./dump');

$dbh->exec($sql);