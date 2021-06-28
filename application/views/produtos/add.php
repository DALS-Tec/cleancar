

		<?php $this->load->view('layout/sidebar'); ?>

            <!-- Main Content -->
            <div id="content">

                <?php $this->load->view('layout/navbar'); ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

				<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?php echo base_url('produtos'); ?>">Produtos</a></li>
					<li class="breadcrumb-item active" aria-current="page"><?php echo $titulo ?></li>
				</ol>
				</nav>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
							<form method="POST" name="form_add">

								<!-- Dados principais  -->
								<fieldset class="mb-3 border p-2">
									<legend class="font-small text-gray-900"><i class="fab fa-product-hunt"></i>&nbsp;Informações do produto</legend>

									<div class="form-group row mb-4">

										<div class="col-md-2">
											<label>Código  produto</label>
											<input type="text" class="form-control disabled" name="produto_codigo" aria-describedby="emailHelp" value="<?php echo $produto_codigo; ?>" readonly>
										</div>

										<div class="col-md-10">
											<label>Descricao do produto</label>
											<input type="text" class="form-control" name="produto_descricao" aria-describedby="emailHelp" placeholder="Descrição do produto" value="<?php echo set_value('produto_descricao'); ?>" >
											<?php echo form_error('produto_descricao', '<small 
											class="form-text text-danger">','</small>'); ?>
										</div>
										
									</div>

									<div class="form-group row mb-4">

										<div class="col-md-3">
											<label>Marca</label>
											<select class="form-control" name="produto_marca_id">
												<?php foreach ($marcas as $marca): ?>
													<option title="<?php echo ($marca->marca_ativa == 0 ? 'Não pode ser escolhida' : 'Marca ativa');?>" <?php echo ($marca->marca_ativa == 0 ? 'disabled' : '' ); ?> value="<?php echo $marca->marca_id ?>">
														<?php echo ($marca->marca_ativa == 0 ? $marca->marca_nome.'&nbsp;(Inativa)': $marca->marca_nome) ;?>	
													</option>
												<?php endforeach; ?>
											</select>
										</div>

										<div class="col-md-3">
											<label>Categoria</label>
											<select class="form-control" name="produto_categoria_id">
												<?php foreach ($categorias as $categoria): ?>
												<option title="<?php echo ($categoria->categoria_ativa == 0 ? 'Não pode ser escolhida' : 'Categoria ativa');?>" <?php echo ($categoria->categoria_ativa == 0 ? 'disabled' : '' ); ?> value="<?php echo $categoria->categoria_id ?>">
													<?php echo ($categoria->categoria_ativa == 0 ? $categoria->categoria_nome.'&nbsp;(Inativa)': $categoria->categoria_nome) ;?>	
												</option>
												<?php endforeach; ?>
											</select>
										</div>

										<div class="col-md-3">
											<label>Fornecedor</label>
											<select class="form-control" name="produto_fornecedor_id">
												<?php foreach ($fornecedores as $fornecedor): ?>
												<option title="<?php echo ($fornecedor->fornecedor_ativo == 0 ? 'Não pode ser escolhido' : 'Fornecedor ativo');?>" <?php echo ($fornecedor->fornecedor_ativo == 0 ? 'disabled' : '' ); ?> value="<?php echo $fornecedor->fornecedor_id ?>">
													<?php echo ($fornecedor->fornecedor_ativo == 0 ? $fornecedor->fornecedor_nome_fantasia .'&nbsp;(Inativo)': $fornecedor->fornecedor_nome_fantasia ) ;?>	
												</option>
												<?php endforeach; ?>
											</select>
										</div>

										<div class="col-md-3">
											<label>Produto unidade</label>
											<input type="text" class="form-control" name="produto_unidade" aria-describedby="emailHelp" placeholder="Unidade do produto" value="<?php echo set_value('produto_unidade'); ?>">
											<?php echo form_error('produto_unidade', '<small 
											class="form-text text-danger">','</small>'); ?>
										</div>
										
									</div>

								</fieldset>

								<fieldset class="mb-3 border p-2">
									<legend class="font-small text-gray-900"><i class="fas fa-funnel-dollar"></i>&nbsp;Precificação e estoque</legend>

									<div class="form-group row mb-4">

										<div class="col-md-3">
											<label>Preço de custo</label>
											<input type="text" class="form-control money2" name="produto_preco_custo" aria-describedby="emailHelp" placeholder="Preço de custo" value="<?php echo set_value('produto_preco_custo'); ?>" >
											<?php echo form_error('produto_preco_custo', '<small 
											class="form-text text-danger">','</small>'); ?>
										</div>

										<div class="col-md-3">
											<label>Preço de venda</label>
											<input type="text" class="form-control money2" name="produto_preco_venda" aria-describedby="emailHelp" placeholder="Preço de venda" value="<?php echo set_value('produto_preco_venda'); ?>" >
											<?php echo form_error('produto_preco_venda', '<small 
											class="form-text text-danger">','</small>'); ?>
										</div>

										<div class="col-md-3">
											<label>Estoque mínimo</label>
											<input type="number" class="form-control" name="produto_estoque_minimo" aria-describedby="emailHelp" placeholder="Estoque mínimo" value="<?php echo set_value('produto_estoque_minimo'); ?>" >
											<?php echo form_error('produto_estoque_minimo', '<small 
											class="form-text text-danger">','</small>'); ?>
										</div>

										<div class="col-md-3">
											<label>Quantidade em estoque</label>
											<input type="number" class="form-control" name="produto_qtde_estoque" aria-describedby="emailHelp" placeholder="Quantidade em estoque" value="<?php echo set_value('produto_qtde_estoque'); ?>" >
											<?php echo form_error('produto_qtde_estoque', '<small 
											class="form-text text-danger">','</small>'); ?>
										</div>
										
									</div>

									<div class="form-group row mb-4">

										<div class="col-md-3">
											<label>Ativo</label>
											<select class="form-control" name="produto_ativo">
												<option value="0">Não</option>
												<option value="1" selected >Sim</option>
											</select>
										</div>

										<div class="col-md-9">
											<label>Observações</label>
											<textarea type="text" class="form-control" name="produto_obs" placeholder="Observações sobre o produto"><?php echo set_value('produto_obs'); ?></textarea>
											<?php echo form_error('produto_obs', '<small 
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
