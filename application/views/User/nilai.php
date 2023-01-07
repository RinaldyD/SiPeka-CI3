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
                    <h1 class="h2 mb-2 text-gray-800 font-st font-weight-bold"><?= $title;?></h1>
                    <!-- End of Title -->
                    <div class="alert text-danger alert-warning font-weight-bold text-center col-7 mx-auto mt-3" role="alert">
                        SEMUA KARYAWAN HARUS MEMILIKI NILAI DARI MASING MASING KRITERIA!!
                    </div>


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
                    <?php  if ($role == "manager"){ ?>
                        <button type="button" class="btn btn-primary mb-4" aria-pressed="false" autocomplete="off" data-toggle="modal" data-target="#kriteriaModal">TAMBAH DATA</button>
                    <?php } ?>

                    <!-- Page Heading -->
                    <div class="row col-lg-12 table-responsive-sm">
                    <table class="table table-hover table-bordered ">
                        <thead>
                            <tr class="bg-primary text-light text-center">
                                <th scope="col" >No</th>
                                <th scope="col" class="col-lg-4">Nama Karyawan</th>
                                <th scope="col">Kriteria</th>
                                <th scope="col">Nilai</th>
                                <?php  if ($role == "manager"){ ?>
                                <th colspan="2" scope="col" class="col-lg-3">Action</th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($nilai as $n) { ?>           
                            <tr class="font-weight-bold text-grey text-center">
                                <th class="text-center py-3" scope="row"><?php echo $no++; ?></th> 
                                <td class="py-3"><?php echo $n->nama_karyawan; ?></td>
                                <td class="py-3"><?php echo $n->nama_kriteria; ?></td>
                                <td class="py-3"><?php echo $n->nilai; ?></td>
                                <?php  if ($role == "manager"){ ?>
                                <td><button type="button" class="btn btn-primary px-4 py-1" data-toggle="modal" data-target="#editkriteriaModal<?= $n->id;?>">EDIT</button></td>    
                                <td><a href="<?php echo base_url("user/hapusnilai/" . $n->id); ?>"><button type="button" class="btn btn-danger py-1">DELETE</button></a></td>
                                <?php } ?>
                            </tr>
                            <?php }
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

<!-- Add Modal -->
<div class="modal fade" id="kriteriaModal" tabindex="-1" role="dialog" aria-labelledby="kriteriaModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="kriteriaModalLabel">TAMBAH DATA</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url("user/nilai") ?>" method="POST">
      <div class="modal-body">
        <div class="form-group">
            <label for="nip">Nama Karyawan</label>
            <select class="form-control mb-2" id="nip" name="nip" value="<?= set_value("nip") ?>" name="nip">
            <?php foreach ($karyawan as $k) { ?>
                <option value=<?php echo $k->nip; echo set_select("nip", $k->id); ?>><?php echo $k->nama_karyawan; ?></option>
            <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="namakriteria">Kriteria</label>
            <select class="form-control mb-2" id="namakriteria" name="namakriteria" value="<?= set_value("namakriteria") ?>">
            <?php foreach ($kriteria as $k) { ?>
                <option value=<?php echo $k->id; echo set_select("namakriteria", $k->id); ?>><?php echo $k->nama_kriteria; ?></option>
            <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="nilaikaryawan">Nilai</label>
            <input class="form-control mb-2" type="number" placeholder="Nilai Karyawan" id="nilaikaryawan" name="nilaikaryawan" min="1" max="100">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">BATAL</button>
        <button type="submit" class="btn btn-primary">TAMBAH DATA</button>
      </div>
  </form>
    </div>
  </div>
</div>

<!-- Edit Modal -->
<?php
    foreach($nilai as $n){ 
?>  
<div class="modal fade" id="editkriteriaModal<?= $n->id;?>" tabindex="-1" role="dialog" aria-labelledby="editkriteriaModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editkriteriaModalLabel">EDIT DATA</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('user/ubahnilai/'. $n->id)?>" method="POST">
      <div class="modal-body">
        <div class="form-group">
            <label for="nip">Nama Karyawan</label>
            <select class="form-control mb-2" id="nip" name="nip" value="<?= set_value("nip") ?>" name="nip" disabled>
            <?php foreach ($karyawan as $k) { ?>
                <option value=<?php echo $k->nip;?> <?php if ($k->nip === $n->nip) {echo 'selected';}?>><?php echo $k->nama_karyawan; ?></option>
            <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="namakriteria">Kriteria</label>
            <select class="form-control mb-2" id="namakriteria" name="namakriteria" value="<?= set_value("namakriteria") ?>" disabled>
            <?php foreach ($kriteria as $kr) { ?>
                <option value=<?php echo $kr->id;?> <?php if ($kr->id === $n->id_kriteria) {echo 'selected';}?>><?php echo $kr->nama_kriteria; ?></option>
            <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="nilaikaryawan">Nilai</label>
            <input class="form-control mb-2" type="number" placeholder="Nilai Karyawan" id="nilaikaryawan" name="nilaikaryawan" min="1" max="100"  value="<?php echo $n->nilai;?>">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">BATAL</button>
        <button type="submit" class="btn btn-primary">EDIT DATA</button>
      </div>
  </form>
    </div>
  </div>
</div>
<?php } ?>

