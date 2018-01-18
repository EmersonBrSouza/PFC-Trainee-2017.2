<html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Cadastro de Membros</title>
	<?php $this->loadCSS()?>
</head>

<body class="d-flex flex-column">
	<?php $this->loadHeader()?> 

	<main>
		<div class="container mt-4 flex-grow">
			<div class="row">
				<div class="d-none d-sm-block col-md-3 col-lg-4"></div>
				<div class="col-md-6 col-12 col-lg-4">
					
					<form id="form" class="form-group" method="POST" enctype="multipart/form-data">
						<div class="mx-auto col-6">
							<img class="img-membro img-responsive rounded-circle ratio" id="img-membro"
								style="background-image:url('<?php echo ROOT_URL.'media/profile/default.svg'?>')">
							<input id="path_profile_picture" name="path_profile_picture" type="hidden" value="<?php echo ROOT_URL.'media/profile/default.svg'?>">
							<input type="file" id="arquivo">
						</div>
						
						<div class="row mt-2">
							<div class="col-12">
								<label for="name">Nome Completo</label>
								<input type="text" name="name" id="name" class="form-control">
							</div>
						</div>
						
						<div class="row mt-2">
							<div class="col-12">
								<label for="personal_email">Email Pessoal</label>
								<input type="text" name="personal_email" id="personal_email" class="form-control">
							</div>
						</div>
						
						<div class="row mt-2">
							<div class="col-12">
								<label for="professional_email">Email Profissional</label>
								<input type="text" name="professional_email" id="professional_email" class="form-control">
							</div>
						</div>
						
						<div class="row mt-2">
							<div class="col-12">
								<label for="password">Senha</label>
								<input type="password" name="password" id="password" class="form-control">
							</div>
						</div>
						
						<div class="row mt-2">
							<div class="col-12 col-md-6">
								<label for="rg">RG</label>
								<input type="text" name="rg" id="rg" class="form-control">
							</div>

							<div class="col-12 col-md-6">
								<label for="cpf">CPF</label>
								<input type="text" name="cpf" id="cpf" class="form-control">
							</div>	
						</div>
						
						
						<div class="row mt-2">
							<div class="col-12 col-md-6">
								<label for="birthdate">Data de nascimento</label>
								<input type="text" name="birthdate" id="birthdate" class="form-control">
							</div>
							
							<div class="col-12 col-md-6">
								<label for="telephone">Telefone</label>
								<input type="text" name="telephone" id="telephone" class="form-control">
							</div>
							
						</div>

						<div class="row mt-2">
							<div class="col-12 col-md-6">
								<label for="marital_status">Estado Civil</label>
								<select class="form-control" id="marital_status" name="marital_status">
								  <option value="single">Solteiro(a)</option>
								  <option value="married">Casado(a)</option>
								  <option value="divorced">Divorciado(a)</option>
								  <option value="widower">Viúvo(a)</option>
								</select>
							</div>

							<div class="col-12 col-md-6">
								<label for="score">Pontos</label>
							  	<input type="number" name="score" id="score" class="form-control">
							</div>
						</div>
						<br>
						<div class="row mt-2 d-flex flex-row">
							<div class="btn-group col-12 justify-content-between " data-toggle="buttons">
							  <label class="btn btn-secondary col-4">
							    <input type="radio" value="director" name="member_type" id="director" autocomplete="off"> Diretor
							  </label>
							  
							  <label class="btn btn-secondary col-4 active">
							    <input type="radio" value="member" name="member_type" id="member" autocomplete="off" checked> Membro
							  </label>
							  
							  <label class="btn btn-secondary col-4">
							    <input type="radio" value="trainee" name="member_type" id="trainee" autocomplete="off"> Trainee
							  </label>
							</div>
						</div>
						
						<div class="row mt-2">
							<button type="submit" class="btn col-8 btn-primary mx-auto mt-3" id="confirmar">Pronto</button>
						</div>						
					</form>


				</div>
				<div class="d-none d-sm-block col-md-3 col-lg-4"></div>
			</div>
		</div>
	</main>

	<?php $this->loadFooter()?>	
	<?php $this->loadJavascript()?>
	<!--<script src="<?php //$this->path('assets/js/register.js')?>"></script>-->
	<script src="<?php $this->path('assets/js/member_register.js')?>"></script>
</body>
</html>