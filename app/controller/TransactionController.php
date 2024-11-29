<?php
require '../vendor/autoload.php';
require_once "../app/helper.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

model_asset("Product");
model_asset("Transaction");
model_asset("Stock");

class TransactionController
{
    public function store($request)
    {
        try {
            $productID = $request["product_id"];
            $searchedProduct = Product::find($productID);

            if ($request["qty"] > $searchedProduct["stock"]) {
                throw new Exception("Stok tidak mencukupi");
            }

            $transaction = new Transaction();
            $transaction->create([
                "buyer" => $request["buyer"],
                "product_name" => $searchedProduct["name"],
                "product_price" => $searchedProduct["price"],
                "qty" => $request["qty"],
                "total" => $searchedProduct["price"] * $request["qty"],
            ]);

            $product = new Product();
            $product->updateStock($productID, [
                "stock" => $searchedProduct["stock"] - $request["qty"],
            ]);

            $stock = new Stock();
            $stock->create([
                "product_name" => $searchedProduct["name"],
                "type" => "Keluar",
                "qty" => $request["qty"],
                "description" => "Transaksi Penjualan",
            ]);

            setNotification("Berhasil", "Transaksi berhasil ditambahkan", "success");
        } catch (Exception $e) {
            setNotification("Gagal", $e->getMessage(), "error");
        }

        redirect("transaction/index.php");
    }

    public function export()
    {
        try {
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setCellValue('A1', 'No');
            $sheet->setCellValue('B1', 'Nama Pembeli');
            $sheet->setCellValue('C1', 'Barang Dibeli');
            $sheet->setCellValue('D1', 'Harga Barang');
            $sheet->setCellValue('E1', 'Jumlah');
            $sheet->setCellValue('F1', 'Total');
            $sheet->setCellValue('G1', 'Tanggal (Waktu)');

            $transactions = Transaction::all();
            $number = 1;
            foreach ($transactions as $row) {
                $sheet->setCellValue('A' . ($number + 1), $number);
                $sheet->setCellValue('B' . ($number + 1), $row["buyer"]);
                $sheet->setCellValue('C' . ($number + 1), $row["product_name"]);
                $sheet->setCellValue('D' . ($number + 1), $row["product_price"]);
                $sheet->setCellValue('E' . ($number + 1), $row["qty"]);
                $sheet->setCellValue('F' . ($number + 1), formatMoney($row["total"]));
                $sheet->setCellValue('G' . ($number + 1), $row["created_at"]);
                $number++;
            }

            $writer = new Xlsx($spreadsheet);
            header('Content-Disposition: attachment;filename="laporan-penjualan.xlsx"');
            $writer->save('php://output');
        } catch (Exception $e) {
            setNotification("Gagal", $e->getMessage(), "error");
        }

        redirect("baju/index.php");
        exit;
    }
}
