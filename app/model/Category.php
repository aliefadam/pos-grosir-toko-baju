<?php

$url = $_SERVER["REQUEST_URI"];

if (strpos($url, "/view/pages/") === 0) {
    require_once "../../../config/database.php";
} else {
    require_once "../config/database.php";
}

class Category
{
    public static function all()
    {
        $conn = new Database();
        $data = [];

        $result = $conn->query("SELECT * FROM categories");
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        return $data;
    }

    public static function create($data)
    {
        $name = $data["name"];

        $conn = new Database();
        return $conn->query("INSERT INTO categories VALUES (NULL, '$name')");
    }

    public static function update($id, $data)
    {
        $name = $data["name"];

        $conn = new Database();
        return $conn->query("UPDATE categories SET name = '$name' WHERE id = '$id'");
    }

    public function delete($id)
    {
        $conn = new Database();
        return $conn->query("DELETE FROM categories WHERE id = $id");
    }
}
