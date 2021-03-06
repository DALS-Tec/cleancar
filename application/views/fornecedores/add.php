

		<?php $this->load->view('layout/sidebar'); ?>

            <!-- Main Content -->
            <div id="content">

                <?php $this->load->view('layout/navbar'); ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

				<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?php echo base_url('fornecedores'); ?>">Fornecedores</a></li>
					<li class="breadcrumb-item active" aria-current="page"><?php echo $titulo ?></li>
				</ol>
				</nav>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
							<form method="POST" name="form_add">

								<?php if(isset($fornecedor)): ?>
								<p><strong><i class="fas fa-clock"></i>&nbsp;&nbsp;Última edição:&nbsp;</strong><?php echo formata_data_banco_com_hora($fornecedor->fornecedor_data_alteracao) ?></p>
								<?php endif ?>

								<!-- Dados principais  -->
								<fieldset class="mb-3 border p-2">
									<legend class="font-small text-gray-900"><i class="fas fa-truck-loading"></i>&nbsp;Dados principais</legend>

									<div class="form-group row mb-4">

										<div class="col-md-6">
											<label>Razão social</label>
											<input type="text" class="form-control" name="fornecedor_razao" aria-describedby="emailHelp" placeholder="Razão social" value="<?php echo set_value('fornecedor_razao') ?>" >
											<?php echo form_error('fornecedor_razao', '<small 
											class="form-text text-danger">','</small>'); ?>
										</div>

										<div class="col-md-5">
											<label >Nome fantasia</label>
											<input type="text" class="form-control" name="fornecedor_nome_fantasia" aria-describedby="emailHelp" placeholder="Nome fantasia" value="<?php echo set_value('fornecedor_nome_fantasia'); ?>" >
											<?php echo form_error('fornecedor_nome_fantasia', '<small 
											class="form-text text-danger">','</small>'); ?>
										</div>
										
									</div>

									<div class="form-group row mb-4">

										<div class="col-md-4">
											<label>CNPJ</label>
											<input type="text" class="form-control cnpj" name="fornecedor_cnpj" aria-describedby="emailHelp" placeholder="CNPJ" value="<?php echo set_value('fornecedor_cnpj'); ?>" >
											<?php echo form_error('fornecedor_cnpj', '<small 
											class="form-text text-danger">','</small>'); ?>
										</div>

										<div class="col-md-4">
											<label>Inscrição estadual</label>
											<input type="text" class="form-control" name="fornecedor_ie" aria-describedby="emailHelp" placeholder="Inscrição estadual" value="<?php echo set_value('fornecedor_ie'); ?>" >
											<?php echo form_error('fornecedor_ie', '<small 
											class="form-text text-danger">','</small>'); ?>
										</div>

										<div class="col-md-4">
											<label>Telefone fixo</label>
											<input type="text" class="form-control phone_with_ddd" name="fornecedor_telefone" aria-describedby="emailHelp" placeholder="Telefone fixo" value="<?php echo set_value('fornecedor_telefone'); ?>" >
											<?php echo form_error('fornecedor_telefone', '<small 
											class="form-text text-danger">','</small>'); ?>
										</div>
										
									</div>

									<div class="form-group row mb-4">

										<div class="col-md-4">
											<label>Telefone celular</label>
											<input type="text" class="form-control sp_celphones" name="fornecedor_celular" aria-describedby="emailHelp" placeholder="Telefone celular" value="<?php echo set_value('fornecedor_celular'); ?>" >
											<?php echo form_error('fornecedor_celular', '<small 
											class="form-text text-danger">','</small>'); ?>
										</div>

										<div class="col-md-4">
											<label>E-mail</label>
											<input type="email" class="form-control" name="fornecedor_email" aria-describedby="emailHelp" placeholder="E-mail" value="<?php echo set_value('fornecedor_email'); ?>" >
											<?php echo form_error('fornecedor_email', '<small 
											class="form-text text-danger">','</small>'); ?>
										</div>

										<div class="col-md-4">
											<label>Nome do contato</label>
											<input type="text" class="form-control" name="fornecedor_contato" aria-describedby="emailHelp" placeholder="Nome do contato" value="<?php echo set_value('fornecedor_contato'); ?>" >
											<?php echo form_error('fornecedor_contato', '<small 
											class="form-text text-danger">','</small>'); ?>
										</div>
										
									</div>  

								</fieldset>

								<!-- Dados de endereço  -->
								<fieldset class="mb-3 border p-2">
									
									<script>
									
										function getDadosEnderecoPorCEP() {
											let cep = document.getElementById('cep').value
											
											let url = 'https://viacep.com.br/ws/'+cep+'/json/unicode/'

											let xmlHTTP = new XMLHttpRequest()
											xmlHTTP.open('GET', url)

											xmlHTTP.onreadystatechange = () => {
												if(xmlHTTP.readyState == 4 && xmlHTTP.status == 200) {
													let dadosJSONText = xmlHTTP.responseText
													let dadosJSONObj = JSON.parse(dadosJSONText)

													document.getElementById('endereco').value = dadosJSONObj.logradouro
													document.getElementById('bairro').value = dadosJSONObj.bairro
													document.getElementById('cidade').value = dadosJSONObj.localidade
													document.getElementById('uf').value = dadosJSONObj.uf
												}
											}

											xmlHTTP.send()
										}
									</script>

									<legend class="font-small text-gray-900"><i class="fas fa-map-marker-alt"></i>&nbsp;Dados de endereço</legend>

									<div class="form-group row mb-3">
									
										<div class="col-md-3">
											<label>CEP</label>
											<div class="input-group">
												<input id="cep" type="text" class="form-control cep" name="fornecedor_cep" aria-describedby="emailHelp" placeholder="CEP" value="<?php echo set_value('fornecedor_cep'); ?>" aria-describedby="button-addon2">
												<div class="input-group-append">
													<button class="btn btn-outline-secondary" type="button" id="button-addon2" onclick="getDadosEnderecoPorCEP()"><i class="fas fa-search"></i></button>
												</div>
											</div>
											<?php 
												echo form_error('fornecedor_cep', '<small 
												class="form-text text-danger">','</small>'); 
											?>
										</div>

										<div class="col-md-4">
											<label>Endereço</label>
											<input type="text" class="form-control" name="fornecedor_endereco" placeholder="Endereço" value="<?php echo set_value('fornecedor_endereco'); ?>" id="endereco"/>
											<?php echo form_error('fornecedor_endereco', '<small 
											class="form-text text-danger">','</small>'); ?>
										</div>

										<div class="col-md-2">
											<label>Número</label>
											<input type="text" class="form-control" name="fornecedor_numero_endereco" placeholder="Número" value="<?php echo set_value('fornecedor_numero'); ?>" />
											<?php echo form_error('fornecedor_numero_endereco', '<small 
											class="form-text text-danger">','</small>'); ?>
										</div>

										<div class="col-md-3">
											<label>Complemento</label>
											<input type="text" class="form-control" name="fornecedor_complemento" placeholder="Complemento" value="<?php echo set_value('fornecedor_complemento'); ?>" />
											<?php echo form_error('fornecedor_complemento', '<small 
											class="form-text text-danger">','</small>'); ?>
										</div>
										
									</div>

									<div class="form-group row mb-3">

										<div class="col-md-6">
											<label>Bairro</label>
											<input type="text" class="form-control" name="fornecedor_bairro" placeholder="Bairro" value="<?php echo set_value('fornecedor_bairro'); ?>" id="bairro"/>
											<?php echo form_error('fornecedor_bairro', '<small 
											class="form-text text-danger">','</small>'); ?>
										</div>

										<div class="col-md-4">
											<label>Cidade</label>
											<input type="text" class="form-control" name="fornecedor_cidade" placeholder="Cidade" value="<?php echo set_value('fornecedor_cidade'); ?>" id="cidade"/>
											<?php echo form_error('fornecedor_cidade', '<small 
											class="form-text text-danger">','</small>'); ?>
										</div>

										<div class="col-md-2">
											<label>UF</label>
											<input type="text" class="form-control" name="fornecedor_estado" placeholder="UF" value="<?php echo set_value('fornecedor_estado'); ?>" id="uf"/>
											<?php echo form_error('fornecedor_estado', '<small 
											class="form-text text-danger">','</small>'); ?>
										</div>

									</div>
							
								</fieldset>

								<!-- Definições -->
								<fieldset class="mb-3 border p-2">
										<legend class="font-small text-gray-900"><i class="fas fa-wrench"></i>&nbsp;Definições</legend>

										<div class="form-group row mb-3">

											<div class="col-md-4">
												<label>Ativo</label>
												<select class="form-control" name="fornecedor_ativo" id="">
													<option value="0">Não</option>
													<option value="1">Sim</option>
												</select>
											</div>

											<div class="col-md-8">
											<label>Observações</label>
											<textarea type="text" class="form-control" name="fornecedor_obs" placeholder="Observações sobre o fornecedor"><?php echo set_value('fornecedor_obs') ?></textarea>
											<?php echo form_error('fornecedor_obs', '<small 
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
