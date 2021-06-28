

		<?php $this->load->view('layout/sidebar'); ?>

            <!-- Main Content -->
            <div id="content">

                <?php $this->load->view('layout/navbar'); ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

				<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?php echo base_url('servicos'); ?>">Servicos</a></li>
					<li class="breadcrumb-item active" aria-current="page"><?php echo $titulo ?></li>
				</ol>
				</nav>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
							<form method="POST" name="form_add">

								<!-- Dados principais  -->
								<fieldset class="mb-3 border p-2">
									<legend class="font-small text-gray-900"><i class="fas fa-align-left"></i>&nbsp;Informações do serviço</legend>

									<div class="form-group row mb-4">

										<div class="col-md-6">
											<label>Nome do serviço</label>
											<input type="text" class="form-control" name="servico_nome" aria-describedby="emailHelp" placeholder="Nome do serviço" value="<?php echo set_value('servico_nome'); ?>" >
											<?php echo form_error('servico_nome', '<small 
											class="form-text text-danger">','</small>'); ?>
										</div>

										<div class="col-md-3">
											<label>Preço</label>
											<input type="text" class="form-control money" name="servico_preco" aria-describedby="emailHelp" placeholder="Preço do serviço" value="<?php echo set_value('servico_preco'); ?>" >
											<?php echo form_error('servico_preco', '<small 
											class="form-text text-danger">','</small>'); ?>
										</div>

										<div class="col-md-3">
											<label>Ativo</label>
											<select class="form-control" name="servico_ativo">
												<option value="0">Não</option>
												<option value="1">Sim</option>
											</select>
										</div>
										
									</div>

									<div class="form-group row mb-4">

										<div class="col-md-12">
											<label>Descrição do serviço</label>
											<textarea type="text" class="form-control" name="servico_descricao" placeholder="Descrições sobre o servico" style="min-height: 100px  !important; max-height: 164px;"><?php echo set_value('servico_descricao') ?></textarea>
											<?php echo form_error('servico_descricao', '<small 
											class="form-text text-danger">','</small>'); ?>
										</div>
										
									</div>

								</fieldset>

								<button type="submit" class="btn btn-primary btn mr-2">
									Salvar
								</button>
								<a title="Voltar" href="<?php echo base_url($this->router->fetch_class()); ?>" class="btn btn-success"><i class="fas fa-arrow-left"></i>&nbsp;Voltar</a>

							</form>
                        </div>

                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
