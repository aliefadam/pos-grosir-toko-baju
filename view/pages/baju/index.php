<?php require_once "../../partials/header.php" ?>
<?php model_asset("Product", "view") ?>
<?php model_asset("Category", "view") ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->

    <div class="d-flex justify-content-between">
        <h1 class="h3 mb-2 text-gray-800">Data Baju</h1>
        <div class="">
            <button href="#" class="btn btn-primary px-3 py-2" data-toggle="modal" data-target="#tambahBajuModal">
                <i class="fas fa-plus"></i> Tambah
            </button>
            <a href="<?= routing_asset("export-product") ?>" class="btn btn-success px-3 py-2">
                <i class="fas fa-download"></i> Export
            </a>
        </div>
    </div>

    <!-- DataTales Example -->
    <?php $products = Product::all(); ?>
    <div class="card shadow mb-4 mt-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Baju</th>
                            <th>Kategori</th>
                            <th>Stok</th>
                            <th>Harga</th>
                            <th>Foto</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $number => $product): ?>
                            <tr>
                                <td><?= $number + 1 ?></td>
                                <td><?= $product["product_name"] ?></td>
                                <td><?= $product["category_name"] ?></td>
                                <td><?= $product["stock"] ?></td>
                                <td><?= formatMoney($product["price"]) ?></td>
                                <td>
                                    <img style="width: 100px; height: 100px; object-fit: cover" src="../../../upload/<?= $product["image"] ?>" alt="">
                                </td>
                                <td>
                                    <button data-toggle="modal" data-target="#editBajuModal-<?= $number + 1 ?>" type="button" class="btn-edit btn btn-warning btn-sm">Edit</button>
                                    <a onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')" href="<?= routing_asset("delete-product", $product["id"]) ?>" class="btn btn-danger btn-sm">Hapus</a>
                                </td>
                            </tr>

                            <!-- Edit Baju Modal -->
                            <div class="modal fade" id="editBajuModal-<?= $number + 1 ?>" tabindex="-1" aria-labelledby="editBajuModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editBajuModalLabel">Tambah Baju</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="<?= routing_asset() ?>" method="POST" enctype="multipart/form-data">
                                            <input type="hidden" name="id" value="<?= $product["id"] ?>">

                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="name">Nama Baju</label>
                                                    <input value="<?= $product["product_name"] ?>" type="text" class="form-control" id="name" name="name" required>
                                                </div>

                                                <?php $categories = Category::all(); ?>
                                                <div class="form-group">
                                                    <label for="category">Kategori</label>
                                                    <select class="form-control" id="category" name="category" required>
                                                        <option value="">-- Pilih Kategori --</option>
                                                        <?php foreach ($categories as $category): ?>
                                                            <option <?= $product["category_id"] == $category["id"] ? "selected" : "" ?> value="<?= $category["id"] ?>"><?= $category["name"] ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="price">Harga</label>
                                                    <input value="<?= $product["price"] ?>" type="number" class="form-control" id="price" name="price" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="foto">Foto</label>
                                                    <div class="mb-3">
                                                        <img style="width: 100px; height: 100px; object-fit: cover" src="../../../upload/<?= $product["image"] ?>" alt="">
                                                    </div>
                                                    <input type="file" class="form-control-file" id="foto" name="foto">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                <button type="submit" name="update-product" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Tambah Baju Modal -->
    <div class="modal fade" id="tambahBajuModal" tabindex="-1" aria-labelledby="tambahBajuModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahBajuModalLabel">Tambah Baju</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= routing_asset() ?>" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Nama Baju</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>

                        <?php $categories = Category::all(); ?>
                        <div class="form-group">
                            <label for="category">Kategori</label>
                            <select class="form-control" id="category" name="category" required>
                                <option value="">-- Pilih Kategori --</option>
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?= $category["id"] ?>"><?= $category["name"] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="stock">Stok</label>
                            <input type="number" class="form-control" id="stock" name="stock" required>
                        </div>

                        <div class="form-group">
                            <label for="price">Harga</label>
                            <input type="number" class="form-control" id="price" name="price" required>
                        </div>

                        <div class="form-group">
                            <label for="foto">Foto</label>
                            <input type="file" class="form-control-file" id="foto" name="foto">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" name="create-product" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<?php require_once "../../partials/footer.php" ?>