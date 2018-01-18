<html>
	<head>
		<title>Área de projetos</title>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		
		<?php $this->loadCSS()?>
	</head>
	<body class="d-flex flex-column">

		<?php $this->loadHeader()?>
		
		<div class="container mt-5 flex-grow animated fadeInRightBig" id="cards-home">
			<div class="col-12">
				<div class="row justify-content-center">

					<div class="card col-12 col-md-3 mt-3 mr-md-3 mt-md-0">
						<div class="card-img-top w-100 h-100 bg-card" style="background:url('<?php echo VIEW_BASE?>assets/images/svg/folder.svg');"></div>
						<div class="card-body text-center">
							<h5 class="card-title"><b>Cadastrar Projetos</b></h5>
						    <p class="card-text">Cadastre os projetos da empresa</p>
						    <a href="<?php echo ROOT_URL?>project/create" class="btn btn-primary">Cadastrar</a>
						</div>
					</div>
					<br>
					
					<div class="card col-12 col-md-3 mt-3 mr-md-3 mt-md-0">
						<div class="card-img-top w-100 h-100 bg-card" style="background:url('<?php echo VIEW_BASE?>assets/images/svg/folder-edit.svg');"></div>
						<div class="card-body text-center">
							<h5 class="card-title"><b>Atualizar Projetos</b></h5>
							<p class="card-text">Atualize as informações dos projetos</p>
							<a href="<?php echo ROOT_URL?>project/update" class="btn btn-primary">Atualizar</a>
						</div>
					</div>
					<br>

				</div>
			</div>
		</div>
		<?php $this->loadFooter()?>
		<?php $this->loadJavascript()?>	
	</body>
</html>