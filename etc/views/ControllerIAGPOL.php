<?php 
 /**
 * Class resposible to control the flux of ETC
 * @author: Lucas Almeida Salvador
 */
	session_start();	
	include '../Model/Filter.php'; 
	include '../Model/Sky.php';
	include '../Model/CCD.php';
	include '../Model/Instrument.php';
	include '../Model/Observation.php';
	include '../Model/Graphics.php';

	/** Getting input values*/
	$magnitude = isset($_POST['tMag'])? $_POST['tMag'] : 15;
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
	$aperture = isset($_POST['tAperture'])? $_POST['tAperture']: 2;
	$sigmaP = isset($_POST['tSigmaP']) ? $_POST['tSigmaP']: 0;
	$time = isset($_POST['tTemp']) ? $_POST['tTemp']: 0;
	$mode = $_POST['tMode'];
	
	/** Build CCD, Filter, Instrument and Sky Objects */
	$filtro =  new Filter($filter);       
	$ccd = new CCD($detector, $filter, $binning);
	$instrument = new Instrument($nwp, $dTel, $focal, $ccd);
	$sky = new Sky($tSky, $airMass,$filter, $moon , $instrument->getCCD()->getQuanTumEfficiency(), $filtro->getFluxZero(), $filtro->getFilterWidth(), $filtro->getEffectiveLenght(), $instrument->getAperture(), $instrument->getPlateScale(),1, $ccd->getBinning());
	/** Build Observation Object */
	$observation = new Observation($instrument->getCCD()->getQuanTumEfficiency(), $sky->getTransparencySky(), $filtro->getFluxZero(), $filtro->getFilterWidth(), $filtro->getEffectiveLenght(), $instrument->getAperture(), $magnitude, $aperture, $instrument->getPlateScale(), 1, $ccd->getBinning());
	
	/** Generate the values according ETC mode choiced 
		if Mode=1 Int.Time -> Polarization Error 
		if Mode=2 Polarization Error -> Int.Time*/
 	if($mode==1)
 	{

 		$observation->setTimeExposure(1,$time);

 		/** Generate values according WavePlate*/
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

 		/** Generate values according WavePlate*/
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

 	//Saving values 
	$snr = $observation->getSignalNoiseRatio();
	$sigmaP = $observation->getSigmaP();
 	$sigmaV = $observation->getSigmaV();


 	//Generate Dataset to the Graph
 	$graph = new Graphics($observation, $sky, $instrument, $wave);
	$data = $graph->generateValues($observation->getTimeExposure(), $nwp, $wave);


 	//Keep the values

 	//Input values
	$_SESSION['inMag'] = $magnitude;
	$_SESSION['inNwp'] = $nwp;
	$_SESSION['inWave'] = $wave;
	$_SESSION['inDTel'] = $dTel;
	$_SESSION['inFocal'] = $focal;
	$_SESSION['inFilter'] = $filter; 
	$_SESSION['inTsky'] = $tSky;
	$_SESSION['inAperture'] = $aperture;
	$_SESSION['inMoon'] = $moon;
	$_SESSION['inAirMass'] = $airMass;
	


	if($mode == 1)
	{
		$_SESSION['inTime'] = $time;
		$_SESSION['inSigmaP']= 0;
	}
	else
	{
		$_SESSION['inTime'] = 0;
		$_SESSION['inSigmaP']= $sigmaP;
	}	

	//saving observation values
	$_SESSION['numberPixels'] = $observation->getNumberPixels();
	$_SESSION['numberPhotons'] =$observation->getNumberPhotons();
	$_SESSION['timeExposure'] = $observation->getTimeExposure();
	$_SESSION['snr'] = $snr;
	$_SESSION['sigmaP'] = $sigmaP;
 	$_SESSION['sigmaV'] = $sigmaV;
 	$_SESSION['fCalib'] = $observation->getFcalib();


	//filter
	$_SESSION['fluxZero']= $filtro->getFluxZero();
 	$_SESSION['central'] = $filtro->getEffectiveLenght();
 	$_SESSION['band'] = $filtro->getFilterWidth();


	// instrument
	$_SESSION['quantumEfficiency'] = $instrument->getCCD()->getQuanTumEfficiency();
 	$_SESSION['gain'] = $instrument->getCCD()->getGain();
 	$_SESSION['readoutNoise'] = $instrument->getCCD()->getReadoutNoise();
 	$_SESSION['plateScale'] = $instrument->getPlateScale();
 	$_SESSION['nwp'] = $instrument->getNumberWavePlates();
 	$_SESSION['dTel'] = $instrument->getAperture();
 	$_SESSION['focalReducer'] = $instrument->getFocalReducer();
 	$_SESSION['binning'] = $ccd->getBinning();

 	//SKY 
 	$_SESSION['tSky'] = $sky->getTransparencySky();
 	$_SESSION['magSky'] = $sky->getMagnitudeSky();
 	$_SESSION['nSky'] = $sky->getNumberPhotons();
 	
 	//Dataset to graph
 	$_SESSION['data'] = $data;

 	//Open the output screen
 	header("location: ../../etc/views/outputIAGPOL.php");
?>