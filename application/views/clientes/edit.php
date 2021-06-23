

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
                        <div class="card-header py-3">
                            <a title="Voltar" href="<?php echo base_url('clientes'); ?>" class="btn btn-success btn-sm float-right"><i class="fas fa-arrow-left"></i>&nbsp;Voltar</a>
                        </div>
                        <div class="card-body">
							<form method="POST" name="form_edit">

								<div class="form-group row mb-4">

									<div class="col-md-4">
										<label>Nome</label>
										<input type="text" class="form-control" name="cliente_nome" aria-describedby="emailHelp" placeholder="Nome" value="<?php echo $cliente->cliente_nome; ?>" >
										<?php echo form_error('cliente_nome', '<small 
										class="form-text text-danger">','</small>'); ?>
									</div>

									<div class="col-md-4">
										<label>Sobrenome</label>
										<input type="text" class="form-control" name="cliente_sobrenome" aria-describedby="emailHelp" placeholder="Seu sobrenome" value="<?php echo $cliente->cliente_sobrenome; ?>" >
										<?php echo form_error('cliente_sobrenome', '<small 
										class="form-text text-danger">','</small>'); ?>
									</div>

									<div class="col-md-2">
										<label>CPF ou CNPJ</label>
										<input type="text" class="form-control cnpj" name="cliente_cpf_cnpj" aria-describedby="emailHelp" placeholder="CPF ou CNPJ" value="<?php echo $cliente->cliente_cpf_cnpj; ?>" >
										<?php echo form_error('cliente_cpf_cnpj', '<small 
										class="form-text text-danger">','</small>'); ?>
									</div>

									<div class="col-md-2">
										<label>RG ou IE</label>
										<input type="text" class="form-control" name="cliente_rg_ie" aria-describedby="emailHelp" placeholder="RG ou IE" value="<?php echo $cliente->cliente_rg_ie; ?>" >
										<?php echo form_error('cliente_rg_ie', '<small 
										class="form-text text-danger">','</small>'); ?>
									</div>
									
								</div>

								<div class="form-group row mb-4">

									<div class="col-md-4">
										<label>E-mail</label>
										<input type="email" class="form-control" name="cliente_email" aria-describedby="emailHelp" placeholder="Seu e-mail (login)" value="<?php echo $cliente->cliente_email; ?>" >
										<?php echo form_error('cliente_email', '<small 
										class="form-text text-danger">','</small>'); ?>
									</div>

									<div class="col-md-2">
										<label>Telefone fixo</label>
										<input type="text" class="form-control phone_with_ddd" name="cliente_telefone" aria-describedby="emailHelp" placeholder="Telefone fixo" value="<?php echo $cliente->cliente_telefone; ?>" >
										<?php echo form_error('cliente_telefone', '<small 
										class="form-text text-danger">','</small>'); ?>
									</div>

									<div class="col-md-2">
										<label>Telefone celular</label>
										<input type="text" class="form-control sp_celphones" name="cliente_celular" aria-describedby="emailHelp" placeholder="Telefone celular" value="<?php echo $cliente->cliente_celular; ?>" >
										<?php echo form_error('cliente_celular', '<small 
										class="form-text text-danger">','</small>'); ?>
									</div>
									
									<div class="col-md-4">
										<label>Data Nascimento</label>
										<input type="date" class="form-control" name="cliente_data_nascimento" aria-describedby="emailHelp" placeholder="" value="<?php echo $cliente->cliente_data_nascimento; ?>" >
										<?php echo form_error('cliente_data_nascimento', '<small 
										class="form-text text-danger">','</small>'); ?>
									</div>
									
								</div>

								<div class="form-group row mb-4">

									<!-- Código API de CEP lib: viaCEP -->
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

									<div class="col-md-2">
										<label>CEP</label>
										<div class="input-group">
											<input id="cep" type="text" class="form-control cep" name="cliente_cep" aria-describedby="emailHelp" placeholder="CEP" value="<?php echo $cliente->cliente_cep; ?>" aria-describedby="button-addon2">
											<div class="input-group-append">
												<button class="btn btn-outline-secondary" type="button" id="button-addon2" onclick="getDadosEnderecoPorCEP()"><i class="fas fa-search"></i></button>
											</div>
										</div>
										<?php 
											echo form_error('cliente_cep', '<small 
											class="form-text text-danger">','</small>'); 
										?>
									</div>

									<div class="col-md-3">
										<label>Endereço</label>
										<input type="text" class="form-control" name="cliente_endereco" placeholder="Endereço" value="<?php echo $cliente->cliente_endereco; ?>" id="endereco"/>
										<?php echo form_error('cliente_endereco', '<small 
										class="form-text text-danger">','</small>'); ?>
									</div>

									<div class="col-md-1">
										<label>Número</label>
										<input type="text" class="form-control" name="cliente_numero_endereco" placeholder="Número" value="<?php echo $cliente->cliente_numero_endereco; ?>" />
										<?php echo form_error('cliente_numero_endereco', '<small 
										class="form-text text-danger">','</small>'); ?>
									</div>

									<div class="col-md-3">
										<label>Bairro</label>
										<input type="text" class="form-control" name="cliente_bairro" placeholder="Bairro" value="<?php echo $cliente->cliente_bairro; ?>" id="bairro"/>
										<?php echo form_error('cliente_bairro', '<small 
										class="form-text text-danger">','</small>'); ?>
									</div>

									<div class="col-md-2">
										<label>Cidade</label>
										<input type="text" class="form-control" name="cliente_cidade" placeholder="Cidade" value="<?php echo $cliente->cliente_cidade; ?>" id="cidade"/>
										<?php echo form_error('cliente_cidade', '<small 
										class="form-text text-danger">','</small>'); ?>
									</div>

									<div class="col-md-1">
										<label>UF</label>
										<input type="text" class="form-control" name="cliente_estado" placeholder="UF" value="<?php echo $cliente->cliente_estado; ?>" id="uf"/>
										<?php echo form_error('cliente_estado', '<small 
										class="form-text text-danger">','</small>'); ?>
									</div>
									
								</div>
								
								<div class="form-group row mb-4">

									<div class="col-md-8">
										<label>Observações</label>
										<textarea type="text" class="form-control" name="cliente_obs" placeholder="Observações sobre o cliente"><?php echo $cliente->cliente_obs; ?></textarea>
										<?php echo form_error('cliente_obs', '<small 
										class="form-text text-danger">','</small>'); ?>
									</div>

									<input type="hidden" name="cliente_id" value="<?php echo $cliente->cliente_id; ?>" />

								</div>
								
								<button type="submit" class="btn btn-primary btn-sm">Salvar</button>
							</form>
                        </div>

                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            