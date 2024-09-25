<?php

require __DIR__ . "/../secretsManager.php";

class Database
{
    public $conn;

    public function __construct()
    {
        $credentials = getSecret(getenv('DB_CREDENTIALS_SECRET_ARN'));

        $url = getenv('DB_URL');
        $name = getenv('DB_NAME');
        $username = $credentials['username'];
        $password = $credentials['password'];

        $this->conn = new mysqli($url, $username, $password, $name);
    }

    public function close()
    {
        $this->conn->close();
    }
}
