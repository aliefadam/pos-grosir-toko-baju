<?php

$url = $_SERVER["REQUEST_URI"];

if (strpos($url, "/view/pages/") === 0) {
    require_once "../../../config/database.php";
} else {
    require_once "../config/database.php";
}

class Product
{
    public static function all()
    {
        $conn = new Database();
        $data = [];

        $result = $conn->query("
            SELECT products.id, products.name AS product_name, categories.id AS category_id, categories.name AS category_name, products.stock, products.price 
            FROM products 
            INNER JOIN categories ON products.category_id = categories.id
        ");
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        return $data;
    }

    public static function find($id)
    {
        $conn = new Database();
        $result = $conn->query("SELECT * FROM products WHERE id = $id");
        return $result->fetch_assoc();
    }

    public function create($data)
    {
        $name = $data["name"];
        $category_id = $data["category"];
        $stock = $data["stock"];
        $price = $data["price"];

        $conn = new Database();
        return $conn->query("INSERT INTO products VALUES (NULL, $category_id, '$name', $stock, $price)");
    }

    public function update($id, $data)
    {
        $name = $data["name"];
        $category_id = $data["category"];
        $price = $data["price"];

        $conn = new Database();
        return $conn->query("UPDATE products SET name = '$name', category_id = $category_id, price = $price WHERE id = $id");
    }

    public function updateStock($id, $data)
    {
        $stock = $data["stock"];

        $conn = new Database();
        return $conn->query("UPDATE products SET stock = $stock WHERE id = $id");
    }

    public function delete($id)
    {
        $conn = new Database();
        return $conn->query("DELETE FROM products WHERE id = $id");
    }
}
