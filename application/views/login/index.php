

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-6 col-lg-10 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5" style="margin-top: 10rem !important;">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-10 mx-auto">
								<?php if($message = $this->session->flashdata('error')) { ?>

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
                                <div class="p-5">
									<div class="text-center mb-2">
										<img src="public\img\logo-azul.png" class="" width="200rem">
									</div>
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Seja bem vindo!</h1>
                                    </div>
                                    <form class="user" name="form_auth" method="POST" action="<?php echo base_url('login/auth'); ?>">
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control form-control-user" placeholder="Digite seu e-mail">
											<input type="password" name="password" class="form-control form-control-user"
                                            placeholder="Digite sua senha">
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block " style="background-color: #56CCF2 !important; border-color: #56CCF2;">
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

    </div>

