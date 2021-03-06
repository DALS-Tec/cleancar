

		<?php $this->load->view('layout/sidebar'); ?>

            <!-- Main Content -->
            <div id="content">

                <?php $this->load->view('layout/navbar'); ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

				<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?php echo base_url('/') ?>">Home</a></li>
					<li class="breadcrumb-item active" aria-current="page"><?php echo $titulo ?></li>
				</ol>
				</nav>

				<?php if($message = $this->session->flashdata('sucesso')) : ?>
					<div class="row">
						<div class="col-md-12">
							<div class="alert alert-success alert-dismissible border border-0 fade show" role="alert">
								<strong><i class="far fa-check-circle"></i>&nbsp;&nbsp;<?php echo $message; ?></strong>
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
						</div>
					</div>
					
				<?php unset($_SESSION['sucesso']); endif;   ?>

				<?php if($message = $this->session->flashdata('error')) : ?>

					<div class="row">
						<div class="col-md-12">
							<div class="alert alert-danger alert-dismissible fade show" role="alert">
								<strong><i class="fas fa-exclamation-triangle"></i>&nbsp;&nbsp;<?php echo $message; ?></strong>
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
						</div>
					</div>

				<?php unset($_SESSION['error']); endif; ?>
				
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <a title="Novo cadastro" href="<?php echo base_url('lavadores/add') ?>" class="btn btn-success btn-sm float-right"><i class="fas fa-plus"></i>&nbsp;Novo</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="text-gray-900  text-monospace">
                                            <th>#</th>
                                            <th>Nome completo</th>
                                            <th>Matricula</th>
                                            <th>Telefone Celular</th>
                                            <th>E-mail</th>
                                            <th class="text-center">Ativo</th>
                                            <th class="text-center no-sort">A????es</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									
										<?php foreach ($lavadores as $lavador): ?>
                                        <tr>
                                            <td><?php echo $lavador->lavador_id ?></td>
                                            <td><?php echo $lavador->lavador_nome_completo ?></td>
                                            <td><?php echo $lavador->lavador_codigo ?></td>
                                            <td><?php echo $lavador->lavador_celular ?></td>
                                            <td><?php echo $lavador->lavador_email ?></td>
                                            <td class="text-center pr-4">
												<?php 
													echo ($lavador->lavador_ativo == 1 ? '<span class="badge badge-info btn-sm">Sim</span>' : '<span class="badge badge-warning btn-sm">N??o</span>' ) 
												?>
											</td>
											<td class="text-right">
												<a title="Editar" href="<?php echo base_url('lavadores/edit/'.$lavador->lavador_id) ?>" class="btn btn-sm btn-primary"><i class="fas fa-user-edit"></i></a>
												<a title="Excluir" href="javascript(void)" data-toggle="modal" data-target="#lavador-<?php echo $lavador->lavador_id; ?>" class="btn btn-sm btn-danger"><i class="fas fa-user-times"></i></a>
											</td>
                                        </tr>
                                        
                                        <div class="modal fade" id="lavador-<?php echo $lavador->lavador_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Deseja excluir o lavador?</h5>
                                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">??</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">Ap??s a exclus??o n??o ser?? mais poss??vel recuperar o lavador.</div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">N??o</button>
                                                        <a class="btn btn-danger" href="<?php echo base_url('lavadores/del/'.$lavador->lavador_id) ?>">Sim</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
										<?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            