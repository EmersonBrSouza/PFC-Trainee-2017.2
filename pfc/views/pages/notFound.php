<html>
	<head>
		<title>Página não encontrada</title>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		
		<?php $this->loadCSS()?>
	</head>
	
	<body class="d-flex flex-column">

		<?php $this->loadHeader();?>
		
		<div class="container mt-5 mb-5 flex-grow" id="cards-home">
            <div class="row">
                <div class="col-md-6 col-12">
                    <h3>A página que você solicitou não foi encontrada.</h3>
                    <br>
                    <br>
                    <h3>
                        <center><a href="<?php echo ROOT_URL?>">Voltar à Página Inicial</a></center>
                    </h3>
                </div>

                <div class="col-md-6 mt-2 col-12 text-center">
                    <img src="<?php echo VIEW_BASE?>assets/images/svg/sherlock.svg" width="90%" height="90%"><br>
                </div>
            </div>			
		</div>
		<?php $this->loadFooter()?>
		<?php $this->loadJavascript()?>	
	</body>
</html>