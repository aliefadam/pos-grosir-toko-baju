<?php require_once "../../partials/header.php" ?>
<?php model_asset("Product", "view") ?>
<?php model_asset("Category", "view") ?>
<?php model_asset("Transaction", "view") ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Data Barang
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= count(Product::all()) ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fa-solid fa-shirt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Data Kategori
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= count(Category::all()) ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fa-solid fa-tag fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Data Penjualan
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= count(Transaction::all()) ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fa-solid fa-money-simple-from-bracket fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Pendapatan Penjualan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= Transaction::total() ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->

    <div class="row">
        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Data Penjualan Dalam Satu Tahun</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myAreaChart"
                            data-januari="<?= Transaction::totalPerMonthInYear(date("Y"))[1] ?>"
                            data-februari="<?= Transaction::totalPerMonthInYear(date("Y"))[2] ?>"
                            data-maret="<?= Transaction::totalPerMonthInYear(date("Y"))[3] ?>"
                            data-april="<?= Transaction::totalPerMonthInYear(date("Y"))[4] ?>"
                            data-mei="<?= Transaction::totalPerMonthInYear(date("Y"))[5] ?>"
                            data-juni="<?= Transaction::totalPerMonthInYear(date("Y"))[6] ?>"
                            data-juli="<?= Transaction::totalPerMonthInYear(date("Y"))[7] ?>"
                            data-agustus="<?= Transaction::totalPerMonthInYear(date("Y"))[8] ?>"
                            data-september="<?= Transaction::totalPerMonthInYear(date("Y"))[9] ?>"
                            data-oktober="<?= Transaction::totalPerMonthInYear(date("Y"))[10] ?>"
                            data-november="<?= Transaction::totalPerMonthInYear(date("Y"))[11] ?>"
                            data-desember="<?= Transaction::totalPerMonthInYear(date("Y"))[12] ?>">
                        </canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Penjualan Berdasarkan Waktu</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="myPieChart"
                            data-pagi="<?= Transaction::totalPerTimeInOneDay(date("Y-m-d"))["pagi"] ?>"
                            data-siang="<?= Transaction::totalPerTimeInOneDay(date("Y-m-d"))["siang"] ?>" data-malam="<?= Transaction::totalPerTimeInOneDay(date("Y-m-d"))["malam"] ?>">
                        </canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        <span class="mr-2">
                            <i class="fas fa-circle text-success"></i> Pagi Hari
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-warning"></i> Siang Hari
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-dark"></i> Malam Hari
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<?php require_once "../../partials/footer.php" ?>