

		<?php $this->load->view('layout/sidebar'); ?>

            <!-- Main Content -->
            <div id="content">

                <?php $this->load->view('layout/navbar'); ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

				<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?php echo base_url('clientes'); ?>">Clientes</a></li>
					<li class="breadcrumb-item active" aria-current="page"><?php echo $titulo ?></li>
				</ol>
				</nav>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
							<form method="POST" name="form_add">

								<div class="mb-3 pb-2 border-bottom d-inline-block">
									<div class="custom-control custom-radio custom-control-inline mt-2">
										<input type="radio" id="pessoa_fisica" name="cliente_tipo" class="custom-control-input" value="1" <?php echo set_checkbox('cliente_tipo', '1') ?> checked="">
										<label class="custom-control-label pt-1" for="pessoa_fisica">Pessoa física</label>
									</div>
									<div class="custom-control custom-radio custom-control-inline">
										<input type="radio" id="pessoa_juridica" name="cliente_tipo" class="custom-control-input" value="2" <?php echo set_checkbox('cliente_tipo', '2') ?> >
										<label class="custom-control-label pt-1" for="pessoa_juridica">Pessoa jurídica</label>
									</div>
								</div>

								<!-- Dados pessoais  -->
								<fieldset class="mb-3 border p-2">
									<legend class="font-small text-gray-900"><i class="fas fa-user-tie"></i>&nbsp;Dados pessoais</legend>

									<div class="form-group row mb-3">

										<div class="col-md-3">
											<label>Nome</label>
											<input type="text" class="form-control" name="cliente_nome" aria-describedby="emailHelp" placeholder="Nome" value="<?php echo set_value('cliente_nome')?>">
											<?php echo form_error('cliente_nome', '<small 
											class="form-text text-danger">','</small>'); ?>
										</div>

										<div class="col-md-5">
											<label>Sobrenome</label>
											<input 
											type="text" 
											class="form-control" 
											name="cliente_sobrenome" 
											aria-describedby="emailHelp" 
											placeholder="Seu sobrenome" 
											value="<?php echo set_value('cliente_sobrenome')?>">
											<?php echo form_error('cliente_sobrenome', '<small 
											class="form-text text-danger">','</small>'); ?>
										</div>

										<div class="col-md-4">
											<label>Data Nascimento</label>
											<input type="date" class="form-control" name="cliente_data_nascimento" aria-describedby="emailHelp" placeholder="" value="<?php echo set_value('cliente_data_nascimento');?>" >
											<?php echo form_error('cliente_data_nascimento', '<small 
											class="form-text text-danger">','</small>'); ?>
										</div>
										
									</div>

									<div class="form-group row mb-3">
										
										<div class="col-md-3">

											<div class="pessoa_fisica">
												<label>CPF</label>
												<input type="text" class="form-control cpf" name="cliente_cpf" aria-describedby="emailHelp" placeholder="CPF do cliente" value="<?php echo set_value('cliente_cpf') ?>" >
												<?php echo form_error('cliente_cpf', '<small class="form-text text-danger">','</small>'); ?>
											</div>

											<div class="pessoa_juridica">
												<label>CNPJ</label>
												<input type="text" class="form-control cnpj" name="cliente_cnpj" aria-describedby="emailHelp" placeholder="CNPJ do cliente" value="<?php echo set_value('cliente_cnpj') ?>">
												<?php
													echo form_error('cliente_cnpj', '<small class="form-text text-danger">','</small>'); 
												?>
											</div>

										</div>

										<div class="col-md-3">
											<label class="pessoa_fisica">RG</label>
											<label class="pessoa_juridica">Inscrição Estadual</label>
											<input type="text" class="form-control" name="cliente_rg_ie" aria-describedby="emailHelp" value="<?php echo set_value('cliente_rg_ie') ?>" >
											<?php echo form_error('cliente_rg_ie', '<small 
											class="form-text text-danger">','</small>'); ?>
										</div>

										<div class="col-md-6">
											<label>E-mail</label>
											<input type="email" class="form-control" name="cliente_email" aria-describedby="emailHelp" placeholder="Seu e-mail (login)" value="<?php echo set_value('cliente_email') ?>" >
											<?php echo form_error('cliente_email', '<small 
											class="form-text text-danger">','</small>'); ?>
										</div>

									</div>

									<div class="form-group row mb-3">

										<div class="col-md-6">
											<label>Telefone fixo</label>
											<input type="text" class="form-control phone_with_ddd" name="cliente_telefone" aria-describedby="emailHelp" placeholder="Telefone fixo" value="<?php echo set_value('cliente_telefone') ?>" >
											<?php echo form_error('cliente_telefone', '<small 
											class="form-text text-danger">','</small>'); ?>
										</div>

										<div class="col-md-6">
											<label>Telefone celular</label>
											<input type="text" class="form-control sp_celphones" name="cliente_celular" aria-describedby="emailHelp" placeholder="Telefone celular" value="<?php echo set_value('cliente_celular') ?>" >
											<?php echo form_error('cliente_celular', '<small 
											class="form-text text-danger">','</small>'); ?>
										</div>

									</div>

								</fieldset>

								<!-- Dados de endereço  -->
								<fieldset class="mb-3 border p-2">
									<!-- Código API de CEP -->
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
												<input id="cep" type="text" class="form-control cep" name="cliente_cep" aria-describedby="emailHelp" placeholder="CEP" value="<?php echo set_value('cliente_cep') ?>" aria-describedby="button-addon2">
												<div class="input-group-append">
													<button class="btn btn-outline-secondary" type="button" id="button-addon2" onclick="getDadosEnderecoPorCEP()"><i class="fas fa-search"></i></button>
												</div>
											</div>
											<?php 
												echo form_error('cliente_cep', '<small 
												class="form-text text-danger">','</small>'); 
											?>
										</div>

										<div class="col-md-4">
											<label>Endereço</label>
											<input type="text" class="form-control" name="cliente_endereco" placeholder="Endereço" value="<?php echo set_value('cliente_endereco') ?>" id="endereco"/>
											<?php echo form_error('cliente_endereco', '<small 
											class="form-text text-danger">','</small>'); ?>
										</div>

										<div class="col-md-2">
											<label>Número</label>
											<input type="text" class="form-control" name="cliente_numero_endereco" placeholder="Número" value="<?php echo set_value('cliente_value') ?>" />
											<?php echo form_error('cliente_numero_endereco', '<small 
											class="form-text text-danger">','</small>'); ?>
										</div>

										<div class="col-md-3">
											<label>Complemento</label>
											<input type="text" class="form-control" name="cliente_complemento" placeholder="Complemento" value="<?php echo set_value('cliente_complemento') ?>" />
											<?php echo form_error('cliente_complemento', '<small 
											class="form-text text-danger">','</small>'); ?>
										</div>
										
									</div>

									<div class="form-group row mb-3">

										<div class="col-md-6">
											<label>Bairro</label>
											<input id="bairro"type="text" class="form-control" name="cliente_bairro" placeholder="Bairro" value="<?php echo set_value('cliente_bairro')?>"/>
											<?php echo form_error('cliente_bairro', '<small 
											class="form-text text-danger">','</small>'); ?>
										</div>

										<div class="col-md-4">
											<label>Cidade</label>
											<input type="text" class="form-control" name="cliente_cidade" placeholder="Cidade" value="<?php echo set_value('cliente_cidade') ?>" id="cidade"/>
											<?php echo form_error('cliente_cidade', '<small 
											class="form-text text-danger">','</small>'); ?>
										</div>

										<div class="col-md-2">
											<label>UF</label>
											<input type="text" class="form-control" name="cliente_estado" placeholder="UF" value="<?php echo set_value('cliente_estado') ?>" id="uf"/>
											<?php echo form_error('cliente_estado', '<small 
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
												<select class="form-control" name="cliente_ativo" id="">
													<option value="0">Não</option>
													<option value="1">Sim</option>
												</select>
											</div>

											<div class="col-md-8">
											<label>Observações</label>
											<textarea type="text" class="form-control" name="cliente_obs" placeholder="Observações sobre o cliente"></textarea>
											<?php echo form_error('cliente_obs', '<small 
											class="form-text text-danger">','</small>'); ?>
										</div>
										
										</div>

								</fieldset>

								<button type="submit" class="btn btn-primary btn mr-2">
									Salvar
								</button>
								<a title="Voltar" href="<?php echo base_url('clientes'); ?>" class="btn btn-success"><i class="fas fa-arrow-left"></i>&nbsp;Voltar</a>
							</form>
                        </div>

                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            