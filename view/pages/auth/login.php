<?php require_once "../../partials/header-auth.php" ?>

<div class="login-content">
    <div class="login-card shadow shadow-md">
        <h1 class="h2 text-gray-900 mb-4">LOGIN POS</h1>

        <form action="<?= routing_asset() ?>" method="POST">
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
                <button name="login" class="btn btn-primary btn-user btn-block py-2">
                    Login
                </button>
            </div>
        </form>
    </div>
</div>

<?php require_once "../../partials/footer-auth.php" ?>