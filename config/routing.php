<?php

require_once "../app/helper.php";
controller_asset("AuthController");
controller_asset("ProductController");
controller_asset("CategoryController");
controller_asset("StockController");
controller_asset("TransactionController");

if (isset($_POST["login"])) {
    $auth = new AuthController();
    $auth->login($_POST);
}

if (isset($_POST["register"])) {
    $auth = new AuthController();
    $auth->register($_POST);
}

if (isset($_POST["create-product"])) {
    $product = new ProductController();
    $product->store($_POST);
}

if (isset($_POST["update-product"])) {
    $product = new ProductController();
    $product->update($_POST);
}

if (isset($_GET["name"]) && $_GET["name"] == "delete-product") {
    $product = new ProductController();
    $product->destroy($_GET["id"]);
}

if (isset($_GET["name"]) && $_GET["name"] == "export-product") {
    $product = new ProductController();
    $product->export();
}

if (isset($_POST["create-category"])) {
    $product = new CategoryController();
    $product->store($_POST);
}

if (isset($_POST["update-category"])) {
    $product = new CategoryController();
    $product->update($_POST);
}

if (isset($_GET["name"]) && $_GET["name"] == "delete-category") {
    $product = new CategoryController();
    $product->destroy($_GET["id"]);
}

if (isset($_GET["name"]) && $_GET["name"] == "export-category") {
    $categories = new CategoryController();
    $categories->export();
}

if (isset($_POST["create-stock"])) {
    $stock = new StockController();
    $stock->store($_POST);
}

if (isset($_GET["name"]) && $_GET["name"] == "export-stock") {
    $stock = new StockController();
    $stock->export();
}

if (isset($_POST["create-transaction"])) {
    $transaction = new TransactionController();
    $transaction->store($_POST);
}

if (isset($_GET["name"]) && $_GET["name"] == "export-transaction") {
    $transaction = new TransactionController();
    $transaction->export();
}

if (isset($_POST["change-password"])) {
    $auth = new AuthController();
    $auth->changePassword($_POST);
}

if (isset($_GET["name"]) && $_GET["name"] == "logout") {
    $auth = new AuthController();
    $auth->logout();
}
