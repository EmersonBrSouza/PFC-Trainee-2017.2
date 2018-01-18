<html>
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">	
		
		<title>Login</title>
		
		<?php $this->loadCSS()?>
	</head>
	<body>

	
	<?php $this->loadHeader()?>


	<main>
		<div class="container mt-4">
			<div class="row mt-5">
				<div class="col-1 col-md-4"></div>
				<div class="col-10 col-md-4 middle-shadow">
					<div class="row text-center mt-2">
						<div class="col-12">
							<h4>Login</h4>	
						</div>
					</div>
					<div>
						<form class="form-group" method="POST">
							<div class="row mt-3">
								<div class="col-12">
									<label for="email">E-mail</label>
									<input type="email" id="email" name="email" placeholder="E-mail" class="form-control">
								</div>
							</div>
							<div class="row mt-3">
								<div class="col-12">
									<label for="password">Senha</label>
									<input type="password" id="password" name="password" placeholder="Senha" class="form-control">
								</div>
							</div>
							<div class="row mt-4">
								<div class="col-12 text-center text-danger">
									<span><?php if(isset($this->data['error'])){echo $this->data['error'];}?></span>
								</div>
							</div>
							<div class="row mt-3">
								<div class="col-12">
									<button type="submit" class="btn btn-primary btn-block">Entrar</button>
								</div>
							</div>
						</form>
					</div>

				</div>
				<div class="col-1 col-md-4"></div>
			</div>	
		</div>
	</main>

	<footer class="mt-5">
		<div class="copyrights">
			<img src="<?php $this->path('assets/images/ecomp/logoNome.png')?>" alt="" width="120" class="d-inline" id="logo1">
			<br>
			Copyright © <b>EcompJr</b>. 2017
		</div>
	</footer>
	
		<?php $this->loadJavascript()?>
		<script src="<?php $this->path('assets/js/register.js')?>"></script>
	</body>
</html>