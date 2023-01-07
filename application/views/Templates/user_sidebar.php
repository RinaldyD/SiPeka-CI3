<!-- Sidebar -->
        
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <div class="sticky-top">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?=base_url('User')?>">
                <div class="sidebar-brand-icon rotate-n-15">
                  <i class="fa-sharp fa-solid fa-link"></i>
                </div>
                <div class="sidebar-brand-text mx-3" >Si Pe Ka</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="<?=base_url('User')?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <!-- <hr class="sidebar-divider"> -->

            <!-- Heading -->
            <!-- <div class="sidebar-heading">
                Lokasi
            </div> -->

            <!-- Nav Item - Pages Collapse Menu -->
            <!--<li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fa-regular fa-compass"></i>
                    <span>Lokasi</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Lokasi Components:</h6>
                        <a class="collapse-item" href="buttons.html">Kota Madya</a>
                        <a class="collapse-item" href="cards.html">Kecamatan</a>
                        <a class="collapse-item" href="cards.html">Kelurahan</a>
                    </div>
                </div>
            </li>-->

            <!-- Divider -->
            <hr class="sidebar-divider">

            <div class="sidebar-heading">
                Penilaian
            </div>

            <!-- Nav Item - Utilities Collapse Menu -->
               <li class="nav-item">
                <a class="nav-link" href="<?=base_url('User/kriteria')?>">
                    <i class="fa-solid fa-binoculars"></i>
                    <span>Kriteria</span></a>
            </li>

                           <li class="nav-item">
                <a class="nav-link" href="<?=base_url('User/bobot')?>">
                    <i class="fa-solid fa-scale-balanced"></i>
                    <span>Bobot</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?=base_url('User/karyawan')?>">
                    <i class="fa-solid fa-users"></i>
                    <span>Karyawan</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?=base_url('User/nilai')?>">
                    <i class="fa-solid fa-list-ol"></i>
                    <span>Nilai</span></a>
            </li>

            <!-- Nav Item - Pages Collapse Menu -->
            <!-- <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fa-solid fa-list-ol"></i>
                    <span>Nilai</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Lokasi Components:</h6>
                        <a class="collapse-item" href="buttons.html">Tambah Nilai</a>
                        <a class="collapse-item" href="cards.html">Edit Nilai</a>
                    </div>
                </div>
            </li> -->


            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Perhitungan
            </div>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="<?=base_url('Rangking')?>">
                    <i class="fa-solid fa-stopwatch-20"></i>
                    <span>Hitung</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">


            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center mt-5">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </div>
        </ul>
        <!-- End of Sidebar -->