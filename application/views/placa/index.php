<?php $this->load->view('layout/sidebar'); ?>
            <!-- Main Content -->
            <div id="content">

                <?php $this->load->view('layout/navbar'); ?>
<style>
/* .conteudo form .user-details{
	display: center;
	flex-wrap: wrap;
	justify-content: space-between;
	margin: 20px 0 12px 0;
}

form .user-details .input-box{
	margin-bottom:15px;
	color: #2F80ED;
}

.user-details .input-box details{
	display:block;
	font-weight:500;
	margin-bottom:5px;
	
}

.user-details .input-box input{
	outline: none;
	border-radius: 5px;
	border: 1px solid #ccc;
	font-size:16px;
	border-bottom-width: 2px;
	transition: all 0.5s ease;
}

.user-details .input-box input:focus,
.user-details .input-box input:valid{
	border-color: #2F80ED;
}



form .button input:hover{
background: linear-gradient(-135deg, rgb(20, 147, 220), rgb(17,54,71));	
} */
</style>
<div class="container">
	<div class="o-hidden border-0 my-5">
		<div class="row justify-content-center">

			<div class="col-xl-6 col-lg-8 col-md-6 col-sm-6">

			<div class="p-5 nowrap">

				<div class="text-center">
					<span class="h1 text-uppercase text-justify font-weight-bolder">Pesquisar Placa</span>
				</div>	

				<form class="text-center" action="buscar_placa" method="$_POST">
					<div class="form-group">
						<input class="form-control form-control-user" type="text" name="pesquisa-placa" placeholder="Insira a Placa" maxlength="8" required>	
					</div>
					<button class="btn btn-info d-inline-block w-50" type="submit" value="Buscar">Buscar</button>
				</form>
			
			</div>
				
			</div>

		</div>
	</div>


</div>
