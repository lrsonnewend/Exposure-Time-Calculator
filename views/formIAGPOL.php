<!DOCTYPE html>

<?php include($_SERVER['DOCUMENT_ROOT']."/include/functions.php"); ?>

<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" dir="ltr">
<head>
	<title>INPE/ETC</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta content="width=device-width, initial-scale=1.0" name="viewport" />

	<link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon" />
	<link rel="apple-touch-icon" href="../img/favicon.png" />

	<link media="screen" href="../../css/plone.css" type="text/css" rel="stylesheet" id="plone-css" />    
	<link media="all" href="../../css/main.css" type="text/css" rel="stylesheet" id="main-css" />  
	<link media="all" href="../../css/style.css" type="text/css" rel="stylesheet" id="style-css" />

	<link media="all" href="../../css/css-intranet-inpe.css" rel="stylesheet" id="intranet-css" /> 
	<link media="all" href="../../css/css-menu.css" rel="stylesheet" id="menu-css" /> 
	<link media="all" rel="stylesheet" type="text/css" href="../css/css-servico-inpe.css"/>
	<link media="all" href="../../css/css-branco-inpe.css" rel="stylesheet">   

	<!-- CONTRASTE -->
	<link media="all" href="../../css/css-intranet-inpe-contraste.css" rel="stylesheet" id="intranet-css-contraste" /> 
	<link media="all" href="../../css/css-menu-contraste.css" rel="stylesheet" id="menu-css-contraste" /> 

	<script src="/js/jquery/jquery-1.9.1.js" type="application/javascript"></script>  
	<script src="/js/jquery/jquery.cookie.js" type="application/javascript"></script>  
	<script src="/js/functions.js" type="application/javascript"></script>

	<!-- css do modal -->
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"/>  
	<!-- JS da página -->
	<script type="application/javascript" src="../js/indexJS.js"></script>
	<!--css adicional da página-->
	<link rel="stylesheet" type="text/css" href="../css/css-index.css">
</head>

<body onkeypress="key(event)">
	<!-- TOPO -->    
	<?php include("topo.php"); ?>


	<!-- CONTEUDO -->
	<div id="main" role="main">
		<div id="plone-content">

			<div id="portal-columns" class="row">



				<!-- Column 1 - MENU -->      
				<?php include("menu.php"); ?>	

				<!-- Conteudo -->
				<div id="portal-column-content" class="cell width-3:4 position-1:4">

					<div id="main-content">    
						<div id="content">

							<h1 class="documentFirstHeading">Exposure Time Calculator - IAGPOL </h1>
							<section>
								<!-- Introduction -->
								<p>The Exposure Time Calculator (ETC) is a tool to estimate the exposure time required to achieve a given polarization error or the polarization error obtained using a given exposure time. The ETC works for the IAGPOL instrument installed at the Pico dos Dias Observatory (OPD). Details about the calculations can be found clicking on “Information” in the lateral menu.</p>
	                            <br/>
                            </section>
                            <strong>ETC</strong>
							<br>
							<!--Form -->
							<form method="post" id="fEtc" name="etcForm" action="../source/Controller/ControllerIAGPOL.php">
								<fieldset>
									<p>
										<label for="cMag">Magnitude</label><br>
										<input type="Number" name="tMag" id="cMag" min="0" max="23" size="15" value="15"  step="0.01" required/><font>mag</font>
									</p>
									<p>
										<label for="cNwp">Number of WavePlate positions</label>
										<br>
										<select name="tNwp" id="cNwp">
											<option value="4">4</option>
											<option value="8" selected="selected">8</option>
											<option value="12">12</option>
											<option value="16">16</option>
										</select>
									</p>
									<p>
										<!--Descobrir como isso interfere nos cálculos-->
										<label>WavePlate</label><br>
										<input type="radio" name="tWave" id="cWave1" checked="checked"  value="1/2"/>
											<label for="cWave1">1/2 wave</label>
											<input type="radio" name="tWave" id="cWave2" value="1/4"/>
											<label for="cWave2">1/4 wave</label>
									</p>
									<p>
										<label for="cBin">Binning</label>
										<br>
										<select name="tBin" id="cBin">
											<option value="1" selected="selected">1x1</option>
											<option value="2">2x2</option>
											<option value="3">3x3</option>
											<option value="4">4X4</option>
											<option value="5">5X5</option>
										</select>
									</p>
									<p>
										<label>Telescope</label><br>
										<input type="radio" name="tTel" id="cTel1" value="0.6">
										<label for="cTel1">0.6m</label>
										<input type="radio" name="tTel" id="cTel2" checked value="1.6">
										<label for="cTel2">1.6m</label>
									</p>
									<p>
										<label for="">Detector</label><br><bt>
										<!-- Begin Modal -->
											<a onclick="document.getElementById('id01').style.display='block'" class="w3-button w3-blue">Click to choose a CCD</a>
											<div id="id01" class="w3-modal">
											 <div class="w3-modal-content w3-card-4 w3-animate-zoom">
											  <header class="w3-container w3-blue"> 
											   <span onclick="document.getElementById('id01').style.display='none'" 
											   class="w3-button w3-blue w3-xlarge w3-display-topright">&times;</span>
											   <h2>CCDs</h2>
											  </header>
											  <!-- Realiza as transições de tabs -->
											  <div class="w3-bar w3-border-bottom">
											   <a class="tablink w3-bar-item w3-button" onclick="openTab(event, '105')">CCD 105</a>
											   <a class="tablink w3-bar-item w3-button" onclick="openTab(event, '106')">CCD 106</a>
											   <a class="tablink w3-bar-item w3-button" onclick="openTab(event, 'iKon-L936-BV')">iKon - 9867 & 10127</a>
											   <a class="tablink w3-bar-item w3-button" onclick="openTab(event, 'iKon-L936-EX')">iKon - 14912 & 17587</a>
											   <a class="tablink w3-bar-item w3-button" onclick="openTab(event, 'iKon-L936-BR')">iKon - 13739 & 13740 & 17588</a>
											   <a class="tablink w3-bar-item w3-button" onclick="openTab(event, 'iXon-DU-888E-C00-#BV')">iXon - 4269 & 4335</a>
											   <!--<a class="tablink w3-bar-item w3-button" onclick="openTab(event, '19002')">iKon - 19002</a>-->
											  </div>
											  <!-- Begin Table -->
											 	<?php include("tabelasCCDIAGPOL.php"); ?>
											  <!-- End Table -->

											  <div class="w3-container w3-light-grey w3-padding">
											   <a class="w3-button w3-right w3-white w3-border" 
											   onclick="document.getElementById('id01').style.display='none'">Close</a>
											  </div>
											 </div>
											</div>
										<!-- End Modal -->
									</p>
									<p>	<label>Focal Reducer</label><br>
										<input type="radio" name="tFocal" id="cFocal1" value="1">
										<label for="cFocal1">Yes</label>
										<input type="radio" name="tFocal" id="cFocal2" checked value="0">
										<label for="cFocal2">No</label>
									</p>
									<p>									
										<label>Filter</label><br>
										<input type="radio" name="tFilter" id="cFil1" value="U">
										<label for="cFil1">U</label>&nbsp;&nbsp;
										<input type="radio" name="tFilter" id="cFil2" value="B">
										<label for="cFil2">B</label>&nbsp;&nbsp;
										<input type="radio" name="tFilter" id="cFil3" checked value="V">
										<label for="cFil3">V</label>&nbsp;&nbsp;
										<input type="radio" name="tFilter" id="cFil4" value="R">
										<label for="cFil4">R</label>&nbsp;&nbsp;
										<input type="radio" name="tFilter" id="cFil5" value="I">
										<label for="cFil5">I</label>
									</p>
									<p>
										<label>Moon Phase</label><br>
										<input type="radio" name="tMoon" id="cMoon1" checked="checked" value="new">
										<label for="cMoon1">New</label>
										<input type="radio" name="tMoon" id="cMoon2" value="quarter">
										<label for="cMoon2">Quarter</label>
										<input type="radio" name="tMoon" id="cMoon3" value="full">
										<label for="cMoon3">Full</label>
									</p>
									<p>
										<label>Sky quality</label><br>
										<input type="radio" name="tSky" id="cSky1" checked value="photometric">
										<label for="cSky1">Photometric</label>
										<input type="radio" name="tSky" id="cSky2" value="good">
										<label for="cSky2">Good</label>
										<input type="radio" name="tSky" id="cSky3" value="regular">
										<label for="cSky3">Regular</label>
									</p>
									<p>
										<label for="cAperture">Air Mass</label><br>
										<input type="Number" name="tAirMass" id="cAirMass" value="1" size="15" min="1" max="3" step="0.01" required>
									</p>
									<p>
										<label for="cAperture">Aperture radius</label><br>
										<input type="Number" name="tAperture" id="cAperture" value="2" size="15" min="0" max="30" step="0.01" required><font>arcsec</font>
									</p>
									<p>	<label>ETC Mode</label><br>
										<a onclick="changeState('boxTime','block','boxSigma','none')">
											<input type="radio" name="tMode" id="cMode1" value="1" required>
										</a>
										<label for="cMode1">Calculate the polarization error for a given integration time</label></br>
										<a onclick="changeState('boxSigma', 'block','boxTime','none')">
											<input type="radio" name="tMode" id="cMode2" value="0">
										</a>
										<label for="cMode2">Calculate the integration time  for a given polarization error </label>
									</p>
									<p>
										<div id="boxTime">
											<label for="tTime">Integration time</label><br>
											<input type="Number" name="tTime" id="cTime" min="1" max="100000" size="15" value="60" /><font>s</font>
										</div>
									</p>
									<p>
										<div id="boxSigma">
											<label for="cSigma">Sigma</label><br>
											<input type="Number" name="tSigmaP" id="cSigmaP" size="15" value="0.1" step="0.0001" min="0.0001"><font>%</font>
										</div>
									</p>
									
								<a href="outputIAGPOL.php" title="Calculate">Calculate
								<input type="reset" name="breset" value="Reset Values">
								
								</fieldset>

							</form>
							<!-- End of Form -->   
                            <strong>Desenvolvido por <a href="http://www.cea.inpe.br/" title="Acesse COCTI/INPE" target="_blank">CEA/INPE</a></strong>
                            </p>
                            <div class="clear"></div>
						</div>
					</div>
				</div>
				<!-- Fim do Conteudo -->            

				<div class="clear"></div>
				<div id="voltar-topo"><a href="#topo" title="Acesse Voltar para o topo">Voltar para o topo</a></div>


			</div>
		</div>
	</div>
	<!-- FIM CONTEUDO -->

	<div class="clear"><!-- --></div>

	<!-- Footer -->
	<?php include("rodape.php"); ?>
	<!-- /Footer-->

</body>  
</html>
