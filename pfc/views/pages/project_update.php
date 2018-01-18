<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">	
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<title>Atualizar Projeto</title>
		
		<?php $this->loadCSS()?>
	</head>
	
	<body class="d-flex flex-column">

	
		<?php $this->loadHeader()?>
	
		<div class="container mt-4 flex-grow">
			<div class="row">
				<div class="col-md-4 col-12">
					<form method="POST" class="form-group" id="form">
						<div class="row mt-3">
							<div class="col-12">
								<label for="project_title">Título do Projeto</label>
								<input type="text" name="project_title" id="project_title" class="form-control" 
                                    value = "<?php
                                        if(isset($this->data['project'])){
                                            echo $this->data['project']->getTitle();
                                        }
                                    ?>"
                                >
							</div>
						</div>

						<div class="row mt-3">
							<div class="col-12">
								<label for="client_name">Nome da empresa / cliente</label>
								<input type="text" name="client_name" id="client_name" class="form-control"
                                    value = "<?php
                                        if(isset($this->data['project'])){
                                            echo $this->data['project']->getClientName();
                                        }
                                    ?>"
                                >
							</div>
						</div>
						
						<div class="row mt-3">
							<div class="col-12">
								<label for="project_duration">Duração do projeto</label>
								<input type="text" name="project_duration" id="project_duration" class="form-control"
                                    value = "<?php
                                        if(isset($this->data['project'])){
                                            echo $this->data['project']->getDuration();
                                        }
                                    ?>"
                                >
							</div>
						</div>
						
						<div class="row mt-3">
							<div class="col-12"><label>Forma de pagamento</label></div>
							<div class="btn-group col-12" data-toggle="buttons">
                              <?php
                                    if(isset($this->data['project'])){
                                        if($this->data['project']->getPaymentMethod() == "in_money"){
                                             echo '<label class="btn btn-secondary col-5 active" id="in_cash">
                                                        <input type="radio" name="payment_method" autocomplete="off" value="in_money" checked> À vista
                                                   </label>
                                                   <div class="col-2"></div>
                                                   <label class="btn btn-secondary col-5" id="parceled">
                                                        <input type="radio" name="payment_method" autocomplete="off" value="in_parcel"> Parcelado
                                                   </label>';
                                        }else{
                                             echo '<label class="btn btn-secondary col-5" id="in_cash">
                                                        <input type="radio" name="payment_method" autocomplete="off" value="in_money"> À vista
                                                   </label>
                                                   <div class="col-2"></div>
                                                   <label class="btn btn-secondary col-5 active" id="parceled">
                                                        <input type="radio" name="payment_method" autocomplete="off" value="in_parcel" checked> Parcelado
                                                   </label>';
                                        }

                                       
                                    }
                                ?>
							</div>
						</div>
						
						<div class="row d-flex align-items-end flex-row mt-2">
							<div class="col-12 mt-2">
								<label for="price">Preço</label>
								<input type="text" name="price" id="price" class="form-control"
									value = "<?php
                                        if(isset($this->data['project'])){
                                            echo $this->data['project']->getPrice();
                                        }
                                    ?>"
								>
							</div>
								
						</div>

						<div class="row mt-3">
							<div class="col-12">
								<button type="submit" class="btn btn-block btn-primary mx-auto" id="confirm">Pronto</button>
							</div>
						</div>					
					</form>
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
								<br><h4>Gerenciar Equipe</h4>
							</span>
						</div>
						<div class="row d-flex align-items-end flex-row mt-2">
							<div class="col-12 mt-2">
								<label for="member_search">Buscar um membro</label>
								<input type="text" name="member_search" id="member_search" class="form-control">
								<span id="vendor-alert" class="text-danger" style="display:none"></span>
								<ul class="list-group" id="member_list"></ul>
							</div>
						</div>
						<div class="row mt-3">
							<div class="col-12">
								<table class="table">
									<thead class="thead-light text-center">
										<tr>
											<th scope="col">Nome</th>
											<th scope="col">Cargo</th>
											<th scope="col">Ação</th>
										</tr>
									</thead>
									<tbody class="text-center" id="team-body">
										<?php 
											if(isset($this->data['team'])){
												foreach($this->data['team'] as $member){
													echo "<tr>".
														 "<td>".$member[0]->getName()."</td>".
														 "<td>".$member[1]."</td>".
														 '<td>'
														.'   <button class="btn btn-danger" onclick="remove(this)" member_id="'.$member[0]->getCPF().'" member_role="'.$member[1].'">'
														.'       Remover'
														.'   </button>'
														.'</td>'
														."</tr>";
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
								<br><h4>Atualizar Pagamento</h4>
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

						<div class="row d-flex align-items-end flex-row mt-2">
							<div class="col-12 col-md-6 mt-2">
								<label for="payment_receive">Valor recebido</label>
								<input type="text" name="payment_receive" id="payment_receive" class="form-control">
							</div>
							<div class="col-12 col-md-6 mt-2">
								<button type="button" class="btn btn-success" id="confirm_payment">
									Confirmar Recebimento
								</button>
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
								<br><h4>Status: Em andamento</h4><br>
								<p>
									Concluir o projeto é uma ação <b>irreversível</b>, ao fazer isso os pontos serão distribuídos e será impossível alterar informações do projeto.
								</p>
								<button type="button" class="btn btn-warning" id="finish_project"><b>Concluir Projeto</b></button>
							</div>
						</div>
						<div class="row mt-3 d-flex align-items-end" id="confirmation" style="display:none !important">
							<div class="col-md-6 col-12">
								<label for="password">Senha do diretor</label>
								<input type="password" id="password" name="password" class="form-control">
							</div>
							<div class="col-md-6 col-12">
								<button class="btn btn-success" id="confirm_finish"><b>Confirmar</b></button>
							</div>
						</div>
						<div class="row mt-2">
							<div class="col-12">
								<span id="alert-status" class="text-danger" style="display:none"></span><br>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	

		<?php $this->loadFooter()?>
		<?php $this->loadJavascript()?>
		<script src="<?php $this->path('assets/js/project_create.js')?>"></script>
		<script src="<?php $this->path('assets/js/project_update.js')?>"></script>
	</body>
</html>