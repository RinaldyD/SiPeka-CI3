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
                    
                    <?php  if ($role == "HRD"){ ?>
                        <button type="button" class="btn btn-primary mb-4" aria-pressed="false" autocomplete="off" data-toggle="modal" data-target="#kriteriaModal">TAMBAH DATA</button>
                    <?php } ?>
                    <!-- Page Heading -->
                    <div class="row col-lg-12 table-responsive-sm">
                    <table class="table table-hover table-bordered ">
                        <thead>
                            <tr class="bg-primary text-light text-center">
                                <th scope="col" >No</th>
                                <th scope="col" class="col-lg-4">Nama Karyawan</th>
                                <th scope="col">NIP</th>
                                <th scope="col">Jabatan</th>
                                <th scope="col">Team</th>
                                <?php  if ($role == "HRD"){ ?>
                                <th colspan="2" scope="col">Action</th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($karyawan as $k) { ?>           
                            <tr class="font-weight-bold text-grey text-center">
                                <th class="text-center py-3" scope="row"><?php echo $no++; ?></th> 
                                <td class="py-3"><?php echo $k->nama_karyawan; ?></td>
                                <td class="py-3"><?php echo $k->nip; ?></td>
                                <td class="py-3"><?php echo $k->jabatan_karyawan; ?></td>
                                <td class="py-3"><?php echo $k->nama_divisi; ?></td>
                                <?php  if ($role == "HRD"){ ?>
                                <td><button type="button" class="btn btn-primary px-4 py-1" data-toggle="modal" data-target="#editkriteriaModal<?= $k->id;?>">EDIT</button></td>    
                                <td><a href="<?php echo base_url("user/hapuskaryawan/" . $k->nip); ?>"><button type="button" class="btn btn-danger py-1">DELETE</button></a></td>
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
      <form action="<?= base_url('user/karyawan')?>" method="POST">
      <div class="modal-body">
        <div class="form-group">
            <label for="namakaryawan">Nama Karyawan</label>
            <input class="form-control mb-2" type="text" placeholder="Nama Karyawan" id="namakaryawan" name="namakaryawan" value="<?= set_value('namakaryawan');?>">
            <?=form_error('namakaryawan', '<small class="text-danger px-2">', '</small>' );?>
        </div>
        <div class="form-group">
            <label for="nipkaryawan">Nomor Induk Pegawai</label>
            <input class="form-control mb-2" type="number" placeholder="Nomor Induk Pegawai" id="nipkaryawan" name="nipkaryawan" value="<?= set_value('nipkaryawan');?>" maxlength="8">
            <?=form_error('nipkaryawan', '<small class="text-danger px-2">', '</small>' );?>
        </div>
        <div class="form-group">
            <label for="jabatan_karyawan">Jabatan</label>
            <select class="form-control" id="jabatan_karyawan" name="jabatan_karyawan" value="<?= set_value('jabatan_karyawan');?>">
                <option value="Manager">Manager</option>
                <option value="Staff">Staff</option>
            </select>
            <?=form_error('jabatan', '<small class="text-danger px-2">', '</small>' );?>
        </div>
        <div class="form-group">
            <label for="id_divisi">Team</label>
            <select class="form-control" id="id_divisi" name="id_divisi" value="<?= set_value('id_divisi');?>">
                <?php foreach ($divisi as $d) { ?>
                <option value=<?php echo $d->id; echo set_select("karyawan", $d->id); ?>><?php echo $d->nama_divisi; ?></option>
                    <?= form_error("jumlah_bobot",'<small class="text-danger px-3">',"</small>") ?>
            <?php } ?>
            </select>
            <?=form_error('team', '<small class="text-danger px-2">', '</small>' );?>
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
    foreach($karyawan as $k){ 
?>  
<div class="modal fade" id="editkriteriaModal<?= $k->id;?>" tabindex="-1" role="dialog" aria-labelledby="editkriteriaModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editkriteriaModalLabel">EDIT DATA</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('user/ubahkaryawan/'. $k->id)?>" method="POST">
      <div class="modal-body">
        <div class="form-group">
            <input class="form-control mb-2" type="hidden" placeholder="ID Kriteria" id="idkriteria" value="<?= $k->id;?>">
            <label for="namakaryawan">Nama Karyawan</label>
            <input class="form-control mb-2" type="text" placeholder="Nama Karyawan" id="namakaryawan" name="namakaryawan" value="<?= $k->nama_karyawan;?>" required>
            <?=form_error('namakaryawan', '<small class="text-danger px-2">', '</small>' );?>
        </div>
        <div class="form-group">
            <label for="nipkaryawan">Nomor Induk Pegawai</label>
            <input class="form-control mb-2" type="number" placeholder="Nomor Induk Pegawai" id="nipkaryawan" name="nipkaryawan" value="<?= $k->nip;?>" disabled>
            <?=form_error('nipkaryawan', '<small class="text-danger px-2">', '</small>' );?>
        </div>
        <div class="form-group">
            <label for="jabatan_karyawan">Jabatan</label>
            <select class="form-control" id="jabatan_karyawan" name="jabatan_karyawan" value="<?= set_value('jabatan_karyawan');?>">
                <option <?php if ($k->jabatan_karyawan == 'Staff') {echo 'selected';}?> value="Staff">Staff</option>
                <option <?php if ($k->jabatan_karyawan == 'Manager') {echo 'selected';}?> value="Manager">Manager</option>
            </select>
            <?=form_error('jabatan', '<small class="text-danger px-2">', '</small>' );?>
        </div>
        <div class="form-group">
            <label for="id_divisi">Team</label>
            <select class="form-control" id="id_divisi" name="id_divisi" value="<?= set_value('id_divisi');?>">
                <?php foreach ($divisi as $d) { ?>
                <option value=<?php echo $d->id;?> <?php if ($k->id_divisi === $d->id) {echo 'selected';}?>><?php echo $d->nama_divisi; ?></option>
                    <?= form_error("jumlah_bobot",'<small class="text-danger px-3">',"</small>") ?>
            <?php } ?>
            </select>
            <?=form_error('team', '<small class="text-danger px-2">', '</small>' );?>
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

