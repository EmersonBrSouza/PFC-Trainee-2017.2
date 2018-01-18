<html>
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Histórico de Pontos</title>
	
	<?php $this->loadCSS();?>	
</head>
<body class="d-flex flex-column">

	<?php $this->loadHeader()?> 

	<div class="container mt-4 flex-grow">

		<div class="selector col-12"> 
			<div class="row flex-row flex-nowrap" style="overflow-x: auto;">
				<?php
					if(isset($this->data['profiles']) && 
					   isset($_SESSION['isLogged']) && 
					   ($_SESSION['member_type'] == "director" || $_SESSION['member_type'] == "admin")){
						
						foreach($this->data['profiles'] as $member){
							echo ('
								<div class="col-5 col-md-2 mr-2 ml-2">
									<img class="img-membro img-responsive rounded-circle ratio" cpf="'.$member->getCPF().'" id="img-membro"
									style="background-image:url(\''.$member->getProfilePicture().'\')">
								</div>
							');
						}
						
					}
				?>
			</div>
		</div>

		
		<div class="row mt-5">
			<div class="col-12 col-md-3 text-center" id="member_data">
				<div class="row">
					<div class="col-12">
						<h5>Sobre o Membro</h5>
					</div>
				</div>
				<div class="row">
					<div class="mx-auto col-4">
						<img src="assets/images/profile.svg" alt="" >
					</div>
				</div>
				<div class="row mt-2">
					<div class="col-12">
						<h6>Nome: <span id="name"></span></h6>
					</div>
				</div>
				<div class="row mt-2">
					<div class="col-12">
						<h6>Data de Nascimento: <span id="birthdate"></span></h6>
					</div>
				</div>
				<div class="row mt-2">
					<div class="col-12">
						<h6>Email: <span id="personal_email"></span></h6>
					</div>
				</div>
				<div class="row mt-2">
					<div class="col-12">
						<h6>Email Profissional: <span id="professional_email"></span></h6>
					</div>
				</div>
				<div class="row mt-2">
					<div class="col-12">
						<h6>Telefone: <span id="telephone"></span></h6>
					</div>
				</div>
				<div class="row mt-2">
					<div class="col-12">
						<h6>Estado Civil: <span id="marital_status"></span>
						</h6>
					</div>
				</div>
				<div class="row mt-2">
					<div class="col-12">
						<h6>Cargo: <span id="member_type"></span></h6>
					</div>
				</div>
				<div class="row mt-2">
					<div class="col-12">
						<h6>Pontuação Atual: <span id="score"></span> pontos</h6>
					</div>
				</div>
				
				<div class="row mt-2">
					<div class="col-12">
						<button class="btn btn-danger" id="desligar_membro">Desligar Membro</button>
					</div>
				</div>
				<br>
			</div>

			<div class="col-12 col-md-3" id="exclude_member" style="display: none">
				<div class="row">
					<div class="col">
						<button class="btn" id="voltar-exclude">Voltar</button>
					</div>
					<div class="col"></div>
					<div class="col"></div>
				</div>
				<div class="row mt-2 text-center">
					<div class="col-12">
						<h5>Desligar Membro</h5>
					</div>
				</div>
				
				<form class="form-group" method="POST" id="form">
					<div class="row mt-2 text-center">
						<div class="col-12">
							<h6>Nome: 
								<span id="exclude-name"><span>
							</h6>
							<input type="hidden" id="exclude-cpf">
						</div>
					</div>
					<div class="row mt-2  align-items-end text-center">
						<h6 class="col-12 text-center text-danger">
							<span id="moved-score"></span> pontos serão transferidos para a empresa.
						</h6>
					</div>
					<div class="row mt-2 align-items-start">
						<h6 class="col-12">Senha do Diretor</h6>
						<input name="password" id="password" type="password" class="form-control col-12" placeholder="Senha do Diretor">
					</div>
					<div class="row mt-2 text-center">
						<span class="text-danger" id="response"></span>
					</div>
					<div class="row mt-2 text-center">
						<div class="col-12">
							<button type="button" class="btn btn-danger" id="confirm_exclude">Desligar Membro</button>
						</div>
					</div>
				</form>
				<br>
			</div>

			<div class="col-12 col-md-9 text-center">
				<ul class="nav nav-tabs">
					<li class="nav-item">
						<a class="nav-link active" style="cursor:pointer" id="history-link">Histórico</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" style="cursor:pointer" id="request-link">Solicitações 
							<span class="badge badge-pill badge-primary align-top text-white badge-request" style="font-size:10pt"></span>
						</a>
					</li>
				</ul>
				
				<div id="history">
					<div class="row">
						<div class="col-12">
							<h3>Histórico de Pontos</h3><br>
						</div>
					</div>
					
					<div class="row">
						<div class="col-12">
							<table class="table">
								<thead class="thead-light text-center">
									<tr>
										<th scope="col">Motivo</th>
										<th scope="col">Data</th>
										<th scope="col">Transação</th>
									</tr>
								</thead>
								<tbody class="text-center" id="history-body"></tbody>
							</table>
							<div class="col-md-3"></div>
						</div>
					</div>
				</div>
				
				<div id="request" style="display:none">
					<div class="row">
						<div class="col-12">
							<h3>Solicitações de Reembolso</h3><br>
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							<table class="table">
								<thead class="thead-light text-center">
									<tr>
										<th scope="col">Motivo</th>
										<th scope="col">Status</th>
										<th scope="col">Ação</th>
									</tr>
								</thead>
								<tbody class="text-center" id="request-body"></tbody>
							</table>
							<div class="col-md-3"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php $this->loadFooter()?>
	<?php $this->loadJavascript()?>
	<script src="<?php $this->path('assets/js/director_history.js')?>"></script>
</body>
</html>