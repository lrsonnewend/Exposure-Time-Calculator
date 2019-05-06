<?php
	session_start();	
	include '../Model/Filter.php'; 
	include '../Model/CCD.php';
	include '../Model/Instrument.php';
	include '../Model/Sky.php';
	include '../Model/Observation.php';
	include '../Model/Graphics.php';
	
	$magnitude = $_POST['tMagCD'];
	$binning = $_POST['tBinCD'];
	$nwp = 1;
	$wave = 1;
	$dTel = $_POST['tTelCD'];
	$detector = $_POST['tCCD'];
	$focal = $_POST['tFocalCD'];
	$filter = $_POST['tFilterCD'];
	$moon = $_POST['tMoonCD'];
	$tSky = $_POST['tSkyCD'];
	$airMass = $_POST['tAirMassCD'];
	$aperture = $_POST['tApertureCD'];
	$sigmaM = $_POST['tSigmaM'];
	$time = $_POST['tTempCD'];
	$mode = $_POST['tModeCD'];
	$detector = json_decode($detector);
	
	$filtro =  new Filter($filter);       
	$ccd = new CCD($detector->serialNumber, $detector->mode, $filter, $binning);
	
	$instrument = new Instrument($nwp,$dTel, $focal ,$ccd);
	$instrument->setFArea(0.804);
	//$instrument->setTTel($filter);
	$instrument->setTInstr($focal);
	$instrument->setTFilter($filter);
	
		
	$sky = new Sky($tSky, $airMass,$filter, $moon , $instrument->getCCD()->getQuanTumEfficiency(), $filtro->getFluxZero(), $filtro->getFilterWidth(), $filtro->getEffectiveLenght(), $instrument->getAperture(), $instrument->getPlateScale(),1, $ccd->getBinning(), $instrument->getFArea(), $instrument->getTInstr(), $instrument->getTFilter());
	
	$observation = new Observation($instrument->getCCD()->getQuanTumEfficiency(), $sky->getTransparencySky(), $filtro->getFluxZero(), $filtro->getFilterWidth(), $filtro->getEffectiveLenght(), $instrument->getAperture(), $magnitude, $aperture, $instrument->getPlateScale(), 1, $ccd->getBinning(), $instrument->getFArea(), $instrument->getTInstr(), $instrument->getTFilter());
 	
 	// Defining mode
	if($mode==1)
 	{
 
 		$observation->setTimeExposure(1,$time);
 		//Generate values according WavePlate 
 		
 		$observation->setSignalNoiseRatioCD(1,$observation->getNumberPhotons(), $time, $observation->getNumberPixels(), $sky->getNumberPhotons(), $instrument->getCCD()->getReadoutNoise(),$instrument->getCCD()->getGain(), $ccd->getBinning());

		$observation->setSigmaM(1, $observation->getSignalNoiseRatioCD(), $nwp);

 	}

 	else
 	{
 

		$observation->setSigmaM(3,0,0,$sigmaM);

		$observation->setSignalNoiseRatioCD(2,0,0,0,0,0,0,0,1,$sigmaM,$nwp);

		$observation->setTimeExposure(2,0, $observation->getNumberPhotons(), $observation->getSignalNoiseRatioCD(), $observation->getNumberPixels(), $sky->getNumberPhotons(), $instrument->getCCD()->getReadoutNoise(), $instrument->getCCD()->getGain(), $ccd->getBinning(), $observation->getSigmaM());

		

 	
	}

	$snr = $observation->getSignalNoiseRatioCD();
	$sigmaM = $observation->getSigmaM();
 	
	//Generate Data set
	$graph = new Graphics($observation, $sky, $instrument);
 	$data = $graph->generateValuesCD($observation->getTimeExposure(), $nwp);
	
	$results = array(
				'inMag' => $magnitude,
				//'inNwp' => $nwp,
				//'inWave' => $wave,
				'inDTel' => $dTel,
				'inFocal' => $focal,
				'inTSky' => $tSky, 
				'inAperture' => $aperture,
				'inMoon' => $moon,
				'inAirMass' => $airMass,
				'inTime' => $inTime,
				'inSigma' => $inSigma,
				'inFilter' => $filter,
				'inTsky' => $tSky,
				'numberPixels' => $observation->getNumberPixels() ,
				'numberPhotons' => $observation->getNumberPhotons(),
				'timeExposure' =>  $observation->getTimeExposure(),
				'snr' => $snr,
				'sigmaM' => $sigmaM,
				//'sigmaV' => $sigmaV,
				'fCalib' => $observation->getFcalib(),
				'fluxZero' => $filtro->getFluxZero(),
				'tFilter' => $instrument->getTFilter(),
				//'tTel' => $instrument->getTTel(),
				'central' => $filtro->getEffectiveLenght(),
				'band' => $filtro->getFilterWidth(),
				'quantumEfficiency' => $instrument->getCCD()->getQuanTumEfficiency(),
				'gain' => $instrument->getCCD()->getGain(),
				'readoutNoise' => $instrument->getCCD()->getReadoutNoise(),
				'plateScale' => $instrument->getPlateScale(),
				'binning' => $ccd->getBinning(),
				'tSky' => $sky->getTransparencySky(),
				'magSky' =>  $sky->getMagnitudeSky(),
				'nSky' =>  $sky->getNumberPhotons(),
				'dataSet' => $data,
			);
		
 	$_SESSION['results'] = $results;
 	header("location: ../../etc/views/outputCD.php");
?>