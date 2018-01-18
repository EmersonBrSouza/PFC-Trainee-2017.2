<html>
	<head>
		<title>Área de Membros</title>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		
		<?php $this->loadCSS()?>
	</head>
	<body class="d-flex flex-column">

		<?php $this->loadHeader();?>		
        
		<div class="container mt-5 flex-grow animated fadeInLeftBig" id="cards-home">
			<div class="col-12">
				<div class="row justify-content-around">
				<?php 
					if($_SESSION['member_type'] == "director" || $_SESSION['member_type'] == "admin"){
						echo ('
							<div class="card col-12 col-md-3 mt-3 mt-md-0">
								<div class="card-img-top w-100 h-100 bg-card" style="background:url('.VIEW_BASE.'assets/images/svg/user.svg'.');"></div>
								<div class="card-body text-center">
									<h5 class="card-title"><b>Cadastrar Membros</b></h5>
									<p class="card-text">Associe os membros ao PFC</p>
									<a href="'.ROOT_URL.'member/register" class="btn btn-primary">Cadastrar</a>
								</div>
							</div>
							<br>
						');
					}
				?>
					
					<div class="card col-12 col-md-3 mt-3 mt-md-0">
						<div class="card-img-top w-100 h-100 bg-card" style="background:url('<?php echo VIEW_BASE?>/assets/images/svg/refresh.svg');"></div>
						<div class="card-body text-center">
							<h5 class="card-title"><b>Atualizar Cadastro</b></h5>
							<p class="card-text">Atualize as informações</p>
							<a href="<?php echo ROOT_URL?>member/update" class="btn btn-primary">Atualizar</a>
						</div>
					</div>
					<br>
					<div class="card col-12 col-md-3 mt-3  mt-md-0">
					  	<div class="card-img-top w-100 h-100 bg-card" style="background:url('<?php echo VIEW_BASE?>/assets/images/svg/graph.svg');"></div>
						<div class="card-body text-center">
							<h5 class="card-title"><b>Histórico de Pontos</b></h5>
							<p class="card-text">Visualize o histórico</p>
							<a href="<?php echo ROOT_URL?>member/history" class="btn btn-primary">Visualizar</a>
						</div>
					</div>
					<br>
					<div class="card col-12 col-md-3 mt-3 mt-md-0">
					  	<div class="card-img-top w-100 h-100 bg-card" style="background:url('<?php echo VIEW_BASE?>/assets/images/svg/get-money.svg');"></div>
						<div class="card-body text-center">
							<h5 class="card-title"><b>Solicitar Reembolso</b></h5>
							<p class="card-text">Solicite o seu reembolso</p>
							<a href="<?php echo ROOT_URL?>member/request" class="btn btn-primary">Solicitar</a>
						</div>
					</div>
				</div>
			</div>
		</div>
        
		<?php $this->loadFooter()?>
		<?php $this->loadJavascript()?>	
	</body>
</html>