<?php require_once "../../partials/header.php" ?>
<?php model_asset("Category", "view") ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->

    <div class="d-flex justify-content-between">
        <h1 class="h3 mb-2 text-gray-800">Ganti Password</h1>
    </div>

    <div class="card shadow w-50 mb-4 mt-4">
        <div class="card-body">
            <form action="<?= routing_asset() ?>" method="POST">
                <div class="form-group">
                    <label for="old_password">Password Lama</label>
                    <input type="password" class="form-control" id="old_password" name="old_password" required>
                </div>
                <div class="form-group">
                    <label for="new_password">Password Baru</label>
                    <input type="password" class="form-control" id="new_password" name="new_password" required>
                </div>
                <div class="form-group">
                    <label for="confirm_password">Konfirmasi Password</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                </div>
                <button type="submit" name="change-password" class="btn btn-primary">Ganti Password</button>
            </form>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<?php require_once "../../partials/footer.php" ?>