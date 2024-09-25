<?php

class Products
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function migrateUp()
    {
        $this->conn->query("
            CREATE TABLE IF NOT EXISTS products (
                number INT PRIMARY KEY, 
                name VARCHAR(255), 
                bottlesize VARCHAR(50), 
                price DECIMAL(10, 2), 
                price_gbp DECIMAL(10, 2), 
                updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 
                orderamount INT DEFAULT 0
            );
        ");
    }

    public function migrateDown()
    {
        $this->conn->query("DROP TABLE IF EXISTS products;");
    }

    public function addProduct(int $number, string $name, string $bottlesize, float $price, float $price_gbp)
    {
        $query = $this->conn->prepare("
            INSERT INTO products (number, name, bottlesize, price, price_gbp, updated) 
            VALUES (?, ?, ?, ?, ?, NOW()) 
            ON DUPLICATE KEY UPDATE 
                price = VALUES(price),
                price_gbp = VALUES(price_gbp),
                updated = NOW()
        ");
        $query->bind_param("issdd", $number, $name, $bottlesize, $price, $price_gbp);

        $query->execute();

        $query->close();
    }

    public function getAll()
    {
        $result = $this->conn->query("SELECT * FROM products");

        return  $result->fetch_all(MYSQLI_ASSOC);
    }

    public function updateOrderAmount(int $number, int $orderAmount)
    {
        $query = $this->conn->prepare("
            UPDATE products
            SET orderamount = ?
            WHERE number = ?;
        ");
        $query->bind_param("ii", $orderAmount, $number);

        $query->execute();

        $query->close();
    }
}
