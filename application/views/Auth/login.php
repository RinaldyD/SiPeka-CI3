
<body class="bg-gradient-primary">
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-lg-5 mt-5">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4"><strong>WELCOME BACK!</strong></h1>
                                    </div>
                                    <?= $this->session->flashdata('message');?>
                                      <form method="post" action="<?=base_url("auth");?>" class="user">
                                        <div class="form-group">
                                            <input type="username" class="form-control form-control-user"
                                                id="username" name="username"
                                                placeholder="Enter Username..." value="<?= set_value('username');?>">
                                                <?=form_error('username','<small class="text-danger px-3">', '</small>' );?>
                                        </div>
                                        <div class="form-group mt-3 ">
                                            <input type="password" class="form-control form-control-user"
                                                id="password" name="password"  placeholder="Password">
                                                <?=form_error('password','<small class="text-danger px-3">', '</small>' );?>
                                        </div>
                                            <button type="submit" class="btn btn-primary btn-user btn-block mt-4">
                                            Login
                                        </button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="<?=base_url('auth\registration');?>">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>