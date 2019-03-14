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
				<?php include("views/menu.php"); ?>	

				<!-- Conteudo -->
				<?php include("etc/views/menu.php"); ?>
				<div id="portal-column-content" class="cell width-3:4 position-1:4">

					<div id="main-content">    
						<div id="content">

							<h1 class="documentFirstHeading">About</h1>

							<p>This Exposure Time Calculator (ETC) was developed in INPE by Lucas Salvador and Lucas Sonnewend and is in version 2.0. It works for the IAGPOL, CCD Imager and SPARC4 instruments installed at Observatory Pico dos Dias.</p>
							<p>The ETC was developed in PHP 5.6, HTML 5, CSS 3 and JavaScript. The trio HTML, CS3 and JavaScript were used to build the interface of the site.The PHP is used to perform the calculation and to generate the graph. The graph is created using the<a href="http://phplot.org/" target="_blank"> PHPlot Library.</a></p>
						   	<p>The code is available <a href="https://github.com/lrsonnewend/Exposure-Time-Calculator" target="_blank">here</a> and it is licensed under the GNU General Public License v2.0.</p>
						   	<p>If you find an error, please send us an email to Claudia Rodrigues (<?php echo file_get_contents("./static/claudia.txt");?>).

							<br><br>
                            
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
