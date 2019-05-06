<?php

 /**
  * This class represents the Observation and its attributes
  * @author: Lucas Almeida Salvador
  */
 
 class Observation
 {
 	/** Polarization Error on WavePlate 1/2 */
 	private $sigmaP;
 	/** Polarization Error on WavePlate 1/4 */
 	private $sigmaV;
  /**Magnitude Error*/
  private $sigmaM;
 	/** Number of source photons */
 	private $numberPhotons;
 	/** Magnitude of source */
 	private $magnitude;
 	/** Signal to Noise Ratio */
 	private $signalNoiseRatio;
 	/** Number of source pixels */
 	private $numberPixels;
 	/** Number of Aperture Radius to photometry */
 	private $radiusAperture;
 	/** Integration Time or ExposureTime*/
 	private $timeExposure;
 	/** It's a factor to correct possible difference between this ETC results and the real measurements */
 	private $fCalib;

 	/**
 	* Constructor: It sets up the Observation attributes(Fcalib, Magnitude, RadiusAperture, NumberPixels and NumberPhotons)
 	* @param float $q - Quantum Efficiency
 	* @param float $tSky - Sky Transparency
 	* @param float $f0 - flux of a zero magnitude source
 	* @param float $filterWidth - FilterWidth
 	* @param float $effectiveLenght - EffectiveWaveLenght of Filter
 	* @param float $dTel - Telescope's Diameter
 	* @param float $mag - Magnitude of Source
 	* @param float $rap - Aperture Radius to photometry
 	* @param float $plateScale - Plate Scale of Instrument
 	* @param float $fCalib - It's a factor to correct possible difference between this ETC results and the real measurements
 	* @param int $binning - Binning of CCD
 	*/ 
 	function __construct($q, $tSky, $f0, $filterWidth, $effectiveLenght, $dTel , $mag, $rap, $platescale, $fCalib, $binning, $fArea, $tInstr, $tFilter)
 	{
 		$this->setFcalib($fCalib);
 		$this->setMagnitude($mag);
 		$this->setRadiusAperture($rap);
 		$this->setNumberPixels($rap, $platescale, $binning);
 		$this->setNumberPhotons($q, $tSky, $f0, $filterWidth, $effectiveLenght, $dTel , $mag, $fArea,  $tInstr, $tFilter);
 	}
 	/**
 	* It sets up the Error of the linear polarization or sigmaP 
 	* @param int $type - Defines how to calculate SigmaP
 	* @param float $snr - Signal To noise ratio
 	* @param int $nwp - Number of WavePlate Positions
 	* @param float $sigmaP - sigma P (this values is used in Mode SigmaP->Int. Time)
 	*/
 	public function setSigmaP($type, $snr = 0, $nwp = 0, $sigmaP = 0)
 	{
 		// when wave 1/2
 		if($type == 1)
 		{ 
 			$temp = (100/sqrt($nwp))*(1/$snr);
 			$this->sigmaP = $temp;
 		}
 		// when wave 1/4
 		elseif($type == 2)
 		{ 
 			$temp = 100 * ((sqrt(2)/sqrt($nwp)) * (1/$snr));
 			$this->sigmaP = $temp;
 		}
 		// when ETC mode used is SigmaP-> Int. Time
 		else
 		{
 			$this->sigmaP = $sigmaP;	
 		}
 	}
 	/**
 	* It returns the Error of the linear polarization or sigmaP 
 	* @return float $sigmaP - error of linear polarization 
 	*/
 	public function getSigmaP()
 	{
 		return	$this->sigmaP;
 	}
  /**
  *It sets up the Magnitude Error sigmaM
 	*@param float $sigmaM - sigma M (this values is used in Mode SigmaM->Int. Time)
  */
  public function setSigmaM($type, $snr = 0, $nwp = 0, $sigmaM = 0){
    if($type == 1){// when ETC mode used is Int. Time -> SigmaM
      $temp = 1 * $nwp * (1/$snr);
      $this->sigmaM = $temp;
    }

    else
      $this->sigmaM = $sigmaM;

  }

  /**
  *It returns the Magnitude Error
  *@return float $sigmaM - magnitude error
  */
  public function getSigmaM(){
    return $this->sigmaM;
  }
  /**
 	* It sets up the Error of the circular polarization or sigmaV 
 	* @param float $sigmaV - sigmaV
 	*/
 	public function setSigmaV($sigmaV)
 	{
 			$this->sigmaV = $sigmaV;
 	}
 	/**
 	* It returns the Error of the circular polarization 
 	* @return float $sigmaV - SigmaV
 	*/
 	public function getSigmaV()
 	{
 		return $this->sigmaV;
 	}
 	/**
 	* It Sets up the Number of source photons
 	* @param float $q - Quantum Efficiency
 	* @param float $tSky - Sky Transparency
 	* @param float $f0 - flux of a zero magnitude source
 	* @param float $filterWidth - FilterWidth
 	* @param float $effectiveLenght - EffectiveWaveLenght of Filter
 	* @param float $dTel - Telescope's Diameter
 	* @param float $mag - Magnitude of Source
   * @param float $fArea - The fraction of the telescope area that effectively collects photons
   * @param float $tTel - The transmission of the telescope surface
   * @param float $tInstr - the transmission in the instrument
   * @param float $tFilter - The transmission of the filter
 	*/
 	public function setNumberPhotons($q, $tSky, $f0, $filterWidth, $effectiveLenght, $dTel , $mag, $fArea, $tInstr, $tFilter)
 	{/**
    conditions for determining the reflectance value of 
    the telescope, according to filter and diameter chosen.
    */
    if($dTel == 1.60 && $tFilter == 0.65) //telescope reflector diameter 1.60m with U-filter
      $this->numberPhotons = $fArea * 0.81* $tInstr * $tFilter* $this->getFcalib() *  $q * $tSky * 1.18531e10 * $f0 * ($filterWidth/$effectiveLenght) * ($dTel * $dTel) *  pow(10, -0.4*$mag);
    
    else if($dTel == 0.6 && $tFilter == 0.65)//telescope reflector diameter 0.60m with U-filter
      $this->numberPhotons = $fArea * 0.71* $tInstr * $tFilter* $this->getFcalib() *  $q * $tSky * 1.18531e10 * $f0 * ($filterWidth/$effectiveLenght) * ($dTel * $dTel) *  pow(10, -0.4*$mag);

    
    else if($dTel == 1.60 && $tFilter == 0.50)//telescope reflector diameter 0.60m with B-filter
       $this->numberPhotons = $fArea * 0.81* $tInstr * $tFilter* $this->getFcalib() *  $q * $tSky * 1.18531e10 * $f0 * ($filterWidth/$effectiveLenght) * ($dTel * $dTel) *  pow(10, -0.4*$mag);
     
     else if($dTel == 0.6 && $tFilter == 0.50)//telescope reflector diameter 0.60m with B-filter
       $this->numberPhotons = $fArea * 0.71* $tInstr * $tFilter* $this->getFcalib() *  $q * $tSky * 1.18531e10 * $f0 * ($filterWidth/$effectiveLenght) * ($dTel * $dTel) *  pow(10, -0.4*$mag);

    
    else if($dTel == 1.6 && $tFilter == 0.75)//telescope reflector diameter 1.60m with V-filter
       $this->numberPhotons = $fArea * 0.80* $tInstr * $tFilter* $this->getFcalib() *  $q * $tSky * 1.18531e10 * $f0 * ($filterWidth/$effectiveLenght) * ($dTel * $dTel) *  pow(10, -0.4*$mag);

    else if($dTel == 0.60 && $tFilter == 0.75)//telescope reflector diameter 0.60m with V-filter
       $this->numberPhotons = $fArea * 0.78* $tInstr * $tFilter* $this->getFcalib() *  $q * $tSky * 1.18531e10 * $f0 * ($filterWidth/$effectiveLenght) * ($dTel * $dTel) *  pow(10, -0.4*$mag);

    
    else if($dTel == 1.6 && $tFilter == 0.70)//telescope reflector diameter 1.60m with R-filter
       $this->numberPhotons = $fArea * 0.78* $tInstr * $tFilter* $this->getFcalib() *  $q * $tSky * 1.18531e10 * $f0 * ($filterWidth/$effectiveLenght) * ($dTel * $dTel) *  pow(10, -0.4*$mag);

    else if($dTel == 0.6 && $tFilter == 0.70)//telescope reflector diameter 0.60m with R-filter
       $this->numberPhotons = $fArea * 0.75* $tInstr * $tFilter* $this->getFcalib() *  $q * $tSky * 1.18531e10 * $f0 * ($filterWidth/$effectiveLenght) * ($dTel * $dTel) *  pow(10, -0.4*$mag);


    else if($dTel == 1.6 && $tFilter == 0.82)//telescope reflector diameter 1.60m with I-filter
       $this->numberPhotons = $fArea * 0.67* $tInstr * $tFilter* $this->getFcalib() *  $q * $tSky * 1.18531e10 * $f0 * ($filterWidth/$effectiveLenght) * ($dTel * $dTel) *  pow(10, -0.4*$mag);

    else if($dTel == 0.6 && $tFilter == 0.82)//telescope reflector diameter 0.60m with I-filter
       $this->numberPhotons = $fArea * 0.65* $tInstr * $tFilter* $this->getFcalib() *  $q * $tSky * 1.18531e10 * $f0 * ($filterWidth/$effectiveLenght) * ($dTel * $dTel) *  pow(10, -0.4*$mag);

 	}
 	/**
 	* It returns the number of source photons
 	* @return float $numberPhotons - number Photons of source
 	*/
 	public function getNumberPhotons()
 	{
 		return $this->numberPhotons;
 	}
 	/**
 	* It sets up the Magnitude of source
 	* @param float $mag - Magnitude of Source
 	*/
 	public function setMagnitude($mag)
 	{
 		$this->magnitude = $mag;
 	}
 	/**
 	* It returns the Magnitude of source
 	* @return float $magnitude - Magnitude of Source
 	*/
 	public function getMagnitude()
 	{	
 		return $this->magnitude;
 	}
 	/**
 	* It sets up the Signal to Noise Ratio
 	* @param int $type - Type of calculation
 	* @param float $n - Number photons of source
 	* @param float $t - Integration Time
 	* @param float $nPix - number of pixels
 	* @param float $nS - number photons of Sky
 	* @param float $nR - Readout Noise of CCD
 	* @param float $g - Gain of CCD
 	* @param int $binning - Binning of CCD
 	* @param float $k - constant used on Type 2 of calculation
 	* @param float $sigma - Error of Polarization
 	* @param int $nwp - number of WavePlates positions
 	*/
 	public function setSignalNoiseRatio($type, $n = 0, $t = 0, $nPix = 0, $nS = 0, $nR = 0, $g = 0, $binning = 0 , $k = 0, $sigma = 0, $nwp = 0)
 	{
 		//When ETC is in Mode 1 (Int. Time -> Sigma)
 		if($type == 1)
 		{		
 			$this->signalNoiseRatio = $n*$t/sqrt($n*$t+2*$nPix*($nS*$t + $binning * pow($nR,2) + pow(0.289, 2) * pow($g,2))); 	
 		}
 		//When ETC is in Mode 2 (Sigma -> Int. Time)
 		elseif($type==2)
 		{
      $snr = $k * (100/sqrt($nwp)) * (1/$sigma);
      $this->signalNoiseRatio = $snr;
 		}
 	}
 	/**
 	* It returns the Signal to Noise Ratio
 	* @return float $signalNoiseRaio - Signal to Noise Ratio
 	*/	
 	public function getSignalNoiseRatio()
 	{
 		return $this->signalNoiseRatio;
 	}

  /**
  * It sets up the Signal to Noise Ratio from Câmera Direta
  * @param int $type - Type of calculation
  * @param float $n - Number photons of source
  * @param float $t - Integration Time
  * @param float $nPix - number of pixels
  * @param float $nS - number photons of Sky
  * @param float $nR - Readout Noise of CCD
  * @param float $g - Gain of CCD
  * @param int $binning - Binning of CCD
  * @param float $k - constant used on Type 2 of calculation
  * @param float $sigma - Error of Magnitude
  * @param int $nwp - number of WavePlates positions
  */
  public function setSignalNoiseRatioCD($type, $n = 0, $t = 0, $nPix = 0, $nS = 0, $nR = 0, $g = 0, $binning = 0 , $k = 0, $sigma = 0, $nwp = 0)
  {
    //When ETC is in Mode 1 (Int. Time -> Sigma)
    if($type == 1)
    {   
      $this->signalNoiseRatio = $n*$t/sqrt($n*$t+2*$nPix*($nS*$t + $binning * pow($nR,2) + (pow(0.289, 2) * pow($g,2))));   
    }
    //When ETC is in Mode 2 (Sigma -> Int. Time)
    elseif($type==2)
    {
      $snr = (1/$sigma);
      
      $this->signalNoiseRatio = $snr;
    }
  }
  /**
  * It returns the Signal to Noise Ratio
  * @return float $signalNoiseRaio - Signal to Noise Ratio
  */  
  public function getSignalNoiseRatioCD()
  {
    return $this->signalNoiseRatio;
  }

 	/**
 	* It sets up the Number of Pixels 
 	* @param float  $rap - Aperture Radius
 	* @param float $plateScale - Plate Scale of CCD
 	* @param float $binning - Binning of CCD.
 	*/
 	public function setNumberPixels($rap, $platescale, $binning)
 	{
 		$this->numberPixels =  3.14159 * pow(($rap/($platescale * $binning)), 2);
 	}
 	/**
 	* It returns the Number of Pixels
 	* @return float $numberPixels - number pixels Of source
 	*/
 	public function getNumberPixels()
 	{
 		return $this->numberPixels;
 	}
 	/**
 	* It sets up the Aperture Radius 
 	* @param int $rap - Aperture Radius
 	*/
 	public function setRadiusAperture($rap)
 	{
 		$this->radiusAperture = $rap;
 	}
 	/**
 	* It returns the Aperture Radius
 	* @return int $radiusAperture - Aperture Radius
 	*/
 	public function getRadiusAperture()
 	{
 		return $this->radiusAperture;
 	}
 	/**
 	* It sets up the time Exposure or Integration Time
 	* @param int $type - Mode to Calculation Int. Time
 	* @param float $t - Integration Time
 	* @param float $n - Number photons of Source
 	* @param float $snr - Signal to noise ratio
 	* @param float $nPix - Number Pixels of Source
 	* @param float $nS - Number photons of Sky
 	* @param float $nR - ReadoutNoise of CCD
 	* @param float $g - Gain of CCD
 	* @param float $binning - Binning of CCD
 	*/
 	public function setTimeExposure($type,$t = 0, $n=0, $snr = 0, $nPix = 0, $nS = 0, $nR = 0, $g = 0, $binning = 0)
 	{
    //When the ETC is in mode Int. time -> Polarization error
 		if($type==1) 
 		{
 			$this->timeExposure = $t;
 		}
    //When the ETC is in mode Polarization error -> Int. time
 		elseif($type==2)
 		{
 			$a = pow($n,2);
 			$b = -1 * pow($snr,2) * ($n + 2*$nPix * $nS);
 			$c = -2 * $nPix * pow($snr,2) * ($binning * pow($nR,2) + pow(0.289, 2) * pow($g, 2));
 			$t = (-$b + sqrt(pow($b,2) -4 * $a * $c))/(2*$a);
 			
 			$this->timeExposure = $t;
 		}
 	}
 	/**
 	* It returns the time Exposure 
 	* @return float $timeExposure - Exposure Time
 	*/
 	public function getTimeExposure()
 	{
 		return $this->timeExposure;
 	}
  /**
  * It sets up the time Exposure or Integration Time from Câmera Direta
  * @param int $type - Mode to Calculation Int. Time
  * @param float $t - Integration Time
  * @param float $n - Number photons of Source
  * @param float $snr - Signal to noise ratio
  * @param float $nPix - Number Pixels of Source
  * @param float $nS - Number photons of Sky
  * @param float $nR - ReadoutNoise of CCD
  * @param float $g - Gain of CCD
  * @param float $binning - Binning of CCD
  */
  public function setTimeExposureCD($type,$t = 0, $n=0, $snr = 0, $nPix = 0, $nS = 0, $nR = 0, $g = 0, $binning = 0)
  {
    //When the ETC is in mode Int. time -> Magnitude error
    if($type==1) 
    {
      $this->timeExposure = $t;
    }
    //When the ETC is in mode Magnitude error -> Int. time
    elseif($type==2)
    {
      $a = pow($n,2);
      $b = -1 * pow($snr,2) * ($n + 2*$nPix * $nS);
      $c = -2 * $nPix * pow($snr,2) * ($binning * pow($nR,2) + pow(0.289, 2) * pow($g, 2));
      $t = (-$b + sqrt(pow($b,2) -4 * $a * $c))/(2*$a);
      
      $this->timeExposure = $t;
    }
  }
  /**
  * It returns the time Exposure from Câmera Direta
  * @return float $timeExposure - Exposure Time
  */
  public function getTimeExposureCD()
  {
    return $this->timeExposure;
  }
 	/**
 	* It sets up the Fcalib
 	* @param float $value Fcalib
 	*/
 	public function setFcalib($value)
 	{
 		$this->fCalib = $value;
 	}
 	/**
   * It returns the Fcalib
 	* @return float $fCalib - fCalib
 	*/
 	public function getFcalib()
 	{
 		return $this->fCalib;
 	}
 }
?>
