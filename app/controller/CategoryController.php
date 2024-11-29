<?php
require '../vendor/autoload.php';
require_once "../app/helper.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

model_asset("Category");

class CategoryController
{
    public function store($request)
    {
        try {
            $category = new Category();
            $category->create([
                "name" => $request["name"],
            ]);
            setNotification("Berhasil", "Kategori berhasil ditambahkan", "success");
        } catch (Exception $e) {
            setNotification("Gagal", $e->getMessage(), "error");
        }

        redirect("category/index.php");
        exit;
    }

    public function update($request)
    {
        try {
            $category = new Category();
            $category->update($request["id"], [
                "name" => $request["name"],
            ]);
            setNotification("Berhasil", "Kategori berhasil diubah", "success");
        } catch (Exception $e) {
            setNotification("Gagal", $e->getMessage(), "error");
        }

        redirect("category/index.php");
        exit;
    }

    public function export()
    {
        try {
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setCellValue('A1', 'No');
            $sheet->setCellValue('B1', 'Nama Kategori');

            $category = Category::all();
            $number = 1;
            foreach ($category as $row) {
                $sheet->setCellValue('A' . $number + 1, $number);
                $sheet->setCellValue('B' . $number + 1, $row["name"]);
                $number++;
            }

            $writer = new Xlsx($spreadsheet);
            header('Content-Disposition: attachment;filename="laporan-kategori.xlsx"');
            $writer->save('php://output');
        } catch (Exception $e) {
            setNotification("Gagal", $e->getMessage(), "error");
        }

        redirect("category/index.php");
        exit;
    }

    public function destroy($id)
    {
        try {
            $category = new Category();
            $category->delete($id);
            setNotification("Berhasil", "Kategori berhasil dihapus", "success");
        } catch (Exception $e) {
            setNotification("Gagal", $e->getMessage(), "error");
        }

        redirect("category/index.php");
        exit;
    }
}
