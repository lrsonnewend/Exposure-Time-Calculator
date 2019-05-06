 <?php 
 	session_start();

 	include '../libs/phplot-6.2.0/phplot.php';

 	/** getting values used in Output */
	$time = isset($_SESSION['results']['timeExposure']) ? $_SESSION['results']['timeExposure'] : 0;
	$sigmaP = isset($_SESSION['results']['sigmaP']) ? $_SESSION['results']['sigmaP']: 0;
	$sigmaV = isset($_SESSION['results']['sigmaV']) ? $_SESSION['results']['sigmaV']: 0; 
	$snr = isset($_SESSION['results']['snr']) ? $_SESSION['results']['snr']: 0;
	$data = $_SESSION['results']['dataSet'];
	
	$GLOBALS['time'] = $time;
	$GLOBALS['sigmaP'] = $sigmaP;
	/** Build Graph */
	function annotate_plot($img, $plot)
	{
		//global $time, $sigmaP;
		# Allocate our own colors, rather than poking into the PHPlot object:
		$green = imagecolorresolve($img, 0, 216, 0);
		# Get the pixel coordinates of the data points for the best and worst:
		list($time_x, $sigma_y) = $plot->GetDeviceXY($GLOBALS['time'], $GLOBALS['sigmaP']);
		# Draw ellipses centered on those two points:
		imageellipse($img, $time_x, $sigma_y, 50, 20, $green);
		# Place some text above the points:
		$font = '3';
		$fh = imagefontheight($font);
		$fw = imagefontwidth($font);
	}

	$plot = new PHPlot(1200,600);
	$plot->SetFailureImage(False); // No error images
	$plot->SetPrintImage(False); // No automatic output
	$plot->SetDataValues($data);
	$plot->SetDataType('data-data');
	$plot->SetTitle("Polarization Error X Time");
	$plot->SetXLabelType('data');
	$plot->SetXTitle("Integration Time (s)");
	$plot->SetPrecisionX(0);
	$plot->SetYLabelType('data');
	$plot->SetYTitle("Polarization Error (%)");
	$plot->SetPrecisionY(3);

	$plot->SetFontGD('y_label', 4);
	$plot->SetFontGD('x_label', 4);
	$plot->SetFontGD('x_title', 5);
	$plot->SetFontGD('y_title', 5);

	# Force the bottom of the plot to be at Y=0, and omit
	# the bottom "$0M" tick label because it looks odd:
	$plot->SetPlotAreaWorld(NULL, 0);
	$plot->SetSkipBottomTick(True);

	# Establish the drawing callback to do the annotation:
	$plot->SetCallback('draw_all', 'annotate_plot', $plot);

	$plot->DrawGraph();
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>ETC Results</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../css/css-output.css">
</head>
<body>
	<!-- Begin Output View -->
	<div class="output" id="output">
		<!-- Begin Final values -->
		<section class="values">
			<h2> Final values</h2>
			<?php
				echo '<span>Integration time: </span> '.number_format($time,3).' s<br>';
				echo '<span>Error of the linear polarization: </span> '.number_format($sigmaP,3).' %<br>';
				if($sigmaV!=0)
				{
					echo '<span>Error of the circular polarization:</span> '.number_format($sigmaV,3).' %<br>';
				}	
				echo '<span> Integrated signal noise ratio of one waveplate position: </span> '.number_format($snr,2).'<br>';
			?>
			<button onclick="window.print()" style="font-size: 15pt;">Print results</button>
		</section>
		<!--End Final values -->
		<!-- Begin Input values -->
		<section>
			<h4>Input Values</h4>
			<?php
				session_start();
				echo 'Magnitude: '.$_SESSION['results']['inMag'].' mag<br>';
				if($_SESSION['inTime']!=0)
				{
					echo 'Integration time: '.$_SESSION['results']['inTime'] .' s<br>';
				}
				echo 'Number of Waveplate position: '.$_SESSION['results']['inNwp'].'<br>';
				echo 'Waveplate: '.$_SESSION['results']['inWave'].'<br>';
				if($_SESSION['results']['inSigmaP']!=0)
				{
					echo 'Error of the linear polarization: '.$_SESSION['results']['inSigmaP'].' %<br>';
				}
				echo 'Telescope Diameter: '.$_SESSION['results']['inDTel'].' m<br>';
				if($_SESSION['results']['inFocal']==0)
				{
					echo 'Focal Reducer: No <br>';
				}
				else
				{
					echo 'Focal Reducer: Yes <br>';
				}
				echo 'Filter: '.$_SESSION['results']['inFilter'].'<br>'; 
				echo 'Sky quality: '.$_SESSION['results']['inTsky'].'<br>';
				echo 'Air Mass: '.$_SESSION['results']['inAirMass'].'<br>';
				echo 'Aperture radius: '.$_SESSION['results']['inAperture'].' arcsec<br>';
				echo 'Moon Phase: '.$_SESSION['results']['inMoon'].'<br>';
			?>
		</section>
		<!-- End final values -->
		<!--Begin intermediate values -->
		<section id="intermediate-values">
			<h4>Intermediate values</h4>
			<?php
				session_start();
				//observation
				echo 'Number of pixels corresponding to the aperture radius: '.number_format($_SESSION['results']['numberPixels'],2).'<br>';
				echo 'Number of photons from the source per second: '.number_format($_SESSION['results']['numberPhotons'],2).'<br>';
				//filter
				echo 'Filter effective wavelength: '.$_SESSION['results']['central'].'<br>';
				echo 'Filter width: '.$_SESSION['results']['band'].' micron<br>';
				echo 'Flux of zero magnitude: '.$_SESSION['results']['fluxZero'].' 10<sup>-23</sup>W m<sup>-2</sup> Hz<sup>-1</sup><br>';
				// instrument
				echo 'Plate scale: '.$_SESSION['results']['plateScale'].' arcsec/pix<br>';
				echo 'Quantum efficiency: '.$_SESSION['results']['quantumEfficiency'].'<br>';
				echo 'Readout noise: '.$_SESSION['results']['readoutNoise'].' e<sup>-</sup><br>';
				echo 'Gain: '.$_SESSION['results']['gain'].' e<sup>-</sup>/ADU<br>';
				echo 'Sky Transparency: '.number_format($_SESSION['results']['tSky'],3).'<br>';
				echo 'Sky magnitude: '.$_SESSION['results']['magSky'].' mag<br>';
				echo 'Number of photons from the sky per second per pixels: '.number_format($_SESSION['results']['nSky'],2).'<br>';
				echo 'Fcalib: '.$_SESSION['results']['fCalib'].'<br>';
				echo 'Binning: '.$_SESSION['results']['binning'].'<br>';
			?>
		</section>
		<!-- End intermediate values -->	
		<!-- End Output View -->
	</div>
	<div id="divGraph" class="output">
		<br>
		<br>
		<img src="<?php echo $plot->EncodeImage();?>" alt="Graph Polarization Error X Time">
	
	<br>
		<button onclick="window.print()" style="font-size: 15pt;">Print results</button>
	</div>
	<footer id="footer">
		<p>Calculated by Exposure Time Calculator/IAGPOL</p>
		<?php 	echo "<p>".date("F j, Y, g:i:s a")."</p>";?>
		<p>Developed in CEA/INPE</p>
	</footer>
</body> 
</html>