<body class="bg-gradient-primary">
    
    <div class="container">
        
        <div class="card o-hidden border-0 shadow-lg mt-5 col-lg-6 mx-auto">
            <div class="card-body p-0 ">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4"><strong>CREATE AN ACCOUNT!</strong></h1>
                            </div>
                            <form method="post" action="<?=base_url("auth/registration");?>" class="user">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="username" name="username"
                                        placeholder="Username" value="<?= set_value('username');?>">
                                        <?=form_error('username', '<small class="text-danger px-3">', '</small>' );?>
                                </div>
                                <div class="form-group">
                                <select class="form-control" style="border-radius: 10rem;height: 3rem; font-size:.8rem;" 
                                id="divisi" name="divisi" value="<?= set_value('divisi');?>">
                                            <?php foreach($divisi as $d){ 
		                                ?>
                                            <option value=<?php echo $d->id; echo set_select('divisi', $d->id); ?>><?php echo $d->nama_divisi ?></option>
                                            <?=form_error('divisi', '<small class="text-danger px-3">', '</small>' );?>
                                        <?php } ?>
                                </select>
                                </div>
                                <div class="form-group">
                                <select class="form-control" style="border-radius: 10rem;height: 3rem; font-size:.8rem;" 
                                id="role" name="role" value="<?= set_value('role');?>">
                                            <option value="manager" <?php echo  set_select('role', 'manager');?>>Manager</option>
                                            <option value="HRD" <?php echo  set_select('role', 'HRD');?>>HRD</option>
                                            <?=form_error('divisi', '<small class="text-danger px-3">', '</small>' );?>
                                </select>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user"
                                            id="password1" name="password1" placeholder="Password">
                                            <?=form_error('password1','<small class="text-danger px-3">', '</small>' );?>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user"
                                            id="password2" name="password2" placeholder="Repeat Password">
                                            <?=form_error('password2','<small class="text-danger px-3">', '</small>' );?>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Register Account
                                </button>
                                <hr>
                            </form>
                            <div class="text-center">
                                <a class="small" href="forgot-password.html">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="<?=base_url('auth');?>">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
