

		<?php $this->load->view('layout/sidebar'); ?>

            <!-- Main Content -->
            <div id="content">

                <?php $this->load->view('layout/navbar'); ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

				<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?php echo base_url('lavadores'); ?>">lavadores</a></li>
					<li class="breadcrumb-item active" aria-current="page"><?php echo $titulo ?></li>
				</ol>
				</nav>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
							<form method="POST" name="form_edit">

								<p><strong><i class="fas fa-clock"></i>&nbsp;&nbsp;Última edição:&nbsp;</strong><?php echo formata_data_banco_com_hora($lavador->lavador_data_alteracao) ?></p>

								<!-- Dados principais  -->
								<fieldset class="mb-3 border p-2">
									<legend class="font-small text-gray-900"><i class="fas fa-hands-wash"></i>&nbsp;Dados pessoais</legend>

									<div class="form-group row mb-4">

										<div class="col-md-6">
											<label>Nome completo</label>
											<input type="text" class="form-control" name="lavador_nome_completo" aria-describedby="emailHelp" placeholder="Nome completo" value="<?php echo $lavador->lavador_nome_completo; ?>" >
											<?php echo form_error('lavador_nome_completo', '<small 
											class="form-text text-danger">','</small>'); ?>
										</div>

										<div class="col-md-3">
											<label >CPF</label>
											<input type="text" class="form-control" name="lavador_cpf" aria-describedby="emailHelp" placeholder="CPF do vendedor" value="<?php echo $lavador->lavador_cpf; ?>" >
											<?php echo form_error('lavador_cpf', '<small 
											class="form-text text-danger">','</small>'); ?>
										</div>

										<div class="col-md-3">
											<label>RG</label>
											<input type="text" class="form-control" name="lavador_rg" aria-describedby="emailHelp" placeholder="RG do vendedor" value="<?php echo $lavador->lavador_rg; ?>" >
											<?php echo form_error('lavador_rg', '<small 
											class="form-text text-danger">','</small>'); ?>
										</div>
										
									</div>

									<div class="form-group row mb-4">

										<div class="col-md-6">
											<label>E-mail</label>
											<input type="email" class="form-control" name="lavador_email" aria-describedby="emailHelp" placeholder="E-mail" value="<?php echo $lavador->lavador_email; ?>" >
											<?php echo form_error('lavador_email', '<small 
											class="form-text text-danger">','</small>'); ?>
										</div>

										<div class="col-md-3">
											<label>Telefone celular</label>
											<input type="text" class="form-control sp_celphones" name="lavador_celular" aria-describedby="emailHelp" placeholder="Telefone celular" value="<?php echo $lavador->lavador_celular; ?>" >
											<?php echo form_error('lavador_celular', '<small 
											class="form-text text-danger">','</small>'); ?>
										</div>

										<div class="col-md-3">
											<label>Telefone fixo</label>
											<input type="text" class="form-control sp_celphones" name="lavador_telefone" aria-describedby="emailHelp" placeholder="Telefone fixo" value="<?php echo $lavador->lavador_telefone; ?>" >
											<?php echo form_error('lavador_telefone', '<small 
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
									
										<div class="col-md-2">
											<label>CEP</label>
											<div class="input-group">
												<input id="cep" type="text" class="form-control cep" name="lavador_cep" aria-describedby="emailHelp" placeholder="CEP" value="<?php echo $lavador->lavador_cep; ?>" aria-describedby="button-addon2">
												<div class="input-group-append">
													<button class="btn btn-outline-secondary" type="button" id="button-addon2" onclick="getDadosEnderecoPorCEP()"><i class="fas fa-search"></i></button>
												</div>
											</div>
											<?php 
												echo form_error('lavador_cep', '<small 
												class="form-text text-danger">','</small>'); 
											?>
										</div>

										<div class="col-md-4">
											<label>Endereço</label>
											<input type="text" class="form-control" name="lavador_endereco" placeholder="Endereço" value="<?php echo $lavador->lavador_endereco; ?>" id="endereco"/>
											<?php echo form_error('lavador_endereco', '<small 
											class="form-text text-danger">','</small>'); ?>
										</div>

										<div class="col-md-2">
											<label>Número</label>
											<input type="text" class="form-control" name="lavador_numero_endereco" placeholder="Número" value="<?php echo $lavador->lavador_numero_endereco; ?>" />
											<?php echo form_error('lavador_numero_endereco', '<small 
											class="form-text text-danger">','</small>'); ?>
										</div>

										<div class="col-md-4">
											<label>Complemento</label>
											<input type="text" class="form-control" name="lavador_complemento" placeholder="Complemento" value="<?php echo $lavador->lavador_complemento; ?>" />
											<?php echo form_error('lavador_complemento', '<small 
											class="form-text text-danger">','</small>'); ?>
										</div>
										
									</div>

									<div class="form-group row mb-3">

										<div class="col-md-6">
											<label>Bairro</label>
											<input type="text" class="form-control" name="lavador_bairro" placeholder="Bairro" value="<?php echo $lavador->lavador_bairro; ?>" id="bairro"/>
											<?php echo form_error('lavador_bairro', '<small 
											class="form-text text-danger">','</small>'); ?>
										</div>

										<div class="col-md-4">
											<label>Cidade</label>
											<input type="text" class="form-control" name="lavador_cidade" placeholder="Cidade" value="<?php echo $lavador->lavador_cidade; ?>" id="cidade"/>
											<?php echo form_error('lavador_cidade', '<small 
											class="form-text text-danger">','</small>'); ?>
										</div>

										<div class="col-md-2">
											<label>UF</label>
											<input type="text" class="form-control" name="lavador_estado" placeholder="UF" value="<?php echo $lavador->lavador_estado; ?>" id="uf"/>
											<?php echo form_error('lavador_estado', '<small 
											class="form-text text-danger">','</small>'); ?>
										</div>

									</div>
							
								</fieldset>

								<!-- Definições -->
								<fieldset class="mb-3 border p-2">
										<legend class="font-small text-gray-900"><i class="fas fa-wrench"></i>&nbsp;Definições</legend>

										<div class="form-group row mb-3">

											<div class="col-md-3">
												<label>Ativo</label>
												<select class="form-control" name="lavador_ativo">
													<option value="0" <?php echo ($lavador->lavador_ativo == 0) ? 'selected' : '' ?>>Não</option>
													<option value="1" <?php echo ($lavador->lavador_ativo == 1) ? 'selected' : '' ?>>Sim</option>
												</select>
											</div>
		
											<div class="col-md-3">
												<label>Matricula</label>
												<input type="text" class="form-control" name="lavador_codigo" placeholder="Matricula" readonly value="<?php echo $lavador->lavador_codigo; ?>"/>
												<?php echo form_error('lavador_codigo', '<small 
												class="form-text text-danger">','</small>'); ?>
											</div>

											<div class="col-md-6">
												<label>Observações</label>
												<textarea type="text" class="form-control" name="lavador_obs" placeholder="Observações sobre o lavador"><?php echo $lavador->lavador_obs; ?></textarea>
												<?php echo form_error('lavador_obs', '<small 
												class="form-text text-danger">','</small>'); ?>
											</div>
										
										</div>

								</fieldset>

								<input type="hidden" name="lavador_id" value="<?php echo $lavador->lavador_id; ?>" />
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
