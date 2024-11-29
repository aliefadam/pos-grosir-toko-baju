<?php require_once "../../partials/header.php" ?>
<?php model_asset("Stock", "view") ?>
<?php model_asset("Product", "view") ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-flex justify-content-between">
        <h1 class="h3 mb-2 text-gray-800">Data Mutasi Stok</h1>
        <div class="">
            <button href="#" class="btn btn-primary px-3 py-2" data-toggle="modal" data-target="#tambahStockModal">
                <i class="fas fa-plus"></i> Input Mutasi
            </button>
            <a href="<?= routing_asset("export-stock") ?>" class="btn btn-success px-3 py-2">
                <i class="fas fa-download"></i> Export
            </a>
        </div>
    </div>

    <!-- DataTales Example -->
    <?php $stocks = Stock::all(); ?>
    <div class="card shadow mb-4 mt-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Tipe (Masuk/Keluar)</th>
                            <th>Jumlah</th>
                            <th>Keterangan</th>
                            <th>Tanggal (Waktu)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($stocks as $number => $stock): ?>
                            <tr>
                                <td><?= $number + 1 ?></td>
                                <td><?= $stock["product_name"] ?></td>
                                <td class="<?= $stock["type"] == "Masuk" ? "text-success" : "text-danger" ?>"><?= $stock["type"] ?></td>
                                <td><?= $stock["qty"] ?></td>
                                <td><?= $stock["description"] ?></td>
                                <td><?= $stock["created_at"] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Tambah Baju Modal -->
    <div class="modal fade" id="tambahStockModal" tabindex="-1" aria-labelledby="tambahStockModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahStockModalLabel">Input Mutasi Stok</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= routing_asset() ?>" method="POST">
                    <div class="modal-body">
                        <?php $products = Product::all(); ?>
                        <div class="form-group">
                            <label for="product_id">Barang</label>
                            <select class="form-control" id="product_id" name="product_id" required>
                                <option value="">-- Pilih Barang --</option>
                                <?php foreach ($products as $product): ?>
                                    <option value="<?= $product["id"] ?>"><?= $product["product_name"] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="type">Tipe</label>
                            <select class="form-control" id="type" name="type" required>
                                <option value="">-- Pilih Tipe --</option>
                                <option value="Masuk">Masuk</option>
                                <option value="Keluar">Keluar</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="qty">Jumlah</label>
                            <input type="number" class="form-control" id="qty" name="qty" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" name="create-stock" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<?php require_once "../../partials/footer.php" ?>