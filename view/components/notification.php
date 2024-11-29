<?php if (isset($_SESSION["notification"])) : ?>
    <script>
        Swal.fire({
            title: "<?= $_SESSION["notification"]["title"] ?>",
            text: "<?= $_SESSION["notification"]["text"] ?>",
            icon: "<?= $_SESSION["notification"]["icon"] ?>"
        });
    </script>

    <?php unset($_SESSION["notification"]) ?>
<?php endif; ?>