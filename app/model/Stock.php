<?php
$url = $_SERVER["REQUEST_URI"];

if (strpos($url, "/view/pages/") === 0) {
    require_once "../../../config/database.php";
} else {
    require_once "../config/database.php";
}

class Stock
{
    public static function all()
    {
        $conn = new Database();
        return $conn->query("SELECT * FROM stocks ORDER BY created_at DESC");
    }

    public function create($data)
    {
        date_default_timezone_set("Asia/Jakarta");
        $product_name = $data["product_name"];
        $type = $data["type"];
        $qty = $data["qty"];
        $description = $data["description"];
        $created_at = date("Y-m-d H:i:s");

        $conn = new Database();
        return $conn->query("INSERT INTO stocks (product_name, type, qty, description, created_at) VALUES ('$product_name', '$type', $qty, '$description', '$created_at')");
    }
}
