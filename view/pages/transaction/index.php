<?php require_once "../../partials/header.php" ?>
<?php model_asset("Stock", "view") ?>
<?php model_asset("Product", "view") ?>
<?php model_asset("Transaction", "view") ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-flex justify-content-between">
        <h1 class="h3 mb-2 text-gray-800">Data Transaksi Penjualan</h1>
        <div class="">
            <button href="#" class="btn btn-primary px-3 py-2" data-toggle="modal" data-target="#inputPenjualanModal">
                <i class="fas fa-plus"></i> Input Penjualan
            </button>
            <a href="<?= routing_asset("export-transaction") ?>" class="btn btn-success px-3 py-2">
                <i class="fas fa-download"></i> Export
            </a>
        </div>
    </div>

    <!-- DataTales Example -->
    <?php $transactions = Transaction::all(); ?>
    <div class="card shadow mb-4 mt-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pembeli</th>
                            <th>Barang Dibeli</th>
                            <th>Harga Barang</th>
                            <th>Jumlah</th>
                            <th>Total</th>
                            <th>Tanggal (Waktu)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($transactions as $number => $transaction): ?>
                            <tr>
                                <td><?= $number + 1 ?></td>
                                <td><?= $transaction["buyer"] ?></td>
                                <td><?= $transaction["product_name"] ?></td>
                                <td><?= formatMoney($transaction["product_price"]) ?></td>
                                <td><?= $transaction["qty"] ?></td>
                                <td><?= formatMoney($transaction["total"]) ?></td>
                                <td><?= $transaction["created_at"] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Tambah Baju Modal -->
    <div class="modal fade" id="inputPenjualanModal" tabindex="-1" aria-labelledby="inputPenjualanModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="inputPenjualanModalLabel">Input Penjualan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= routing_asset() ?>" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="buyer">Nama Pembeli</label>
                            <input type="text" class="form-control" id="buyer" name="buyer" required>
                        </div>

                        <?php $products = Product::all(); ?>
                        <div class="form-group">
                            <label for="product_id">Barang Dibeli</label>
                            <select class="form-control" id="product_id" name="product_id" required>
                                <option value="">-- Pilih Barang --</option>
                                <?php foreach ($products as $product): ?>
                                    <option value="<?= $product["id"] ?>"><?= $product["product_name"] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="qty">Jumlah</label>
                            <input type="number" class="form-control" id="qty" name="qty" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" name="create-transaction" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<?php require_once "../../partials/footer.php" ?>