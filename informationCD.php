<?php include($_SERVER['DOCUMENT_ROOT']."/include/functions.php"); ?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" dir="ltr">
<head>
	<title>INPE/ETC</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta content="width=device-width, initial-scale=1.0" name="viewport" />

	<link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon" />
	<link rel="apple-touch-icon" href="/img/favicon.png" />

	<link media="screen" href="/css/plone.css" type="text/css" rel="stylesheet" id="plone-css" />    
	<link media="all" href="/css/main.css" type="text/css" rel="stylesheet" id="main-css" />  
	<link media="all" href="/css/style.css" type="text/css" rel="stylesheet" id="style-css" />

	<link media="all" href="/css/css-intranet-inpe.css" rel="stylesheet" id="intranet-css" /> 
	<link media="all" href="/css/css-menu.css" rel="stylesheet" id="menu-css" /> 
	<link media="all" rel="stylesheet" type="text/css" href="/css/css-servico-inpe.css"/>
	<link media="all" href="/css/css-branco-inpe.css" rel="stylesheet">   

	<!-- CONTRASTE -->
	<link media="all" href="/css/css-intranet-inpe-contraste.css" rel="stylesheet" id="intranet-css-contraste" /> 
	<link media="all" href="/css/css-menu-contraste.css" rel="stylesheet" id="menu-css-contraste" />   

	<script src="/js/jquery/jquery-1.9.1.js" type="application/javascript"></script>  
	<script src="/js/jquery/jquery.cookie.js" type="application/javascript"></script>  
	<script src="/js/functions.js" type="application/javascript"></script>


</head>

<body>
	<!-- TOPO -->    
	<?php include("etc/views/topo.php"); ?>


	<!-- CONTEUDO -->
	<div id="main" role="main">
		<div id="plone-content">

			<div id="portal-columns" class="row">

				<!-- RASTRO -->
				<div id="viewlet-above-content">
					<div id="portal-breadcrumbs">
						<span id="breadcrumbs-you-are-here">
							Você está aqui: 
							<span>
								<?= rastro();?>
							</span>
						</span>
					</div>
				</div>


				<!-- Column 1 - MENU -->      
				<?php include("etc/views/menuCD.php"); ?>	

				<!-- Conteudo -->
				<div id="portal-column-content" class="cell width-3:4 position-1:4">

					<div id="main-content">    
						<div id="content">

							<h1 class="documentFirstHeading">Information ETC - CÂMERA DIRETA</h1>

							
                            <br/>

							<p>The file will be downloaded automatically.</p>	
							<br/>
									<iframe src="docs/calculo_erro_polarizacao.pdf"></iframe>													
                            <p>
                            <strong>Desenvolvido por <a href="http://www.cea.inpe.br/" title="Acesse COCTI/INPE" target="_blank">CEA/INPE</a></strong>
                            </p>
							
                            <div class="clear"></div>


						</div>
					</div>
				</div>
				<!-- Fim do Conteudo -->            


				<div class="clear"><!-- --></div>
				<div id="voltar-topo"><a href="#topo" title="Acesse Voltar para o topo">Voltar para o topo</a></div>


			</div>
		</div>
	</div>
	<!-- FIM CONTEUDO -->

	<div class="clear"><!-- --></div>

	<!-- Footer -->
	<?php include("etc/views/rodape.php"); ?>
	<!-- /Footer-->

</body>  
</html>