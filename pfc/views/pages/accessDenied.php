<html>
	<head>
		<title>Acesso Negado</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		
		<?php $this->loadCSS()?>
	</head>
	
	<body class="d-flex flex-column">

		<?php $this->loadHeader();?>
		
		<div class="container mt-5 mb-5 flex-grow" id="cards-home">
            <div class="row">
                <div class="col-md-6 col-12">
                    <h3>Ops! Parece que você não tem permissão para prosseguir.</h3>
                    <br><br>
                    <h3>
                        <center><a href="<?php echo ROOT_URL?>">Voltar à Página Inicial</a></center>
                    </h3>
                </div>

                <div class="col-md-6 col-12 text-center pulse animated infinite">
                    <img src="<?php echo VIEW_BASE?>assets/images/svg/gandalf.svg" width="90%" height="90%"><br>
                    <h4> YOU SHALL NOT PASS !!!</h4>
                </div>
            </div>			
		</div>
		<?php $this->loadFooter()?>
		<?php $this->loadJavascript()?>	
	</body>
</html>