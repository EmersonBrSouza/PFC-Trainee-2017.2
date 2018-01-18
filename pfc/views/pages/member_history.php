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
						<h6>Nome: 
							<span id="name">
								<?php 
									if(isset($this->data['single_profile'])){
										echo $this->data['single_profile']->getName();
									}
								?>
							</span>
						</h6>
					</div>
				</div>
				<div class="row mt-2">
					<div class="col-12">
						<h6>Data de Nascimento: 
							<span id="birthdate">
								<?php 
									if(isset($this->data['single_profile'])){
										echo $this->data['single_profile']->getBirthdate();
									}
								?>
							</span>
						</h6>
					</div>
				</div>
				<div class="row mt-2">
					<div class="col-12">
						<h6>Email: 
							<span id="personal_email">
								<?php 
									if(isset($this->data['single_profile'])){
										echo $this->data['single_profile']->getPersonalEmail();
									}
								?>
							</span>
						</h6>
					</div>
				</div>
				<div class="row mt-2">
					<div class="col-12">
						<h6>Email Profissional: 
							<span id="professional_email">
								<?php 
									if(isset($this->data['single_profile'])){
										echo $this->data['single_profile']->getProfessionalEmail();
									}
								?>
							</span>
						</h6>
					</div>
				</div>
				<div class="row mt-2">
					<div class="col-12">
						<h6>Telefone: 
							<span id="telephone">
								<?php 
									if(isset($this->data['single_profile'])){
										echo $this->data['single_profile']->getTelephone();
									}
								?>
							</span>
						</h6>
					</div>
				</div>
				<div class="row mt-2">
					<div class="col-12">
						<h6>Estado Civil: 
							<span id="marital_status">
								<?php 
									if(isset($this->data['single_profile'])){
										if($this->data['single_profile']->getMaritalStatus() == "single"){
											echo "Solteiro(a)";
										}
										else if($this->data['single_profile']->getMaritalStatus() == "married"){
											echo "Casado(a)";
										}
										else if($this->data['single_profile']->getMaritalStatus() == "widower"){
											echo "Viúvo(a)";
										}
										else{
											echo "Divorciado(a)";
										}
									}
								?>
							</span>
						</h6>
					</div>
				</div>
				<div class="row mt-2">
					<div class="col-12">
						<h6>Cargo: 
							<span id="member_type">
								<?php 
									if(isset($this->data['single_profile'])){
										if($this->data['single_profile']->getMemberType() == "director"){
											echo "Diretor";
										}
										else if($this->data['single_profile']->getMemberType() == "member"){
											echo "Membro";
										}
										else{
											echo "Trainee";
										}
									}
								?>
							</span>
						</h6>
					</div>
				</div>
				<div class="row mt-2">
					<div class="col-12">
						<h6>Pontuação Atual: 
							<span id="score">
								<?php 
									if(isset($this->data['single_profile'])){
										echo $this->data['single_profile']->getScore();
									}
								?>
							</span> pontos
						</h6>
					</div>
				</div>
			</div>
            
			<div class="col-12 col-md-9 text-center">

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
							<tbody class="text-center" id="history-body">
								<?php
									if(isset($this->data['history'])){
										foreach($this->data['history'] as $transaction){
											$result;
											if($transaction['action'] == "gain"){
												$result = "<td class='text-success'>".$transaction['value']."</td>";
											}else{
												$result = "<td class='text-danger'>".$transaction['value']."</td>";
											}
											
											echo '<tr>
													<td>'.$transaction['reason'].'</td>
													<td>'.$transaction['date'].'</td>'.
													$result.
												  '</tr>';
										}
									}
								?>
							</tbody>
						</table>
						<div class="col-md-3"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php $this->loadFooter()?>
	<?php $this->loadJavascript()?>
</html>