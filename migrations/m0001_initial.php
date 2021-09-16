<?php

use app\core\Application;

class m0001_initial
{
    public function __construct()
    {
        $this->name = 'Mother fucker';
    }
    public function up(){
    $db = Application::$app->db;
    $SQL = "CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            email VARCHAR(255) NOT NULL,
            name VARCHAR(255) NOT NULL,
            status TINYINT NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )  ENGINE=INNODB;";
    $db->pdo->exec($SQL);
    }

    public function down()
    {
        Application::$app->db->pdo->exec('DROP TABLE users');
    }
}
?>