<?php
require '../vendor/autoload.php';
require_once "../app/helper.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

model_asset("Product");

class ProductController
{
    public function store($request)
    {
        try {
            $product = new Product();
            $product->create([
                "name" => $request["name"],
                "category" => $request["category"],
                "stock" => $request["stock"],
                "price" => $request["price"],
            ]);
            setNotification("Berhasil", "Produk berhasil ditambahkan", "success");
        } catch (Exception $e) {
            setNotification("Gagal", $e->getMessage(), "error");
        }

        redirect("baju/index.php");
        exit;
    }

    public function update($request)
    {
        try {
            $product = new Product();
            $product->update($request["id"], [
                "name" => $request["name"],
                "category" => $request["category"],
                "price" => $request["price"],
            ]);
            setNotification("Berhasil", "Produk berhasil diubah", "success");
        } catch (Exception $e) {
            setNotification("Gagal", $e->getMessage(), "error");
        }

        redirect("baju/index.php");
        exit;
    }

    public function export()
    {
        try {
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setCellValue('A1', 'No');
            $sheet->setCellValue('B1', 'Nama Baju');
            $sheet->setCellValue('C1', 'Kategori');
            $sheet->setCellValue('D1', 'Stok');
            $sheet->setCellValue('E1', 'Harga');

            $product = Product::all();
            $number = 1;
            foreach ($product as $row) {
                $sheet->setCellValue('A' . $number + 1, $number);
                $sheet->setCellValue('B' . $number + 1, $row["product_name"]);
                $sheet->setCellValue('C' . $number + 1, $row["category_name"]);
                $sheet->setCellValue('D' . $number + 1, $row["stock"]);
                $sheet->setCellValue('E' . $number + 1, formatMoney($row["price"]));
                $number++;
            }

            $writer = new Xlsx($spreadsheet);
            header('Content-Disposition: attachment;filename="laporan-produk.xlsx"');
            $writer->save('php://output');
        } catch (Exception $e) {
            setNotification("Gagal", $e->getMessage(), "error");
        }

        redirect("baju/index.php");
        exit;
    }

    public function destroy($id)
    {
        try {
            $product = new Product();
            $product->delete($id);
            setNotification("Berhasil", "Produk berhasil dihapus", "success");
        } catch (Exception $e) {
            setNotification("Gagal", $e->getMessage(), "error");
        }

        redirect("baju/index.php");
        exit;
    }
}
