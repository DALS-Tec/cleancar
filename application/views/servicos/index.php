

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
                            <a title="Novo cadastro" href="<?php echo base_url('servicos/add') ?>" class="btn btn-success btn-sm float-right"><i class="fas fa-plus"></i>&nbsp;Novo</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="text-gray-900  text-monospace">
                                            <th>#</th>
                                            <th>T??tulo servi??o</th>
                                            <th>Pre??o</th>
                                            <th>Descri????o</th>
                                            <th class="text-center">Ativo</th>
                                            <th class="text-center no-sort">A????es</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									
										<?php foreach ($servicos as $servico): ?>
                                        <tr>
                                            <td><?php echo $servico->servico_id ?></td>
                                            <td><?php echo $servico->servico_nome ?></td>
                                            <td><?php echo 'R$&nbsp;'.$servico->servico_preco ?></td>
                                            <td><?php echo word_limiter($servico->servico_descricao, 10)  ?></td>
                                            <td class="text-center pr-4">
												<?php 
													echo ($servico->servico_ativo == 1 ? '<span class="badge badge-info btn-sm">Sim</span>' : '<span class="badge badge-warning btn-sm">N??o</span>' ) 
												?>
											</td>
											<td class="text-right">
												<a title="Editar" href="<?php echo base_url('servicos/edit/'.$servico->servico_id) ?>" class="btn btn-sm btn-primary"><i class="fas fa-user-edit"></i></a>
												<a title="Excluir" href="javascript(void)" data-toggle="modal" data-target="#servico-<?php echo $servico->servico_id; ?>" class="btn btn-sm btn-danger"><i class="fas fa-user-times"></i></a>
											</td>
                                        </tr>
                                        
                                        <div class="modal fade" id="servico-<?php echo $servico->servico_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Deseja excluir o servico?</h5>
                                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">??</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">Ap??s a exclus??o n??o ser?? mais poss??vel recuperar o servico.</div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">N??o</button>
                                                        <a class="btn btn-danger" href="<?php echo base_url('servicos/del/'.$servico->servico_id) ?>">Sim</a>
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

            