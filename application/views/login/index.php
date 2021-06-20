    
	<div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-6 col-lg-10 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5" style="margin-top: 10rem !important;">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-10 mx-auto">
								<?php if ($message = $this->session->flashdata('error')) { ?>

									<div class="row">
										<div class="col-md-12">
											<div class="alert alert-warning alert-dismissible fade show" role="alert">
												<strong><i class="fas fa-exclamation-triangle"></i>&nbsp;&nbsp;<?= $message ?></strong>
												<button type="button" class="close" data-dismiss="alert" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
										</div>
									</div>

								<?php unset($_SESSION['error']); } ?>
								<?php if ($message = $this->session->flashdata('info')) { ?>

									<div class="row">
										<div class="col-md-12">
											<div class="alert alert-warning alert-dismissible fade show" role="alert">
												<strong><i class="fas fa-exclamation-triangle"></i>&nbsp;&nbsp;<?= $message ?></strong>
												<button type="button" class="close" data-dismiss="alert" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
										</div>
									</div>

								<?php unset($_SESSION['info']); } ?>
                                <div class="p-5">
									<div class="text-center mb-2">
										<img src="public\img\logo-azul.png" class="" width="200rem">
									</div>
                                    <div class="text-center">
                                        <h1 class="h4 font-weight-light text-secondary mb-4">Seja bem vindo!</h1>
                                    </div>
                                    <form class="user" name="form_auth" method="POST" action="<?php echo base_url('login/auth'); ?>">
                                        <div class="form-group">
                                            <input type="email" name="email" class="py-3 form-control form-control-user" placeholder="Digite seu e-mail">
											<?php echo form_error('email', '<small class="form-text text-danger">','</small>'); ?>
											<input type="password" name="password" class="py-3 form-control form-control-user mt-3"
                                            placeholder="Digite sua senha">
											<?php echo form_error('password', '<small class="form-text text-danger">','</small>'); ?>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block" style="background-color: #56CCF2 !important; border-color: #56CCF2;">
                                            <span class="h6 text-uppercase text-justify font-weight-bold">Entrar</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        <footer class="sticky-footer bg-white">
			<div class="container my-auto">
				<div class="copyright text-center my-auto text-">
					<span>Copyright &copy; Clean Car <?php echo date('Y'); ?>&nbsp; | By DALS'Tec. </span>
				</div>
			</div>
		</footer>

    </div>

