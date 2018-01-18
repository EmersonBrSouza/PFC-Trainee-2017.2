<html>
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">	
		
		<title>Responder Solicitação</title>
		
		<?php $this->loadCSS()?>
	</head>
	<body class="d-flex flex-column">

	
	<?php $this->loadHeader()?>


		<div class="container mt-4 flex-grow">
			<div class="row">
				<div class="col-md-6 col-12 col-lg-4">
					
					<form method="POST" class="form-group" id="form" enctype="multipart/form-data">
						
                        <div class="row mt-3">
							<div class="col-12">
								<label for="member_name">Solicitante: </label>
								<span id="member_name">
                                    <?php if(isset($this->data['member_data'])){
                                        echo $this->data['member_data']['name'];
                                    }?>
                                </span>
							</div>
						</div>

						<div class="row mt-3">
							<div class="col-12">
								<label for="request_reason">Motivo da solicitação: </label>
								<span id="request_reason">
                                    <?php if(isset($this->data['member_data'])){
                                        echo $this->data['member_data']['request_reason'];
                                    }?>
                                </span>
							</div>
						</div>


                        <div class="row mt-3">
							<div class="col-12">
								<label for="avaliable_score">Saldo disponível: </label>
								<span id="avaliable_score" name="avaliable_score">
                                    <?php if(isset($this->data['member_data'])){
                                        echo $this->data['member_data']['score'];
                                    }?>
                                </span>
							</div>
						</div>

						<div class="row mt-3">
							<div class="col-12">
								<label for="files">Comprovantes</label>
								<span id="files">
									<ul>
										
										<?php if(isset($this->data['member_data'])){
											$i = 0;
											foreach($this->data['member_data']['files'] as $file){
												echo "<li><a download href=".$file['path']."> Baixar Comprovante ".++$i."</a></li>";
											}
                                    	}?>
									
									
									</ul>
                                    
                                </span>
							</div>
						</div>
						
						<div class="row mt-3">
                            <div class="col-12">
                                <label for="value_required">Quantidade de pontos a serem retirados</i></label>
                                <input type="number" class="form-control" placeholder="Quantidade de pontos" id="value_required" name="value_required">
                            </div>
						</div>

						<div class="row mt-1">
                            <div class="col-12">
                                <span class="text-danger">
									<?php
										if(isset($this->data['error'])){
											echo $this->data['error'];
										}
									?>
							</span>
                            </div>
						</div>		
						<div class="row mt-3">
							<div class="col-12">
								<button type="submit" class="btn btn-block btn-primary mx-auto" id="confirm" disabled="disabled">Pronto</button>
							</div>
							
						</div>					
					</form>
				</div>
				<div class="d-none d-md-block col-md-4 offset-md-4 logo-bg">

				</div>
				</div>
			</div>
		</div>

		<?php $this->loadFooter()?>
	
		<?php $this->loadJavascript()?>
		<script src="<?php $this->path('assets/js/director_response.js')?>"></script>
	</body>
</html>