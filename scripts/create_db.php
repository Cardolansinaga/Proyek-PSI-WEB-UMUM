<?php
$hosts = ['127.0.0.1', 'localhost'];
$port = 3306;
$users = ['root'];
$passwords = ['', 'root', 'laragon', '123456'];
$dbname = 'laravel';

$tried = [];
foreach ($hosts as $host) {
    foreach ($users as $user) {
        foreach ($passwords as $pass) {
            $tried[] = "host={$host} user={$user} pass=" . ($pass === '' ? '[empty]' : $pass);
            try {
                $pdo = new PDO("mysql:host={$host};port={$port}", $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
                $pdo->exec("CREATE DATABASE IF NOT EXISTS `{$dbname}` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;");
                echo "OK DB (connected {$host} with user={$user} pass=" . ($pass === '' ? '[empty]' : $pass) . ")\n";
                exit(0);
            } catch (PDOException $e) {
                // continue trying
            }
        }
    }
}
echo "ERR: all attempts failed\n";
echo "Tried: \n" . implode("\n", $tried) . "\n";
exit(1);
