<?php require_once __DIR__ . "/../../app/helper.php"; ?>

<?php
if (!isset($_SESSION["login"])) {
    redirect("auth/login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS - <?= getTitle() ?></title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Stlye -->
    <link rel="stylesheet" href="<?= asset("css/style.css") ?>">

    <!-- Custom fonts for this template-->
    <link href="<?= asset("vendor/fontawesome-free/css/all.min.css") ?>" rel="stylesheet" type="text/css">
    <link
        rel="stylesheet"
        href="https://site-assets.fontawesome.com/releases/v6.7.1/css/all.css">

    <link
        rel="stylesheet"
        href="https://site-assets.fontawesome.com/releases/v6.7.1/css/sharp-duotone-thin.css">

    <link
        rel="stylesheet"
        href="https://site-assets.fontawesome.com/releases/v6.7.1/css/sharp-duotone-solid.css">

    <link
        rel="stylesheet"
        href="https://site-assets.fontawesome.com/releases/v6.7.1/css/sharp-duotone-regular.css">
    <link
        rel="stylesheet"
        href="https://site-assets.fontawesome.com/releases/v6.7.1/css/sharp-duotone-light.css">
    <link
        rel="stylesheet"
        href="https://site-assets.fontawesome.com/releases/v6.7.1/css/sharp-thin.css">
    <link
        rel="stylesheet"
        href="https://site-assets.fontawesome.com/releases/v6.7.1/css/sharp-solid.css">
    <link
        rel="stylesheet"
        href="https://site-assets.fontawesome.com/releases/v6.7.1/css/sharp-regular.css">
    <link
        rel="stylesheet"
        href="https://site-assets.fontawesome.com/releases/v6.7.1/css/sharp-light.css">
    <link
        rel="stylesheet"
        href="https://site-assets.fontawesome.com/releases/v6.7.1/css/duotone-thin.css">
    <link
        rel="stylesheet"
        href="https://site-assets.fontawesome.com/releases/v6.7.1/css/duotone-regular.css">
    <link
        rel="stylesheet"
        href="https://site-assets.fontawesome.com/releases/v6.7.1/css/duotone-light.css">

    <!-- Custom styles for this template-->
    <link href="<?= asset("css/sb-admin-2.min.css") ?>" rel="stylesheet">

    <!-- Sweet Alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body id="page-top">

    <?php require_once  __DIR__ . "/../components/notification.php" ?>

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php require_once __DIR__ . "/../components/sidebar.php"; ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php require_once __DIR__ . "/../components/topbar.php" ?>