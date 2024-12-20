<?php require_once "../../partials/header-auth.php" ?>

<div class="login-content">
    <div class="login-card shadow shadow-md">
        <h1 class="h2 text-gray-900 mb-4">
            <i class="fa-solid fa-cash-register mr-2"></i> REGISTER POS
        </h1>

        <form action="<?= routing_asset() ?>" method="POST">
            <div class="form-group">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control form-control-user py-4"
                    id="nama"
                    name="nama"
                    placeholder="John Doe" required>
            </div>
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control form-control-user py-4"
                    id="email"
                    name="email"
                    placeholder="email@example.com" required>
            </div>
            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control form-control-user py-4"
                    id="password"
                    name="password"
                    placeholder="*********"
                    required>
            </div>
            <div class="mt-4">
                <button name="register" class="btn btn-primary btn-user btn-block py-2">
                    Daftar
                </button>
            </div>
            <div class="mt-4">
                <a href="login.php" class="text-black text-center d-block">Sudah punya akun?</a>
            </div>
        </form>
    </div>
</div>

<?php require_once "../../partials/footer-auth.php" ?>