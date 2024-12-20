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
            SELECT products.id, products.name AS product_name, categories.id AS category_id, categories.name AS category_name, products.stock, products.price, products.image as image 
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
        $image = $data["image"];

        $conn = new Database();
        return $conn->query("INSERT INTO products VALUES (NULL, $category_id, '$name', $stock, $price, '$image')");
    }

    public function storeFile($file)
    {
        $date = date("Y_m_d_H_i_s");
        $extension = pathinfo($file["name"], PATHINFO_EXTENSION);
        $name = $date . "." . $extension;
        $uploadDir = "../upload/";
        move_uploaded_file($file["tmp_name"], $uploadDir . $name);
        return $name;
    }

    public function update($id, $data)
    {
        $name = $data["name"];
        $category_id = $data["category"];
        $price = $data["price"];

        $conn = new Database();
        return $conn->query("UPDATE products SET name = '$name', category_id = $category_id, price = $price WHERE id = $id");
    }


    public function updateWithImage($id, $data)
    {
        $name = $data["name"];
        $category_id = $data["category"];
        $price = $data["price"];
        $image = $data["image"];

        $conn = new Database();
        return $conn->query("UPDATE products SET name = '$name', category_id = $category_id, price = $price, image = '$image' WHERE id = $id");
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
