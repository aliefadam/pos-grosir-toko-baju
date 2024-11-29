 <!-- Sidebar -->
 <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

     <!-- Sidebar - Brand -->
     <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
         <i class="fa-solid fa-cash-register"></i>
         <div class="sidebar-brand-text mx-3">POS Admin</div>
     </a>


     <!-- Divider -->
     <hr class="sidebar-divider my-0">

     <!-- Nav Item - Dashboard -->
     <li class="nav-item <?= isActiveSideBar("dashboard") ?>">
         <a class="nav-link" href="<?= view_asset("dashboard/index.php") ?>">
             <i class="fas fa-fw fa-tachometer-alt"></i>
             <span>Dashboard</span>
         </a>
     </li>

     <!-- Divider -->
     <hr class="sidebar-divider">

     <!-- Heading -->
     <div class="sidebar-heading">
         Produk
     </div>

     <!-- Nav Item - Charts -->
     <li class="nav-item <?= isActiveSideBar("baju") ?>">
         <a class="nav-link" href="<?= view_asset("baju/index.php") ?>">
             <i class="fa-solid fa-shirt"></i>
             <span>Baju</span>
         </a>
     </li>

     <li class="nav-item <?= isActiveSideBar("category") ?>">
         <a class="nav-link" href="<?= view_asset("category/index.php") ?>">
             <i class="fa-solid fa-tag"></i>
             <span>Kategori</span>
         </a>
     </li>

     <!-- Divider -->
     <hr class="sidebar-divider">

     <!-- Heading -->
     <div class="sidebar-heading">
         Stok
     </div>

     <li class="nav-item <?= isActiveSideBar("stock") ?>">
         <a class="nav-link" href="<?= view_asset("stock/index.php") ?>">
             <i class="fa-solid fa-boxes-stacked"></i>
             <span>Stok Barang</span>
         </a>
     </li>

     <!-- Divider -->
     <hr class="sidebar-divider">

     <!-- Heading -->
     <div class="sidebar-heading">
         Transaksi
     </div>

     <li class="nav-item <?= isActiveSideBar("transaction") ?>">
         <a class="nav-link" href="<?= view_asset("transaction/index.php") ?>">
             <i class="fa-solid fa-money-simple-from-bracket"></i>
             <span>Penjualan</span></a>
     </li>

     <!-- Divider -->
     <hr class="sidebar-divider d-none d-md-block">

     <!-- Sidebar Toggler (Sidebar) -->
     <div class="text-center d-none d-md-inline">
         <button class="rounded-circle border-0" id="sidebarToggle"></button>
     </div>
 </ul>
 <!-- End of Sidebar -->