<html>
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">	
		
		<title>Cadastrar Projeto</title>
		
		<?php $this->loadCSS()?>
	</head>
	
	<body class="d-flex flex-column">

	
		<?php $this->loadHeader()?>
	
		<div class="container mt-4 flex-grow">
			<div class="row">
				<div class="col-md-6 col-12 col-lg-4">
					<form method="POST" class="form-group" id="form">
						<div class="row mt-3">
							<div class="col-12">
								<label for="project_title">Título do Projeto</label>
								<input type="text" name="project_title" id="project_title" class="form-control">
							</div>
						</div>

						<div class="row mt-3">
							<div class="col-12">
								<label for="client_name">Nome da empresa / cliente</label>
								<input type="text" name="client_name" id="client_name" class="form-control">
							</div>
						</div>
						
						<div class="row mt-3">
							<div class="col-12">
								<label for="project_duration">Duração do projeto</label>
								<input type="text" name="project_duration" id="project_duration" class="form-control">
							</div>
						</div>
						
						<div class="row mt-3">
							<div class="col-12"><label>Forma de pagamento</label></div>
							<div class="btn-group col-12" data-toggle="buttons">
							  <label class="btn btn-secondary col-5 active" id="in_cash">
							    <input type="radio" name="payment_method" autocomplete="off" value="in_money" checked> À vista
							  </label>
							  <div class="col-2"></div>
							  <label class="btn btn-secondary col-5" id="parceled">
							    <input type="radio" name="payment_method" autocomplete="off" value="in_parcel"> Parcelado
							  </label>
							</div>
						</div>
						
						<div class="row d-flex align-items-end flex-row">
							<div class="col-12 col-md-6 mt-2">
								<label for="price">Preço</label>
								<input type="text" name="price" id="price" class="form-control">
							</div>
								
							<div class="col-12 col-md-6 mt-2">
								<button type="button" class="btn btn-success" name="add_parcel" id="add_parcel" style="display:none">
									Adicionar Parcela
								</button>
							</div>
							
						</div>							

						<div class="row mt-3">
							<div class="col-12">
								<button type="submit" class="btn btn-block btn-primary mx-auto" id="confirm">Pronto</button>
							</div>
						</div>					
					</form>
				</div>
				<div class="d-none d-md-block col-md-4 offset-md-4 logo-bg"></div>
			</div>
		</div>
	

		<?php $this->loadFooter()?>
		<?php $this->loadJavascript()?>
		<script src="<?php $this->path('assets/js/project_create.js')?>"></script>
	</body>
</html>