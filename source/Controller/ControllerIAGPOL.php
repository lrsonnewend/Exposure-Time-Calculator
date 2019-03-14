<?php
	session_start();	
	include '../Model/Filter.php'; 
	include '../Model/CCD.php';
	include '../Model/Instrument.php';
	include '../Model/Sky.php';
	include '../Model/Observation.php';
	include '../Model/Graphics.php';
	
	$magnitude = $_POST['tMag'];
	$nwp = $_POST['tNwp'];
	$wave = $_POST['tWave'];
	$binning = $_POST['tBin'];
	$dTel = $_POST['tTel'];
	$detector = $_POST['tCCD'];
	$focal = $_POST['tFocal'];
	$filter = $_POST['tFilter'];
	$moon = $_POST['tMoon'];
	$tSky = $_POST['tSky'];
	$airMass = $_POST['tAirMass'];
	$aperture = $_POST['tAperture'];
	$sigmaP = $_POST['tSigmaP'];
	$time = $_POST['tTemp'];
	$mode = $_POST['tMode'];
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
 		$inTime = $time;
		$inSigma = 0;
 		$observation->setTimeExposure(1,$time);
 		//Generate values according WavePlate 
 		if($wave=='1/2')
 		{
 			$observation->setSignalNoiseRatio(1,$observation->getNumberPhotons(), $time, $observation->getNumberPixels(), $sky->getNumberPhotons(), $instrument->getCCD()->getReadoutNoise(),$instrument->getCCD()->getGain(), $ccd->getBinning());
			$observation->setSigmaP(1, $observation->getSignalNoiseRatio(),$nwp); 
 		}
 		elseif ($wave=='1/4')
 		{	
 			$observation->setSignalNoiseRatio(1,$observation->getNumberPhotons(), $time, $observation->getNumberPixels(), $sky->getNumberPhotons(), $instrument->getCCD()->getReadoutNoise(),$instrument->getCCD()->getGain(), $ccd->getBinning());
			$observation->setSigmaP(2, $observation->getSignalNoiseRatio(),$nwp); 
			$observation->setSigmaV($observation->getSigmaP()); 
 		}
 	}
 	else
 	{
 		$inTime = 0;
		$inSigma = $sigmaP;
 		// Generate values according WavePlate
 		if($wave=='1/2')
 		{
 			$observation->setSigmaP(3,0,0,$sigmaP);
 			$observation->setSignalNoiseRatio(2,0,0,0,0,0,0,0,1,$sigmaP,$instrument->getNumberWavePlates());
 			$observation->setTimeExposure(2,0, $observation->getNumberPhotons(), $observation->getSignalNoiseRatio(), $observation->getNumberPixels(), $sky->getNumberPhotons(), $instrument->getCCD()->getReadoutNoise(), $instrument->getCCD()->getGain(), $ccd->getBinning());
 		}
 		elseif ($wave=='1/4')
 		{
 			$observation->setSigmaP(3,0,0,$sigmaP);
 			$observation->setSigmaV($observation->getSigmaP());
 			$observation->setSignalNoiseRatio(2,0,0,0,0,0,0,0,sqrt(2),$sigmaP,$instrument->getNumberWavePlates());
 			$observation->setTimeExposure(2,0, $observation->getNumberPhotons(), $observation->getSignalNoiseRatio(), $observation->getNumberPixels(), $sky->getNumberPhotons(), $instrument->getCCD()->getReadoutNoise(), $instrument->getCCD()->getGain(),$ccd->getBinning());
 		}
 	}
 	$snr = $observation->getSignalNoiseRatio();
	$sigmaP = $observation->getSigmaP();
		$sigmaV = $observation->getSigmaV();
	//Generate Data set
 	$graph = new Graphics($observation, $sky, $instrument);
	$data = $graph->generateValues($observation->getTimeExposure(), $nwp, $wave);
	$results = array(
				'inMag' => $magnitude,
				'inNwp' => $nwp,
				'inWave' => $wave,
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
				'sigmaP' => $sigmaP,
				'sigmaV' => $sigmaV,
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
 	header("location: ../../etc/views/outputIAGPOL.php");
?>