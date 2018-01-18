<html>
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">	
		
		<title>Visualizar Projeto</title>
		
		<?php $this->loadCSS()?>
	</head>
	
	<body class="d-flex flex-column">

	
		<?php $this->loadHeader()?>
	
		<div class="container mt-4 flex-grow">
			<div class="row">
				<div class="col-md-4 col-12">
					<div class="row mt-3">
						<div class="col-12">
							<label><b>Título do Projeto</b></label><br>
							<span>
								<?php
									if(isset($this->data['project'])){
										echo $this->data['project']->getTitle();
									}
								?>
							</span>
						</div>
					</div>

					<div class="row mt-3">
						<div class="col-12">
							<label><b>Nome da empresa / cliente</b></label><br>
							<span> 
								<?php
									if(isset($this->data['project'])){
										echo $this->data['project']->getClientName();
									}
								?>
							</span>
						</div>
					</div>
					
					<div class="row mt-3">
						<div class="col-12">
							<label><b>Duração do Projeto</b></label><br>
							<span>
								<?php
									if(isset($this->data['project'])){
										echo $this->data['project']->getDuration();
									}
								?>
							</span>
						</div>
					</div>
					
					<div class="row mt-3">
						<div class="col-12">
							<label><b>Forma de Pagamento</b></label><br>
							<span>
								<?php
									if(isset($this->data['project'])){
										if($this->data['project']->getPaymentMethod() == "in_money"){
											echo 'À vista';
										}else{
											echo 'Parcelado';
										}
									}
								?>
							</span>
						</div>
					</div>
					
					<div class="row d-flex align-items-end flex-row mt-2">
						<div class="col-12 mt-2">
							<label><b>Preço</b></label><br>
							<span>
								<?php
									if(isset($this->data['project'])){
										echo $this->data['project']->getPrice().' reais';
									}
								?>
							</span>
						</div>	
					</div>
				</div>
				<div class="col-md-8">
					<ul class="nav nav-tabs">
						<li class="nav-item">
							<a class="nav-link active" style="cursor:pointer" id="team-link">Equipe</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" style="cursor:pointer" id="payment-link">Histórico de Pagamento 
								<span class="badge badge-pill badge-primary align-top text-white badge-request" style="font-size:10pt"></span>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" style="cursor:pointer" id="status-link">Status do Projeto 
								<span class="badge badge-pill badge-primary align-top text-white badge-request" style="font-size:10pt"></span>
							</a>
						</li>
					</ul>
					
					<div id="team">
						<div class="row">
							<span class="col-12">
								<br><h4>Equipe</h4>
							</span>
						</div>
						<div class="row mt-3">
							<div class="col-12">
								<table class="table">
									<thead class="thead-light text-center">
										<tr>
											<th scope="col">Nome</th>
											<th scope="col">Cargo</th>
										</tr>
									</thead>
									<tbody class="text-center" id="team-body">
										<?php 
											if(isset($this->data['team'])){
												foreach($this->data['team'] as $member){
													echo "<tr>".
															"<td>".$member[0]->getName()."</td>".
															"<td>".$member[1]."</td>".
														 "</tr>";
												}
											}
										?>
									</tbody>
								</table>
								<div class="col-md-3"></div>
							</div>
						</div>
					</div>
					
					<div id="payment" style="display:none">
						<div class="row">
							<span class="col-12">
								<br><h4>Histórico de Pagamento</h4>
							</span>
						</div>
						
						<div class="row d-flex align-items-start flex-row mt-2">
							<div class="col-12 mt-2">
								<span for="price">Débito restante:</span>
								<?php 
									if(isset($this->data['debit'])){
										echo '<span id="debit">'.$this->data['debit'].'</span>';
                                    }
								
								?>
							</div>
						</div>

						<div class="row mt-3">
							<div class="col-12">
								<table class="table">
									<thead class="thead-light text-center">
										<tr>
											<th scope="col">Data</th>
											<th scope="col">Valor</th>
											<th scope="col">Quem recebeu</th>
										</tr>
									</thead>
									<tbody class="text-center" id="payment-body">
										<?php 
											if(isset($this->data['payments'])){
												foreach($this->data['payments'] as $payment){
													echo "<tr>".
														 "<td>".$payment['date']."</td>".
														 "<td>".$payment['value']."</td>".
														 "<td>".$payment['receptor']."</td>".
														 "</tr>";
												}
											}
										?>
									</tbody>
								</table>
								<div class="col-md-3"></div>
							</div>
						</div>
					</div>

					<div id="status" style="display:none">
						<div class="row">
							<div class="col-12">
								<br><h4>Status: Concluído</h4><br>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	

		<?php $this->loadFooter()?>
		<?php $this->loadJavascript()?>
		<script src="<?php $this->path('assets/js/project_update.js')?>"></script>
	</body>
</html>