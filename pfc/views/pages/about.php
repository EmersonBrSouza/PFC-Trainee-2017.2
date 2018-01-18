<html>
	<head>
		<title>PFC - Como funciona?</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<?php $this->loadCSS()?>
	</head>
	<body class="d-flex flex-column">

		<?php $this->loadHeader()?>
		
		<div class="container flex-grow">
			
			<section id="definicao" class="mt-4">
				
				<div class="col-12">
					<h5 class="tituloSecao">O que é o PFC?</h5>
					<div class="descricao">
						<span>
							O Programa de Fomento à Capacitação é um mecanismo fornecido pela EcompJr que visa auxiliar o desenvolvimento técnico e/ou administrativo dos seus membros. O PFC se baseia em um sistema de pontos que são obtidos pelos membros com a realização de projetos. <br><a id="link-pontuacao" href="#pontuacao">Ver informações sobre pontuação</a>
						</span> 
					</div>	
				</div>
				
			</section>				
			
			<section id="participantes" class="mt-4">
				
				<div class="col-12">
					<h5 class="tituloSecao">Quem pode participar?</h5>
					<div class="descricao">
						<span>
							Qualquer membro efetivo da EcompJr, terá direito a participar desse programa que estimula a capacitação do membro em eventos que serão pagos <b>integralmente</b> ou <b>parcialmente</b> pela empresa.
						</span> 
					</div>	
				</div>
				
			</section>	
			
			<section id="regras" class="mt-4">
				
				<div class="col-12">
					<h5 class="tituloSecao">Regras</h5>
					<div class="row justify-content-around">
						<div class="card col-12 col-md-3 mt-3">
						 <img class="card-img-top" src="<?php $this->path('assets/images/svg/regra1.svg')?>" alt="Card image cap">
						  <div class="card-body">
						    <p class="card-text">Membros desligados da empresa perderão os pontos acumulados, sendo destinado os pontos para a empresa.</p>
						  </div>
						</div>
						
						<div class="card col-12 col-md-3 mt-3">
						  <img class="card-img-top" src="<?php $this->path('assets/images/svg/regra2.svg')?>" alt="Card image cap">
						  <div class="card-body">
						    <p class="card-text">Serão permitidas <b>apenas</b> participações em eventos que tragam algum retorno <b>técnico</b> ou <b>administrativo</b> para o membro.</p>
						  </div>
						</div>	

						<div class="card col-12 col-md-3 mt-3">
						  <img class="card-img-top" src="<?php $this->path('assets/images/svg/regra3.svg')?>" alt="Card image cap">
						  <div class="card-body">
						    <p class="card-text">Cada pessoa <b>não</b> poderá ter uma pontuação que <b>exceda 250 pontos</b> em um único projeto, sendo assim, o excedente será destinado a empresa.</p>
						  </div>
						</div>	
					</div>
					
					<br>
					<span class="observacao"><i>Obs: O membro receberá um apoio proporcional a quantidade de pontos que tiver acumulado. O apoio será feito em forma de reembolso que será realizado após apresentação do comprovante de pagamento. O comprovante deverá ficar com a empresa para comprovar o destino do dinheiro.</i> </span>
				</div>
				
			</section>	

			<section id="pontuacao" class="mt-4">
				
				<div class="col-12">
					<h5 class="tituloSecao">Pontuação</h5>
					<div class="row justify-content-around">					
						
						<div class="col-12 col-md-4 mt-4 mr-sm-4">
							<div class="row">
								<div class="grafico-maioria grafico-80"><center>80%</center></div>
								<div class="grafico-minoria grafico-20"><center>20%</center></div>
							</div>
						</div>

						<div class="card col-12 col-md-7 mt-md-4">
						  <div class="card-body">
						    <p class="card-text">A empresa ficará com 80% do valor do projeto e 20% do valor ficará para a equipe desenvolvedora do projeto.</p>
						  </div>
						</div>
												
						<div class="col-12 col-md-4 mt-4 mr-sm-4">
							<div class="row">
								<div class="grafico-maioria grafico-81"><center>81.25%</center></div>
								<div class="grafico-minoria grafico-18"><center>18.75%</center></div>
							</div>
						</div>

						<div class="card col-12 col-md-7 mt-md-4">
						  <div class="card-body">
						    <p class="card-text">O valor recebido pela empresa (80%) é dividido, resultando em 18.75% do valor para ser dividido entre os diretores e os 81.25% restantes sendo destinados para a empresa.</p>
						  </div>
						</div>
										
						<div class="col-12 col-md-4 mt-4 mr-sm-4">
							<div class="row">
								<div class="grafico-maioria grafico-90"><center>90%</center></div>
								<div class="grafico-minoria grafico-10"><center>10%</center></div>
							</div>
						</div>

						<div class="card col-12 col-md-7 mt-md-4">
						  <div class="card-body">
						    <p class="card-text">O valor recebido pela equipe (20%) é dividido entre os membros e o prospector do projeto. 10% do valor vai para o prospector<b>*</b> e os 90% restantes são divididos entre os membros da equipe.</p>
						  </div>
						</div>								
						

					</div>
				</div>
					<br>
					<span class="observacao"><i><b>*</b> Caso o membro que realizou a prospecção esteja ligado a alguma atividade que de certa forma já seja responsável por isso (e.g. Assessor de vendas), este receberá apenas 5%, sendo os outros 5% destinados à empresa.
					</i> </span>
				</div>
			</section>	


			<?php $this->loadFooter()?>
			<?php $this->loadJavascript()?>
		</div>
			
			
	</body>
</html>