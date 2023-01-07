<body id="page-top"> 
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php 
            include ('application/views/Templates/user_sidebar.php'); 
        ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $username; ?></span>
                                <img class="img-profile rounded-circle"
                                    src="<?= base_url('assets/img/');?>undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->
                
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    
                    <!-- Title -->
                    <h1 class="h2 mb-2 text-gray-800 font-st font-weight-bold"><?= $title ?></h1>
                    <!-- End of Title -->

                    <!-- Divider -->
                    <hr class="sidebar-divider mb-4">
                    <!-- End of Divider -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                    <?php if (validation_errors()){?>
                        <div class="alert alert-danger pb-0 text-center font-weight-bold" role="alert"> <?php echo validation_errors(); ?>
                    </div>
                    <?php } ?>
                        <?= $this->session->flashdata('message');?>
                        <!-- <a href="<?=base_url('user/hasil')?>">
                            <button type="button" class="btn btn-primary mb-4" aria-pressed="false" autocomplete="off">HITUNG DATA</button>
                        </a> -->
                    <!-- Page Heading -->
                    <!-- Tabel 1 -->
                    <h1 class="h4 mb-3 ml-2 text-gray-800 font-st font-weight-bold">DATA NILAI</h1>
                    <div class="row col-lg-12 table-responsive-sm">
                    <table class="table table-hover table-bordered ">
                        <thead>
                            <tr class="bg-primary text-light text-center">
                                <th scope="col">No</th>
                                 <?php
                            $no = 1;
                            foreach ($table1 as $item => $value) {
                                foreach ($value as $heading => $itemValue) {
                                    ?>
                                    <th class="text-center"><?php echo $heading ?></th>
                                    <?php
                                }
                                break;
                            }
                            ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                        foreach ($table1 as $item => $value) {
                            ?>
                            <tr class="font-weight-bold text-grey text-center">
                                <th class="text-center py-3" scope="row"><?php echo $no ?></td>
                                <?php
                                foreach ($value as $itemValue) {
                                    ?>
                                    <td class="py-3"><?php echo $itemValue ?></td>
                                    <?php
                                }
                                ?>
                            </tr>
                            <?php
                            $no++;
                        }
                        ?>
                        </tbody>
                        </table>
                    </div>  

                    
                    <!-- Tabel 2 -->
                    <h1 class="h4 mb-3 ml-2 text-gray-800 font-st font-weight-bold mt-5">DATA NORMALISASI</h1>
                    <div class="row col-lg-12 table-responsive-sm">
                    <table class="table table-hover table-bordered ">
                        <thead>
                            <tr class="bg-primary text-light text-center">
                                <th scope="col">No</th>
                                 <?php
                            $no = 1;
                            foreach ($table2 as $item => $value) {
                                foreach ($value as $heading => $itemValue) {
                                    ?>
                                    <th class="text-center"><?php echo $heading ?></th>
                                    <?php
                                }
                                break;
                            }
                            ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                        foreach ($table2 as $item => $value) {
                            ?>
                            <tr class="font-weight-bold text-grey text-center">
                                <th class="text-center py-3" scope="row"><?php echo $no ?></td>
                                <?php
                                foreach ($value as $itemValue) {
                                    ?>
                                    <td class="py-3"><?php echo $itemValue ?></td>
                                    <?php
                                }
                                ?>
                            </tr>
                            <?php
                            $no++;
                        }
                        ?>
                     </tbody>
                    </table>
                    </div>  


                    <!-- Tabel 3 -->
                    <h1 class="h4 mb-3 ml-2 text-gray-800 font-st font-weight-bold mt-5">DATA NORMALISASI x BOBOT</h1>
                    <div class="row col-lg-12 table-responsive-sm">
                    <table class="table table-hover table-bordered ">
                        <thead>
                            <tr class="bg-primary text-light text-center">
                                <th scope="col">No</th>
                                 <?php
                            $no = 1;
                            foreach ($table2 as $item => $value) {
                                foreach ($value as $heading => $itemValue) {
                                    ?>
                                    <th class="text-center"><?php echo $heading ?></th>
                                    <?php
                                }
                                break;
                            }
                            ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                        foreach ($table3 as $item => $value) {
                            ?>
                            <tr class="font-weight-bold text-grey text-center">
                                <th class="text-center py-3" scope="row"><?php echo $no ?></td>
                                <?php
                                foreach ($value as $itemValue) {
                                    ?>
                                    <td class="py-3"><?php echo $itemValue ?></td>
                                    <?php
                                }
                                ?>
                            </tr>
                            <?php
                            $no++;
                        }
                        ?>
                        </tbody>
                        </table>
                    </div>  
                    

                    
                    <!-- Tabel Final -->
                        <h1 class="h4 mb-3 ml-2 text-gray-800 font-st font-weight-bold mt-5">PERANKINGAN</h1>
                        <div class="row col-lg-12 table-responsive-sm">
                        <table class="table table-hover table-bordered ">
                            <thead>
                                <tr class="bg-primary text-light text-center">
                                    <th scope="col">No</th>
                                     <?php
                            $no = 1;
                            foreach ($tableFinal as $item => $value) {
                                foreach ($value as $heading => $itemValue) {
                                    ?>
                                    <th class="text-center"><?php echo $heading ?></th>
                                    <?php
                                }
                                break;
                            }
                            ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                            foreach ($tableFinal as $item => $value) {
                                ?>
                                <tr class="font-weight-bold text-grey text-center">
                                    <th class="text-center py-3" scope="row"><?php echo $no ?></td>
                                    <?php
                                    foreach ($value as $itemValue) {
                                        ?>
                                        <td class="py-3"><?php echo $itemValue ?></td>
                                        <?php
                                    }
                                    ?>
                                </tr>
                                <?php
                                $no++;
                            }
                            ?>
                            </tbody>
                            </table>
                    </div>




                </div>
            </div>
            <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Kelompok 3 PPSI Mercu Buana</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="<?php echo base_url("auth/logout")?>">Logout</a>
                </div>
            </div>
        </div>
    </div>