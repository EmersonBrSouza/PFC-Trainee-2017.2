<html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Atualizar Perfil</title>
	<?php $this->loadCSS()?>
</head>

<body class="d-flex flex-column">
	<?php $this->loadHeader()?> 

		<div class="container mt-4 flex-grow">
			<div class="row">
				<div class="d-none d-sm-block col-md-3 col-lg-4"></div>
				<div class="col-md-6 col-12 col-lg-4">

					<form id="form" class="form-group" method="POST" enctype="multipart/form-data">
						<div class="mx-auto col-6">
							<img class="img-membro img-responsive rounded-circle ratio" id="img-membro"
								style="background-image:url('<?php echo  $data[0]->getProfilePicture()?>')">
							<input id="path_profile_picture" name="path_profile_picture" type="hidden" 
                            value="<?php echo  $data[0]->getProfilePicture()?>">
							<input type="file" id="arquivo">
						</div>
						
						<div class="row mt-2">
							<div class="col-12">
								<label for="name">Nome Completo</label>
								<input type="text" name="name" id="name" class="form-control"
                                value="<?php echo $data[0]->getName()?>">
							</div>
						</div>
						
						<div class="row mt-2">
							<div class="col-12">
								<label for="professional_email">Email Profissional</label>
								<input type="text" name="professional_email" id="professional_email" class="form-control"
                                value="<?php echo $data[0]->getProfessionalEmail()?>">
							</div>
						</div>
						
						<div class="row mt-2">
							<div class="col-12">
								<label for="password">Senha <i>(Deixe em branco se não quiser mudar)</i></label>
								<input type="password" name="password_update" id="password_update" class="form-control">
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
								<label for="telephone">Telefone</label>
								<input type="text" name="telephone" id="telephone" class="form-control" 
                                value="<?php echo $data[0]->getTelephone()?>">
							</div>
						</div>
						<br>
						
						<div class="row mt-2">
							<button type="submit" class="btn col-8 btn-primary mx-auto mt-3" id="confirmar">Pronto</button>
						</div>						
					</form>


				</div>
				<div class="d-none d-sm-block col-md-3 col-lg-4"></div>
			</div>
		</div>

	<?php $this->loadFooter()?>	
	<?php $this->loadJavascript()?>
	<script src="<?php $this->path('assets/js/member_register.js')?>"></script>
</body>
</html>