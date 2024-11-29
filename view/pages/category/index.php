<?php require_once "../../partials/header.php" ?>
<?php model_asset("Category", "view") ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->

    <div class="d-flex justify-content-between">
        <h1 class="h3 mb-2 text-gray-800">Data Kategori</h1>
        <div class="">
            <button href="#" class="btn btn-primary px-3 py-2" data-toggle="modal" data-target="#tambahCategoryModal">
                <i class="fas fa-plus"></i> Tambah
            </button>
            <a href="<?= routing_asset("export-category") ?>" class="btn btn-success px-3 py-2">
                <i class="fas fa-download"></i> Export
            </a>
        </div>
    </div>

    <!-- DataTales Example -->
    <?php $categories = Category::all(); ?>
    <div class="card shadow mb-4 mt-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($categories as $number => $category): ?>
                            <tr>
                                <td><?= $number + 1 ?></td>
                                <td><?= $category["name"] ?></td>
                                <td>
                                    <button type="button" data-toggle="modal" data-target="#editCategoryModal-<?= $number + 1 ?>" class="btn btn-warning btn-sm">Edit</button>
                                    <a onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')" href="<?= routing_asset("delete-category", $category["id"]) ?>" class="btn btn-danger btn-sm">Hapus</a>
                                </td>
                            </tr>

                            <!-- Edit Baju Modal -->
                            <div class="modal fade" id="editCategoryModal-<?= $number + 1 ?>" tabindex="-1" aria-labelledby="editCategoryModal-<?= $number + 1 ?>Label" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editCategoryModal-<?= $number + 1 ?>Label">Tambah Baju</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="<?= routing_asset() ?>" method="POST">
                                            <input type="hidden" name="id" value="<?= $category["id"] ?>">

                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="name">Nama Baju</label>
                                                    <input value="<?= $category["name"] ?>" type="text" class="form-control" id="name" name="name" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                <button type="submit" name="update-category" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="tambahCategoryModal" tabindex="-1" aria-labelledby="tambahCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahCategoryModalLabel">Tambah Kategori</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= routing_asset() ?>" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Nama Kategori</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" name="create-category" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<?php require_once "../../partials/footer.php" ?>