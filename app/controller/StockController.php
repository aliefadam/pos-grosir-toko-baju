<?php
require '../vendor/autoload.php';
require_once "../app/helper.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

model_asset("Stock");
model_asset("Product");

class StockController
{
    public function store($request)
    {
        try {
            if ($request["qty"] <= 0) {
                throw new Exception("Qty harus lebih besar dari 0");
            }

            $productID = $request["product_id"];
            $searchedProduct = Product::find($productID);

            $product = new Product();
            if ($request["type"] == "Masuk") {
                $product->updateStock($productID, [
                    "stock" => $searchedProduct["stock"] + $request["qty"],
                ]);
            } else {
                if ($request["qty"] > $searchedProduct["stock"]) {
                    throw new Exception("Stok tidak mencukupi");
                }
                $product->updateStock($productID, [
                    "stock" => $searchedProduct["stock"] - $request["qty"],
                ]);
            }

            $stock = new Stock();
            $stock->create([
                "product_name" => $searchedProduct["name"],
                "type" => $request["type"],
                "qty" => $request["qty"],
                "description" => "Penyesuaian Stok Barang",
            ]);

            setNotification("Berhasil", "Stock berhasil diinputkan", "success");
        } catch (Exception $e) {
            setNotification("Gagal", $e->getMessage(), "error");
        }

        redirect("stock/index.php");
    }

    public function export()
    {
        try {
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setCellValue('A1', 'No');
            $sheet->setCellValue('B1', 'Nama Barang');
            $sheet->setCellValue('C1', 'Tipe');
            $sheet->setCellValue('D1', 'Jumlah');
            $sheet->setCellValue('E1', 'Keterangan');
            $sheet->setCellValue('F1', 'Tanggal (Waktu)');

            $stocks = Stock::all();
            $number = 1;
            foreach ($stocks as $row) {
                $sheet->setCellValue('A' . ($number + 1), $number);
                $sheet->setCellValue('B' . ($number + 1), $row["product_name"]);
                $sheet->setCellValue('C' . ($number + 1), $row["type"]);
                $sheet->setCellValue('D' . ($number + 1), $row["qty"]);
                $sheet->setCellValue('E' . ($number + 1), $row["description"]);
                $sheet->setCellValue('F' . ($number + 1), $row["created_at"]);
                $number++;
            }

            $writer = new Xlsx($spreadsheet);
            header('Content-Disposition: attachment;filename="laporan-mutasi-stok.xlsx"');
            $writer->save('php://output');
        } catch (Exception $e) {
            setNotification("Gagal", $e->getMessage(), "error");
        }

        redirect("baju/index.php");
        exit;
    }
}
