<?php

$url = $_SERVER["REQUEST_URI"];

if (strpos($url, "/view/pages/") === 0) {
    require_once "../../../config/database.php";
} else {
    require_once "../config/database.php";
}

class Transaction
{
    public static function all()
    {
        $conn = new Database();
        $data = [];

        $result = $conn->query("SELECT * FROM transactions ORDER BY created_at DESC");
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        return $data;
    }

    public function create($data)
    {
        date_default_timezone_set("Asia/Jakarta");
        $buyer = $data["buyer"];
        $product_name = $data["product_name"];
        $product_price = $data["product_price"];
        $qty = $data["qty"];
        $total = $data["total"];
        $created_at = date("Y-m-d H:i:s");

        $conn = new Database();
        $conn->query("INSERT INTO transactions (buyer, product_name, product_price, qty, total, created_at) VALUES ('$buyer', '$product_name', $product_price, $qty, $total, '$created_at')");
    }

    public static function total()
    {
        $conn = new Database();
        $result = $conn->query("SELECT SUM(total) AS total FROM transactions");
        $total = $result->fetch_assoc()["total"];
        return formatMoney($total);
    }

    public static function totalPerMonthInYear($year)
    {
        $conn = new Database();
        $monthlyTotals = [];

        for ($month = 1; $month <= 12; $month++) {
            $startDate = "$year-$month-01";
            $endDate = date("Y-m-t", strtotime($startDate));

            $result = $conn->query("
            SELECT SUM(total) AS total 
            FROM transactions 
            WHERE created_at BETWEEN '$startDate' AND '$endDate'
            ");

            $total = $result->fetch_assoc()["total"];
            $monthlyTotals[$month] = $total ? (float) $total : 0.0;
        }

        return $monthlyTotals;
    }


    public static function totalPerTimeInOneDay($date)
    {
        $conn = new Database();
        $timeTotals = [];

        $startDate = "$date 06:00:00";
        $endDate = "$date 12:00:00";

        $result = $conn->query("
        SELECT SUM(total) AS total 
        FROM transactions 
        WHERE created_at BETWEEN '$startDate' AND '$endDate'
        ");
        $total = $result->fetch_assoc()["total"];
        $timeTotals["pagi"] = $total ? (float) $total : 0.0;

        $startDate = "$date 12:00:00";
        $endDate = "$date 18:00:00";

        $result = $conn->query("
        SELECT SUM(total) AS total 
        FROM transactions 
        WHERE created_at BETWEEN '$startDate' AND '$endDate'
        ");
        $total = $result->fetch_assoc()["total"];
        $timeTotals["siang"] = $total ? (float) $total : 0.0;

        $startDate = "$date 18:00:00";
        $endDate = date("Y-m-d", strtotime("$date + 1 days")) . " 06:00:00";

        $result = $conn->query("
        SELECT SUM(total) AS total 
        FROM transactions 
        WHERE created_at BETWEEN '$startDate' AND '$endDate'
        ");
        $total = $result->fetch_assoc()["total"];
        $timeTotals["malam"] = $total ? (float) $total : 0.0;

        return $timeTotals;
    }
}
